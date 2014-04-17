/**
 * Created with JetBrains PhpStorm.
 * User: Eric
 * Date: 21/02/14
 * Time: 18:08
 * To change this template use File | Settings | File Templates.
 */
function clore(){
    $('#note').attr('class','');
}
$(document).ready(function(){
    $('#liste_tickets tr').bind('click', function(e) {
        // Prevents the default action to be triggered.
        e.preventDefault();
        // on va chercher avec un appel Ajax/Json les données sur le ticket choisi
        var identifiant = $(this).find("td").eq(1).html();
        //alert (fonction);

        $("#id_ticket").html(identifiant);

        $.ajax({
            type: "POST",
            url: "../util/c_requetes.php",
            dataType: "json",
            data: "action=infos_ticket&data="+identifiant,
            success: function(data){
                $("tr[name=une_ligne]").remove();
                $("#descri_ticket").html(data['description']);
                $("#solution_ticket").html(data['resume']);
                if(data['status'] != "Ouvert"){
                    $("#note").html("Compte rendu du technicien : "+data['note']);
                }
                $("#created").html("Crée le "+data['created']['date']);
                $("#engineer").html("Assigné à :"+data['engineer']);
                $("#reporter").html("Ouvert par :"+data['reporter']);
                $("#products").html("Produit(s) concerné(s) :"+data['products']);
                if(data['priorite'] == "Haut"){
                    $('#Haut').attr('checked','checked');
                }
                if(data['priorite'] == "Normal"){
                    $('#Normal').attr('checked','checked');
                }
                if(data['priorite'] == "Bas"){
                    $('#Bas').attr('checked','checked');
                }
                $("#image").html("<img src='../"+data['image']+"' width='90%'>");
                $("#clore").html("<a href='' onclick='clore();' data-role='button'>Clore</a><div data-role='fieldcontain' class='ui-hide-label'><label for='note'>Compte Rendu du technicien : </label><input type='text' name='note' id='note' value='' placeholder='Compte rendu du technicien' class='ui-disabled'/></div>");
                if (fonction == "Technicien" ){
                    if(data['status'] == "Ouvert"){

                    }
                }
                if (fonction == "Responsable" ){
                    if(data['status'] == "Ouvert"){
                   }
                }
                $("#id_tick").html(identifiant);
                $("#contenu_clore").html("<form name='clos_bug' method='POST' action='index.php?uc=dash'><p><label for='note'>Note : </label></p><p><textarea name='note' rows='8' cols='50' placeholder='Ecrivez ici...'></textarea></p><input type='hidden' name='bug' value='"+identifiant+"'><center><p><input type='submit' class='button' value='Valider' name='valider'></p></center></form>");
                $("#contenu_prio").html("<form name='prio_bug' method='POST' action='index.php?uc=dash'><fieldset data-role='controlgroup'><legend>Niveau de priorité</legend><input type='radio' name='prio' id='haut' value='Haut' /><label for='haut'>Haut</label><input type='radio' name='prio' id='normal' value='Normal' /><label for='normal'>Normal</label><input type='radio' name='prio' id='bas' value='Bas' /><label for='bas'>Bas</label><input type='hidden' name='bug' value='"+identifiant+"'><p><input type='submit' class='button' value='Valider' name='valider'></p></fieldset></form>");
                // on active le clic sur le lien invisible pour déclencher le dialog
                $('#lnkDialog').click();
                // Autre façon de changer la page à la volée
                //$.mobile.changePage('#ticket_dialog', { transition: 'pop', role: 'dialog' });
            }
        });
    });
});