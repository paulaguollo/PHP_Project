<?php
class Database
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "grove";

    private function connect()
    {
        return new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbname . ";charset=utf8", $this->username, $this->password);
    }

    public function fetchQuery($sql, $params = [])
    {
        $pdo = $this->connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function executeQuery($sql, $params = [])
    {
        $pdo = $this->connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount();
    }
}
?>