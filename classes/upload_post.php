<?php

class upload_post extends AcoreAdmin
{
    protected function obr()
    {
        // File upload.php
// Если в $_FILES существует "images" и она не NULL
        if (isset($_FILES['images'])) {
            // Изменим структуру $_FILES
            foreach($_FILES['images'] as $key => $value) {
                foreach($value as $k => $v) {
                    $_FILES['images'][$k][$key] = $v;
                }
                // Удалим старые ключи
                unset($_FILES['images'][$key]);
            }
            $id = isset($_POST['id']) ? (int)$_POST['id'] : false;
            $root = $this->dbh->prepare("SELECT img_root FROM posts WHERE id=$id");
            $root->execute();
            $row = $root->fetch();
            $dir = $row["img_root"];
            $i = 1;
            // Открыть известный каталог и начать считывать его содержимое
            if (is_dir('./'.$dir)) {
                if ($dh = opendir('./'.$dir)) {
                    if(count(scandir('./'.$dir.'/'))!=2){
                        $i-=2;
                        while (readdir($dh) !== false) {
                            $i++;
                        }
                    }
                    closedir($dh);
                }
            }

            // Загружаем все картинки по порядку
            foreach ($_FILES['images'] as $k => $v) {
                // Загружаем по одному файлу
                $fileName = $_FILES['images'][$k]['name'];
                $fileTmpName = $_FILES['images'][$k]['tmp_name'];
                $fileType = $_FILES['images'][$k]['type'];
                $fileSize = $_FILES['images'][$k]['size'];
                $errorCode = $_FILES['images'][$k]['error'];

                // Проверим на ошибки
                if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($fileTmpName)) {
                    // Массив с названиями ошибок
                    $errorMessages = [
                        UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
                        UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
                        UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
                        UPLOAD_ERR_NO_FILE    => 'Файл не был загружен.',
                        UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
                        UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
                        UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла.',
                    ];
                    // Зададим неизвестную ошибку
                    $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';
                    // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
                    $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;
                    // Выведем название ошибки
                    die($outputMessage);
                } else {
                    // Создадим ресурс FileInfo
                    $fi = finfo_open(FILEINFO_MIME_TYPE);
                    // Получим MIME-тип
                    $mime = (string) finfo_file($fi, $fileTmpName);
                    // Проверим ключевое слово image (image/jpeg, image/png и т. д.)
                    if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');
                    // Результат функции запишем в переменную
                    $image = getimagesize($fileTmpName);
                    // Зададим ограничения для картинок
                   /* $limitBytes  = 1024 * 1024 * 5;
                    $limitWidth  = 1280;
                    $limitHeight = 768;
                    // Проверим нужные параметры
                    if (filesize($fileTmpName) > $limitBytes) die('Размер изображения не должен превышать 5 Мбайт.');
                    if ($image[1] > $limitHeight)             die('Высота изображения не должна превышать 768 точек.');
                    if ($image[0] > $limitWidth)              die('Ширина изображения не должна превышать 1280 точек.');
                   */
                   // Сгенерируем новое имя файла через функцию getRandomFileName()
                    $name = 'blog-'.$i++;
                    // Сгенерируем расширение файла на основе типа картинки
                    $extension = image_type_to_extension($image[2]);
                    // Сократим .jpeg до .jpg
                    $format = str_replace('jpeg', 'jpg', $extension);
                    // Переместим картинку с новым именем и расширением в папку
                    if (!move_uploaded_file($fileTmpName, './'. $dir.'/' . $name . $format)) {
                        die('При записи изображения на диск произошла ошибка.');
                    }
                }
            };
            $_SESSION['res']='<div class="alert alert-primary" role="alert">
                                Файлы успешно загружены!
                            </div>';
            header('Location:?option=admin');
        };
    }
    public function get_content()
    {
        ?>
        <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <h5>Загрузка файлов для "<?= $_GET['name']?>"</h5>
            </div>
            <div class="mb-3">
                <label for="formFileMultiple" class="form-label">Загрузить изображения</label>
                <input class="form-control" type="file" id="formFileMultiple" name="images[]" multiple>
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Загрузить</button>
            </div>
        </form>
<?php
        $root = $this->dbh->prepare("SELECT img_root FROM posts WHERE id=".$_GET['id']);
        $root->execute();
        $row = $root->fetch();
        $dir = $row["img_root"];
        $i = 1;
        // Открыть известный каталог и начать считывать его содержимое
        echo '<div class="container"><div class="d-flex flex-wrap">';
        foreach(glob('./'.$dir.'/*.jpg') as $filename) {
            ?>
            <div class="card" style="width: 18rem;">
                <img src="<?= $filename ?>" class="card-img-top" alt="<?= basename($filename) ?>">
                <div class="card-body">
                    <p class="card-text">
                        Название: <?= basename($filename) ?> <br />
                        Размер файла: <?= filesize($filename) ?>
                    </p>
                </div>
            </div>
<?php
        }
        echo '</div></div>';
    }
}