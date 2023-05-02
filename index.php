<?php
session_start();

if(isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
} else {
    header('Location: login.php');
}


require_once './partials/db.php';

// so che se sto eseguendo queste righe del codice, la connessione è andata a buon fine
// echo "connessione riuscita";

$query = "
    SELECT * 
    FROM `departments`;
";


$result = $connection->query($query);

// var_dump($result);


// faccio alcuni controlli prima di stampare in pagina direttamente i risultati
// devo controllare innanzitutto che il risultato non abbia un errore
// che le righe siano più di 0

if($result && $result->num_rows > 0) {
    // sono sicuro che ci sia almeno una riga dalla tabella risultante della nostra query
    // echo "trovate delle righe nel database!";

    // creiamo un array che conterrà tutte le righe
    $departments;

    while ($row = $result->fetch_assoc()) {

        // var_dump($row);
        $departments[] = $row;

    }

    // fuori dal while significa che abbiamo finito le righe da controllare


} else {
    echo "nessun risultato trovato";
}


?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP MySQLi</title>
</head>
<body>


    <h1>
        Dipartimenti della nostra università:
        utente <?= $_SESSION['userId'] ?>
    </h1>

    <ul>

        <?php 
            foreach($departments as $singleDepartment) {
                ?>
                <li>
                    <strong><?= $singleDepartment['name'] ?></strong> - <?= $singleDepartment['address'] ?>
                </li>
                <?php
            }
        ?>

    </ul>

</body>
</html>