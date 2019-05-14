<?php
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 23/03/2018
 * Time: 07:51
 */

if(!isset($_POST['email'])){
    echo "2";
    die();
    }

$email = strtolower(htmlspecialchars($_POST['email']));
if(empty($email)){
    echo "2";
    die();
}

include_once '../Database/DbConnect.php';
$bdd = Database();

try {
    $req = $bdd->prepare("SELECT email FROM newsletter WHERE email=:email LIMIT 1");
    $req->execute(array(
        'email' => $email));
}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    echo "2";
    die();
}
if($donnees = $req->fetch()){
    echo "1";
    die();
}
$bdd = null;
$bdd = Database();

try {
    $req = $bdd->prepare("INSERT INTO newsletter (email, dateSub, isactive) 
                                   VALUES(:email, CURRENT_TIMESTAMP, TRUE)");
    $req->execute(array(
        'email' => $email));
}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    echo "2";
    die();
}
$bdd = null;
echo "0";
die();

?>