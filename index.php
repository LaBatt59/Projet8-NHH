<?php
session_start() ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Header  -->
    <div class="container">
        <div class="header">
            <p>Panneau D'administration</p>
        </div>
    </div>
    <!-- En-Tête  -->
    <div class="menu">
        <form action="index.php" method="post">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="?page=utilisateur">Utilisateur</a></li>
                <li><a href="?page=paramètres">Parmètres</a></li>

                <?php
                if (isset($_SESSION) and !empty($_SESSION)) { ?>
                    <input class="deconnexion" type="submit" name="submitDeconnexion" value="Déconnexion">
                <?php } else { ?>
                    <li><a href="?page=connexion">Connexion</a></li>
                <?php } ?>
            </ul>
        </form>
        <br>
        <?php
        if (isset($_SESSION) && !empty($_SESSION)) { ?>
            <p>Welcome LaBatt !</p>
        <?php }
        ?>
    </div>

    <div class="content">
        <!-- Partie Connexion  -->
        <?php
        if ((isset($_GET['page']) && $_GET['page'] == "connexion") && (empty($_SESSION)) || (empty($_SESSION))) { ?>
            <div>
                <form action="index.php" class="formConnexion" method="POST">
                    <label for="identifiant">Identifiant</label>
                    <br>
                    <input type="text" name="identifiant">
                    <br>
                    <label for="identifiant">Mot de passe</label>
                    <br>
                    <input type="password" name="password">
                    <br>
                    <input type="submit" name="submitConnexion" value="Se connecter">
                </form>
            </div>
        <?php }
        if (isset($_POST['submitDeconnexion'])) {
            session_destroy(); ?>
            <p class="alert success">C'est carré, t'es déconnecté(e) !</p>
            <?php
        }
        // Partie Utilisateur 
        if (isset($_POST['submitConnexion'])) {
            if ($_POST['identifiant'] == "LaBatt" and $_POST['password'] == "5962") {
                $_SESSION['data'] = [
                    'prenom' => "Nathan",
                    'nom' => "Hochet",
                    'age' => 21,
                    'role' => 'Appprenti'
                ];
            ?>
                <p class="alert success">Welcome LaBatt</p>
            <?php
            } else { ?>
                <p class="alert error">Ta oublié ton mot de passe ou ton identifiant mec !</p>
            <?php }
        }
        if (isset($_GET['page']) && $_GET['page'] == 'utilisateur' && empty($_SESSION)) { ?>
            <p class="alert warning">Tu dois être connecté pour voir la suite.</p>
        <?php }

        if (isset($_GET['page']) && $_GET['page'] == 'utilisateur' && !empty($_SESSION)) { ?>
            <h1>T'es infos utilisateur</h1>
            <p>Nom : <?php echo $_SESSION['data']['nom']; ?></p>
            <p>Prénom : <?php echo $_SESSION['data']['prenom']; ?></p>
            <p>Age : <?php echo $_SESSION['data']['age']; ?></p>
            <p>Rôle : <?php echo $_SESSION['data']['role']; ?></p>
        <?php }

        if (isset($_GET['page']) && $_GET['page'] == 'paramètres' && empty($_SESSION)) { ?>
            <p class="alert warning">Tu dois être connecté(e) pour voir la suite.</p>
        <?php }
        // Modifs Utilisateur
        if (isset($_GET['page']) && $_GET['page'] == 'paramètres' && !empty($_SESSION)) { ?>
            <form action="?paramètres" method="POST" class="formConnexion">
                <h1>Modification de tes paramètres</h1>
                <label for="nom">Nom</label>
                <input type="text" name="nom" value="<?php echo $_SESSION['data']['nom']; ?>">
                <br>
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" value="<?php echo $_SESSION['data']['prenom']; ?>">
                <br>
                <label for="age">Âge</label>
                <input type="number" name="age" value="<?php echo $_SESSION['data']['age']; ?>">
                <br>
                <label for="role">Rôle</label>
                <input type="text" name="role" value="<?php echo $_SESSION['data']['role']; ?>">
                <br>
                <input type="submit" name="submitUpdate" value="Modifier">
            </form>
            <?php }

        if (isset($_POST['submitUpdate'])) {
            if (empty($_POST['prenom']) || empty($_POST['nom']) || empty($_POST['age']) || empty($_POST['role'])) { ?>
                <p class="alert error">Toutes les infos ont besoin d'être renseigné.</p>
            <?php } else {
                $_SESSION['data']['prenom'] = $_POST['prenom'];
                $_SESSION['data']['nom'] = $_POST['nom'];
                $_SESSION['data']['age'] = $_POST['age'];
                $_SESSION['data']['role'] = $_POST['role'];
            ?>
                <p class="alert success">Tes données utilisateur ont bien été mis à jour !</p>
            <?php }
        }

        if (isset($_GET['page']) && $_GET['page'] == 'connexion' && !empty($_SESSION)) { ?>
            <p class="alert success"> T'es déjà connecté mec, reste concentré !</p>
        <?php }
        ?>
    </div>
</body>

</html>