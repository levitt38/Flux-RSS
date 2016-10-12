<?php
require_once("../model/DAO.class.php");

if(count($_POST["etat"])<1){
  die("erreur hidden input");
}

// Tentative de login
if($_POST["etat"]=="login"){
  if(isset($_POST["Login_user"]) && isset($_POST["Login_pwd"])){
    $login = $_POST["Login_user"];
    $pwd = $_POST["Login_pwd"];
    $result = $dao->getUserByLogin($login);

    if( $result != false){
      //Cas 1 => bon login
      if(password_verify($pwd, $result[0]["mp"])){
        session_start();
        $_SESSION["id"] = $result[0]["id"];
        header("Location: http://www-etu-info.iut2.upmf-grenoble.fr/~nourik/m3104/tp1/BobMi-l-heure/controler/ctrl-home.php");
      }
      //Cas 2 => mauvais password
      else {
        header("Location: http://www-etu-info.iut2.upmf-grenoble.fr/~nourik/m3104/tp1/BobMi-l-heure/controler/ctrl-login.php?error=pwd");
      }
    }
      //Cas 3 => login inexistant
    else {
        header("Location: http://www-etu-info.iut2.upmf-grenoble.fr/~nourik/m3104/tp1/BobMi-l-heure/controler/ctrl-login.php?error=login");
    }
  }
}
// Tentative de création de compte
else {
  if(isset($_POST["Sign_user"]) && isset($_POST["Sign_pwd"])){
    $login = $_POST["Sign_user"];
    $pwd = $_POST["Sign_pwd"];
    $pwd = password_hash($pwd, PASSWORD_BCRYPT);
    $result = $dao->getUserByLogin($login);

    //Cas 1 => inscription validée
    if($result == 0){
      $result = $dao->insertNewUser($login,$pwd);
      if($result==true){
        session_start();
        $_SESSION["id"] = $login;
        header("Location: ctrl-chose.php?");
      } else { echo "probleme de insert"; }
    }
    //Cas 2 => login déja pris
    else {
      header("Location: http://www-etu-info.iut2.upmf-grenoble.fr/~nourik/m3104/tp1/BobMi-l-heure/controler/ctrl-login.php?error=taken&sign=1");
    }
  }
}


















 ?>
