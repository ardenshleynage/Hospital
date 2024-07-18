<?php

include_once ("../dao/dao_superusers.php");

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
$errors1 = false;
$errors2 = false;
$errors3 = false;
$errors4 = false;

// Création de l'objet DoctorDAO
$allusersDAO = new ListUsers();
// Récupération de tous les docteurs
$users = $allusersDAO->getAllUsers();
$num_users = $allusersDAO->getAllUsersNumber();


$allowusersDAO = new ListAllowUsers();
// Récupération de tous les docteurs
$allowusers = $allowusersDAO->getAllowUsers();
$num_allow_users = $allowusersDAO->getAllowUsersNumber();

$blockusersDAO = new ListBlockUsers();
// Récupération de tous les docteurs
$blockusers = $blockusersDAO->getBlockUsers();
$num_block_users = $blockusersDAO->getBlockUsersNumber();


if (isset($_POST["add_users"])) {
    header("location:../view/view_add_users.php");
}


if (isset($_POST["modify_entry"])) {
    session_start();
    $_SESSION["modified_entry_id"] = $_POST["modify_entry"]; // Définir la variable de session
    header("location:../view/mod_users.php");
}


$delUsersController = new DelUsers();
$delUsersController->DeleteUsers();
$searchUsersDAO = new SearchUsersDAO();

$delAllowUsersController = new DelAllowUsers();
$delAllowUsersController->DeleteAllowUsers();

$delBlockUsersController = new DelBlockUsers();
$delBlockUsersController->DeleteBlockUsers();

$aceUsersController = new AccesUsers();
$aceUsersController->AllowOrBlockAccessUsers();




if (isset($_POST['search'])) {
    session_start();
    $searcha = $_POST['searcha'];
    $_SESSION["searcha"] = $searcha;
    $searchUsersDAO = new SearchUsersDAO();
    $searchusers = $searchUsersDAO->searchUsersByName($searcha); // Utiliser $searchServiceDAO au lieu de $searchserviceDAO
    header("location:../view/search_all_users.php");
}
if (isset($_POST['search_allow'])) {
    session_start();
    $searcha = $_POST['searcha'];
    $_SESSION["searcha"] = $searcha;
    $searchUsersDAO = new SearchUsersDAO();
    $searchusers = $searchUsersDAO->searchUsersByName($searcha); // Utiliser $searchServiceDAO au lieu de $searchserviceDAO
    header("location:../view/search_allow.php");
}
if (isset($_POST['search_block'])) {
    session_start();
    $searcha = $_POST['searcha'];
    $_SESSION["searcha"] = $searcha;
    $searchUsersDAO = new SearchUsersDAO();
    $searchusers = $searchUsersDAO->searchUsersByName($searcha); // Utiliser $searchServiceDAO au lieu de $searchserviceDAO
    header("location:../view/search_block.php");
}
?>