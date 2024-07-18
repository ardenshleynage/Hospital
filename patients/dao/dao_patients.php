<?php
include ("../../db/hop_base.php");
include ("../model/model_patients.php");


class AddPatientDAO
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

    public function checkIfPatientExists($tel_pat)
    {
        // Préparation de la requête SQL
        $checksql = "SELECT * FROM `patient` WHERE `telephone` = :tel";
        $checkstmt = $this->bd->prepare($checksql);
        // Liaison des valeurs avec les paramètres de la requête
        $checkstmt->bindParam(':tel', $tel_pat);

        // Exécution de la requête
        $checkstmt->execute();

        // Retourne le résultat de la requête
        return $checkstmt->rowCount() > 0;
    }

    public function AddEmployee(RegPatient $pat)
    {
        // Récupération des données de l'utilisateur
        $lname_pat = $pat->getpatLnameSign();
        $fname_pat = $pat->getpatFnameSign();
        $sex_pat = $pat->getpatSexSign();
        $dob_pat = $pat->getpatDobSign();
        $pob_pat = $pat->getpatPobSign();
        $ad_pat = $pat->getpatAdresseSign();
        $tel_pat = $pat->getpatTelSign();

        // Préparation de la requête SQL
        $sql = "INSERT INTO `patient` (`nom`, `prenom`,`sexe`,`dob`,`pob`,`service`,`id_service`,`adresse`,`telephone`,`date`)
                VALUES (:lname_pat,:fname_pat,:sex_pat,:dob_pat,:pob_pat,:srvc_pat_name,:srvc_pat_id,:ad_pat,:tel_pat,NOW())";
        $istmt = $this->bd->prepare($sql);
        try {
            // Liaison des valeurs avec les paramètres de la requête
            $istmt->bindParam(':lname_pat', $lname_pat);
            $istmt->bindParam(':fname_pat', $fname_pat);
            $istmt->bindParam(':sex_pat', $sex_pat);
            $istmt->bindParam(':dob_pat', $dob_pat);
            $istmt->bindParam(':dob_pat', $pob_pat);
            $istmt->bindParam(':ad_pat', $ad_pat);
            $istmt->bindParam(':tel_pat', $tel_pat);
            // Exécution de la requête
            $istmt->execute();
            return true;
        } catch (PDOException $e) {
            // Si une exception est attrapée, renvoyer l'exception
            throw new Exception("Erreur lors de l'exécution de la requête : " . $e->getMessage());
        }
    }

}
// Autres méthodes de la classe PatientSignDAO...

class PatientServiceDAO
{
    private $bd;

    public function __construct()
    {
        try {
            $this->bd = Bd::getConection();
        } catch (PDOException $e) {
            // Gérer l'erreur de connexion à la base de données
        }
    }

    public function getIdAndNameServicePatient()
    {
        $services_patient = [];

        try {
            $query = "SELECT id, name FROM services";
            $stmt = $this->bd->prepare($query);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $service = new AddServicepatient($row['id'], $row['name']);
                $services_patient[] = $service;
            }
            return $services_patient;
        } catch (PDOException $e) {
            // Gérer l'erreur de requête SQL
            return [];
        }
    }
}


class ServicePatientDAO
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

    public function getAllServicesPat()
    {
        $servicespat = array();

        // Remplacez cette requête par votre propre logique pour récupérer les données depuis la base de données
        $query = "SELECT `id`, `name` FROM `services`";
        // Préparation de la requête
        $stmt = $this->bd->prepare($query);
        // Exécution de la requête
        $stmt->execute();
        // Récupération des résultats
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $service = new ServicePatient($row['id'], $row['name']);
            $servicespat[] = $service;
        }

        return $servicespat;
    }
}

class ListPatient
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

    public function getAllPatient()
    {
        $checksql = "SELECT * FROM `patient`";
        $checkstmt = $this->bd->prepare($checksql);
        $checkstmt->execute();

        return $checkstmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllPatientNumber()
    {
        $checksql = "SELECT * FROM `patient`";
        $checkstmt = $this->bd->prepare($checksql);
        $checkstmt->execute();

        // Utilisation de rowCount() pour obtenir le nombre de lignes retournées par la requête
        $num_pat = $checkstmt->rowCount();
        return $num_pat;
    }

}

class DelPatient
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

    public function DeletePatient()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_all_entries"])) {
            $deleteAllSql = $this->bd->prepare("DELETE FROM `patient`");
            $deleteAllSql->execute();
            header("location:../view/view_pat_dash.php");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_entry"])) {
            $entryToDelete = $_POST["delete_entry"];
            $deleteSql = $this->bd->prepare("DELETE FROM `patient` WHERE `id` = ?");
            $deleteSql->execute([$entryToDelete]);
            header("location:../view/view_pat_dash.php");
            exit();
        }
    }

}

class ModPatientDAO
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

    public function modEmployee(
        $id,
        $lname_patient,
        $fname_patient,
        $sex_patient,
        $dob_patient,
        $pob_patient,
        $srvc_patient,
        $id_srvc,
        $ad_patient,
        $tel_patient
    ) {
        $query = "UPDATE `patient` SET `nom` = :lname_patient,`prenom` = :fname_patient, `sexe` = :sex_patient, 
        `dob` = :dob_patient,`pob` = :pob_patient,`service` = :srvc_patient,
        `id_service` = :id_srvc,`adresse` = :ad_patient,`telephone` = :tel_patient,`date` = NOW() WHERE `id` = :id";
        $stmt = $this->bd->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':lname_patient', $lname_patient);
        $stmt->bindParam(':fname_patient', $fname_patient);
        $stmt->bindParam(':sex_patient', $sex_patient);
        $stmt->bindParam(':dob_patient', $dob_patient);
        $stmt->bindParam(':pob_patient', $pob_patient);
        $stmt->bindParam(':srvc_patient', $srvc_patient);
        $stmt->bindParam(':id_srvc', $id_srvc);
        $stmt->bindParam(':ad_patient', $ad_patient);
        $stmt->bindParam(':tel_patient', $tel_patient);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

class SearchPatientDAO
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

    public function searchPat($searcha)
    {
        $sql = "SELECT * FROM `patient` 
        WHERE `nom` LIKE :searcha 
        OR `prenom` LIKE :searcha 
        OR `sexe` LIKE :searcha 
        OR `pob` LIKE :searcha 
        OR `service` LIKE :searcha 
        OR `adresse` LIKE :searcha
        OR `telephone` LIKE :searcha";
        // Utiliser :searcha au lieu de :seacha
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':searcha', $searcha);
        $stmt->execute();

        $searchpatient  = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $patient = new Searchpatient(); // Typo: 'SeachService' doit être 'SearchService'
            $patient ->setIdSearchpat($row['id']);
            $patient ->setLnameSearchpat($row['nom']);
            $patient ->setFnameSearchpat($row['prenom']);
            $patient ->setSexSearchpat($row['sexe']);
            $patient -> setPobSearchpat($row['pob']);
            $patient ->setSrvcSearchpat($row['service']);
            $patient ->setAdSearchpat($row['adresse']);
            $patient ->setTelSearchpat($row['telephone']);
            $searchpatient [] = $patient ; // Typo: Utiliser $searchservices au lieu de $services
        }

        return $searchpatient ;
    }
}


?>