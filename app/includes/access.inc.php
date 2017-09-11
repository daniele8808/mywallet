<?php

function userIsLoggedIn() {
  if (isset($_POST['action']) and $_POST['action'] == 'login') {
    if (!isset($_POST['mail']) or $_POST['mail'] == '' or !isset($_POST['password']) or $_POST['password'] == '') {
      
      $GLOBALS['loginError'] = 'Compila entrambi i campi';
      return FALSE;
    }

    //$password = md5($_POST['password'] . '1234');
    $password = md5($_POST['password']);

    if (databaseContainsAuthor($_POST['mail'], $password)) {
      session_start();
      $_SESSION['loggedIn'] = TRUE;
      $_SESSION['mail'] = $_POST['mail'];
      $_SESSION['password'] = $password;
      return TRUE;
    } else {
      session_start();
      unset($_SESSION['loggedIn']);
      unset($_SESSION['mail']);
      unset($_SESSION['password']);
      $GLOBALS['loginError'] =
          'La mail o la pasword non sono corrette.';
      return FALSE;
    }
  }

  if (isset($_POST['action']) and $_POST['action'] == 'logout') {
    session_start();
    unset($_SESSION['loggedIn']);
    unset($_SESSION['mail']);
    unset($_SESSION['password']);
    header('Location: ' . $_POST['goto']);
    exit();
  }

  session_start();
  if (isset($_SESSION['loggedIn'])) {
    return databaseContainsAuthor($_SESSION['mail'], $_SESSION['password']);
  }
}

function databaseContainsAuthor($mail, $password) {
  include 'db.inc.php';

  try {
    $sql = 'SELECT COUNT(*), utente FROM utenti
        WHERE mail = :mail AND password = :password';
    $s = $pdo->prepare($sql);
    $s->bindValue(':mail', $mail);
    $s->bindValue(':password', $password);
    $s->execute();
  }
  catch (PDOException $e) {
    $error = 'Errore nella ricerca dell\'utente.';
    include 'error.html.php';
    exit();
  }

  $row = $s->fetch();
  
  if ($row[0] > 0) {
    return TRUE;
  } else {
    return FALSE;
  }
}

function userHasRole($role) {

  include 'db.inc.php';
  try
  {
    $sql = "SELECT COUNT(*) FROM utenti
        INNER JOIN utentiruoli ON utenti.id = utenteid
        INNER JOIN ruoli ON ruoloid = ruoli.id
        WHERE mail = :mail AND ruoli.id = :ruoloid";
    $s = $pdo->prepare($sql);
    $s->bindValue(':mail', $_SESSION['mail']);
    $s->bindValue(':ruoloid', $role);
    $s->execute();
  } catch (PDOException $e) {
    $error = 'Errore nella ricarca del ruolo utente.';
    include 'error.html.php';
    exit();
  }

  $row = $s->fetch();

  if ($row[0] > 0) {
    return TRUE;
  } else {
    return FALSE;
  }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function ceck_username($mail){
  include 'db.inc.php';

    try {
      $sql = 'SELECT utente FROM utenti WHERE mail = :mail';
      $s = $pdo->prepare($sql);
      $s->bindValue(':mail', $mail);
      $s->execute();
    }
    catch (PDOException $e) {
      $error = 'Errore nella ricerca dell\'utente.';
      include 'error.html.php';
      exit();
    }

    $utente = $s->fetch();
    $GLOBALS['utente_loggato'] = $utente;
}

function isConnected(){
  if (userIsLoggedIn() == TRUE){
    return TRUE;
  }
}