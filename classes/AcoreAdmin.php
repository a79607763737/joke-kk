<?php
abstract class AcoreAdmin
{
    protected $dbh;

    public function __construct()
    {
        if(!$_SESSION['user']) {
            header("Location:?option=login");
        }
        $dsn = 'mysql:dbname=' . DB . ';host=' . HOST;
        $user = USER;
        $password = PASS;
        try {
            $this->dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    protected function get_header()
    {
        include "header_admin.php";
    }
    protected function get_footer()
    {
        include "footer_admin.php";
    }
    protected function get_sidebar(){
        ?>
        <div class="d-flex flex-row mb-3">
            <div class="flex-shrink-0 p-3" style="width: 280px;">
                <a href="?option=admin" class="d-flex align-items-center pb-3 mb-3 link-body-emphasis text-decoration-none border-bottom">
                    <svg class="bi pe-none me-2" width="30" height="24"><use xlink:href="admin.php"/></svg>
                    <span class="fs-5 fw-semibold"><img src="img/logos.png" alt=""></span>
                </a>
                <ul class="list-unstyled ps-0">
                    <li class="mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                            Главная
                        </button>
                        <div class="collapse show" id="home-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Обзор</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Обновления</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Отчеты</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                            Редактирование
                        </button>
                        <div class="collapse" id="dashboard-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Контент</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Турбазы</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Пользователи</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Прочее</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                            Бронирование
                        </button>
                        <div class="collapse" id="orders-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Новые</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">В процессе</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Завершенные</a></li>
                                <li><a href="#" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Отмененные</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="border-top my-3"></li>
                    <li class="mb-1">
                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                            Аккаунт
                        </button>
                        <div class="collapse" id="account-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Новое</a></li>
                                <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Профиль</a></li>
                                <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Настройки</a></li>
                                <li><a href="logout.php" class="link-dark d-inline-flex text-decoration-none rounded">Выход</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        <?php
    }

    public function get_body()
    {
        if($_POST || isset($_GET['del'])) {
            $this->obr();
        }
        $this->get_header();
        $this->get_sidebar();
        $this->get_content();
        $this->get_footer();
    }
    abstract function get_content();
    protected function get_text_post($id) {
        try{
            $sth = $this->dbh->prepare("SELECT name,id,description,text FROM posts WHERE id='$id'");
            $sth->execute();
            $array = $sth->fetch(PDO::FETCH_ASSOC);
            $row = array();
            foreach ($array as $value){
                $row[] = $value;
            }
            return $row;
        } catch (PDOException $e){
            echo 'Ошибка добавления записи: ' . $e->getMessage();
        }
    }
}