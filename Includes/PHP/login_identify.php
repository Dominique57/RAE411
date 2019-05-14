<?php
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 23/03/2018
 * Time: 07:51
 */
$login_log = strtolower(htmlspecialchars($_POST['log_username']));
$paswd_log = htmlspecialchars($_POST['log_pswd']);

$response = "No response from the server";
$errorcode = "-1";


if(!isset($login_log) || !isset($paswd_log)) {
    $response = "An error occurred, please try again !";
    $errorcode = "0";
    return;
}
if(empty($login_log) || empty($paswd_log)) {
    $response = "Some Field are empty !";
    $errorcode = "0";
    return;
}
include_once __DIR__.'\\..\\Database\\DbConnect.php';
$hashed = GetServerHashed($paswd_log);
$bdd = Database();

try {
    $req = $bdd->prepare("SELECT * FROM informations WHERE pseudo=:pseudo LIMIT 1");
    $req->execute(array(
        'pseudo' => $login_log));
}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    return;
}

if($donnees = $req->fetch()){
    $serv_paswd = $donnees['pass'];
    if(password_verify($paswd_log, $serv_paswd)){
        $_SESSION['isLogged'] = true;
        $_SESSION['id'] = $donnees['id'];
        $_SESSION['dateCreation'] = $donnees['dateCreation'];
        $_SESSION['firstName'] = $donnees['firstName'];
        $_SESSION['lastName'] = $donnees['lastName'];
        $_SESSION['pseudo'] = $donnees['pseudo'];
        $_SESSION['email'] = $donnees['email'];
        $_SESSION['power'] = $donnees['power'];

        $URL="profile.php?q=".$_SESSION['id'];
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }
    else{
        $response = "Password does not match !";
        $errorcode = 0;
        return;
    }
}
else{
    $response = "Username not found in the database !";
    $errorcode = 1;
    return;
}
$bdd = null;
$bdd = null;
$database;
?>
