<?php
class delete_post extends AcoreAdmin
{
    protected function obr()
    {
        if($_GET['del']) {
            try {
                $id = (int)$_GET['del'];
                $root = $this->dbh->prepare("SELECT img_root FROM posts WHERE id=$id");
                $root->execute();
                $row = $root->fetch();
                $this->recursiveRemoveDir('./'.$row['img_root']);
                $query = "DELETE FROM posts WHERE id=$id";
                $this->dbh->exec($query);
                $_SESSION['res'] = '<div class="alert alert-danger" role="alert">
                  Удалено!
                </div>';
                header("Location:?option=admin");
                exit;
            } catch(PDOException $e){
                echo 'Ошибка удаления: ' . $e->getMessage();
            }
        }
        else {
            exit("Не верные данные для этой страницы");
        }
    }
    protected function recursiveRemoveDir($dir)
    {
        $includes = glob($dir.'/*');
        foreach ($includes as $include) {
            if(is_dir($include)) {
                recursiveRemoveDir($include);
            } else {
            unlink($include);
            }
        }
        rmdir($dir);
    }
    public function get_content()
    {
        // TODO: Implement get_content() method.
    }
}