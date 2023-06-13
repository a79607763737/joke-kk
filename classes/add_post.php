<?php
class add_post extends AcoreAdmin
{
    protected function obr()
    {
        $name = $_POST['name'];
        $description= $_POST['description'];
        $text = $_POST['text'];
        mkdir("./img/blog/".$_POST['img_root'], 0700);
        $img_root = 'img/blog/'.$_POST['img_root'];
        $date = date("Y-m-d",time());

        if(empty($name) || empty($text) || empty($description) || empty($img_root)) {
            exit("Не заполнены обязательные поля");
        }
        try {
            $query = " INSERT INTO posts
						(name,text,description,img_root,date_post)
					VALUES ('$name','$text','$description','$img_root','$date')";
            $this->dbh->exec($query);
            $_SESSION['res'] = '<div class="alert alert-success" role="alert">
                Добавлено!
            </div>';
            header("Location:?option=admin");
            exit;
        } catch (PDOException $e){
            echo 'Ошибка БД: ' . $e->getMessage();
        }

    }
    public function get_content()
    {
?>
        <form enctype='multipart/form-data' action='' method='POST'>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Название</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="name">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput2" class="form-label">Район</label>
                <input type="text" class="form-control" id="exampleFormControlInput2" name="description">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput3" class="form-label">Папка для загрузки изображений (именовать на латинице)</label>
                <input type="text" class="form-control" id="exampleFormControlInput3" name="img_root">
            </div>
            <div class="mb-3">
                <textarea id="summernote" name="text"></textarea>
            </div>
            <div class="d-flex mb-3">
                <button type="submit" class="btn btn-success mb-3">Добавить</button>
                &nbsp;&nbsp;
                <a href='?option=admin'>
                    <button type="button" class='btn btn-secondary'>Отмена</button>
                </a>
            </div>
        </form>


<?php
    }
}