<?php
include ("../dao/dao_users.php");

$errors = false;
$errors3 = false;
$errors4 = false;
$errors5 = false;

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = $_POST["pseudo"];
    $pass = $_POST["password"];

    // Création de l'objet LogUsersDAO
    $logUsersDAO = new LogUsersDAO();

    // Appel de la méthode pour récupérer l'utilisateur par son pseudo
    $loggedInUser = $logUsersDAO->getUsersByPseudoAndPassword($pseudo);
    // Vérification si l'utilisateur existe
    if ($loggedInUser) {
        // Vérification si le mot de passe est correct en utilisant password_verify
        if (password_verify($pass, $loggedInUser->getUsersPasswordLog())) {
            // Vérification si l'utilisateur a accès en vérifiant le champ statut
            if ($loggedInUser->getUsersStatutLog() == 1) {
                // L'utilisateur est connecté avec succès
                $_SESSION["pseudo"] = $loggedInUser->getUsersPseudoLog();
                // Redirection vers la page appropriée après la connexion réussie
                header("Location:../view/view_home_dash.php");
                exit();
            } else {
                // L'utilisateur n'a pas accès en raison de son statut
                $errors5 = true;
                if (isset($errors5) && $errors5) {
                    header("Location: ./view_error_no_access.php");
                    exit();
                }
            }
        } else {
            // Le mot de passe est incorrect
            $errors4 = true;
            if (isset($errors4) && $errors4) {
                header("Location: ./view_error_incorrect.php");
                exit();
            }
        }
    } else {
        // L'utilisateur n'existe pas ou les informations de connexion sont incorrectes
        $errors3 = true;
        if (isset($errors3) && $errors3) {
            header("Location: ./view_error_no_user.php");
            exit();
        }
    }
}

// Inclure la vue pour afficher le formulaire de connexion et les messages d'erreur
?>
