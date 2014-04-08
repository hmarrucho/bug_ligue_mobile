<?php
session_start();

include("../util/fonctions.inc.php");
include("./vues/v_header.php") ;

$msgErreurs = array();

if(!isset($_REQUEST['uc']))
    $uc = 'accueil';
else
    $uc = $_REQUEST['uc'];

switch($uc)
{
    case 'accueil':
    {
        include("./vues/v_connexion.php");
        break;
    }

    case 'connexion':
    {
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
        $bugs_en_cours = $the_bugs[0];
        $bugs_fermes =  $the_bugs[1];
        include("./vues/v_dash.php");
        break;
    }
}
//include("./vues/v_erreurs.php");
//include("./vues/v_footer.php") ;
?>
