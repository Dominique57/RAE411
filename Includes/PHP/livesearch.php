<?php
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 15/03/2018
 * Time: 11:23
 */
//get the q parameter from URL
$q=$_GET["q"];
//lookup all links from the xml file if length of q>0
if (strlen($q)>0) {
    include_once '../Database/DbConnect.php';
    $regex =  '^'.$q;
    $bdd = Database();
    try {
        $req = $bdd->prepare("SELECT firstName, lastName, pseudo, id FROM informations WHERE pseudo REGEXP :reg or firstName REGEXP :reg or lastName REGEXP :reg LIMIT 5");
        $req->execute(array('reg' => $regex));
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    while ($donnees = $req->fetch())
    {
        $link = '/profile.php?q='.$donnees['id'];
        ?>
        <div class="w3-container w3-hover-light-blue w3-blue w3-padding w3-margin" style="cursor:pointer;">
            <h6><?php echo '<a href="'.$link.'">'.$donnees['firstName'].' '.$donnees['lastName'].' <br> '.$donnees['pseudo'] . '</a><br />'; ?></h6>
        </div>
        <?php
    }
}
?>