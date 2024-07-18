<?php

include_once ("../dao/dao_srvc.php");

function validate_name_srvc($name_srvc)
{
    return preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ\s-]+$/', $name_srvc);
}

$errors = false;
$errors1 = false;
$errors2 = false;
$errors3 = false;
$errors4 = false;

// Création de l'objet DoctorDAO
$allservicesDAO = new ListServices();

// Récupération de tous les docteurs
$services = $allservicesDAO->getAllService();
$num = $allservicesDAO->getAllServiceNumber();


if (isset($_POST["add_srvc"])) {
    header("location:../view/view_add_srvc.php");
}

if (isset($_POST["modify_entry"])) {
    session_start();
    $_SESSION["modified_entry_id"] = $_POST["modify_entry"]; // Définir la variable de session
    header("location:../view/view_mod_srvc.php");
}


$delServicesController = new DelServices();
$delServicesController->DeleteService();

$searchServiceDAO = new SearchServiceDAO();



if (isset($_POST['search'])) {
    session_start();
    $searcha = $_POST['searcha'];
    $_SESSION["searcha"] = $searcha;
    $searchServiceDAO = new SearchServiceDAO();
    $searchservices = $searchServiceDAO->searchByName($searcha); // Utiliser $searchServiceDAO au lieu de $searchserviceDAO
    header("location:../view/view_search_results.php");
}
?>