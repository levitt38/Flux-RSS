<?php
require_once("../model/DAO.class.php");
session_start();

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
        header("Location: ../controler/ctrl-home.php");
      }
      //Cas 2 => mauvais password
      else {
        header("Location: ../controler/ctrl-login.php?error=pwd");
      }
    }
      //Cas 3 => login inexistant
    else {
      header("Location: ../controler/ctrl-login.php?error=login");
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
        header("Location: ../controler/ctrl-chose.php?");
      } else { echo "probleme de insert lors de la création de compte"; }
    }
    //Cas 2 => login déja pris
    else {
      header("Location: ../controler/ctrl-login.php?error=taken&sign=1");
    }
  }
  else {
    echo 'problème de connexion coté SignIn';
  }
}


















 ?>
