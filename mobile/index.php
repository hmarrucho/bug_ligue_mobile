<?php
session_start();

include("../util/fonctions.inc.php");
include("./vues/v_header.php") ;

$msgErreurs = array();

if(!isset($_REQUEST['uc']))
    $uc = 'connexion';
else
    $uc = $_REQUEST['uc'];

switch($uc)
{
    case 'connexion':
    {
        if (isset($_SESSION['login'])){
            header("Location:index.php?uc=dash");
        }
        if (isset($_POST['valider'])){
            $pseudo = $_POST['pseudo'];
            $mdp = $_POST['mdp'];

            if (authentifierUser($pseudo, $mdp)){
                header("Location:index.php?uc=dash");
            }else{
                $msgErreurs[] = "Votre login n'a pas été reconnu par l'application";
                include("vues/v_connexion.php");
            }
        }else{
            include("vues/v_connexion.php");
        }

        break;
    }
    case 'dash':
    {
        if (isset($_POST['note'])){
            $message = closeBug();
            include("../vues/v_message.php");
        }
        if (isset($_POST['prio'])){
            $message = updatePrio();
            include('../vues/v_message.php');
        }
        if (isset($_POST['engineer'])){
            $message = updateAssign();
            include('vues/v_message.php');
        }
        if (isset($_SESSION['login'])){
            if ($_SESSION['login']['fonction'] == "Responsable" ){
                $the_bugs = getAllBugs();
            }else{
                if ($_SESSION['login']['fonction'] == "Technicien" ){
                    $the_bugs = getBugsAssign($_SESSION['login']['id']);
                }else{
                    if ($_SESSION['login']['fonction'] == "Club" ){
                        $the_bugs = getBugsOpenByUser($_SESSION['login']['id']);
                    }
                }
            }
        }
        $the_products = getAllProducts();
        $the_techs = getAllTech();
        $tech = "";
        foreach($the_techs as $t){
           $tech .= "<option value='".$t->getId()."'>".$t->getName()." (".$t->getNbAssign().")</option>";
        }
        $bugs_en_cours = $the_bugs[0];
        $bugs_fermes =  $the_bugs[1];
        include("./vues/v_dash.php");
        break;
    }
    case 'nouveau':
    {
        if (isset($_POST['objet'])){
            $message = ajouterNewBug();
            include("vues/v_message.php");
            header("Location:index.php?uc=dash");
        }
        $the_products = getAllProducts();
        $prod = "";
        foreach($the_products as $p){
            $prod .= "<option value='".$p->getId()."'>".$p->getName()."</option>";
        }
        include('./vues/v_nouveau.php');
        break;
    }
    case 'deconnexion' :
    {
        seDeconnecter();
        header("Location: ./");
        break;
    }
}
//include("./vues/v_erreurs.php");
//include("./vues/v_footer.php") ;
?>
