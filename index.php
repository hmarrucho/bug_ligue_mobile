<?php
session_start();

include("util/fonctions.inc.php");
include("vues/v_entete.php") ;
include("vues/v_bandeau.php") ;

$msgErreurs = array();

if(!isset($_REQUEST['uc']))
    $uc = 'accueil';
else
	$uc = $_REQUEST['uc'];

if (!isset($_SESSION['login'])){
    $uc="connexion";
}

switch($uc)
{
	case 'accueil':
		{
            header("Location:index.php?uc=dash");
            break;
        }
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
        if (isset($_SESSION['login'])){
            if ($_SESSION['login']['fonction'] == "Responsable" ){
                include("./controleurs/c_dashboard_resp.php");
            }else{
                if ($_SESSION['login']['fonction'] == "Technicien" ){
                    include("./controleurs/c_dashboard_tech.php");
                }else{
                    if ($_SESSION['login']['fonction'] == "Club" ){

                        include("./controleurs/c_dashboard_club.php");
                    }
                }
            }
        }
        break;
    }
    case 'deconnexion' :
    {
        seDeconnecter();
        header("Location: ./");
    }
}
include("vues/v_erreurs.php");
include("vues/v_pied.php") ;
?>

