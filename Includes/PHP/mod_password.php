<?php
include_once __DIR__.'/../session.php';
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 27/04/2018
 * Time: 15:09
 */
$npaswd = htmlspecialchars($_POST['newpassword']);
$npaswd_conf = htmlspecialchars($_POST['newpassword_conf']);
$id = htmlspecialchars($_POST['id']);

$_SESSION['reponse_edit_moderator'] = "No response from the server";
$_SESSION['color_edit_moderator'] = "red";
$urltogo = '../../profile.php?q='.$id;


if(!isset($npaswd) || !isset($npaswd_conf)) {
    $_SESSION['reponse_edit_moderator'] = "An error occurred, please try again !";
    $_SESSION['color_edit_moderator'] = "red";
    header('Location: '.$urltogo);
    return;
}
if(empty($npaswd) || empty($npaswd_conf)) {
    $_SESSION['reponse_edit_moderator'] = "Some Field are empty !";
    $_SESSION['color_edit_moderator'] = "red";
    header('Location: '.$urltogo);
    return;
}
if($npaswd != $npaswd_conf) {
    $_SESSION['reponse_edit_moderator'] = "The new password Confirm Field does not match !";
    $_SESSION['color_edit_moderator'] = "red";
    header('Location: '.$urltogo);
    return;
}

include_once __DIR__ . '\\..\\Database\\DbConnect.php';
$bdd = Database();
$hashed = GetServerHashed($npaswd);

try {
    $req = $bdd->prepare("UPDATE informations SET pass=:password WHERE id=:id");
    $result = $req->execute(array(
        'password' => $hashed,
        'id' => $id));
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    $_SESSION['reponse_edit_moderator'] = "An error occurred, please try again !";
    $_SESSION['color_edit_moderator'] = "red";
    header('Location: '.$urltogo);
    return;
}
if ($result) {
    $_SESSION['reponse_edit_moderator'] = "The password has been successfully updated !";
    $_SESSION['color_edit_moderator'] = "green";
    header('Location: '.$urltogo);
    return;
} else {
    $_SESSION['reponse_edit_moderator'] = "Could not access to data in database !";
    $_SESSION['color_edit_moderator'] = "red";
    header('Location: '.$urltogo);
    return;
}
?>