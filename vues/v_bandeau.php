<div id="bandeau">
<!-- Images En-t�te -->
    <img src="images/iconemlg.png" alt="Icone maison des ligues" style="float: left;"><br><br><h1>HelpDesk Maison des ligues</h1>
</div>
<!--  Menu haut-->
<ul id="menu">


    <?php
        if(estConnecter()){
            echo '<li><a href="index.php?uc=dash"> Mon tableau de bord </a></li>';
            echo '<li><a href="#" data-width="500" data-rel="popup1" data-action="nouveau" class="poplight" >Nouvel incident</a></li>';
            echo '<li><a href="index.php?uc=deconnexion">Se déconnecter</a></li>';
        }else{
            echo '<li><a href="index.php?uc=accueil"> Accueil </a></li>';
        }
    ?>
</ul>
