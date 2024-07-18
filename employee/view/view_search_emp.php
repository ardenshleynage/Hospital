<?php include ("../controllers/ctrl_list_emp.php");
session_start();
$searcha = isset($_SESSION["searcha"]) ? $_SESSION["searcha"] : '';
$pdo = new PDO('mysql:host=localhost;dbname=hospital', 'root', '');
$searcha_lower = strtolower($searcha);
if ($searcha_lower === "vide") { // Comparaison avec "vide" plutôt que la longueur de la chaîne
    $sql = "SELECT * FROM `employee` 
        WHERE `id_service` IS NULL"; // Utiliser IS NULL pour vérifier si le champ est null
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $searchemployee = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $sql = "SELECT * FROM `employee` 
        WHERE `nom` LIKE :searcha 
        OR `prenom` LIKE :searcha 
        OR `sexe` LIKE :searcha 
        OR `email` LIKE :searcha 
        OR `age` LIKE :searcha 
        OR `telephone` LIKE :searcha 
        OR `service` LIKE :searcha 
        OR `role` LIKE :searcha
        OR `date` LIKE :searcha"; // Utiliser :searcha au lieu de :seacha
    $stmt = $pdo->prepare($sql);
    $searchParam = "%$searcha%"; // Ajouter des jokers % pour rechercher des correspondances partielles
    $stmt->bindParam(':searcha', $searchParam);
    $stmt->execute();
    $searchemployee = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


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
                    <button name="add_employee" class="app-content-headerButton">Ajoutez Employées</button>
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
                        // Vérifie si $searchservices est défini et non vide
                        if (isset($searchemployee) && !empty($searchemployee)) {
                            $count = 1;

                            foreach ($searchemployee as $row) {
                                echo "<tr>";
                                echo "<th scope='row'>$count</th>";
                                echo "<td>{$row['nom']}</td>";
                                echo "<td>{$row['prenom']}</td>";
                                echo "<td>{$row['sexe']}</td>";
                                echo "<td>{$row['email']}</td>";
                                echo "<td>{$row['age']}</td>";
                                echo "<td>{$row['telephone']}</td>";
                                if ($row['id_service'] === null) {
                                    echo "<td>vide</td>";
                                } else {
                                    echo "<td>{$row['service']}</td>";
                                }
                                echo "<td>{$row['role']}</td>";
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