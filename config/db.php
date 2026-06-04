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
        try {
            $pdo = $this->connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $results = $stmt->fetchAll(PDO::FETCH_CLASS);
            return ['status' => 'success', 'data' => $results];
        } catch (PDOException $e) {
            return ['status' => 'error', 'data' => $e->getMessage()];
        }
    }

    public function executeQuery($sql, $params = [])
    {
        try {
            $pdo = $this->connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            return [
                'status' => 'success',
                'lastID' => $pdo->lastInsertId(),
                'affectedRows' => $stmt->rowCount()
            ];
        } catch (PDOException $e) {
            return ['status' => 'error', 'data' => $e->getMessage()];
        }
    }
}
?>