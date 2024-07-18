<?php
include ("../dao/dao_emp.php");

// Fonction pour valider le prénom
function validate_lname_emp($lname_emp)
{
    return preg_match('/^[a-zA-Z]+(?:-[a-zA-Z]+)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?$/', $lname_emp);
}

// Fonction pour valider le prénom
function validate_fname_emp($fname_emp)
{
    return preg_match('/^[a-zA-Z]+(?:-[a-zA-Z]+)*(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?$/', $fname_emp);
}

// Fonction pour valider le numéro de téléphone (8 chiffres)
function validate_tel_emp($tel_emp)
{
    return is_numeric($tel_emp) && strlen($tel_emp) === 8;
}
function validate_age_emp($age_emp)
{
    return is_numeric($age_emp) && $age_emp >= 20;
}
function validate_email_emp($email_emp)
{
    return filter_var($email_emp, FILTER_VALIDATE_EMAIL);
}
function validate_role_emp($role_emp)
{
    return preg_match('/^[a-zA-Z]+(?:-[a-zA-Z]+)*(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?$/', $role_emp);
}


// Création de l'objet ServiceEmployeeDAO
$serviceEmployeeDAO = new ServiceEmployeeDAO();

// Récupération de tous les services
$allservices = $serviceEmployeeDAO->getAllServicesEmp();

// Récupération de l'ID du service sélectionné dans le formulaire


// Récupération du nom du service correspondant à l'ID


// Création d'un nouvel employé avec les données du formulaire


// Ajout de l'employé en utilisant la méthode existante AddEmployee()




session_start();
$errors = false;
$errors1 = false;
$errors2 = false;
$errors3 = false;
$errors4 = false;

// Assurez-vous d'avoir une connexion à votre base de données avant d'exécuter ce code

// Assurez-vous d'avoir une connexion à votre base de données avant d'exécuter ce code
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lname_emp = $_POST["lname_emp"];
    $fname_emp = $_POST["fname_emp"];
    $sex_emp = $_POST["sex_emp"];
    $email_emp = filter_input(INPUT_POST, "email_emp", FILTER_VALIDATE_EMAIL);
    $age_emp = filter_input(INPUT_POST, "age_emp", FILTER_SANITIZE_NUMBER_INT);
    $tel_emp = filter_input(INPUT_POST, "tel_emp", FILTER_SANITIZE_NUMBER_INT);

    $role_emp = $_POST["role_emp"];

    // Validation des champs
    if (
        !empty($lname_emp) && validate_lname_emp($lname_emp) &&
        !empty($fname_emp) && validate_fname_emp($fname_emp) &&
        validate_tel_emp($tel_emp) && validate_age_emp($age_emp) && validate_email_emp($email_emp)
        && validate_role_emp($role_emp)
    ) {
        // Assurez-vous d'avoir une connexion à votre base de données avant d'exécuter ce code
        if (isset($_POST['srvc_emp'])) {
            // Récupérer l'ID et le nom de l'option sélectionnée
            $selectedId = $_POST['srvc_emp'];
            $selectedName = "";

            // Parcourir les options pour trouver le nom correspondant à l'ID sélectionné
            foreach ($allservices as $service) {
                if ($service->getServiceEmpId() == $selectedId) {
                    $selectedName = $service->getServiceEmpName();
                    break;
                }
            }

            // Utilisez $selectedId et $selectedName comme vous le souhaitez
            // Vérifier si l'utilisateur est déjà présent dans la table employee
            $pdo = new PDO('mysql:host=localhost;dbname=hospital', 'root', '');
            $checkSql = "SELECT COUNT(*) FROM employee WHERE email = :email_emp OR telephone = :tel_emp";
            $checkStmt = $pdo->prepare($checkSql);
            $checkStmt->bindParam(':email_emp', $email_emp);
            $checkStmt->bindParam(':tel_emp', $tel_emp);
            $checkStmt->execute();
            $userExists = $checkStmt->fetchColumn();

            if ($userExists) {
                $errors3 = true;
                if (isset($errors3) && $errors3) {
                    header("location:../view/error_exist_emp.php");
                }
            } else {
                // Mettre à jour la table employee avec les valeurs récupérées
                $sql = "INSERT INTO `employee` (`nom`, `prenom`,`sexe`,`email`,`age`,`telephone`,`id_service`,`service`,`role`,`date`)
                VALUES (:lname_emp,:fname_emp,:sex_emp,:email_emp,:age_emp,:tel_emp,:selectedId,:selectedName,:role_emp,NOW())";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':lname_emp', $lname_emp);
                $stmt->bindParam(':fname_emp', $fname_emp);
                $stmt->bindParam(':sex_emp', $sex_emp);
                $stmt->bindParam(':email_emp', $email_emp);
                $stmt->bindParam(':age_emp', $age_emp);
                $stmt->bindParam(':tel_emp', $tel_emp);
                $stmt->bindParam(':selectedId', $selectedId);
                $stmt->bindParam(':selectedName', $selectedName);
                $stmt->bindParam(':role_emp', $role_emp);
                $stmt->execute();
                header("location:../view/view_emp_dash.php");
            }
        } else {
            $errors4 = true;
            if (isset($errors4) && $errors4) {
                header("location:../view/error_slc_emp.php");
            }
        }
    } else {
        $errors1 = true; // Il y a des champs invalides

        if (isset($errors1) && $errors1) {
            if (!validate_lname_emp($lname_emp)) {
                header("location:../view/error_lname_emp.php");
            }
            if (!validate_fname_emp($fname_emp)) {
                header("location:../view/error_fname_emp.php");
            }
            if (!validate_tel_emp($tel_emp)) {
                header("location:../view/error_tel_emp.php");
            }
            if (!validate_age_emp($age_emp)) {
                header("location:../view/error_age_emp.php");
            }
            if (!validate_email_emp($email_emp)) {
                header("location:../view/error_email_emp.php");
            }
            if (!validate_role_emp($role_emp)) {
               header("location:../view/error_role_emp.php");
            }
        }
    }
} else {
    $errors = true; // La méthode HTTP utilisée n'est pas POST
}






$idandnameserviceDAO = new EmployeeServiceDAO();

// Récupérer tous les services
$id_name_srvc = $idandnameserviceDAO->getIdAndNameService();



?>