<?php
class admin extends AcoreAdmin
{
    protected function get_posts()
    {
        ?>
        <div class="container" style="min-height: 100vh;">
            <h4 class="display-4">Аржааны и озера</h4>
            <a href="?option=add_post"  class="btn btn-success">Добавить</a><br /><br />
            <?php
            if(isset($_SESSION['res'])) {
            echo $_SESSION['res'];
            unset($_SESSION['res']);
            }
            ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Название</th>
                    <th scope="col">Район</th>
                    <th scope="col">Операции</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sth = $this->dbh->prepare("SELECT id,name,description FROM posts WHERE id > 0 ORDER BY date_post desc");
                $sth->execute();
                $array = $sth->fetchAll(PDO::FETCH_ASSOC);
                foreach ($array as $row):
                    echo '<tr>
                <th scope="row">'.$row["id"].'</th>
                <td>'.$row["name"].'</td>
                <td>'.$row["description"].'</td>
                <td>
                    <a href="?option=view_post&id='.$row["id"].'"  class="btn btn-outline-info">Посмотреть</a>
                    <a href="?option=update_post&id_text='.$row["id"].'"  class="btn btn-outline-success">Изменить</a>                     
                    <a href="?option=upload_post&id='.$row["id"].'&name='.$row["name"].'" class="btn btn-outline-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                      <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                      <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                    </svg>
                    </a>&nbsp;&nbsp;
                    <a href="?option=delete_post&del='.$row["id"].'" class="btn btn-outline-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                      <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                    </svg>
                    </a>
                </td>
                </tr>';
                endforeach;
                ?>
                </tbody>
            </table>
        </div>
        </div>
        <?php
    }

    public function get_content()
    {
        $this->get_posts();
    }
}