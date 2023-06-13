<?php

class update_post extends AcoreAdmin
{
    protected function obr()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description= $_POST['description'];
        $text = $_POST['text'];
        $date = date("Y-m-d H:i:s",time());

        if(empty($name) || empty($text) || empty($description)) {
            exit("Не заполнены обязательные поля");
        }
        try {
            $query = " UPDATE  posts 
                    SET name='$name',text='$text',description='$description',date_post='$date'
                    WHERE id='$id'";
            $this->dbh->exec($query);
            $_SESSION['res'] = '<div class="alert alert-warning" role="alert">
                Обновлено!
            </div>';
            header("Location:?option=admin");
            exit;
        } catch (PDOException $e){
            echo 'Ошибка БД: ' . $e->getMessage();
        }
    }
    public function get_content()
    {
        if($_GET['id_text']) {
            $id_text = (int)$_GET['id_text'];
        }
        else {
            exit('НЕ правильные данные для этой страницы');
        }

        $text = $this->get_text_post($id_text);
        ?>
        <form enctype='multipart/form-data' action='' method='POST'>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Название</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="<?= $text[0] ?>">
                <input type='hidden' name='id' style='width:420px;' value="<?= $text[1] ?>">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput2" class="form-label">Район</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="description" value="<?= $text[2] ?>">
            </div>
            <div class="mb-3">
                <textarea id="summernote" name="text"><?= $text[3] ?></textarea>
            </div>
            <div class="d-flex mb-3">
                <button type="submit" class="btn btn-success mb-3">Обновить</button>
                &nbsp;
                <a href='?option=admin'>
                    <button type="button" class='btn btn-secondary'>Отмена</button>
                </a>
            </div>
        </form>
<?php
    }
}