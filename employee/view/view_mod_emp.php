<?php
include ("../controllers/ctrl_list_emp.php");

// Démarrer la session pour pouvoir accéder à la variable de session
session_start();

// Récupérer la valeur de l'ID modifié du service s'il existe, sinon définissez-la comme une chaîne vide
$modified_entry_id = isset($_SESSION["modified_entry_id"]) ? $_SESSION["modified_entry_id"] : '';
$serviceEmployeeDAO = new ServiceEmployeeDAO();

// Récupération de tous les services
$allservices = $serviceEmployeeDAO->getAllServicesEmp();

// Nouvelle connexion PDO
$pdo = new PDO('mysql:host=localhost;dbname=hospital', 'root', '');

// Préparation et exécution de la requête SQL pour récupérer les détails du service modifié
$sql = "SELECT * FROM `employee` WHERE `id` = :mod";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':mod', $modified_entry_id);
$stmt->execute();
$service = $stmt->fetch(PDO::FETCH_ASSOC);

// Utiliser cet ID pour effectuer les opérations nécessaires
// Par exemple, vous pouvez l'utiliser pour récupérer les détails du service modifié à partir de la base de données
// ou effectuer toute autre opération requise

$sql2 = "SELECT `prenom`,`nom` FROM `employee` WHERE `id` = :mod";
$stmt2 = $pdo->prepare($sql2);
$stmt2->bindParam(':mod', $modified_entry_id);
$stmt2->execute();

if (isset($_POST["add_emp"])) {
    // Récupérer les valeurs du formulaire
    $lname_emp = $_POST["lname_emp"];
    $fname_emp = $_POST["fname_emp"];
    $sex_emp = $_POST["sex_emp"];
    $email_emp = $_POST["email_emp"];
    $age_emp = $_POST["age_emp"];
    $tel_emp = filter_input(INPUT_POST, "tel_emp", FILTER_SANITIZE_NUMBER_INT);
    $role_emp = $_POST["role_emp"];
    $srvc_emp_id = isset($_POST["srvc_emp"]) ? $_POST["srvc_emp"] : '';

    // Mettre à jour les champs modifiés dans la base de données
    $query = "UPDATE `employee` SET ";
    $updates = [];

    if (!empty($lname_emp) && validate_lname_emp($lname_emp)) {
        $updates[] = "`nom` = :lname_emp";
    }
    if (!empty($fname_emp) && validate_fname_emp($fname_emp)) {
        $updates[] = "`prenom` = :fname_emp";
    }
    if (!empty($sex_emp)) {
        $updates[] = "`sexe` = :sex_emp";
    }
    if (!empty($email_emp) && validate_email_emp($email_emp)) {
        $updates[] = "`email` = :email_emp";
    }
    if (!empty($age_emp) && validate_age_emp($age_emp)) {
        $updates[] = "`age` = :age_emp";
    }
    if (!empty($tel_emp) && validate_tel_emp($tel_emp)) {
        $updates[] = "`telephone` = :tel_emp";
    }
    if (!empty($role_emp) && validate_role_emp($role_emp)) {
        $updates[] = "`role` = :role_emp";
    }
    if (!empty($srvc_emp_id)) {
        $updates[] = "`id_service` = :srvc_emp_id";
    }
    if (!empty($srvc_emp_id)) {
        $updates[] = "`service` = :srvc_emp_name";
    }



    // Vérifier s'il y a des champs à mettre à jour
    if (!empty($updates)) {
        $query .= implode(", ", $updates);
        $query .= " WHERE `id` = :id";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $modified_entry_id);
        if (!empty($lname_emp)) {
            if (validate_lname_emp($lname_emp)) {
                // L'âge est valide, vous pouvez procéder à la liaison du paramètre
                $stmt->bindParam(':lname_emp', $lname_emp);
            } else {
                // L'âge n'est pas valide, afficher un message d'erreur
                header("location:./view_error_lname_emp.php");
                exit();
            }
        }
        if (!empty($fname_emp)) {
            if (validate_fname_emp($fname_emp)) {
                // L'âge est valide, vous pouvez procéder à la liaison du paramètre
                $stmt->bindParam(':fname_emp', $fname_emp);
            } else {
                // L'âge n'est pas valide, afficher un message d'erreur
                header("location:./view_error_fname_emp.php");
                exit();
            }
        }
        if (!empty($sex_emp)) {
            $stmt->bindParam(':sex_emp', $sex_emp);
        }
        if (!empty($email_emp)) {
            if (validate_email_emp($email_emp)) {
                $sql_check_tel = "SELECT COUNT(*) FROM `employee` WHERE `email` = :email_emp";
                $stmt_check_tel = $pdo->prepare($sql_check_tel);
                $stmt_check_tel->bindParam(':email_emp', $email_emp);
                $stmt_check_tel->execute();
                $count = $stmt_check_tel->fetchColumn();

                if ($count > 0) {
                    header("location:./view_error_exist_emp.php");
                    exit();
                } else {
                    $stmt->bindParam(':email_emp', $email_emp);
                }
            } else {
                header("location:./view_error_email_emp.php");
                exit();
            }
        }
        if (!empty($age_emp)) {
            if (validate_age_emp($age_emp)) {
                // L'âge est valide, vous pouvez procéder à la liaison du paramètre
                $stmt->bindParam(':age_emp', $age_emp);
            } else {
                // L'âge n'est pas valide, afficher un message d'erreur
                header("location:./view_error_age_emp.php");
                exit();
            }
        }


        if (!empty($tel_emp)) {
            // Vérifier si le numéro de téléphone existe déjà dans la base de données
            if (validate_tel_emp($tel_emp)) {
                $sql_check_tel = "SELECT COUNT(*) FROM employee WHERE telephone = :tel_emp";
                $stmt_check_tel = $pdo->prepare($sql_check_tel);
                $stmt_check_tel->bindParam(':tel_emp', $tel_emp);
                $stmt_check_tel->execute();
                $count = $stmt_check_tel->fetchColumn();

                if ($count > 0) {
                    header("location:./view_error_exist_emp.php");
                    exit();
                } else {
                    $stmt->bindParam(':tel_emp', $tel_emp);
                }
            } else {
                header("location:./view_error_tel_emp.php");
                exit();
            }

        }

        if (!empty($role_emp)) {
            if (validate_role_emp($role_emp)) {
                // L'âge est valide, vous pouvez procéder à la liaison du paramètre
                $stmt->bindParam(':role_emp', $role_emp);
            } else {
                // L'âge n'est pas valide, afficher un message d'erreur
                header("location:./view_error_role_emp.php");
                exit();
            }
        }

        if (!empty($srvc_emp_id)) {
            $stmt->bindParam(':srvc_emp_id', $srvc_emp_id);
        }
        if (!empty($srvc_emp_id)) {
            // L'id du service est déjà récupéré, pas besoin de le récupérer à nouveau
            $stmt->bindParam(':srvc_emp_id', $srvc_emp_id);
            // Récupérer le nom du service correspondant à l'ID
            $query_srvc_name = "SELECT `name` FROM `services` WHERE `id` = :srvc_emp_id";
            $stmt_srvc_name = $pdo->prepare($query_srvc_name);
            $stmt_srvc_name->bindParam(':srvc_emp_id', $srvc_emp_id);
            $stmt_srvc_name->execute();
            $srvc_emp_name = $stmt_srvc_name->fetchColumn(); // Récupérer le nom du service
            $stmt->bindParam(':srvc_emp_name', $srvc_emp_name);
            // Mettre à jour le champ `service` avec le nom du service

        }

        // Exécuter la requête de mise à jour
        if ($stmt->execute()) {
            // Rediriger l'utilisateur vers la page de tableau de bord des employés après la mise à jour
            header("Location:./view_emp_dash.php");
            exit();
        } else {
            // Afficher un message d'erreur si la mise à jour a échoué
            echo "Erreur lors de la mise à jour des informations de l'employé.";
        }
    } else {
        // Si aucun champ n'a été modifié, rediriger l'utilisateur vers la page de tableau de bord des employés
        header("Location:./view_emp_dash.php");
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
    <title>Modifier Employée</title>

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
    <a href="./view_emp_dash.php" class="btn btn--radius-2 btn--blue">Retour</a>
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
                                    <label class="label" for="lname_emp">Nom</label>
                                    <input type="text" class="input--style-4" name="lname_emp">
                                </div>
                            </div>
                            <div class="col-2">
                                <label class="label" for="fname_emp">Prénom</label>
                                <input type="text" class="input--style-4" name="fname_emp">
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label" for="sex_emp">Sexe</label>
                                    <div class="p-t-10">
                                        <label class="radio-container" for="male">Homme
                                            <input type="radio" id="male" checked="checked" name="sex_emp"
                                                value="homme">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container m-r-45" for="female">Femme
                                            <input type="radio" id="female" name="sex_emp" value="femme">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div><br>
                                    <div class="input-group">
                                        <label class="label" for="emal_emp">Email</label>
                                        <input class="input--style-4" type="email" name="email_emp">
                                    </div>

                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label" for="age_emp">Âge</label>
                                    <input class="input--style-4" type="number" name="age_emp">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label" for="tel_emp">Téléphone</label>
                                    <input class="input--style-4" type="number" name="tel_emp">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label" for="role_emp">Rôle</label>
                                    <input class="input--style-4" type="text" name="role_emp">
                                </div>
                            </div>
                            <div class="input-group">
                                <label class="label">Service</label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select name="srvc_emp">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <?php foreach ($allservices as $service): ?>
                                            <option value="<?php echo $service->getServiceEmpId(); ?>">
                                                <?php echo $service->getServiceEmpName(); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                            <div class="p-t-15">
                                <button class="btn btn--radius-2 btn--blue" name="add_emp"
                                    type="submit">Enregistrer</button>
                            </div>
                        </div>
                </div>
                <?php
                if (isset($errors4) && $errors4) {
                    echo "- Cet employée existe déjat.<br>";
                }
                if (!empty($age_emp) && !validate_age_emp($age_emp)) {
                    echo "Trop Jeunes .<br>";
                    exit();
                }




                if (isset($errors2) && $errors2) {
                    echo "Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage() . "<br>";
                }
                if (isset($errors3) && $errors3) {
                    echo "- Cet employée existe déjat.<br>";
                }

                if (isset($errors1) && $errors1) {
                    if (!validate_lname_emp($lname_emp)) {
                        echo "- Erreur au niveau du nom .<br>";
                    }
                    if (!validate_fname_emp($fname_emp)) {
                        echo "- Erreur au niveau du prénom .<br>";
                    }
                    if (!validate_tel_emp($tel_emp)) {
                        echo "- Le numéro de téléphone doit contenir 8 chiffres (sans le préfixe +509).<br>";
                    }
                    if (!validate_age_emp($age_emp)) {
                        echo "- Trop jeunes .<br>";
                    }
                    if (!validate_email_emp($email_emp)) {
                        echo "- E-Mail invalide .<br>";
                    }
                    if (!validate_role_emp($role_emp)) {
                        echo "- Erreur au niveau du rôle .<br>";
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