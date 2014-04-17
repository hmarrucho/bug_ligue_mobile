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
        <h4>Nouvel incident</h4>
        <form name='new_bug' method='POST' action='index.php?uc=dash&action=nouveau' enctype='multipart/form-data'>
        <p>
            <label for='objet'>Objet : </label>
            <input id='objet' type='text' name='objet' size='50' maxlength='50'>
        </p>
        <p>
            <label for='libelle'>Description du problème : </label>
            <textarea id='libelle' name='libelle' size='500' maxlength='500'></textarea>
        </p>
        <p>
            <label for='apps'>Application(s) concernées : </label>
            <select multiple id='apps' name='apps[]' width='400px'>"+prod+"</select>
        </p>
        <p>
            <label>Capture d'écran (optionnelle)</label>
            <input name='capture' type='file' style='width:300px;'/>
        </p>
        <p>
            <input type='submit' value='Valider' name='valider'>
            <input type='reset' value='Annuler' name='annuler'>
        </p>
        </form>
    </div>
    <div data-role="footer" data-position="fixed">
        <h4>Lemarquis - Marrucho - Silva</h4>
    </div>
</div>