<?php
include ("../../db/hop_base.php");
include ("../model/model_superusers.php");

class AddUsersDAO
{
    private $bd;

    public function __construct()
    {
        try {
            $this->bd = Bd::getConection();
        } catch (PDOException $e) {
            // En cas d'erreur de connexion, renvoyer une exception
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function checkIfUsersExists($pseudo)
    {
        // Préparation de la requête SQL
        $checksql = "SELECT * FROM `users` WHERE `pseudo` = :pseudo";
        $checkstmt = $this->bd->prepare($checksql);

        // Liaison des valeurs avec les paramètres de la requête
        $checkstmt->bindParam(':pseudo', $pseudo);

        // Exécution de la requête
        $checkstmt->execute();

        // Retourne le résultat de la requête
        return $checkstmt->rowCount() > 0;
    }

    public function AddUsers(RegUsers $user)
    {
        // Récupération des données de l'utilisateur
        $lname = $user->getUserslnameReg();
        $fname = $user->getUsersfnameReg();
        $pseudo = $user->getUsersPseudoReg();
        $password = $user->getUsersPasswordReg();
        $statut = $user->getUsersStatutReg();

        // Hashage du mot de passe
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Préparation de la requête SQL
        $sql = "INSERT INTO `users` (`nom`, `prenom`, `pseudo`, `password`, `statut`, `date`)
                VALUES (:lname, :fname, :pseudo, :password, :statut, NOW())";
        $istmt = $this->bd->prepare($sql);

        try {
            // Liaison des valeurs avec les paramètres de la requête
            $istmt->bindParam(':lname', $lname);
            $istmt->bindParam(':fname', $fname);
            $istmt->bindParam(':pseudo', $pseudo);
            $istmt->bindParam(':password', $hash);
            $istmt->bindParam(':statut', $statut);
            // Exécution de la requête
            $istmt->execute();
            return true;
        } catch (PDOException $e) {
            // Si une exception est attrapée, renvoyer l'exception
            throw new Exception("Erreur lors de l'exécution de la requête : " . $e->getMessage());
        }
    }

    // Autres méthodes de la classe PatientSignDAO...
}

class ListUsers
{
    private $bd;

    public function __construct()
    {
        try {
            $this->bd = Bd::getConection();
        } catch (PDOException $e) {
            // En cas d'erreur de connexion, renvoyer une exception
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function getAllUsers()
    {
        $checksql = "SELECT * FROM `users`";
        $checkstmt = $this->bd->prepare($checksql);
        $checkstmt->execute();

        return $checkstmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllUsersNumber()
    {
        $checksql = "SELECT * FROM `users`";
        $checkstmt = $this->bd->prepare($checksql);
        $checkstmt->execute();

        // Utilisation de rowCount() pour obtenir le nombre de lignes retournées par la requête
        $num_users = $checkstmt->rowCount();
        return $num_users;
    }

}

class ListAllowUsers
{
    private $bd;

    public function __construct()
    {
        try {
            $this->bd = Bd::getConection();
        } catch (PDOException $e) {
            // En cas d'erreur de connexion, renvoyer une exception
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function getAllowUsers()
    {
        $checksql = "SELECT * FROM `users`  WHERE `statut` = 1";
        $checkstmt = $this->bd->prepare($checksql);
        $checkstmt->execute();

        return $checkstmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllowUsersNumber()
    {
        $checksql = "SELECT * FROM `users`  WHERE `statut` = 1";
        $checkstmt = $this->bd->prepare($checksql);
        $checkstmt->execute();

        // Utilisation de rowCount() pour obtenir le nombre de lignes retournées par la requête
        $num_allow_users = $checkstmt->rowCount();
        return $num_allow_users;
    }

}

class ListBlockUsers
{
    private $bd;

    public function __construct()
    {
        try {
            $this->bd = Bd::getConection();
        } catch (PDOException $e) {
            // En cas d'erreur de connexion, renvoyer une exception
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function getBlockUsers()
    {
        $checksql = "SELECT * FROM `users`  WHERE `statut` = 0";
        $checkstmt = $this->bd->prepare($checksql);
        $checkstmt->execute();

        return $checkstmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getBlockUsersNumber()
    {
        $checksql = "SELECT * FROM `users`  WHERE `statut` = 0";
        $checkstmt = $this->bd->prepare($checksql);
        $checkstmt->execute();

        // Utilisation de rowCount() pour obtenir le nombre de lignes retournées par la requête
        $num_block_users = $checkstmt->rowCount();
        return $num_block_users;
    }

}

class DelUsers
{
    private $bd;

    public function __construct()
    {
        try {
            $this->bd = Bd::getConection();
        } catch (PDOException $e) {
            // En cas d'erreur de connexion, renvoyer une exception
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function DeleteUsers()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_all_entries"])) {
            $deleteAllSql = $this->bd->prepare("DELETE FROM `users`");
            $deleteAllSql->execute();
            header("location:../view/view_users_dash.php");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_entry"])) {
            $entryToDelete = $_POST["delete_entry"];
            $deleteSql = $this->bd->prepare("DELETE FROM `users` WHERE `id` = ?");
            $deleteSql->execute([$entryToDelete]);
            header("location:../view/view_users_dash.php");
            exit();
        }


    }

}

class AccesUsers
{
    private $bd;

    public function __construct()
    {
        try {
            $this->bd = Bd::getConection();
        } catch (PDOException $e) {
            // En cas d'erreur de connexion, renvoyer une exception
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function AllowOrBlockAccessUsers()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["allow_entry"])) {
            $entryToallow = $_POST["allow_entry"];
            $allowSql = $this->bd->prepare("UPDATE `users` SET `statut` = 1 WHERE `id` = ?");
            $allowSql->execute([$entryToallow]);
            header("location:../view/view_users_dash.php");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["block_entry"])) {
            $entryToBlock = $_POST["block_entry"];
            $blockSql = $this->bd->prepare("UPDATE `users` SET `statut` = 0 WHERE `id` = ?");
            $blockSql->execute([$entryToBlock]);
            header("location:../view/view_users_dash.php");
            exit();
        }


    }

}

class DelAllowUsers
{
    private $bd;

    public function __construct()
    {
        try {
            $this->bd = Bd::getConection();
        } catch (PDOException $e) {
            // En cas d'erreur de connexion, renvoyer une exception
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function DeleteAllowUsers()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_all_allow_entries"])) {
            $deleteAllSql = $this->bd->prepare("DELETE FROM `users` WHERE `statut` = 1");
            $deleteAllSql->execute();
            header("location:../view/view_allow_users.php");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_allow_entry"])) {
            $entryToDelete = $_POST["delete_allow_entry"];
            $deleteSql = $this->bd->prepare("DELETE FROM `users` WHERE `id` = ?");
            $deleteSql->execute([$entryToDelete]);
            header("location:../view/view_allow_users.php");
            exit();
        }


    }

}

class DelBlockUsers
{
    private $bd;

    public function __construct()
    {
        try {
            $this->bd = Bd::getConection();
        } catch (PDOException $e) {
            // En cas d'erreur de connexion, renvoyer une exception
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function DeleteBlockUsers()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_all_block_entries"])) {
            $deleteAllSql = $this->bd->prepare("DELETE FROM `users` WHERE `statut` = 0");
            $deleteAllSql->execute();
            header("location:../view/view_block_users.php");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_block_entry"])) {
            $entryToDelete = $_POST["delete_block_entry"];
            $deleteSql = $this->bd->prepare("DELETE FROM `users` WHERE `id` = ?");
            $deleteSql->execute([$entryToDelete]);
            header("location:../view/view_block_users.php");
            exit();
        }


    }

}

class SearchUsersDAO
{
    private $bd;

    public function __construct()
    {
        try {
            $this->bd = Bd::getConection();
        } catch (PDOException $e) {
            // En cas d'erreur de connexion, renvoyer une exception
            throw new Exception("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function searchUsersByName($searcha)
    {
        $sql = "SELECT * FROM `users` WHERE `nom` LIKE :searcha
        OR `prenom` LIKE :searcha
        OR `pseudo` LIKE :searcha
        OR `statut` LIKE :searcha
        OR `date` LIKE :searcha";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':searcha', $searcha);
        $stmt->execute();

        $searchusers = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users = new SearchUsers(); // Typo: 'SeachService' doit être 'SearchService'
            $users->setIdSearchUsers($row['id']);
            $users->setLnameSearchUsers($row['nom']);
            $users->setFnameSearchUsers($row['prenom']);
            $users->setStatutSearchUsers($row['statut']);
            $users->setDateSearchUsers($row['date']);
            $searchusers[] = $users; // Typo: Utiliser $searchservices au lieu de $services
        }

        return $searchusers;
    }
}
?>