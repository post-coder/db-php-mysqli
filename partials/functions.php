<?php


function login($username, $password, $connection) {

  // dobbiamo controllare che esista una riga nella tabella users che abbia username uguale a quello che ha inserito l'utente
  // e password uguale NELLA STESSA RIGA

  $criptedPassword = md5($password);

  $query = "
    SELECT * 
    FROM `users`
    WHERE `username` = '$username' AND `password` = '$criptedPassword'
  ";

  // per evitare i problemi di SQL injections si usano le prepared statements

  $statement = $connection->prepare("SELECT * 
                                      FROM `users`
                                      WHERE `username` = ? AND `password` = ?");

  $statement->bind_param('ss', $username, $criptedPassword);

  $statement->execute();

  $result = $statement->get_result();

  // $result = $connection->query($query);


  // var_dump($result);

  if($result->num_rows > 0) {
    // allora l'utente ha effettuato correttamente il login
    
    $row = $result->fetch_assoc();
    return $row['id'];

    var_dump($row);

  } else {
    return false;
  }

}