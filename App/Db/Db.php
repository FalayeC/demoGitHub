<?php
namespace App\Db;

use PDO;
use PDOException;

class Db extends PDO
{
    // Instance unique de la classe
    private static $instance = null;

    // Informations de connexion
    private const DBHOST = 'localhost';
    private const DBUSER = 'root';
    private const DBPASS = '';
    private const DBNAME = 'bi';

    // Constructeur privé pour empêcher l'instanciation directe
    private function __construct()
    {
        // DSN de connexion
        $dsn = 'mysql:dbname=' . self::DBNAME . ';host=' . self::DBHOST;

        // On appelle le constructeur de la classe PDO
        try {
            parent::__construct($dsn, self::DBUSER, self::DBPASS);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Database connection error: ' . $e->getMessage());
        }
    }

    // Méthode pour obtenir l'instance unique de Db
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
?>