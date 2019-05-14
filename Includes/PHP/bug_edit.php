<?php
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 15/05/2018
 * Time: 19:19
 */
include_once '../session.php';


$urltogo = '../../bug.php';
if(IsLogged() && HasAccess(3, $_SESSION['power']) && isset($_GET['id']) && isset($_GET['status'])) {
    $id = htmlspecialchars($_GET['id']);
    $status = htmlspecialchars($_GET['status']);
}
else{
    header('Location: '.$urltogo);
    return;
}

if($status == 3){
    try {
        $req = $bdd->prepare("DELETE FROM bug WHERE id=:id");
        $result = $req->execute(array(
            'id' => $id));
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        header('Location: '.$urltogo);
        return;
    }
    header('Location: '.$urltogo);
    return;
}
else if ($status == 0 ||$status == 1 ||$status == 2) {
    print 'status '.$status.' id '.$id;
    try {
        $req = $bdd->prepare("UPDATE bug SET status=:status WHERE id=:id");
        $result = $req->execute(array(
            'status' => $status,
            'id' => $id));
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        header('Location: '.$urltogo);
        return;
    }
    header('Location: '.$urltogo);
}