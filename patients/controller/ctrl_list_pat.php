<?php
include ("../dao/dao_patients.php");
$allpatDAO = new ListPatient();

// Récupération de tous les docteurs
$all_pat = $allpatDAO->getAllPatient();
$num_pat = $allpatDAO->getAllPatientNumber();


$delPatController = new DelPatient();
$delPatController->DeletePatient();

if (isset($_POST["add_patient"])) {
    header("location:../view/view_add_pat.php");
}


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

$errors = false;
$errors1 = false;
$errors2 = false;
$errors3 = false;
$errors4 = false;


if (isset($_POST["modify_entry"])) {
    session_start();
    $_SESSION["modified_entry_id"] = $_POST["modify_entry"]; // Définir la variable de session
    header("location:../view/view_mod_pat.php");
}

$searchPatientDAO = new SearchPatientDAO();

if (isset($_POST['search'])) {
    session_start();
    $searcha = $_POST['searcha'];
    $_SESSION["searcha"] = $searcha;
    $searchPatientDAO = new SearchPatientDAO();
    $searchpatient = $searchPatientDAO->searchPat($searcha); // Utiliser $searchServiceDAO au lieu de $searchserviceDAO
    header("location:../view/view_search_pat.php");
}


?>