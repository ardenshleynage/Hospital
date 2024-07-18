<?php
include ("../dao/dao_patients.php");

// Fonction pour valider le prénom
function validate_lname_pat($lname_pat)
{
    return preg_match('/^[a-zA-Z]+(?:-[a-zA-Z]+)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?$/', $lname_pat);
}

// Fonction pour valider le prénom
function validate_fname_pat($fname_pat)
{
    return preg_match('/^[a-zA-Z]+(?:-[a-zA-Z]+)*(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?$/', $fname_pat);
}

// Fonction pour valider le numéro de téléphone (8 chiffres)
function validate_tel_pat($tel_pat)
{
    return is_numeric($tel_pat) && strlen($tel_pat) === 8;
}
function validate_pob_pat($pob_pat)
{
    return preg_match('/^[a-zA-Z]+(?:-[a-zA-Z]+)*(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?$/', $pob_pat);
}


// Création de l'objet ServiceEmployeeDAO
$servicePatientDAO = new ServicePatientDAO();

// Récupération de tous les services
$allservices = $servicePatientDAO->getAllServicesPat();

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
    $lname_pat = $_POST["lname_pat"];
    $fname_pat = $_POST["fname_pat"];
    $sex_pat = $_POST["sex_pat"];
    $dob_pat = $_POST["dob_pat"];
    $pob_pat = $_POST["pob_pat"];
    $ad_pat = $_POST["ad_pat"];
    $tel_pat = filter_input(INPUT_POST, "tel_pat", FILTER_SANITIZE_NUMBER_INT);
    // Validation des champs
    if (
        !empty($lname_pat) && validate_lname_pat($lname_pat) &&
        !empty($fname_pat) && validate_fname_pat($fname_pat) &&
        validate_tel_pat($tel_pat) && validate_pob_pat($pob_pat)
    ) {
        // Assurez-vous d'avoir une connexion à votre base de données avant d'exécuter ce code
        if (isset($_POST['srvc_pat'])) {
            // Récupérer l'ID et le nom de l'option sélectionnée
            $selectedId = $_POST['srvc_pat'];
            $selectedName = "";

            // Parcourir les options pour trouver le nom correspondant à l'ID sélectionné
            foreach ($allservices as $service) {
                if ($service->getServicepatId() == $selectedId) {
                    $selectedName = $service->getServicepatName();
                    break;
                }
            }

            // Utilisez $selectedId et $selectedName comme vous le souhaitez


            // Vérifier si l'utilisateur est déjà présent dans la table employee
            $pdo = new PDO('mysql:host=localhost;dbname=hospital', 'root', '');
            $checkSql = "SELECT COUNT(*) FROM `patient` WHERE `telephone` = :tel_pat";
            $checkStmt = $pdo->prepare($checkSql);
            $checkStmt->bindParam(':tel_pat', $tel_pat);
            $checkStmt->execute();
            $userExists = $checkStmt->fetchColumn();

            if ($userExists) {
                $errors3 = true;
                if (isset($errors3) && $errors3) {
                    header("location:../view/error_pat_exist.php");
                }
            } else {
                // Mettre à jour la table employee avec les valeurs récupérées
                $sql = "INSERT INTO `patient`(`nom`,`prenom`,`sexe`,`dob`,`pob`,`service`,`id_service`,`adresse`,`telephone`,`date`)
                VALUES (:lname_pat,:fname_pat,:sex_pat,:dob_pat,:pob_pat,:selectedName,:selectedId,:ad_pat,:tel_pat,NOW())";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':lname_pat', $lname_pat);
                $stmt->bindParam(':fname_pat', $fname_pat);
                $stmt->bindParam(':sex_pat', $sex_pat);
                $stmt->bindParam(':dob_pat', $dob_pat);
                $stmt->bindParam(':pob_pat', $pob_pat);
                $stmt->bindParam(':selectedName', $selectedName);
                $stmt->bindParam(':selectedId', $selectedId);
                $stmt->bindParam(':ad_pat', $ad_pat);
                $stmt->bindParam(':tel_pat', $tel_pat);
                $stmt->execute();
                header("location:../view/view_pat_dash.php");
            }
        } else {
            $errors4 = true;
            if (isset($errors4) && $errors4) {
                header("location:../view/error_slc_pat.php");
            }
        }
    } else {
        $errors1 = true; // Il y a des champs invalides
        if (isset($errors1) && $errors1) {
            if (!validate_lname_pat($lname_pat)) {
                header("location:../view/error_lname_pat.php");
            }
            if (!validate_fname_pat($fname_pat)) {
                header("location:../view/error_fname_pat.php");
            }
            if (!validate_tel_pat($tel_pat)) {
                header("location:../view/error_tel_pat.php");
            }
            if (!validate_pob_pat($pob_pat)) {
                header("location:../view/error_pob_pat.php");
            }
        }
    }
} else {
    $errors = true; // La méthode HTTP utilisée n'est pas POST
}






$idandnameserviceDAO = new PatientServiceDAO();

// Récupérer tous les services
$id_name_srvc = $idandnameserviceDAO->getIdAndNameServicePatient();



?>