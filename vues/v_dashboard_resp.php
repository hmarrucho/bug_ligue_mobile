
<div id="popup1" class="popup_block"></div>
</br>
<strong style="margin-left: 15px"><?php echo $nbouvert; ?> Bug ouvert</strong>       <strong style="margin-left: 15px"><?php echo $nbclos; ?> Bug clos  </strong>      <strong style="margin-left: 15px"><?php echo $nbnonassigne; ?> Bug non assigné</strong>
<div id="divTicketsGrid">
    <table cellpadding="10" id="tblTickets" style="width:100%" class="horizseparated outerroundedbox">
        <tr class="nobold" style="white-space:nowrap;">
            <th style="width:100%"><a onclick=''>Titre</a></th>
            <th><a onclick=''>Affecté à</a> </th>
            <th><a onclick=''>Produit(s)</a></th>
            <th><a onclick=''>Priorité</a></th>
            <th><a onclick=''>Statut</a></th>
            <th><a onclick=''>Date</a></th>
            <th><a onclick=''>Description</a></th>
            <th><a onclick=''>Note Technicien</a></th>
            <th><a onclick=''>Capture d'écran</a></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <?php
                foreach ($the_bugs as $bug) {
                    echo "<tr class='ticketRow'><td onclick=''><div class='grey2 ticketrowMeta'><br /><span>".$bug->getId()."</span></div>";
                    if($bug->getStatus() == "Ouvert"){
                        echo "<img src='images/en_cours.png' width='15px'>";
                    }else{
                        echo "<img src='images/ferme.png' width='15px'>";
                    }
                    echo $bug->getResume()."<div class='grey2 ticketAttr'><img src='./images/usericon.gif' alt='' />Par : ".$bug->getReporter()->getName()."</div>";
                    echo "</td><td class='grey'>";
                    if($bug->getStatus() == "Ouvert"){
                        echo "<a href='#' data-width='500' data-id='".$bug->getId()."' data-rel='popup1' data-action='engineer' class='poplight'>";
                    }
                    if ($bug->getEngineer() != null){
                        $engineer = $bug->getEngineer()->getName();
                    }else{
                        $engineer = "Non affecté";
                    }
                    echo $engineer;
                    if($bug->getStatus() == "Ouvert"){
                        echo "</a>";
                    }
                    echo "</td><td class='grey'>";
                    foreach ($bug->getProducts() as $product) {
                        echo "- ".$product->getName()."</br>";
                    }
                    echo "</td> <td class='grey priorityTd'><span style='color:green;'>";
                    if($bug->getStatus() == "Ouvert"){
                        echo "<a href='#' data-width='500' data-id='".$bug->getId()."' data-rel='popup1' data-action='prio' class='poplight'>";
                    }
                    echo $bug->getPriorite();
                    if($bug->getStatus() == "Ouvert"){
                        echo "</a>";
                    }
                    echo "</span></td><td class='grey'>".$bug->getStatus();
                    echo "</td><td class='grey date' style='white-space:nowrap'>".$bug->getCreated()->format('d.m.Y')."</td><td class='grey'>";
                    echo $bug->getDescription()."</td>";
                    if($bug->getStatus() != "Ouvert"){
                        echo "<td class='grey'>".$bug->getNote()."</td>";
                    }else{
                        echo "<td class='grey'>Bug non clos</td>";
                    }
                    echo "<td class='grey'>";
                    if ($bug->getImage() != ""){
                        echo "<a href='".$bug->getImage()."' target='_blank'><img src='images/imageico.png' height='25px' ></a></td>";
                    }else{
                        echo "Aucune Capture</td>";
                    }
                    echo "<td class='grey'>";
                    if($bug->getStatus() == "Ouvert"){
                        echo "<a href='#' data-width='500' data-id='".$bug->getId()."' data-rel='popup1' data-action='clore' class='poplight'>Clore</a>";
                    }
                    echo "</td><td class='grey'><a href='index.php?uc=dash&action=suppr&bug=".$bug->getId()."' onclick=\"return confirm('Etes vous sûre de vouloir supprimer ce bug ?');\"><img src='images/close_pop.png' height='25px'></a></td>";
                }
            ?>
        </tr>
        <tfoot>
            <tr class="sortbottom">
                <td class="grey tablefooter" colspan="11"></td>
            </tr>
        </tfoot>
    </table>
</div>
<script type="text/javascript">
    var prod = "<?php foreach($the_products as $p){echo "<option value='".$p->getId()."'>".$p->getName()."</option>";}?>";
    var tech = "<?php foreach($the_techs as $t){echo "<option value='".$t->getId()."'>".$t->getName()." (".$t->getNbAssign().")</option>";}?>";
    modal(prod);
</script>