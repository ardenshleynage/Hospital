<?php
include ("../../db/hop_base.php");
include ("../models/model_emp.php");


class AddEmployeeDAO
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

    public function checkIfEmployeeExists($email_emp, $tel_emp)
    {
        // Préparation de la requête SQL
        $checksql = "SELECT * FROM `employee` WHERE `email` = :email OR `telephone` = :tel";
        $checkstmt = $this->bd->prepare($checksql);
        // Liaison des valeurs avec les paramètres de la requête
        $checkstmt->bindParam(':email', $email_emp);
        $checkstmt->bindParam(':tel', $tel_emp);

        // Exécution de la requête
        $checkstmt->execute();

        // Retourne le résultat de la requête
        return $checkstmt->rowCount() > 0;
    }

    public function AddEmployee(RegEmployee $emp)
    {
        // Récupération des données de l'utilisateur
        $lname_emp = $emp->getEmpLnameSign();
        $fname_emp = $emp->getEmpFnameSign();
        $sex_emp = $emp->getEmpSexSign();
        $email_emp = $emp->getEmpEmailSign();
        $age_emp = $emp->getEmpAgeSign();
        $tel_emp = $emp->getEmpTelSign();
        $role_emp = $emp->getEmpRoleSign();

        // Préparation de la requête SQL
        $sql = "INSERT INTO `employee` (`nom`, `prenom`,`sexe`,`email`,`age`,`telephone`,`role`,`date`)
                VALUES (:lname_emp,:fname_emp,:sex_emp,:email_emp,:age_emp,:tel_emp,:srvc_emp_name,:srvc_emp_id,:role_emp,NOW())";
        $istmt = $this->bd->prepare($sql);
        try {
            // Liaison des valeurs avec les paramètres de la requête
            $istmt->bindParam(':lname_emp', $lname_emp);
            $istmt->bindParam(':fname_emp', $fname_emp);
            $istmt->bindParam(':sex_emp', $sex_emp);
            $istmt->bindParam(':email_emp', $email_emp);
            $istmt->bindParam(':age_emp', $age_emp);
            $istmt->bindParam(':tel_emp', $tel_emp);
            $istmt->bindParam(':role_emp', $role_emp);
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

class EmployeeServiceDAO
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

    public function getIdAndNameService()
    {
        $services_employee = [];

        try {
            $query = "SELECT id, name FROM services";
            $stmt = $this->bd->prepare($query);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $service = new AddServiceEmployee($row['id'], $row['name']);
                $services_employee[] = $service;
            }

            return $services_employee;
        } catch (PDOException $e) {
            // Gérer l'erreur de requête SQL
            return [];
        }
    }
}


class ServiceEmployeeDAO
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

    public function getAllServicesEmp()
    {
        $servicesemp = array();

        // Remplacez cette requête par votre propre logique pour récupérer les données depuis la base de données
        $query = "SELECT `id`, `name` FROM `services`";
        // Préparation de la requête
        $stmt = $this->bd->prepare($query);
        // Exécution de la requête
        $stmt->execute();
        // Récupération des résultats
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $service = new ServiceEmployee($row['id'], $row['name']);
            $servicesemp[] = $service;
        }

        return $servicesemp;
    }
}

class ListEMployee
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

    public function getAllEmployee()
    {
        $checksql = "SELECT * FROM `employee`";
        $checkstmt = $this->bd->prepare($checksql);
        $checkstmt->execute();

        return $checkstmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllEmployeeNumber()
    {
        $checksql = "SELECT * FROM `employee`";
        $checkstmt = $this->bd->prepare($checksql);
        $checkstmt->execute();

        // Utilisation de rowCount() pour obtenir le nombre de lignes retournées par la requête
        $num_emp = $checkstmt->rowCount();
        return $num_emp;
    }

}

class DelEmployee
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

    public function DeleteEmployee()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_all_entries"])) {
            $deleteAllSql = $this->bd->prepare("DELETE FROM `employee`");
            $deleteAllSql->execute();
            header("location:../view/view_emp_dash.php");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_entry"])) {
            $entryToDelete = $_POST["delete_entry"];
            $deleteSql = $this->bd->prepare("DELETE FROM `employee` WHERE `id` = ?");
            $deleteSql->execute([$entryToDelete]);
            header("location:../view/view_emp_dash.php");
            exit();
        }
    }

}

class ModEmployeeDAO
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
        $lname_employee,
        $fname_employee,
        $sex_employee,
        $email_employee,
        $age_employee,
        $tel_employee,
        $srvc_employee,
        $id_srvc,
        $role_employee
    ) {
        $query = "UPDATE `employee` SET `nom` = :lname_employee,`prenom` = :fname_employee, `sexe` = :sex_employee, 
        `email` = :email_employee,`age` = :age_employee,`telephone` = :tel_employee,
        `service` = :srvc_employee,`id_service` = :id_srvc,`role` = :role_employee,`date` = NOW() WHERE `id` = :id";
        $stmt = $this->bd->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':lname_employee', $lname_employee);
        $stmt->bindParam(':fname_employee', $fname_employee);
        $stmt->bindParam(':sex_employee', $sex_employee);
        $stmt->bindParam(':email_employee', $email_employee);
        $stmt->bindParam(':age_employee', $age_employee);
        $stmt->bindParam(':tel_employee', $tel_employee);
        $stmt->bindParam(':srvc_employee', $srvc_employee);
        $stmt->bindParam(':id_srvc', $id_srvc);
        $stmt->bindParam(':role_employee', $role_employee);
        $stmt->bindParam(':lname_employee', $lname_employee);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

class SearchEmployeeDAO
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

    public function searchEmp($searcha)
    {
        $sql = "SELECT * FROM `employee` 
        WHERE `nom` LIKE :searcha 
        OR `prenom` LIKE :searcha 
        OR `sexe` LIKE :searcha 
        OR `email` LIKE :searcha 
        OR `age` LIKE :searcha 
        OR `telephone` LIKE :searcha 
        OR `service` LIKE :searcha 
        OR `role` LIKE :searcha";
        // Utiliser :searcha au lieu de :seacha
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':searcha', $searcha);
        $stmt->execute();

        $searchemployee = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $employee = new SearchEmp(); // Typo: 'SeachService' doit être 'SearchService'
            $employee->setIdSearchEmp($row['id']);
            $employee->setLnameSearchEmp($row['nom']);
            $employee->setFnameSearchEmp($row['prenom']);
            $employee->setSexSearchEmp($row['sexe']);
            $employee->setEmailSearchEmp($row['email']);
            $employee->setAgeSearchEmp($row['age']);
            $employee->setTelSearchEmp($row['telephone']);
            $employee->setSrvcSearchEmp($row['service']);
            $employee->setRolSearchEmp($row['role']);
            $searchemployee[] = $employee; // Typo: Utiliser $searchservices au lieu de $services
        }

        return $searchemployee;
    }
}


?>