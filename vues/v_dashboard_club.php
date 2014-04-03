<script type="text/javascript">
    var prod = "<?php foreach($the_products as $p){echo "<option value='".$p->getId()."'>".$p->getName()."</option>";}?>";
    modal(prod);
</script>


<div id="popup1" class="popup_block"></div>
</br>
<strong style="margin-left: 15px"><?php echo $nbouvert; ?> Bug ouvert</strong>       <strong style="margin-left: 15px"><?php echo $nbclos; ?> Bug clos  </strong>
<div id="divTicketsGrid">
    <table cellpadding="7" id="tblTickets" style="width:100%" class="horizseparated outerroundedbox">
        <tr class="nobold" style="white-space:nowrap;">
            <th style="width:100%"><a onclick=''>Titre</a></th>
            <th><a onclick=''>Affecté à</a> </th>
            <th><a onclick=''>Produit(s)</a></th>
            <th><a onclick=''>Statut</a></th>
            <th><a onclick=''>Date</a></th>
            <th><a onclick=''>Description</a></th>
            <th><a onclick=''>Capture d'écran</a></th>
        </tr>
        <tr>
        <?php
        foreach ($bugs as $bug) { // Afficher la liste des bugs dans un tableau
            echo "<tr class='ticketRow'><td onclick=''><div class='grey2 ticketrowMeta'><br /><span>".$bug->getId()."</span></div>";
            if($bug->getStatus() == "Ouvert"){
                echo "<img src='images/en_cours.png' width='15px'>";
            }else{
                echo "<img src='images/ferme.png' width='15px'>";
            }
            echo $bug->getResume()."<div class='grey2 ticketAttr'><img src='./images/usericon.gif' alt='' />Par : ".$bug->getReporter()->getName()."</div>";
            echo "</td><td class='grey'>";
            if ($bug->getEngineer() != null){
                $engineer = $bug->getEngineer()->getName();
            }else{
                $engineer = "non affecté";
            }
            echo $engineer;
            echo "</td><td class='grey'>";
            foreach ($bug->getProducts() as $product) {
                echo "- ".$product->getName()."</br>";
            }
            echo "</td> <td class='grey'>".$bug->getStatus();
            echo "</td><td class='grey date' style='white-space:nowrap'>".$bug->getCreated()->format('d.m.Y')."</td><td class='grey date' style='white-space:nowrap'>";
            echo $bug->getDescription()."</td>";
            echo "<td class='grey'>";
            if ($bug->getImage() != ""){
                echo "<a href='".$bug->getImage()."' target='_blank'><img src='images/imageico.png' height='25px'></a></td>";
            }else{
                echo "Aucune Capture</td>";
            }
        }
        ?>
        </tr>
        <tfoot>
        <tr class="sortbottom">
            <td class="grey tablefooter" colspan="9"></td>
        </tr>
        </tfoot>
    </table>
</div>
