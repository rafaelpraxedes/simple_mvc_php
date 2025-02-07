<?php 

// app/orm/Database.php
namespace App\ORM;

use PDO;

class Database {
    
    private static $host = "localhost";
    private static $db_name = "crm_app_db";
    private static $username = "crm_app_admin";
    private static $password = "G0q9hO&Dj1(FzXIM8NrkfFXp";
    private static $conn;
    
    public static function getConnection() {
        
        if (self::$conn === null) {
            try {
                self::$conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db_name, self::$username, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
    
}

?>