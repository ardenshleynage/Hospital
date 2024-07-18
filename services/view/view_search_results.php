<?php include ("../Controllers/ctrl_list_srvc.php");
session_start();
$searcha = isset ($_SESSION["searcha"]) ? $_SESSION["searcha"] : '';
$pdo = new PDO('mysql:host=localhost;dbname=hospital', 'root', '');
$sql = "SELECT * FROM `services` WHERE `name` LIKE :searcha"; // Utiliser :searcha au lieu de :seacha
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':searcha', $searcha);
$stmt->execute();
$searchservices = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <div class="app-container">

        <?php include ("../../menu/menu_srvc_dash.php"); ?>

        <div class="app-content">
            <div class="app-content-header">
                <h1 class="app-content-headerText">Services</h1>
                <button class="mode-switch" title="Switch Theme">
                    <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
                        <defs></defs>
                        <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                    </svg>
                </button>
                <form action="" method="post">
                    <button name="add_srvc" class="app-content-headerButton">Ajoutez services</button>
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
            <ul>
                <table class="fl-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom services</th>
                            <th>Description services</th>
                            <th>Date d'ajout services</th>
                            <th>Supprimer</th>
                            <th>Modifier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Vérifie si $searchservices est défini et non vide
                        if (isset ($searchservices) && !empty ($searchservices)) {
                            $count = 1;

                            foreach ($searchservices as $row) {
                                echo "<tr>";
                                echo "<th scope='row'>$count</th>";
                                echo "<td>{$row['name']}</td>";
                                echo "<td>{$row['des']}</td>";
                                echo "<td>{$row['date']}</td>";
                                echo "<td>";
                                ?>

                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <input type="hidden" name="delete_entry" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="app-content-headerButton">Supprimer</button>
                                </form>
                                <?php
                                echo "</td>";
                                echo "<td>";
                                ?>
                                <form action="" method="post">
                                    <input type="hidden" name="modify_entry" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="app-content-headerButton">Modifier</button>
                                </form>
                                <?php
                                echo "</td>";

                                echo "</tr>";
                                $count++;
                            }
                        } else {
                            echo "<tr><td colspan='11'>Aucun resultat pour '$searcha'</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </ul>
</body>

</html>