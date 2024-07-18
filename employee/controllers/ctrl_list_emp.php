<?php
include ("../dao/dao_emp.php");
$allempDAO = new ListEMployee();

// Récupération de tous les docteurs
$all_emp = $allempDAO->getAllEmployee();
$num_emp = $allempDAO->getAllEmployeeNumber();


$delEmpController = new DelEmployee();
$delEmpController->DeleteEmployee();

if (isset($_POST["add_employee"])) {
    header("location:../view/view_add_emp.php");
}


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
$errors = false;
$errors1 = false;
$errors2 = false;
$errors3 = false;
$errors4 = false;


if (isset($_POST["modify_entry"])) {
    session_start();
    $_SESSION["modified_entry_id"] = $_POST["modify_entry"]; // Définir la variable de session
    header("location:../view/view_mod_emp.php");
}

$searchEmployeeDAO = new SearchEmployeeDAO();

if (isset($_POST['search'])) {
    session_start();
    $searcha = $_POST['searcha'];
    $_SESSION["searcha"] = $searcha;
    $searchEmployeeDAO = new SearchEmployeeDAO();
    $searchemployee = $searchEmployeeDAO->searchEmp($searcha); // Utiliser $searchServiceDAO au lieu de $searchserviceDAO
    header("location:../view/view_search_emp.php");
}


?>