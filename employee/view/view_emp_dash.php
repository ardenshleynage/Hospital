<?php include ("../controllers/ctrl_list_emp.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Employées</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="../../css/style.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="app-container">

        <?php include ("../../menu/menu_emp_dash.php"); ?>

        <div class="app-content">
            <div class="app-content-header">
                <h1 class="app-content-headerText">Employées</h1>
                <button class="mode-switch" title="Switch Theme">
                    <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
                        <defs></defs>
                        <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                    </svg>
                </button>
                <form action="" method="post">
                    <button name="add_employee" class="app-content-headerButton">Ajoutez Employée</button>
                </form>

            </div>
            <div class="app-content-actions">
                <form action="" method="post">
                    <input class="search-bar" name="searcha" placeholder="Search..." type="text">
                    <button type="submit" style="display: none;" name="search"
                        class="app-content-headerButton">Rechercher</button>
                </form>

                <div class="app-content-actions-wrapper">

                    <div class="filter-button-wrapper">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <br><button type="submit" name="delete_all_entries" class="app-content-headerButton-DelAll">Supprimer
                                Tous</button>
                        </form>


                        <div class="filter-menu">
                            <label>Category</label>
                            <select>
                                <option>All Categories</option>
                                <option>Furniture</option>
                                <option>Decoration</option>
                                <option>Kitchen</option>
                                <option>Bathroom</option>
                            </select>
                            <label>Status</label>
                            <select>
                                <option>All Status</option>
                                <option>Active</option>
                                <option>Disabled</option>
                            </select>
                            <div class="filter-menu-buttons">
                                <button class="filter-button reset">
                                    Reset
                                </button>
                                <button class="filter-button apply">
                                    Apply
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <?php
            echo "Nombre d'employée disponibles : {$num_emp}";
            ?><br>
            <table class="fl-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Sexe</th>
                        <th>E-Mail</th>
                        <th>Âge</th>
                        <th>Téléphone</th>
                        <th>Service</th>
                        <th>Rôle</th>
                        <th>Date d'ajout</th>
                        <th>Supprimer</th>
                        <th>Modifier</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($all_emp) {
                        $count = 1;
                        foreach ($all_emp as $row) {
                            echo "<tr>";
                            echo "<th scope='row'>$count</th>";
                            echo "<td>{$row['nom']}</td>";
                            echo "<td>{$row['prenom']}</td>";
                            echo "<td>{$row['sexe']}</td>";
                            echo "<td>{$row['email']}</td>";
                            echo "<td>{$row['age']}</td>";
                            echo "<td>{$row['telephone']}</td>";
                            echo "<td>";
                            if ($row['id_service'] === null) {
                                echo "vide";
                            } else {
                                $pdo = new PDO('mysql:host=localhost;dbname=hospital', 'root', '');
                                // Récupérer le nom du service dans la table employee
                                $employee_service = $row['service'];
                                
                                // Vérifier si le nom du service de la table employee existe dans la table services
                                $query_check_service = "SELECT * FROM `services` WHERE `name` = :service_name";
                                $stmt_check_service = $pdo->prepare($query_check_service);
                                $stmt_check_service->bindParam(':service_name', $employee_service);
                                $stmt_check_service->execute();
                                $service_row = $stmt_check_service->fetch(PDO::FETCH_ASSOC);
                                
                                if ($service_row) {
                                    // Si le nom du service existe dans la table services, afficher le nom du service de la table employee
                                    echo $employee_service;
                                } else {
                                    // Si le nom du service n'existe pas dans la table services, mettre à jour le champ service de la table employee
                                    $new_service = ''; // Le nouveau service à récupérer de la table services
                                    
                                    // Récupérer le nouveau service correspondant à l'ID du service de la table employee
                                    $query_get_new_service = "SELECT `name` FROM `services` WHERE `id` = :service_id";
                                    $stmt_get_new_service = $pdo->prepare($query_get_new_service);
                                    $stmt_get_new_service->bindParam(':service_id', $row['id_service']);
                                    $stmt_get_new_service->execute();
                                    $new_service_row = $stmt_get_new_service->fetch(PDO::FETCH_ASSOC);
                                    
                                    if ($new_service_row) {
                                        // Si le nouveau service est récupéré avec succès, l'assigner à la variable $new_service
                                        $new_service = $new_service_row['name'];
                                    }
                                    
                                    // Mettre à jour le champ service de la table employee avec le nouveau service
                                    $update_query = "UPDATE `employee` SET `service` = :new_service WHERE `id` = :employee_id";
                                    $stmt_update_service = $pdo->prepare($update_query);
                                    $stmt_update_service->bindParam(':new_service', $new_service);
                                    $stmt_update_service->bindParam(':employee_id', $row['id']);
                                    $stmt_update_service->execute();
                                    
                                    // Afficher le nouveau service
                                    echo $new_service;
                                }
                            }
                            echo "</td>";
                            echo "<td>{$row['role']}</td>";
                            echo "<td>{$row['date']}</td>";
                            echo "<td>";
                
                            ?>

                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <input type="hidden" name="delete_entry" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="app-content-headerButton">Supprimer</button>
                            </form>
                            <?php
                            echo "<td>";
                            ?>
                            <form action="" method="post">
                                <input type="hidden" name="modify_entry" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="app-content-headerButton">Modifier</button>
                                <button type="submit"></button>
                            </form>
                            <?php
                            echo "</td>";

                            echo "</td>";
                            echo "</tr>";
                            $count++;
                        }
                    } else {
                        echo "<tr><td colspan='11'>Vide</td></tr>";
                    }
                    ?>
                </tbody>
            </table><br>


        </div>
    </div>
    <!-- partial -->
    <script src="../../js/script.js"></script>

</body>

</html>