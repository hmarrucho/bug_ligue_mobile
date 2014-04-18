/**
 * Created with JetBrains PhpStorm.
 * User: Eric
 * Date: 21/02/14
 * Time: 18:08
 * To change this template use File | Settings | File Templates.
 */
function clore(){
    $('#note').attr('class','ui');
}
function inverser()
{ if (i.style.visibility=="visible")
{ i.style.visibility="hidden";
    b.value="monter"; }
else { i.style.visibility="visible";
    b.value="cacher"; } }

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
                if (data['image'] == "null" ){
                    $("#image").html("<img src='../"+data['image']+"' width='90%'>");
                }
                $("#idbug").html("<input type='hidden' name='bug' value='"+identifiant+"'>");
                if (fonction == "Technicien" ){
                    if(data['status'] == "Ouvert"){
                        $("#form").html("<form name='bug' method='POST' action='index.php?uc=dash' data-ajax='false'>");
                        $("#finform").html("<input type='submit' value='Enregistrer les changements' name='valider'></form>");
                        $("#clore").html("<a href='' onclick='clore();' data-role='button'>Clore</a><div data-role='fieldcontain' class='ui-hide-label'><label for='note'>Compte Rendu du technicien : </label><textarea name='note' id='note' placeholder='Compte rendu du technicien' class='ui-disabled'></textarea></div>");
                        if(data['priorite'] == "Haut"){
                            $('#Haut').attr('checked','checked');
                        }
                        if(data['priorite'] == "Normal"){
                            $('#Normal').attr('checked','checked');
                        }
                        if(data['priorite'] == "Bas"){
                            $('#Bas').attr('checked','checked');
                        }
                    }
                }
                if (fonction == "Responsable" ){
                    if(data['status'] == "Ouvert"){
                        $("#form").html("<form name='bug' method='POST' action='index.php?uc=dash' data-ajax='false'>");
                        $("#finform").html("<input type='submit' value='Enregistrer les changements' name='valider'></form>");
                        $("#priorite").html("<fieldset data-role='controlgroup'><legend>Choisir une priorité :</legend><input type='radio' name='prio' id='Haut' value='Haut'  /><label for='Haut'>Haut</label><input type='radio' name='prio' id='Normal' value='Normal'  /><label for='Normal'>Normal</label><input type='radio' name='prio' id='Bas' value='Bas'  /><label for='Bas'>Bas</label></fieldset>");
                        $("#clore").html("<a href='' onclick='clore();' data-role='button'>Clore</a><div data-role='fieldcontain' class='ui-hide-label'><label for='note'>Compte Rendu du technicien : </label><textarea name='note' id='note' placeholder='Compte rendu du technicien' class='ui-disabled'></textarea></div>");
                        if(data['priorite'] == "Haut"){
                            $('#Haut').attr('checked','checked');
                        }
                        if(data['priorite'] == "Normal"){
                            $('#Normal').attr('checked','checked');
                        }
                        if(data['priorite'] == "Bas"){
                            $('#Bas').attr('checked','checked');
                        }
                    }
                }
                $("#id_tick").html(identifiant);
                 // on active le clic sur le lien invisible pour déclencher le dialog
                $('#lnkDialog').click();
                // Autre façon de changer la page à la volée
                //$.mobile.changePage('#ticket_dialog', { transition: 'pop', role: 'dialog' });
            }
        });
    });
});