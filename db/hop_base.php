<?php
class Bd
{
    public static function getConection()
    {
        $db_server = "mysql:host=localhost;dbname=hospital";
        $db_user = "root";
        $db_pass = "";
        $PDO = "";
        
        try {
            $PDO = new PDO($db_server, $db_user, $db_pass);
            
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        return $PDO;
    }
}
?>