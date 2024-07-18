<?php
include ("../dao/dao_srvc.php");

// Fonction pour valider le prénom
function validate_name_srvc($name_srvc)
{
    return preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ\s-]+$/', $name_srvc);
}

$errors = false;
$errors1 = false;
$errors2 = false;
$errors3 = false;
$errors4 = false;

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name_srvc = $_POST["name_srvc"];
    $des = $_POST["des"];
    // Ajout de la validation supplémentaire
    if (
        !empty($name_srvc) && validate_name_srvc($name_srvc)
    ) {
        // Création de l'objet RegUsers
        $srvc = new RegService($name_srvc, $des);
        // Création de l'objet AddUsersDAO
        $addSrvcDAO = new AddServicesDAO();

        // Vérification si la méthode AddUsers existe dans AddUsersDAO
        if (method_exists($addSrvcDAO, 'AddServices')) {
            // Vérification de l'unicité du pseudo
            if (!$addSrvcDAO->checkIfServiceExists($name_srvc, $des)) {
                // Insertion de l'utilisateur dans la base de données
                try {
                    $result = $addSrvcDAO->AddServices($srvc);
                    if ($result) {
                        // Stockage des données dans la session
                        $_SESSION["name_srvc"] = $name_srvc;
                        $_SESSION["des"] = $des;
                        header("location:../view/view_srvc_dash.php");
                        exit();
                    } else {
                        $errors2 = true;
                    }
                } catch (Exception $e) {
                    $errors2 = true;
                    echo "Erreur lors de l'ajout du service : " . $e->getMessage() . "<br>";
                }
            } else {
                $errors3 = true; // Le pseudo existe déjà dans la base de données
                if (isset($errors3) && $errors3) {
                    header("location:../view/error_srvc_exist.php");
                }
            }
        } else {
            $errors4 = true; // La méthode AddUsers n'existe pas
            if (isset($errors4) && $errors4) {
                echo "Mots de passe ou Pseudo Incorect<br>";
            }
        }
    } else {
        $errors1 = true; // Nom invalide
        if (isset($errors1) && $errors1) {
            header("location:../view/error_n_srvc_invalid.php");
        }
    }
} else {
    $errors = true; // La méthode HTTP utilisée n'est pas POST
}

?>