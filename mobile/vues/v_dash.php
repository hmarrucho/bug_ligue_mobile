<a id='lnkDialog' href="#ticket_dialog" data-transition="flip" style='display:none;'></a>

<div data-role="page">
    <div data-role="header">
        <h1>En-tête</h1>
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
        <h4>Pied de page</h4>
    </div>
</div>

<div data-role="dialog" id="ticket_dialog">
    <div data-role="header">
        <h1>Detail du ticket <div id="id_ticket"></div></h1>
    </div>
    <div data-role="content">
        <div id="descri_ticket"></div>
        <hr/>
        <div id="solution_ticket"></div>
        <div id="note"></div>
        <div id="created"></div>
        <div id="engineer"></div>
        <div id="reporter"></div>
        <div id="products"></div>
        <div id="priorite"></div>
        <div id="image"></div>
        <div id="clore_bouton"></div>
        <div id="assign_bouton"></div>
        <div id="prio_bouton"></div>
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

<div data-role="dialog" id="ticket_prio">
    <div data-role="header">
        <h1>Priorité du bug <div id="id_tick"></div></h1>
    </div>
    <div data-role="content">
        <div id="contenu_prio" data-role="fieldcontain"></div>
    </div>
</div>

</body>
</html>