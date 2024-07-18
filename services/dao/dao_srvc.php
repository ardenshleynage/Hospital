<?php
include ("../../db/hop_base.php");
include ("../model/model_service.php");

class AddServicesDAO
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

    public function checkIfServiceExists($name_srvc, $des)
    {
        // Préparation de la requête SQL
        $checksql = "SELECT * FROM `services` WHERE `name` = :name_srvc or `des` = :des";
        $checkstmt = $this->bd->prepare($checksql);
        // Liaison des valeurs avec les paramètres de la requête
        $checkstmt->bindParam(':name_srvc', $name_srvc);
        $checkstmt->bindParam(':des', $des);

        // Exécution de la requête
        $checkstmt->execute();

        // Retourne le résultat de la requête
        return $checkstmt->rowCount() > 0;
    }

    public function AddServices(RegService $srvc)
    {
        // Récupération des données de l'utilisateur
        $name_srvc = $srvc->getServiceName();
        $des = $srvc->getServiceDes();


        // Préparation de la requête SQL
        $sql = "INSERT INTO `services` (`name`, `des`,`date`)
                VALUES (:name_srvc,:des,NOW())";
        $istmt = $this->bd->prepare($sql);
        try {
            // Liaison des valeurs avec les paramètres de la requête
            $istmt->bindParam(':name_srvc', $name_srvc);
            $istmt->bindParam(':des', $des);
            // Exécution de la requête
            $istmt->execute();
            return true;

        } catch (PDOException $e) {
            // Si une exception est attrapée, renvoyer l'exception
            throw new Exception("Erreur lors de l'exécution de la requête : " . $e->getMessage());
        }
    }
    // Autres méthodes de la classe PatientSignDAO...
}

class ListServices
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

    public function getAllService()
    {
        $checksql = "SELECT * FROM `services`";
        $checkstmt = $this->bd->prepare($checksql);
        $checkstmt->execute();

        return $checkstmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllServiceNumber()
    {
        $checksql = "SELECT * FROM `services`";
        $checkstmt = $this->bd->prepare($checksql);
        $checkstmt->execute();

        // Utilisation de rowCount() pour obtenir le nombre de lignes retournées par la requête
        $num = $checkstmt->rowCount();
        return $num;
    }

}

class DelServices
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

    public function DeleteService()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST["delete_all_entries"])) {
            $deleteAllSql = $this->bd->prepare("DELETE FROM `services`");
            $deleteAllSql->execute();
            header("location:../view/view_srvc_dash.php");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset ($_POST["delete_entry"])) {
            $entryToDelete = $_POST["delete_entry"];
            $deleteSql = $this->bd->prepare("DELETE FROM `services` WHERE `id` = ?");
            $deleteSql->execute([$entryToDelete]);
            header("location:../view/view_srvc_dash.php");
            exit();
        }


    }

}

class ModServiceDAO
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

    public function modService($id, $name_srvc, $des_srvc)
    {
        $query = "UPDATE `services` SET `name` = :name_srvc, `des` = :des, `date` = NOW() WHERE `id` = :id";
        $stmt = $this->bd->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name_srvc', $name_srvc);
        $stmt->bindParam(':des', $des_srvc);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}


class SearchServiceDAO
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

    public function searchByName($searcha)
    {
        $sql = "SELECT * FROM `services` WHERE `name` LIKE :searcha"; // Utiliser :searcha au lieu de :seacha
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':searcha', $searcha);
        $stmt->execute();

        $searchservices = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $service = new SearchService(); // Typo: 'SeachService' doit être 'SearchService'
            $service->setIdSearchService($row['id']);
            $service->setNameSearchService($row['name']);
            $service->setDescriptionSearchService($row['des']);
            $service->setDateSearchService($row['date']);
            $searchservices[] = $service; // Typo: Utiliser $searchservices au lieu de $services
        }

        return $searchservices;
    }
}


?>