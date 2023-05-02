<?php

// se noi facciamo la connessione prima di richiedere le funzioni, queste funzioni possono già utilizzare la connessione che creiamo
require_once './partials/db.php';

require_once './partials/functions.php';

// controllo se sto ricevendo una chiamata post con username e password

if(isset($_POST['username'], $_POST['password'])) {
  

  session_start();

  if(login($_POST['username'], $_POST['password'], $connection) > 0) {
    $_SESSION['userId'] = login($_POST['username'], $_POST['password'], $connection);
    header('Location: index.php');
  } else {
    echo "login fallito";
  }

} 