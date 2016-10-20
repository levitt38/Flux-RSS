<?php
require_once("../model/DAO.class.php");
session_start();

if( ! isset($_SESSION["id"])){
  header("Location: ../controler/ctrl-login.php");
}

$result = $dao->getUserByID($_SESSION["id"]);

if( !empty($_POST["pwd"]) && !empty($_POST["new_pwd"]) && !empty($_POST["new_pwdBIS"])){
  $oldpwd = $_POST["pwd"];
  $newpwd = $_POST["new_pwd"];
  $newpwdBIS = $_POST["new_pwdBIS"];
//Cas n°1 => ancien mot de passe incorrect
  if( ! password_verify($oldpwd, $result[0]["mp"])){
    header("Location: ../controler/ctrl-option.php?error=oldpwd");
  }
//Cas n°2 => nouveaux mots de passe non-correspondant
  elseif($newpwd != $newpwdBIS){
    header("Location: ../controler/ctrl-option.php?error=newpwd");
  }
//Cas n°3 => cas 1&2 sans erreurs => Modification validée
  else{
    $newpwd = password_hash($newpwd, PASSWORD_BCRYPT);
    $dao->updateUserPWD($_SESSION["id"],$newpwd);
    header("Location: ../controler/ctrl-option.php?error=success");
  }
} else {
  header("Location: ../controler/ctrl-option.php");
}



 ?>
