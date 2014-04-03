<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Eric
 * Date: 20/02/14
 * Time: 19:10
 * To change this template use File | Settings | File Templates.
 */

if(!isset($_REQUEST['action']))
    $action = 'list';
else
    $action = $_REQUEST['action'];

switch($action){
    case 'list':{
        if (isset($_POST['objet'])){  // Si l'objet est passé
            $message = ajouterNewBug(); // On ajoute un new bug
            include("vues/v_message.php");
        }
        $the_bugs = getBugsOpenByUser($_SESSION['login']['id']); //Recupere la liste des bugs. Ouvert par le club
        $nbouvert = count($the_bugs[0]); // Compte le nombre bug ouvert
        $nbclos = count($the_bugs[1]); // Compte le nombre de bug fermé
        $bugs = array_merge($the_bugs[0],$the_bugs[1]); // Rassemblement des deux tableaux
        $the_products = getAllProducts();
        include("vues/v_dashboard_club.php");
        break;
    }
}
