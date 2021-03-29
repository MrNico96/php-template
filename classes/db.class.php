<?php
define('DB_HOST', $_SERVER['DB_HOST']);
define('DB_NAME', $_SERVER['DB_NAME']);
define('DB_USER', $_SERVER['DB_USER']);
define('DB_PASS', $_SERVER['DB_PASS']);
class DB
{
    private $host = DB_HOST;
    private $database = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;

    public function credentials($host, $database, $username, $password)
    {
        $this->host = $host;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
    }

    public function connect()
    {
        $dsn = 'mysql:host=' . $this->host . '; dbname=' . $this->database;
        try {
            $pdo = new PDO($dsn, $this->username, $this->password);
        } catch (Exception $e) {
            if (PROJECT_MODE === 'development') {
                die('E.01: Failure. ' . $e->getMessage());
            } else {
                die('E.01: Failure');
            }
        }
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }
}