<?php
include ("../controller/ctrl_list_users.php");
// Démarrer la session pour pouvoir accéder à la variable de session
session_start();
// Récupérer la valeur de l'ID modifié du service s'il existe, sinon définissez-la comme une chaîne vide
$modified_entry_id = isset($_SESSION["modified_entry_id"]) ? $_SESSION["modified_entry_id"] : '';

// Nouvelle connexion PDO
$pdo = new PDO('mysql:host=localhost;dbname=hospital', 'root', '');

// Préparation et exécution de la requête SQL pour récupérer les détails du service modifié
$sql = "SELECT * FROM `users` WHERE `id` = :mod";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':mod', $modified_entry_id);
$stmt->execute();
$service = $stmt->fetch(PDO::FETCH_ASSOC);

$sql2 = "SELECT `prenom`,`nom` FROM `users` WHERE `id` = :mod";
$stmt2 = $pdo->prepare($sql2);
$stmt2->bindParam(':mod', $modified_entry_id);
$stmt2->execute();

// Utiliser cet ID pour effectuer les opérations nécessaires
// Par exemple, vous pouvez l'utiliser pour récupérer les détails du service modifié à partir de la base de données
// ou effectuer toute autre opération requise


if (isset($_POST["mod_services"])) {
    // Récupérer les valeurs du formulaire
    $lname = $_POST["lname"];
    $fname = $_POST["fname"];

    // Si le nom est modifié
    if (!empty($lname)) {
        if (validate_name_users($lname)) {
            $query = "UPDATE `users` SET `nom` = :lname WHERE `id` = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $modified_entry_id);
            $stmt->bindParam(':lname', $lname);
            $stmt->execute();
            header("Location:./view_users_dash.php");
            exit();
        } else {
            header("location:./view_error_lname_users.php");
            exit();
        }
        // Vérifier l'existence de la nouvelle valeur du nom dans la base de données
        // Si la valeur existe déjà, arrêter le processus
        // Mettre à jour le nom dans la base de données     // Afficher un message de succès
    }



    // Si la description est modifiée
    if (!empty($fname)) {
        if (validate_lname_users($fname)) {
            $query = "UPDATE `users` SET `prenom` = :fname WHERE `id` = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $modified_entry_id);
            $stmt->bindParam(':fname', $fname);
            $stmt->execute();
            header("Location:./view_users_dash.php");
            exit();
        } else {
            header("location:./view_error_fname_users.php");
            exit();
        }
        // Mettre à jour la description dans la base de données
        // Afficher un message de succès

    }

    // Si à la fois le nom et la description sont modifiés
    if (!empty($lname) && !empty($fname)) {
        if (validate_lname_users($fname) || validate_name_users($lname)) {
            $query = "UPDATE `services` SET `name` = :lname, `prenom` = :fname WHERE `id` = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $modified_entry_id);
            $stmt->bindParam(':lname', $lname);
            $stmt->bindParam(':fname', $fname);
            $stmt->execute();
            header("Location:./view_users_dash.php");
            exit();

        } else {
            header("location:./view_error_all_users.php");
            exit();


        }
        // Vérifier l'existence de la nouvelle valeur du nom dans la base de données

        // Mettre à jour à la fois le nom et la description dans la base de données


        // Afficher un message de succès
    } else {
        header("Location:./view_users_dash.php");
        exit();
    }
}


?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Modifier Services</title>



</head>

<body>
    <!-- partial:index.partial.html -->
    <!DOCTYPE html>
    <html lang="en">


    <head>
        <!-- Design by foolishdeveloper.com -->
        <title>Glassmorphism login Form Tutorial in html css</title>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
        <!--Stylesheet-->
        <style media="screen">
            *,
            *:before,
            *:after {
                padding: 0;
                margin: 0;
                box-sizing: border-box;
            }

            body {
                background-color: #101827;
            }

            .background {
                width: 430px;
                height: 520px;
                position: absolute;
                transform: translate(-50%, -50%);
                left: 50%;
                top: 50%;
            }

            .shape:first-child {
                background: linear-gradient(#1845ad,
                        #23a2f6);
                left: -80px;
                top: -80px;
            }

            .shape:last-child {
                background: linear-gradient(to right,
                        #ff512f,
                        #f09819);
                right: -30px;
                bottom: -80px;
            }

            form {

                width: 400px;
                background-color: rgba(255, 255, 255, 0.13);
                position: absolute;
                transform: translate(-50%, -50%);
                top: 50%;
                left: 50%;
                border-radius: 10px;
                backdrop-filter: blur(10px);
                border: 2px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
                padding: 50px 35px;
            }

            form * {
                font-family: 'Poppins', sans-serif;
                color: #ffffff;
                letter-spacing: 0.5px;
                outline: none;
                border: none;
            }

            form h3 {
                font-size: 32px;
                font-weight: 500;
                line-height: 42px;
                text-align: center;
            }

            label {
                display: block;
                margin-top: 30px;
                font-size: 16px;
                font-weight: 500;
            }

            input {
                display: block;
                height: 50px;
                width: 100%;
                background-color: rgba(255, 255, 255, 0.07);
                border-radius: 3px;
                padding: 0 10px;
                margin-top: 8px;
                font-size: 14px;
                font-weight: 300;
            }

            ::placeholder {
                color: #e5e5e5;
            }

            button {
                margin-top: 50px;
                width: 100%;
                background-color: #ffffff;
                color: #080710;
                padding: 15px 0;
                font-size: 18px;
                font-weight: 600;
                border-radius: 5px;
                cursor: pointer;
            }

            .social {
                margin-top: 30px;
                display: flex;
            }

            .social div {
                background: red;
                width: 150px;
                border-radius: 3px;
                padding: 5px 10px 10px 5px;
                background-color: rgba(255, 255, 255, 0.27);
                color: #eaf0fb;
                text-align: center;
            }

            .social div:hover {
                background-color: rgba(255, 255, 255, 0.47);
            }

            .social .fb {
                margin-left: 25px;
            }

            .social i {
                margin-right: 4px;
            }

            a {

                background: #4272d7;
                color: #fff;
                display: inline-block;
                line-height: 50px;
                padding: 0 50px;
                font-size: 18px;
                border-radius: 5px;
                text-decoration: none;
                transition: all 0.4s ease;
                cursor: pointer;
                font-size: 18px;
                color: #fff;
                font-family: "Poppins", "Arial", "Helvetica Neue", sans-serif;
            }
        </style>
    </head>

    <body>
        <a href="./view_users_dash.php">Retour</a>




        <div class="row"><br><br><br>
            <div class="background">
                <div class="shape"></div>
                <div class="shape"></div>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h3>
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
                </h3>
                <label for="lname">Nom</label>
                <input type="text" name="lname">

                <label for="fname">Prénom</label>
                <input type="text" name="fname">

                <button type="submit" name="mod_services">Enregistrer</button>
                <?php
                if (isset($errors2) && $errors2) {
                    echo "Erreur lors de l'ajout de l'utilisateur : " . $e->getMessage() . "<br>";
                }


                ?>
            </form>
    </body>

    </html>
    <!-- partial -->

</body>

</html>