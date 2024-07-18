<?php include ("../controller/home_dash_ctrl.php");
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
    <?php include ("../../menu/menu_home_superusers.php"); ?>
    <!-- partial:index.partial.html -->
    <div class="app">
        <div class="app-body">

            <div class="app-body-main-content">
                <section class="service-section">

                    <div class="tiles">
                        <article class="tile">
                            <div class="tile-header">
                                <i class="ph-lightning-light"></i>
                                <h3>
                                    <span>Tous</span>
                                    <span>
                                        <?php echo $num_users ?>
                                    </span>
                                </h3>
                            </div>
                            <a href="http://localhost/website/UML/final_php/superusers/view/view_users_dash.php">
                                <span>Aller à Tous</span>
                                <span class="icon-button">
                                    <i class="ph-caret-right-bold"></i>
                                </span>
                            </a>
                        </article>
                        <article class="tile">
                            <div class="tile-header">
                                <i class="ph-lightning-light"></i>
                                <h3>
                                    <span>Autoriser</span>
                                    <span>
                                        <?php echo $num_allow_users ?>
                                    </span>
                                </h3>
                            </div>
                            <a href="http://localhost/website/UML/final_php/superusers/view/view_allow_users.php">
                                <span>Aller à Autoriser</span>
                                <span class="icon-button">
                                    <i class="ph-caret-right-bold"></i>
                                </span>
                            </a>
                        </article>
                        <article class="tile">
                            <div class="tile-header">
                                <i class="ph-lightning-light"></i>
                                <h3>
                                    <span>Bloquer</span>
                                    <span>
                                        <?php echo $num_block_users ?>
                                    </span>
                                </h3>
                            </div>
                            <a href="http://localhost/website/UML/final_php/superusers/view/view_block_users.php">
                                <span>Aller à Bloquer</span>
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