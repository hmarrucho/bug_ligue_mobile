<a id='lnkDialog' href="#ticket_dialog" data-transition="flip" style='display:none;'></a>

<div data-role="page">
    <div data-role="header" data-position="fixed" >
        <div data-role="navbar">
            <ul>
                <li><a href="index.php?uc=dash" data-role="button" data-icon="home" >Tableau de bord</a></li>
                <li><a href="index.php?uc=nouveau" data-role="button" data-icon="plus">Nouveau bug</a></li>
                <li><a href="index.php?uc=deconnexion" data-role="button" data-icon="delete">Deconnexion</a></li>
            </ul>
        </div>
    </div>
    <div data-role="content">
        <h4>Bienvenue sur votre console de gestion</h4>

        <div data-role="collapsible-set" data-theme="b" data-content-theme="a">
            <div id="liste_tickets">
            <div data-role="collapsible" data-collapsed="true">
                <h3>Tickets en cours</h3>
                <p>
                <table><tr><th></th><th>Numéro</th><th>Titre</th><th>Date</th></tr>
                    <?php
                    foreach ($bugs_en_cours as $bug) {
                        if ($bug->getEngineer() != null){
                            $engineer = $bug->getEngineer()->getName();
                        }else{
                            $engineer = "non affecté";
                        }
                        echo "<tr>";
                        echo "<td><img src='../images/en_cours.png' width='30px' height='30px'/></td>";
                        echo "<td class='colonneid'>".$bug->getId()."</td>";
                        echo "<td =class'colonneresume'>".$bug->getResume()."</td>";
                        echo "<td class='colonnedate'>".$bug->getCreated()->format('d.m.Y')."</td>";
                        //echo "<td class='colonnetech'>".$engineer."</td>";
                        //echo "<td class='colonneprod'>";
                        //foreach ($bug->getProducts() as $product) {
                            //echo "- ".$product->getName()." ";
                        //}
                        echo "</td>";
                        //echo "<li>".$bug->getDescription()."</li>";
                        echo "</tr>";
                    }
                    ?>


                </table>
                </p>
            </div>

            <div data-role="collapsible">
                <h3>Tickets cloturés</h3>
                <p>
                <table><tr><th></th><th>Numéro</th><th>Titre</th><th>Date</th></tr>
                    <?php
                    foreach ($bugs_fermes as $bug) {
                        if ($bug->getEngineer() != null){
                            $engineer = $bug->getEngineer()->getName();
                        }else{
                            $engineer = "non affecté";
                        }
                        echo "<tr>";
                        echo "<td><img src='../images/ferme.png' width='30px' height='30px'/></td>";
                        echo "<td class='colonneid'>".$bug->getId()."</td>";
                        echo "<td =class'colonneresume'>".$bug->getResume()."</td>";
                        echo "<td class='colonnedate'>".$bug->getCreated()->format('d.m.Y')."</td>";
                        //echo "<td class='colonnetech'>".$engineer."</td>";
                        //echo "<td class='colonneprod'>";
                        //foreach ($bug->getProducts() as $product) {
                            //echo "- ".$product->getName()." ";
                        //}
                        echo "</td>";
                        //echo "<td>".$bug->getDescription()."</td>";
                        echo "</tr>";
                    }
                    ?>

                </table>
                </p>
            </div>
            </div>
        </div>
    </div>
    <div data-role="footer" data-position="fixed">
        <h4>Lemarquis - Marrucho - Silva</h4>
    </div>
</div>

<div data-role="dialog" id="ticket_dialog">
    <div data-role="header">
        <h1>Detail du ticket <div id="id_ticket"></div></h1>
    </div>
    <div data-role="content">
        <form name='bug' method='POST' action='index.php?uc=dash' data-ajax="false">
            <h1><div id="descri_ticket"></div></h1>
                Description : <div id="solution_ticket"></div></br>
                <div id="note"></div>
                <div id="created"></div>
                <div data-role="fieldcontain" class="ui-hide-label">
                    <label for='apps'>Assigné à : </label>
                    <select multiple id='apps' name='apps[]' width='400px' >"<?php echo $tech;?>"</select>
                </div>
                <div id="engineer"></div>
                <div id="reporter"></div>
                <div id="products"></div>
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup">
                        <legend>Choisir une priorité :</legend>
                        <input type="radio" name="prio" id="Haut" value="Haut"  />
                        <label for="Haut">Haut</label>

                        <input type="radio" name="prio" id="Normal" value="Normal"  />
                        <label for="Normal">Normal</label>

                        <input type="radio" name="prio" id="Bas" value="Bas"  />
                        <label for="Bas">Bas</label>
                    </fieldset>
                </div>
                <div id="image"></div>
                <div id="clore"></div>
            <input type='submit' value='Enregistrer les changements' name='valider'>
        </form>
    </div>
</div>

<div data-role="dialog" id="ticket_clore">
    <div data-role="header">
        <h1>Clore le ticket N <div id="id_tick"></div></h1>
    </div>
    <div data-role="content">
        <div id="contenu_clore"></div>
    </div>
</div>
</body>
</html>