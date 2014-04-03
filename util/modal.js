function modal(prod) {
	//Lorsque vous cliquez sur un lien de la classe poplight
	$('a.poplight').on('click', function() {
		var popID = $(this).data('rel'); //Trouver la pop-up correspondante
		var popWidth = $(this).data('width'); //Trouver la largeur

        var str;

        if ($(this).data('action') == "clore"){// Si le data-action est égale à clore alors on affiche la popup avec le form pour clore un bug
            var idbug = $(this).data('id'); //Trouver l'id du bug
            str = "<h2>Clore le bug n"+idbug+"</h2><form name='clos_bug' method='POST' action='index.php?uc=dash&action=list'><p><label for='note'>Note : </label></p><p><textarea name='note' rows='8' cols='50'>Ecrivez ici...</textarea></p><input type='hidden' name='bug' value='"+idbug+"'><center><p><input type='submit' class='button' value='Valider' name='valider'></p></center></form>";
        }
        if ($(this).data('action') == "nouveau"){// Si le data-action est égale à nouveau alors on affiche la popup avec le form pour new un bug
            str = "<form name='new_bug' method='POST' action='index.php?uc=dash&action=list' enctype='multipart/form-data'><legend>Signalement d\'un nouveau bug</legend><p><label for='objet'>Objet : </label><input id='objet' type='text' name='objet' size='50' maxlength='50'></p><p><label for='libelle'>Description du problème : </label><textarea id='libelle' name='libelle' size='500' maxlength='500'></textarea></p><p><label for='apps'>Application(s) concernées : </label><select multiple id='apps' name='apps[]' width='400px'>"+prod+"</select></p><p><label>Capture d\'écran (optionnelle)</label><input name='capture' type='file' style='width:300px;'/></p><p><input type='submit' value='Valider' name='valider'><input type='reset' value='Annuler' name='annuler'></p></form>";
        }
        if ($(this).data('action') == "engineer"){// Si le data-action est égale à engineer alors on affiche la popup avec le form pour assigner un technicien
            var idbug = $(this).data('id'); //Trouver l'id du bug
            str = "<h2>Assigner le bug n"+idbug+"</h2><form name='assign_engineer' method='POST' action='index.php?uc=dash&action=list'><p><label for='engineer'>Liste des techniciens : </label><select name='engineer' id='engineer'>"+tech+"</select></p><input type='hidden' name='bug' value='"+idbug+"'><center><p><input type='submit' class='button' value='Valider' name='valider'></p></center></form>";
        }
        if ($(this).data('action') == "prio"){// Si le data-action est égale à prio alors on affiche la popup avec le form pour l'indice de priorite
            var idbug = $(this).data('id'); //Trouver l'id du bug
            str = "<form name='prio_bug' method='POST' action='index.php?uc=dash&action=list'><legend>Niveau de priorité</legend><p><input type='radio' name='prio' value='Haut'>Haut</input></p><p><input type='radio' name='prio' value='Normal'>Normal</input></p><p><input type='radio' name='prio' value='Bas'>Bas</input></p><input type='hidden' name='bug' value='"+idbug+"'><p><input type='submit' class='button' value='Valider' name='valider'></p></form>";
        }

		$("#popup1").html("");//Vide le cotenu de la popup
        $("#popup1").html(str);//Alimente le contenu de la popup avec le contenu de la variable

		//Faire apparaitre la pop-up et ajouter le bouton de fermeture
		$('#' + popID).fadeIn().css({ 'width': popWidth}).prepend('<a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>');
        $("#apps").select2({ //Module de mise en forme des SELECT
            placeholder: "Choisir les produits",
            width: "copy"
        });
        $("#engineer").select2();


        //Récupération du margin, qui permettra de centrer la fenêtre - on ajuste de 80px en conformité avec le CSS
		var popMargTop = ($('#' + popID).height() + 80) / 2;
		var popMargLeft = ($('#' + popID).width() + 80) / 2;

		//Apply Margin to Popup
		$('#' + popID).css({
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});

		//Apparition du fond - .css({'filter' : 'alpha(opacity=80)'}) pour corriger les bogues d'anciennes versions de IE
		$('body').append('<div id="fade"></div>');
		$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();

		return false;
	});
	
	//Close Popups and Fade Layer
	$('body').on('click', 'a.close, #fade', function() { //Au clic sur le body...
		$('#fade , .popup_block').fadeOut(function() {
			$('#fade, a.close').remove();  
	}); //...ils disparaissent ensemble
		
		return false;
	});
}