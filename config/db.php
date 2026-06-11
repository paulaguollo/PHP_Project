<?php
//comunicação com a base de dados

class Database
{
    //dados para acessar o MySQL (usei via terminal)
    private $servername = "localhost";
    private $username = "root";
    private $password = ""; //sem senha. apenas dê um enter
    private $dbname = "grove";

    private function connect()
    {
        return new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbname . ";charset=utf8", $this->username, $this->password);
    }

    //buscar dados
    public function fetchQuery($sql, $params = [])
    {
        try {
            $pdo = $this->connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //se der erro, comunica
            $stmt = $pdo->prepare($sql); //query
            $stmt->execute($params); //executa considerando o parametro escolhido 
            $results = $stmt->fetchAll(PDO::FETCH_CLASS); //pega todos os resultados
            return ['status' => 'success', 'data' => $results];
        } catch (PDOException $e) {
            return ['status' => 'error', 'data' => $e->getMessage()];
        }
    }

    //função usada pro CRUD
    public function executeQuery($sql, $params = [])
    {
        try {
            $pdo = $this->connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            return [
                'status' => 'success',
                'lastID' => $pdo->lastInsertId(), //add novo id para novo registro 
                'affectedRows' => $stmt->rowCount() //diz quantas linhas foram alteradas, se teve update ou delete
            ];
        } catch (PDOException $e) {
            return ['status' => 'error', 'data' => $e->getMessage()];
        }
    }
}
//fetchQuery e executeQuery) usam prepared statements (o prepare() + execute($params)). 
// Isto é uma proteção contra um ataque chamado SQL Injection 
// alguém não consegue "injetar" código malicioso através de um formulário,
//  porque os valores nunca são colados diretamente na query, são sempre tratados como dados.
?>

