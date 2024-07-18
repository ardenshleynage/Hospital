<?php include ("../Controllers/ctrl_home_dash.php"); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="../../css/style.css">

</head>

<body>
    <?php include ("../../menu/menu_home_dash.php"); ?>
    <!-- partial:index.partial.html -->
    <div class="app">
        <div class="app-body">

            <div class="app-body-main-content">
                <section class="service-section">

                    <div class="tiles">
                        <article class="tile">
                            <div class="tile-header">
                                <i class="ph-user"></i>
                                <h3>
                                    <span>Patients</span>
                                    <span>
                                        <?php echo $num_pat ?>
                                    </span>
                                </h3>
                            </div>
                            <a href="http://localhost/website/UML/final_php/patients/view/view_pat_dash.php">
                                <span>Aller à Patients</span>
                                <span class="icon-button">
                                    <i class="ph-caret-right-bold"></i>
                                </span>
                            </a>
                        </article>
                        <article class="tile">
                            <div class="tile-header">
                                <i class="ph-eyedropper"></i>
                                <h3>
                                    <span>Employées</span>
                                    <span>
                                        <?php echo $num_emp ?>
                                    </span>
                                </h3>
                            </div>
                            <a href="http://localhost/website/UML/final_php/employee/view/view_emp_dash.php">
                                <span>Aller à Employées</span>
                                <span class="icon-button">
                                    <i class="ph-caret-right-bold"></i>
                                </span>
                            </a>
                        </article>
                        <article class="tile">
                            <div class="tile-header">
                                <i class="ph-file-light"></i><br><br>
                                <h3>
                                    <span>Services</span>
                                    <span>
                                        <?php echo $num ?>
                                    </span>
                                </h3>
                            </div>
                            <a href="http://localhost/website/UML/final_php/services/view/view_srvc_dash.php">
                                <span>Aller à Services</span>
                                <span class="icon-button">
                                    <i class="ph-caret-right-bold"></i>
                                </span>
                            </a>
                        </article>
                    </div>

                </section>

            </div>
        </div>
    </div>
    </div>
    <!-- partial -->
    <script src='https://unpkg.com/phosphor-icons'></script>
    <script src="./script.js"></script>

</body>

</html>