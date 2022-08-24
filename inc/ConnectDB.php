<?php



class ConnectDB
{
    public function connect()
    {
        if ($this->pdo === null) {
            try {
                $this->pdo = new PDO(
                    'mysql:host=localhost;dbname=netfix',
                    'root',
                    '',
                    array(
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
                );
            } catch(PDOException $e) {
                echo "Erreur SQL :", $e->getMessage();
            }
        }
        return $this->pdo;
    }
    protected $pdo = null;
}
