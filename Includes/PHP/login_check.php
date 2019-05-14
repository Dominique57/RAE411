<?php
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 23/03/2018
 * Time: 07:51
 */
$login = strtolower(htmlspecialchars($_POST['username']));
$fname = ucfirst(strtolower(htmlspecialchars($_POST['firstname'])));
$lname = strtoupper(htmlspecialchars($_POST['lastname']));
$npaswd = strtolower(htmlspecialchars($_POST['email']));
$npaswd_conf = strtolower(htmlspecialchars($_POST['email_conf']));
$paswd = htmlspecialchars($_POST['pswd']);
$paswd_conf = htmlspecialchars($_POST['pswd_conf']);

$response = "No response from the server";
$errorcode = "-1";


if(!isset($login) || !isset($fname) || !isset($lname) || !isset($npaswd) || !isset($npaswd_conf) || !isset($paswd) || !isset($paswd_conf)) {
    $response = "An error occurred, please try again !";
    $errorcode = "0";
    return;
}
if(empty($login) || empty($fname) || empty($lname) || empty($npaswd) || empty($npaswd_conf) || empty($paswd) || empty($paswd_conf)) {
    $response = "Some Field are empty !";
    $errorcode = "0";
    return;
}
if($npaswd != $npaswd_conf) {
    $response = "The Email Confirm Field does not match !";
    $errorcode = "0";
    return;
}
if($paswd != $paswd_conf){
    $response = "The Password Confirm Field does not match !";
    $errorcode = "0";
    return;
}


include_once __DIR__.'\\..\\Database\\DbConnect.php';
$hashed = GetServerHashed($paswd);
$bdd = Database();

try {
    $req = $bdd->prepare("SELECT pseudo FROM informations WHERE pseudo=:pseudo LIMIT 1");
    $req->execute(array(
        'pseudo' => $login));
}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    return;
}
if($donnees =   $req->fetch()){
    $response = "Username is already being used !";
    $errorcode = "1";
    return;
}
$bdd = null;
$bdd = Database();

try {
    $req = $bdd->prepare("SELECT email FROM informations WHERE email=:email LIMIT 1");
    $req->execute(array(
        'email' => $npaswd));
}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    return;
}
if($donnees = $req->fetch()){
    $response = "Email is already being used !";
    $errorcode = "1";
    return;
}
$bdd = null;
$bdd = Database();


try {
    $req = $bdd->prepare("INSERT INTO informations (firstName, lastName, dateCreation, email, pseudo, pass) 
                                   VALUES(:firstName, :lastName, CURRENT_TIMESTAMP, :email, :pseudo, :pass)");
    $req->execute(array(
        'firstName' => $fname,
        'lastName' => $lname,
        'email' => $npaswd,
        'pseudo' => $login,
        'pass' => $hashed));
}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    return;
}
$bdd = null;

$response = "You successfully signed up ! Please Log in !";
$errorcode = "2";
?>
