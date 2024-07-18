<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include ("../controller/ctrl_list_pat.php");

// Démarrer la session pour pouvoir accéder à la variable de session
session_start();

// Récupérer la valeur de l'ID modifié du service s'il existe, sinon définissez-la comme une chaîne vide
$modified_entry_id = isset($_SESSION["modified_entry_id"]) ? $_SESSION["modified_entry_id"] : '';
$servicePatientDAO = new ServicePatientDAO();

// Récupération de tous les services
$allservices = $servicePatientDAO->getAllServicesPat();

// Nouvelle connexion PDO
$pdo = new PDO('mysql:host=localhost;dbname=hospital', 'root', '');

// Préparation et exécution de la requête SQL pour récupérer les détails du service modifié
$sql = "SELECT * FROM `patient` WHERE `id` = :mod";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':mod', $modified_entry_id);
$stmt->execute();
$service = $stmt->fetch(PDO::FETCH_ASSOC);

// Utiliser cet ID pour effectuer les opérations nécessaires
// Par exemple, vous pouvez l'utiliser pour récupérer les détails du service modifié à partir de la base de données
// ou effectuer toute autre opération requise

$sql2 = "SELECT `prenom`,`nom` FROM `patient` WHERE `id` = :mod";
$stmt2 = $pdo->prepare($sql2);
$stmt2->bindParam(':mod', $modified_entry_id);
$stmt2->execute();

if (isset($_POST["add_pat"])) {
    // Récupérer les valeurs du formulaire
    $lname_pat = $_POST["lname_pat"];
    $fname_pat = $_POST["fname_pat"];
    $sex_pat = $_POST["sex_pat"];
    $dob_pat = $_POST["dob_pat"];
    $pob_pat = $_POST["pob_pat"];
    $ad_pat = $_POST["ad_pat"];
    $tel_pat = filter_input(INPUT_POST, "tel_pat", FILTER_SANITIZE_NUMBER_INT);
    $srvc_pat_id = isset($_POST["srvc_pat"]) ? $_POST["srvc_pat"] : '';


    // Mettre à jour les champs modifiés dans la base de données
    $query = "UPDATE `patient` SET ";
    $updates = [];

    if (!empty($lname_pat) && validate_lname_pat($lname_pat)) {
        $updates[] = "`nom` = :lname_pat";
    }
    if (!empty($fname_pat) && validate_fname_pat($fname_pat)) {
        $updates[] = "`prenom` = :fname_pat";
    }
    if (!empty($sex_pat)) {
        $updates[] = "`sexe` = :sex_pat";
    }
    if (!empty($pob_pat) && validate_pob_pat($pob_pat)) {
        $updates[] = "`pob` = :pob_pat";
    }
    if (!empty($tel_pat) && validate_tel_pat($tel_pat)) {
        $updates[] = "`telephone` = :tel_pat";
    }
    if (!empty($dob_pat)) {
        $updates[] = "`dob` = :dob_pat";
    }
    if (!empty($srvc_pat_id)) {
        $updates[] = "`id_service` = :srvc_pat_id";
    }
    if (!empty($srvc_pat_id)) {
        $updates[] = "`service` = :srvc_pat_name";
    }



    // Vérifier s'il y a des champs à mettre à jour
    if (!empty($updates)) {
        $query .= implode(", ", $updates);
        $query .= " WHERE `id` = :id";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $modified_entry_id);
        if (!empty($lname_pat)) {
            if (validate_lname_pat($lname_pat)) {
                // L'âge est valide, vous pouvez procéder à la liaison du paramètre
                $stmt->bindParam(':lname_pat', $lname_pat);
            } else {
                // L'âge n'est pas valide, afficher un message d'erreur
                header("location:./view_error_lname_pat.php");
                exit();
            }
        }
        if (!empty($fname_pat)) {
            if (validate_fname_pat($fname_pat)) {
                // L'âge est valide, vous pouvez procéder à la liaison du paramètre
                $stmt->bindParam(':fname_pat', $fname_pat);
            } else {
                // L'âge n'est pas valide, afficher un message d'erreur
                header("location:./view_error_fname_pat.php");
                exit();
            }
        }
        if (!empty($pob_pat)) {
            if (validate_pob_pat($pob_pat)) {
                // L'âge est valide, vous pouvez procéder à la liaison du paramètre
                $stmt->bindParam(':pob_pat', $pob_pat);
            } else {
                // L'âge n'est pas valide, afficher un message d'erreur
                header("location:./view_error_pob_pat.php");
                exit();
            }
        }
        if (!empty($sex_pat)) {
            $stmt->bindParam(':sex_pat', $sex_pat);
        }
        if (!empty($dob_pat)) {
            $stmt->bindParam(':dob_pat', $dob_pat);
        }
        if (!empty($tel_pat)) {
            // Vérifier si le numéro de téléphone existe déjà dans la base de données
            if (validate_tel_pat($tel_pat)) {
                $sql_check_tel = "SELECT COUNT(*) FROM patient WHERE telephone = :tel_pat";
                $stmt_check_tel = $pdo->prepare($sql_check_tel);
                $stmt_check_tel->bindParam(':tel_pat', $tel_pat);
                $stmt_check_tel->execute();
                $count = $stmt_check_tel->fetchColumn();

                if ($count > 0) {
                    header("location:./view_error_exist_pat.php");
                    exit();
                } else {
                    $stmt->bindParam(':tel_pat', $tel_pat);
                }
            } else {
                header("location:./view_error_tel_pat.php");
                exit();
            }

        }

        if (!empty($srvc_pat_id)) {
            $stmt->bindParam(':srvc_pat_id', $srvc_pat_id);
        }
        if (!empty($srvc_pat_id)) {
            // L'id du service est déjà récupéré, pas besoin de le récupérer à nouveau
            $stmt->bindParam(':srvc_pat_id', $srvc_pat_id);
            // Récupérer le nom du service correspondant à l'ID
            $query_srvc_name = "SELECT `name` FROM `services` WHERE `id` = :srvc_pat_id";
            $stmt_srvc_name = $pdo->prepare($query_srvc_name);
            $stmt_srvc_name->bindParam(':srvc_pat_id', $srvc_pat_id);
            $stmt_srvc_name->execute();
            $srvc_pat_name = $stmt_srvc_name->fetchColumn(); // Récupérer le nom du service
            $stmt->bindParam(':srvc_pat_name', $srvc_pat_name);
            // Mettre à jour le champ `service` avec le nom du service
        }

        // Exécuter la requête de mise à jour
        if ($stmt->execute()) {
            // Rediriger l'utilisateur vers la page de tableau de bord des employés après la mise à jour
            header("Location:./view_pat_dash.php");
            exit();
        } else {
            // Afficher un message d'erreur si la mise à jour a échoué
            echo "Erreur lors de la mise à jour des informations du patient.";
        }
    } else {
        // Si aucun champ n'a été modifié, rediriger l'utilisateur vers la page de tableau de bord des employés
        header("Location:./view_pat_dash.php");
        exit();
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!--  meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Modifier Patient</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../../css/styles3.css" rel="stylesheet" media="all">
</head>

<body>
<a href="./view_pat_dash.php" class="btn btn--radius-2 btn--blue">Retour</a>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">
                        <?php $result = $stmt2->fetch(PDO::FETCH_ASSOC);

                        // Vérifier si des résultats ont été trouvés
                        if ($result) {
                            // Stocker le prénom et le nom dans des variables
                            $lastname = $result['prenom'];
                            $firstname = $result['nom'];

                            // Afficher le prénom et le nom avec echo
                            echo "{$lastname} {$firstname}";
                        } else {
                            // Afficher un message si aucun résultat n'a été trouvé
                            echo "Aucun patient trouvé avec cet identifiant.";
                        } ?>
                    </h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label" for="lname_pat">Nom</label>
                                    <input type="text" class="input--style-4" name="lname_pat">
                                </div>
                            </div>
                            <div class="col-2">
                                <label class="label" for="fname_pat">Prénom</label>
                                <input type="text" class="input--style-4" name="fname_pat">
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label" for="sex_pat">Sexe</label>
                                    <div class="p-t-10">
                                        <label class="radio-container" for="male">Homme
                                            <input type="radio" id="male" checked="checked" name="sex_pat"
                                                value="homme">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container m-r-45" for="female">Femme
                                            <input type="radio" id="female" name="sex_pat" value="femme">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div><br>
                                    <div class="input-group">
                                        <label class="label" for="dob_pat">Date de naissance</label>
                                        <input class="input--style-4" type="date" name="dob_pat">
                                    </div>

                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label" for="pob_pat">Lieu de naissance</label>
                                    <input class="input--style-4" type="text" name="pob_pat">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label" for="tel_pat">Téléphone</label>
                                    <input class="input--style-4" type="number" name="tel_pat">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label" for="ad_pat">Adresse</label>
                                    <input class="input--style-4" type="text" name="ad_pat">
                                </div>
                            </div>
                            <div class="input-group">
                                <label class="label">Service</label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select name="srvc_pat">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <?php foreach ($allservices as $service): ?>
                                            <option value="<?php echo $service->getServicepatId(); ?>">
                                                <?php echo $service->getServicepatName(); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                            <div class="p-t-15">
                                <button class="btn btn--radius-2 btn--blue" name="add_pat"
                                    type="submit">Enregistrer</button>
                            </div>
                        </div>
                </div>
                <?php

                if (isset($errors2) && $errors2) {
                    echo "Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage() . "<br>";
                }
                if (isset($errors3) && $errors3) {
                    echo "- Ce patient existe déjat.<br>";
                }

                if (isset($errors4) && $errors4) {
                    echo "- Veuillez sélectionner une option.<br>";
                }
                if (isset($errors1) && $errors1) {
                    if (!validate_lname_pat($lname_pat)) {
                        echo "- Erreur au niveau du nom .<br>";
                    }
                    if (!validate_fname_pat($fname_pat)) {
                        echo "- Erreur au niveau du prénom .<br>";
                    }
                    if (!validate_tel_pat($tel_pat)) {
                        echo "- Le numéro de téléphone doit contenir 8 chiffres (sans le préfixe +509).<br>";
                    }
                    if (!validate_pob_pat($pob_pat)) {
                        echo "- Erreur au niveau du lieu de naissance .<br>";
                    }
                }
                ?>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->