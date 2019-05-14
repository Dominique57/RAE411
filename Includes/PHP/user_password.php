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
$paswd = htmlspecialchars($_POST['password']);
$id = htmlspecialchars($_POST['id']);

$_SESSION['reponse_edit_setting'] = "No response from the server";
$_SESSION['color_edit_setting'] = "red";
$urltogo = '../../profile.php?q='.$id;


if(!isset($npaswd) || !isset($npaswd_conf) || !isset($paswd)) {
    $_SESSION['reponse_edit_setting'] = "An error occurred, please try again !";
    $_SESSION['color_edit_setting'] = "red";
    header('Location: '.$urltogo);
    return;
}
if(empty($npaswd) || empty($npaswd_conf) || empty($paswd)) {
    $_SESSION['reponse_edit_setting'] = "Some Field are empty !";
    $_SESSION['color_edit_setting'] = "red";
    header('Location: '.$urltogo);
    return;
}
if($npaswd != $npaswd_conf) {
    $_SESSION['reponse_edit_setting'] = "The new password Confirm Field does not match !";
    $_SESSION['color_edit_setting'] = "red";
    header('Location: '.$urltogo);
    return;
}

include_once __DIR__ . '\\..\\Database\\DbConnect.php';
$bdd = Database();

try {
    $req = $bdd->prepare("SELECT pass FROM informations WHERE id=:id LIMIT 1");
    $req->execute(array(
        'id' => $id));
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    $_SESSION['reponse_edit_setting'] = "An error occurred, please try again !";
    $_SESSION['color_edit_setting'] = "red";
    header('Location: '.$urltogo);
    return;
}
if ($donnees = $req->fetch()) {
    $hashed = GetServerHashed($npaswd);
    $serv_paswd = $donnees['pass'];
    if (password_verify($paswd, $serv_paswd)) {
        try {
            $req = $bdd->prepare("UPDATE informations SET pass=:password WHERE id=:id");
            $result = $req->execute(array(
                'password' => $hashed,
                'id' => $id));
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            $_SESSION['reponse_edit_setting'] = "An error occurred, please try again !";
            $_SESSION['color_edit_setting'] = "red";
            header('Location: '.$urltogo);
            return;
        }
        if ($result) {
            $_SESSION['reponse_edit_setting'] = "Your password has been successfully updated !";
            $_SESSION['color_edit_setting'] = "green";
            header('Location: '.$urltogo);
            return;
        } else {
            $_SESSION['reponse_edit_setting'] = "Could not access to data in database !";
            $_SESSION['color_edit_setting'] = "red";
            header('Location: '.$urltogo);
            return;
        }
    } else {
        $_SESSION['reponse_edit_setting'] = "Password does not match !";
        $_SESSION['color_edit_setting'] = "orange";
        header('Location: '.$urltogo);
        return;
    }
} else {
    $_SESSION['reponse_edit_setting'] = "Username not found in the database !";
    $_SESSION['color_edit_setting'] = "orange";
    header('Location: '.$urltogo);
    return;
}
?>