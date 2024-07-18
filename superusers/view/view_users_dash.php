<?php
include ("../controller/ctrl_list_users.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Utilisateurs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="../../css/style.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="app-container">

        <?php include ("../../menu/menu_superusers_dash.php"); ?>

        <div class="app-content">
            <div class="app-content-header">
                <h1 class="app-content-headerText">Utilisateurs</h1>
                <button class="mode-switch" title="Switch Theme">
                    <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
                        <defs></defs>
                        <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                    </svg>
                </button>
                <form action="" method="post">
                    <button name="add_users" class="app-content-headerButton">Ajoutez Utilisateurs</button>
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
                            <br><button type="submit" name="delete_all_entries"
                                class="app-content-headerButton-DelAll">Supprimer
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
            echo "Nombre d'utilisateurs disponibles : {$num_users}";
            ?><br>
            <table class="fl-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Pseudo</th>
                        <th>Statut</th>
                        <th>Date d'ajout</th>
                        <th>Supprimer</th>
                        <th>Modifier</th>
                        <th>Accès</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($users) {
                        $count = 1;

                        foreach ($users as $row) {
                            echo "<tr>";
                            echo "<th scope='row'>$count</th>";
                            echo "<td>{$row['nom']}</td>";
                            echo "<td>{$row['prenom']}</td>";
                            echo "<td>{$row['pseudo']}</td>";
                            echo "<td>" . ($row['statut'] == 1 ? 'Autoriser' : 'Bloquer') . "</td>";
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
                            echo "<td>";
                            if ($row['statut'] == 1) {
                                ?>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <input type="hidden" name="block_entry" value="<?php echo $row['id']; ?>">
                                    <button class="app-content-headerButton" type="submit">Bloquer</button>
                                </form>
                                <?php
                            } else {
                                ?>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <input type="hidden" name="allow_entry" value="<?php echo $row['id']; ?>">
                                    <button class="app-content-headerButton" type="submit">Autoriser</button>
                                </form>
                                <?php
                            }
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