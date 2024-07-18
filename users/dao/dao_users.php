<?php
include ("../../db/hop_base.php"); // Assurez-vous que ce chemin est correct
include ("../models/models_users.php");


class LogUsersDAO
{
    private $bd;

    public function __construct()
    {
        try {
            $this->bd = Bd::getConection();
        } catch (PDOException $e) {
            // En cas d'erreur de connexion, renvoyer une exception
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
    public function getUsersByPseudoAndPassword($pseudo)
    {
        $stmt = $this->bd->prepare("SELECT * FROM `users` WHERE `pseudo` = :pseudo");
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            // Vérification du statut de l'utilisateur
            if ($result['statut'] == 1) { // Vérifie si le statut est égal à 1
                return new LogUsers($result['pseudo'], $result["password"], $result["statut"]);
            } else {
                return false; // L'utilisateur n'a pas accès si le statut est différent de 1
            }
        } else {
            return false;
        }
    }
}
class ServiceDash
{
    private $bd;

    public function __construct()
    {
        try {
            $this->bd = Bd::getConection();
        } catch (PDOException $e) {
            // En cas d'erreur de connexion, renvoyer une exception
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }


    public function ServiceNumber()
    {
        $checksql = "SELECT * FROM `services`";
        $checkstmt = $this->bd->prepare($checksql);
        $checkstmt->execute();

        // Utilisation de rowCount() pour obtenir le nombre de lignes retournées par la requête
        $num = $checkstmt->rowCount();
        return $num;
    }

}


?>