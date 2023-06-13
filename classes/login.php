<?php
class login extends ACore {
    protected function obr() {
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);

        if(!empty($email) AND !empty($password)) {
            $sth = $this->dbh->prepare("SELECT * 
                                    FROM users_lakes 
                                    WHERE email = '$email' AND password = '$password' AND status = 1");
            $sth->execute();

            if($sth->rowCount() == 1) {
                $_SESSION['user'] = TRUE;
                header("Location:?option=admin");
                exit();
            }
            else {
                exit("Такого пользователя нет");
            }

        }
        else {
            exit("Заполните обязательные поля");
        }
    }


    public function get_content() {

 print <<<HEREDOC

<form class="row g-3" method="post" action="" style="width: 300px; height: auto; padding: 15px; margin: 100px auto; border: 1px solid #f1a899; border-radius: 10px;">
    <div class="col-auto">
        <h6 style="text-align: center; text-transform: uppercase;">Авторизация</h6>
        <label for="staticEmail2">Эл.почта</label>
        <input type="text" class="form-control" id="staticEmail2" name="email">
        <label for="inputPassword2">Пароль</label>
        <input type="password" class="form-control" id="inputPassword2" placeholder="Password" name="password"><br />
        <button type="submit" class="btn btn-primary mb-3">Войти</button>
    </div>
</form>

HEREDOC;
    }
}

/*
 * INSERT INTO
		`users`
	SET
		`email` = 'alexbolshak05@gmail.com',
		`password` = AES_ENCRYPT('12345', 'MyKey'),
        `nickname` = 'alex',
        `status` = 1

SELECT
		*,
		AES_DECRYPT(`text`, :key) AS `text`
	FROM
		`table`
	WHERE
		`id` = 1

SELECT CONCAT('ALTER TABLE `', t.`TABLE_SCHEMA`, '`.`', t.`TABLE_NAME`, '` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;') as sqlcode
FROM `information_schema`.`TABLES` t
WHERE 1
AND t.`TABLE_SCHEMA` = 'arzhaany'
ORDER BY 1
 * */
?>