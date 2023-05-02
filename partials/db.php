<?php 

// per definire delle costanti, si utilizza una sintassi particolare
// per best practice, le variabili costanti sono definite tutte in maiuscolo
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "university");


$connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

// controllo se la connessione ha errori
if ($connection && $connection->connect_error) {
  // in caso ci siano errori
  // echo "Connessione al database fallita";
  exit();
}