<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">      
    <meta http-equiv="Content-Type" content="text/html">
    <title>Crud en php</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-wp-preserve="%3Cscript%20src%3D%22js%2Fbootstrap.js%22%3E%3C%2Fscript%3E" data-mce-resize="false" data-mce-placeholder="1" class="mce-object" width="20" height="20" alt="<script>" title="<script>" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> -->


</head>

<body>

    <div class="container">
        <div class="row">
            <h2>Crud en Php</h2>
        </div>
        <div class="row">
            <a href="add.php" class="btn btn-success col-2">Ajouter un user</a>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <th>Name</th>
                        <th>Firstname</th>
                        <th>Age</th>
                        <th>Tel</th>
                        <th>Pays</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th>metier</th>
                        <th>Url</th>
                        <th>Edition</th>
                    </thead>
                    <tbody>
                        <?php include 'database.php'; //on inclut notre fichier de connection
                        $pdo = Database::connect(); //on se connecte à la base 
                        $sql = 'SELECT * FROM testphp ORDER BY id DESC'; //on formule notre requete
                        foreach ($pdo->query($sql) as $row) { //on cree les lignes du tableau avec chaque valeur retournée
                            echo '<tr>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['firstname'] . '</td>';
                            echo '<td>' . $row['age'] . '</td>';
                            echo '<td>' . $row['tel'] . '</td>';
                            echo '<td>' . $row['email'] . '</td>';
                            echo '<td>' . $row['pays'] . '</td>';
                            echo '<td>' . $row['comment'] . '</td>';
                            echo '<td>' . $row['metier'] . '</td>';
                            echo '<td>' . $row['url'] . '</td>';
                            echo '<td>';
                            echo '<a class="btn btn-primary" href="edit.php?id=' . $row['id'] . '">Read</a>'; // un autre td pour le bouton d'edition
                            echo '</td>';
                            echo '<td>';
                            echo '<a class="btn btn-success" href="update.php?id=' . $row['id'] . '">Update</a>'; // un autre td pour le bouton d'update
                            echo '</td>';
                            echo '<td>';
                            echo '<a class="btn btn-danger" href="delete.php?id=' . $row['id'] . ' ">Delete</a>'; // un autre td pour le bouton de suppression
                            echo '</td>';
                            echo '</tr>';
                        }
                        Database::disconnect(); //on se deconnecte de la base
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>