<?php
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 26/04/2018
 * Time: 16:15
 */
session_start();
if(!IsLogged()) {
    $_SESSION['power'] = -1;
}
else{
    include_once 'Database/DbConnect.php';
    $bdd = Database();
    try {
        $req = $bdd->prepare("SELECT power FROM informations WHERE id=:id LIMIT 1");
        $result = $req->execute(array(
            'id' => $_SESSION['id']));
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        return;
    }
    if($donnes = $req->fetch()){
        if($donnes['power'] != $_SESSION['power'])
            $_SESSION['power'] = $donnes['power'];
    }
    else
        $_SESSION['power'] = -1;
}

function IsLogged($paramtocheck = ''){
    if(!empty($paramtocheck))
        return isset($_SESSION['id']) && !empty($_SESSION['id']) && (isset($_SESSION[$paramtocheck]));
    else
        return isset($_SESSION['id']) && !empty($_SESSION['id']);
}

function HasAccess($prequired, $userpower = -1){
    if($userpower <= -1) {
        if (IsLogged())
            $userpower = $_SESSION['power'];
        else
            return false;
    }
    return $userpower >= $prequired;
}

function IsBanned($userpower = -1){
    return $userpower == 0;
}

function UserIsOnHisProfile($idToCompare){
    return IsLogged() && !empty($idToCompare) && $_SESSION['id'] == $idToCompare;
}

function RedirectImmediatly($url){
    echo $url;
    echo "<script type='text/javascript'>document.location.href='{$url}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $url . '">';
}

function GetUserRank($power){
    switch ($power){
        case -1:
            return "Visitor";
            break;
        case 0:
            return "Banned";
            break;
        case 1:
            return "User";
            break;
        case 2:
            return "VIP";
            break;
        case 3:
            return "Moderator";
            break;
        case 4:
            return "Administrator";
            break;
        default:
            return "Banned";
            break;
    }
}

function GetPathRank($power){
    switch ($power){
        case 0:
            return '\img\Banned.png';
        case 1:
            return '\img\User.png';
        case 2:
            return '\img\Sponsor.png';
        case 3:
            return '\img\Mod.png';
        case 4:
            return '\img\Admin.png';
        default:
            return '\img\Banned.png';
    }
}


?>