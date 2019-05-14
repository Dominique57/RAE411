<?php
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 26/04/2018
 * Time: 19:44
 */
$title = htmlspecialchars($_POST['title']);
$message = htmlspecialchars($_POST['message']);

$response = "No response from the server";
$errorcode = "-1";


if(!isset($title) || !isset($message)) {
    $response = "An error occurred, please try again !";
    $errorcode = "0";
    return;
}
if(empty($title) || empty($message)) {
    $response = "Some Field are empty !";
    $errorcode = "0";
    return;
}
if(strlen($message) > 500){
    $response = "The message can not be larger than 500 characters !";
    $errorcode = "0";
    return;
}


include_once __DIR__.'\\..\\Database\\DbConnect.php';
$bdd = Database();

try {
    $req = $bdd->prepare("INSERT INTO bug (status, author, title, description) 
                                   VALUES(0, :author, :title, :description)");
    $req->execute(array(
        'author' => $_SESSION['pseudo'],
        'title' => $title,
        'description' => $message));
}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    return;
}
$bdd = null;

$response = "You successfully send the bug report ! The team will handle it as soon as possible : <br>
             Ps : the bug report will appear as soon as you refresh the page !";
$errorcode = "2";
?>
