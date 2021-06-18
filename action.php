<?php
$username = "root";
$password = "root";
$connection = new PDO('mysql:host = bsu;dbname=bsu_test', $username, $password);
$connection->exec("SET CHARACTER SET utf8");

if (isset($_POST["action"])) {
    if ($_POST["action"] == "Load") {
        $statement = $connection->prepare("SELECT * FROM user");
        $statement->execute();
        $result = $statement->fetchAll();
        $output = "";
        $output = '
        <table class="table table-bordered">
        <tr>
        <th width="15%">Фамилия</th>
        <th width="15%">Имя</th>
        <th width="15%">Отчетство</th>
        <th width="15%">Email</th>
        <th width="15%">Страна</th>
        <th width="10%">Город</th>
        <th width="10%">Логин</th>
        <th width="5%">Пароль</th>
</tr>';
        if ($statement->rowCount() > 0) {
            foreach ($result as $row) {
                $output .= '
                <tr>
                <td>' . $row["surname"] . '</td>
                <td>' . $row["name"] . '</td>
                <td>' . $row["midname"] . '</td>
                <td>' . $row["email"] . '</td>
                <td>' . $row["country"] . '</td>
                <td>' . $row["city"] . '</td>
                <td>' . $row["login"] . '</td>
                <td>' . $row["password"] . '</td>
                <td><button type="button" id= "' . $row["id"] . '" class="btn btn-warning btn-xs update">Обновить</button></td>
               <td><button type="button" id= "' . $row["id"] . '" class="btn btn-danger btn-xs delete">Удалить</button></td>
                </tr>';
            }
        } else {
            $output .= '
            <tr>
            <td align="center">Данных нет</td>
            </tr>';
        }
        $output .= "</table>";
        echo $output;
    }

    if ($_POST['action'] == "Добавить") {
        $statement = $connection->prepare("INSERT INTO user (surname,name,midname,email,country,city,login,password) VALUES(:surname,:name,:midname,:email,:country,:city,:login,:password)");
        $result = $statement->execute(array(':surname' => $_POST["surname"],
                ':name' => $_POST["name"],
                ':midname' => $_POST["midname"],
                ':email' => $_POST["email"],
                ':country' => $_POST["country"],
                ':city' => $_POST["city"],
                ':login' => $_POST["login"],
                ':password' => $_POST["password"],
            )
        );
        if (!empty($result)) {
            echo "Данные записаны";
        }
    }

    if ($_POST["action"] == "Select") {
        $output = array();
        $statement = $connection->prepare(
            "Select * from user where id = '" . $_POST["id"] . "' Limit 1"
        );
        $statement->execute();
        $result = $statement->fetchAll();
        foreach ($result as $row) {
            $output["surname"] = $row["surname"];
            $output["name"] = $row["name"];
            $output["midname"] = $row["midname"];
            $output["email"] = $row["email"];
            $output["country"] = $row["country"];
            $output["city"] = $row["city"];
            $output["login"] = $row["login"];
            $output["password"] = $row["password"];
        }
        echo json_encode($output);
    }
    if ($_POST["action"] == "Обновить") {
        $statement = $connection->prepare(
            "UPDATE user set surname = :surname,name = :name,midname = :midname,email = :email,country = :country,city = :city,login = :login,password = :password where id = :id"
        );
        $result = $statement->execute(
            array(':surname' => $_POST["surname"],
                ':name' => $_POST["name"],
                ':midname' => $_POST["midname"],
                ':email' => $_POST["email"],
                ':country' => $_POST["country"],
                ':city' => $_POST["city"],
                ':login' => $_POST["login"],
                ':password' => $_POST["password"],
                ':id' => $_POST["id"],
            )
        );
        if (!empty($result)) {
            echo "Данные обновлены";
        }
    }
    if ($_POST["action"] == "Delete") {
        $statement = $connection->prepare(
            "Delete from user where id = :id"
        );
        $result = $statement->execute(
            array(
                ':id' => $_POST ['id']
            )
        );
        if (!empty($result)) {
            echo "Данные удалены";
        }
    }

}
?>