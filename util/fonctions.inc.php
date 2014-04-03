<?php
/**
 * teste si une chaîne a un format de code postal
 *
 * Teste le nombre de caractères de la chaîne et le type entier (composé de chiffres)
 * @param $codePostal : la chaîne testée
 * @return : vrai ou faux
*/
function estUnCp($codePostal)
{
   
   return strlen($codePostal)== 5 && estEntier($codePostal);
}
/**
 * teste si une chaîne est un entier
 *
 * Teste si la chaîne ne contient que des chiffres
 * @param $valeur : la chaîne testée
 * @return : vrai ou faux
*/

function estEntier($valeur) 
{
	return preg_match("/[^0-9]/", $valeur) == 0;
}
/**
 * Teste si une chaîne a le format d'un mail
 *
 * Utilise les expressions régulières
 * @param $mail : la chaîne testée
 * @return : vrai ou faux
*/
function estUnMail($mail)
{
return  preg_match ('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#', $mail);
}
/*
 * Fonction qui verifie si utilisateur est connecté
 * renvoie 1 si connecté
 * renvoie 0 si non connecté
 *
 */
function estConnecter(){
    $resu = 0;
    if(isset($_SESSION['login'])){
        $resu = 1;
    }
    return $resu;
}

/*
 * Déconnecte l'utilisateur
 */
function seDeconnecter(){
   unset($_SESSION['login']);
    echo'Vous avez été déconnecté';
}

/*
 * Fonction qui verifie si utilisateur est valide
 * reçoit le login et le mot de passe à vérifier.
 * La fonction s'occcupe de créer la variable session 'status' pour identifier le type d'utilisateur connecté
 * renvoie 1 si ok
 * renvoie 0 si non ok
 *
 */
function authentifierUser($l,$m){
    require $_SERVER['DOCUMENT_ROOT']."/bug_ligue_mobile/bootstrap.php";

    $dql = "SELECT u FROM User u WHERE u.login = '$l' AND u.mdp = '$m'";

    $query = $entityManager->createQuery($dql);
    $query->setMaxResults(1);
    $users = $query->getResult();

    if (count($users) > 0){
        $leClub = null;
        if ($users[0]->getLeClub() != null){
            $leClub = $users[0]->getLeClub()->getNumClub();
        }
        $log = array('id'=>$users[0]->getId(),'identite'=>$users[0]->getPrenom() . " " .$users[0]->getName(), 'fonction'=>$users[0]->getFonction(), 'club'=>$leClub );
        $_SESSION['login'] = $log;
        return 1;
    }else{
        return 0;
    }
}

//Fonction qui va rechercher les bugs du clubs
function getBugsOpenByUser($id){
    require $_SERVER['DOCUMENT_ROOT']."/bug_ligue_mobile/bootstrap.php";
    $users = $entityManager->find('User', $id);
    $bugs = $users->getReportedBugs();
    $tab1 = array();
    $tab2 = array();
    foreach ($bugs as $bug) { //Trier les bugs
        if ($bug->getStatus() == "Clos"){ //Si clos, le bug va dans le tab2
            $tab2[] = $bug;
        }else{ //Sinon le bug va dans le tab1
            $tab1[] = $bug;
        }
    }
    $tab1 = array_reverse($tab1); //Inverse le sens du tableau
    $tab2 = array_reverse($tab2);
    $retour = array($tab1, $tab2);
    return $retour;
}

//Fonction qui va rechercher les bugs assignés au technicien
function getBugsAssign($id){
    require $_SERVER['DOCUMENT_ROOT']."/bug_ligue_mobile/bootstrap.php";
    $users = $entityManager->find('User', $id);
    $bugs = $users->getAssignedBugs();
    $tab1 = array();
    $tab2 = array();
    foreach ($bugs as $bug) {
        if ($bug->getStatus() == "Clos"){
            $tab2[] = $bug;
        }else{
            $tab1[] = $bug;
        }
    }
    $tab1 = array_reverse($tab1);
    $tab2 = array_reverse($tab2);
    $retour = array($tab1, $tab2);
    return $retour;
}

//Fonction qui va rechercher la totalité des produits
function getAllProducts(){
    require $_SERVER['DOCUMENT_ROOT']."/bug_ligue_mobile/bootstrap.php";
    $productRepository = $entityManager->getRepository('Product');
    $products = $productRepository->findAll();
    return $products;
}

//Fonction qui va rechercher la totalité des bugs
function getAllBugs(){
    require $_SERVER['DOCUMENT_ROOT']."/bug_ligue_mobile/bootstrap.php";
    $bugRepository = $entityManager->getRepository('Bug');
    $bugs = $bugRepository->findAll();
    $tab1 = array();
    $tab2 = array();
    foreach ($bugs as $bug) {
        if ($bug->getStatus() == "Clos"){
            $tab2[] = $bug;
        }else{
            $tab1[] = $bug;
        }
    }
    $tab1 = array_reverse($tab1);
    $tab2 = array_reverse($tab2);
    $retour = array($tab1, $tab2);
    return $retour;
}

//Fonction qui va rechercher l'ensemble des techniciens
function getAllTech(){
    require $_SERVER['DOCUMENT_ROOT']."/bug_ligue_mobile/bootstrap.php";
    $techRepository = $entityManager->getRepository('User');
    $techs = $techRepository->findAll();

    foreach ($techs as $tech) {
        if ($tech->getFonction() == "Technicien"){
            $listeTechs[] = $tech;
        }
    }

    return $listeTechs;
}

//Fonction qui permet de créer un nouveau bug
function ajouterNewBug(){
    $obj = $_POST['objet'];
    if($obj==""){
        return "Renseignez un objet svp";
    }
    $lib = $_POST['libelle'];
    if (isset($_POST['apps'])){
        $apps = $_POST['apps'];
    }

    require $_SERVER['DOCUMENT_ROOT']."/bug_ligue_mobile/bootstrap.php";

    $reporter = $entityManager->find("User", $_SESSION['login']['id']);
    //$engineer = new User();

    $bug = new Bug();
    $bug->setResume($obj);
    $bug->setDescription($lib);
    $bug->setCreated(new DateTime("now"));
    $bug->setStatus("Ouvert");
    if(isset($apps)){
        foreach ($apps as $productId) {
            $product = $entityManager->find("Product", $productId);
            $bug->assignToProduct($product);
        }
    }

    $bug->setReporter($reporter);
    //$bug->setEngineer($engineer);

    $entityManager->persist($bug);
    $entityManager->flush();

//UPLOAD IMAGE
    if (isset($_FILES['capture']) AND $_FILES['capture']['error'] == 0)
    {
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['capture']['size'] <= 1000000)
        {
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES['capture']['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
            if (in_array($extension_upload, $extensions_autorisees))
            {
                // On peut valider le fichier et le stocker définitivement
                $dossier = 'images/capturebug';
                $name = $bug->getId();
                move_uploaded_file($_FILES['capture']['tmp_name'], $dossier.'/'.$name.'.'.$extension_upload);
                $bug->setImage($dossier.'/'.$name.'.'.$extension_upload);
            }else{
                return "Extension non acceptée.";
            }
        }else{
            return "Image trop volumineuse.";
        }
    }

    $entityManager->persist($bug);
    $entityManager->flush();

    return "Le bug à été crée";
}

//Function qui permet d'un technicien à un bug
function updateAssign(){
    $idbug = $_REQUEST['bug'];
    $id_engineer = $_REQUEST['engineer'];
    require $_SERVER['DOCUMENT_ROOT']."/bug_ligue_mobile/bootstrap.php";
    $engineer= $entityManager->find("User", $id_engineer);
    $bug = $entityManager->find("Bug",$idbug);
    $bug->setEngineer($engineer);

    $entityManager->flush();

    return "Le bug a bien été assigné";
}

//Fonction qui permet modifier le niveau de priorite
function updatePrio(){
    $idbug = $_REQUEST['bug'];
    $prio = $_REQUEST['prio'];
    require $_SERVER['DOCUMENT_ROOT']."/bug_ligue_mobile/bootstrap.php";
    $bug = $entityManager->find("Bug",$idbug);
    $bug->setPriorite($prio);

    $entityManager->flush();

    return "L'indice de priorité a été mis à jour";
}

//Fonction qui permet de clos un bug
function closeBug(){
    $idbug = $_REQUEST['bug'];
    $note = $_REQUEST['note'];

    require $_SERVER['DOCUMENT_ROOT']."/bug_ligue_mobile/bootstrap.php";

    $bug = $entityManager->find("Bug",$idbug);
    $bug->setNote($note);
    $bug->setStatus("Clos");
    if($_SESSION['login']['fonction'] == 'Responsable'){
        $assigned = $entityManager->find("User", $_SESSION['login']['id']);
        $bug->setEngineer($assigned);
    }

    $entityManager->persist($bug);
    $entityManager->flush();

    return "Le bug est clos";
}

//Fonction qui permet de supprimeer un bug
function deletBug(){
    $idbug = $_REQUEST['bug'];

    require $_SERVER['DOCUMENT_ROOT']."/bug_ligue_mobile/bootstrap.php";

    $bug = $entityManager->find("Bug",$idbug);
    $entityManager->remove($bug);
    $entityManager->flush();

    return "Bug supprimé";
}
?>