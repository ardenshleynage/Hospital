<?php
include ("../dao/dao_superusers.php");

function validate_name_users($lname)
{
    return preg_match('/^[a-zA-Z]+(?:-[a-zA-Z]+)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?$/', $lname);
}

// Fonction pour valider le prénom
function validate_lname_users($fname)
{
    return preg_match('/^[a-zA-Z]+(?:-[a-zA-Z]+)*(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?(?: [a-zA-Z]+(?:-[a-zA-Z]+)*)?$/', $fname);
}

$errors = false;
$errors2 = false;
$errors3 = false;

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lname = $_POST["lname"];
    $fname = $_POST["fname"];
    $pseudo = $_POST["pseudo"];
    $pass = $_POST["password"];
    $statut = 1;
    // Ajout de la validation supplémentaire
    if (
        !empty($lname) && validate_lname_users($fname) &&
        !empty($fname) && validate_name_users($lname)
    ) {
        // Création de l'objet RegUsers
        $user = new RegUsers($lname, $fname, $pseudo, $pass, $statut);
        // Création de l'objet AddUsersDAO
        $addUsersDAO = new AddUsersDAO();

        // Vérification si la méthode AddUsers existe dans AddUsersDAO
        if (method_exists($addUsersDAO, 'AddUsers')) {
            // Vérification de l'unicité du pseudo
            if (!$addUsersDAO->checkIfUsersExists($pseudo)) {
                // Insertion de l'utilisateur dans la base de données
                $result = $addUsersDAO->AddUsers($user);
                if ($result) {
                    // Stockage des données dans la session
                    $_SESSION["lname"] = $lname;
                    $_SESSION["fname"] = $fname;
                    $_SESSION["pseudo"] = $pseudo;
                    $_SESSION["password"] = $pass;
                    $_SESSION["statut"] = $statut;
                    header("location:http://localhost/website/UML/final_php/superusers/view/view_users_dash.php");
                    exit();
                } else {
                    $errors2 = true;
                }
            } else {
                $errors3 = true; // Le pseudo existe déjà dans la base de données
                if (isset($errors3) && $errors3) {
                    header("location:../view/error_users_exist.php");
                    exit();
                }
            }
        } else {
            $errors4 = true; // La méthode AddUsers n'existe pas
        }
    } else {
        $errors = true; // Les données soumises ne sont pas valides
        if (isset($errors) && $errors) {
            if (!empty($fname) && !validate_lname_users($fname)) {
                header("location:../view/error_users_fname.php");
                exit();
            }
            if (!empty($lname) && !validate_name_users($lname)) {
                header("location:../view/error_users_lname.php");
                exit();
            }
        }
    }
} else {
    $errors = true; // La méthode HTTP utilisée n'est pas POST
}

?>