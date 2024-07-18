<?php include ("../controller/ctrl_add_pat.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Enregistrer patients</title>

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
                    <h2 class="title">Enregistrement Patient</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label" for="lname_pat">Nom</label>
                                    <input type="text" class="input--style-4" required name="lname_pat">
                                </div>
                            </div>
                            <div class="col-2">
                                <label class="label" for="fname_pat">Prénom</label>
                                <input type="text" class="input--style-4" required name="fname_pat">
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
                                            <input type="radio" id="female" name="sex_pat" value="femme" required>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div><br>
                                    <div class="input-group">
                                        <label class="label" for="dob_pat">Date de naissance</label>
                                        <input class="input--style-4" type="date" required name="dob_pat">
                                    </div>

                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label" for="pob_pat">Lieu de naissance</label>
                                    <input class="input--style-4" type="text" required name="pob_pat">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label" for="tel_pat">Téléphone</label>
                                    <input class="input--style-4" type="number" required name="tel_pat">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label" for="ad_pat">Adresse</label>
                                    <input class="input--style-4" type="text" required name="ad_pat">
                                </div>
                            </div>
                            <div class="input-group">
                                <label class="label">Service</label>
                                <div class="rs-select2 js-select-simple select--no-search">
                                    <select name="srvc_pat" required>
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