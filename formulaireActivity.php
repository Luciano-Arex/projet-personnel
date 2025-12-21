<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src=" http://code.jquery.com/jquery.min.js"></script>
    <script src="activity.js"></script>
    <title>Travail de Groupe 2, INF 1001</title>
</head>
<body>

    <h1 class="title_h1">Formulaire d'ajout d'une activité</h1>
    <form id="formClient" action=serverformulaire.php method="GET">
        <label for="lname">Nom : </label>
        <input type="text" name="name" id ="lname" placeholder ="Votre nom ici"/>

        <label for="description">description :</label>
        <textarea rows="8" cols="50" name="description" id="description"></textarea>
        <div id="saison">
            <label>season : </label>
            <input type="radio" name="season" value="summer" /> summer
            <input type="radio" name="season" value="fall" /> fall
            <input type="radio" name="season" value="winter" /> winter
            <input type="radio" name="season" value="spring" /> spring
        </div>

        <input type="reset" value="Effacer" />
        <input type="submit" value="Soumettre" />
    </form>
    <a class="page_accueil" href="index.php">Retour a la page accueil</a>
</body>
</html>