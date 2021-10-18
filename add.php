<?php
require 'database.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

    $nameError = null;
    $name = htmlentities(trim($_POST['name']));
    $valid = true;
    if (empty($name)) {
        $nameError = 'Entrez votre nom';
        $valid = false;
    }
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) { //on initialise nos messages d'erreurs; 
    $nameError = '';
    $firstnameError = '';
    $ageError = '';
    $telError = '';
    $emailError = '';
    $paysError = '';
    $commentError = '';
    $metierError = '';
    $urlError = ''; // on recupère nos valeurs 
    $name = htmlentities(trim($_POST['name']));
    $firstname = htmlentities(trim($_POST['firstname']));
    $age = htmlentities(trim($_POST['age']));
    $tel = htmlentities(trim($_POST['tel']));
    $email = htmlentities(trim($_POST['email']));
    $pays = htmlentities(trim($_POST['pays']));
    $comment = htmlentities(trim($_POST['comment']));
    $metier = htmlentities(trim($_POST['metier']));
    $url = htmlentities(trim($_POST['url'])); // on vérifie nos champs 
    $valid = true;
    if (empty($name)) {
        $nameError = 'Please enter Name';
        $valid = false;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $nameError = "Only letters and white space allowed";
    }
    if (empty($firstname)) {
        $firstnameError = 'Please enter firstname';
        $valid = false;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $nameError = "Only letters and white space allowed";
    }
    if (empty($email)) {
        $emailError = 'Please enter Email Address';
        $valid = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Please enter a valid Email Address';
        $valid = false;
    }
    if (empty($age)) {
        $ageError = 'Please enter your age';
        $valid = false;
    }
    if (empty($tel)) {
        $telError = 'Please enter phone';
        $valid = false;
    } else if (!preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", $tel)) {
        $telError = 'Please enter a valid phone';
        $valid = false;
    }
    if (empty($pays)) {
        $paysError = 'Please select a country';
        $valid = false;
    }
    if (empty($comment)) {
        $commentError = 'Please enter a description';
        $valid = false;
    }
    if (empty($metier)) {
        $metierError = 'Please select a job';
        $valid = false;
    }
    if (empty($url)) {
        $urlError = 'Please enter website url';
        $valid = false;
    } else if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $url)) {
        $urlError = 'Enter a valid url';
        $valid = false;
    } // si les données sont présentes et bonnes, on se connecte à la base
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO testphp (name, firstname, age, tel, email, pays, comment, metier, url) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $firstname, $age, $tel, $email, $pays, $comment, $metier, $url));
        Database::disconnect();
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Crud</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="row col-3 m-auto">
        <div class="container">
            <div class="row">
                <h3>Ajouter un contact</h3>
            </div>
            <form method="POST" action="add.php" class="needs-validation">
                <div class="control-group <?php echo !empty($nameError) ? 'error' : ''; ?>">
                    <label class="control-label">Nom :</label>
                    <div class="controls">
                        <input name="name" class="form-control p-2 m-2 <?php echo !empty($nameError) ? 'is-invalid' : ''; ?> <?php echo !empty($name) ? 'is-valid' : ''; ?>" type="text" placeholder="Nom" value="<?php echo !empty($name) ? $name : ''; ?>">
                        <?php if (!empty($nameError)) : ?>
                            <span class="help-inline"><?php echo $nameError; ?></span>
                        <?php endif; ?>
                        </div>
                </div>

                <div class="control-group<?php echo !empty($firstnameError) ? 'error' : ''; ?>">
                    <label class="control-label">Prénom :</label>
                    <div class="controls">
                        <input type="text" class="form-control p-2 m-2 <?php echo !empty($firstnameError) ? 'is-invalid' : ''; ?> <?php echo !empty($firstname) ? 'is-valid' : ''; ?>" name="firstname" placeholder="Prénom" value="<?php echo !empty($firstname) ? $firstname : ''; ?>">
                        <?php if (!empty($firstnameError)) : ?>
                            <span class="help-inline"><?php echo $firstnameError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="control-group<?php echo !empty($ageError) ? 'error' : ''; ?>">
                    <label class="control-label">Age :</label>
                    <div class="controls">
                        <input type="number" class="form-control p-2 m-2 <?php echo !empty($ageError) ? 'is-invalid' : ''; ?> <?php echo !empty($age) ? 'is-valid' : ''; ?>" name="age" value="<?php echo !empty($age) ? $age : ''; ?>">
                        <?php if (!empty($ageError)) : ?>
                            <span class="help-inline"><?php echo $ageError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($emailError) ? 'error' : ''; ?>">
                    <label class="control-label">Adresse Email :</label>
                    <div class="controls">
                        <input name="email" class="form-control p-2 m-2 <?php echo !empty($emailError) ? 'is-invalid' : ''; ?> <?php echo !empty($email) ? 'is-valid' : ''; ?>" type="text" placeholder="Adresse Email" value="<?php echo !empty($email) ? $email : ''; ?>">
                        <?php if (!empty($emailError)) : ?>
                            <span class="help-inline"><?php echo $emailError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($telError) ? 'error' : ''; ?>">
                    <label class="control-label">Téléphone :</label>
                    <div class="controls">
                        <input name="tel" class="form-control p-2 m-2 <?php echo !empty($telError) ? 'is-invalid' : ''; ?> <?php echo !empty($tel) ? 'is-valid' : ''; ?>" type="text" placeholder="Téléphone" value="<?php echo !empty($tel) ? $tel : ''; ?>">
                        <?php if (!empty($telError)) : ?>
                            <span class="help-inline"><?php echo $telError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($paysError) ? 'error' : ''; ?> <?php echo !empty($pays) ? 'is-valid' : ''; ?>">
                    <div><label class="control-label">Ville :</label></div>
                    <select name="pays" class="form-select p-2 m-2 <?php echo !empty($paysError) ? 'is-invalid' : ''; ?> <?php echo !empty($pays) ? 'is-valid' : ''; ?>" >
                        <option value="" selected>Choisir</option>
                        <option value="amsterdam">Amsterdam</option>
                        <option value="londres">Londres</option>
                        <option value="marseille">Marseille</option>
                        <option value="paris">Paris</option>
                    </select>
                    <?php if (!empty($paysError)) : ?>
                        <span class="help-inline"><?php echo $paysError; ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="control-group<?php echo !empty($metierError) ? 'error' : ''; ?>">
                    <label class="checkbox-inline">Métier :</label>
                    <div class="controls" >
                        Développeur
                        <input type="radio" checked name="metier" value="dev" <?php if (isset($metier) && $metier == "dev") echo "checked"; ?>>
                        Intégrateur
                        <input type="radio" name="metier" value="integrateur" <?php if (isset($metier) && $metier == "integrateur") echo "checked"; ?>>
                        Réseau
                        <input type="radio" name="metier" value="reseau" <?php if (isset($metier) && $metier == "reseau") echo "checked"; ?>>
                    </div>

                    <?php if (!empty($metierError)) : ?>
                        <span class="help-inline"><?php echo $metierError; ?></span>
                    <?php endif; ?>
                </div>
                <div class="control-group  <?php echo !empty($urlError) ? 'error' : ''; ?>">
                    <label class="control-label">Site web :</label>
                    <div class="controls">
                        <input type="text" class="form-control p-2 m-2 <?php echo !empty($urlError) ? 'is-invalid' : ''; ?> <?php echo !empty($url) ? 'is-valid' : ''; ?>" name="url" value="<?php echo !empty($url) ? $url : ''; ?>" >
                        <?php if (!empty($urlError)) : ?>
                            <span class="help-inline"><?php echo $urlError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="control-group <?php echo !empty($commentError) ? 'is-invalid' : ''; ?>">
                    <label class="control-label">Commentaire </label>
                    <div class="controls">
                        <textarea class="form-control p-2 m-2 <?php echo !empty($commentError) ? 'is-invalid' : ''; ?> <?php echo !empty($comment) ? 'is-valid' : ''; ?>" rows="4" cols="30" name="comment"><?php if (isset($comment)) echo $comment; ?></textarea>
                        <?php if (!empty($commentError)) : ?>
                            <span class="help-inline"><?php echo $commentError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-actions">
                    <input type="submit" class="btn btn-success" name="submit" value="submit">
                    <a class="btn" href="index.php">Retour</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>