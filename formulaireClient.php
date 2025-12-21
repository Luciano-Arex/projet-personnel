<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src=" http://code.jquery.com/jquery.min.js"></script>
    <script src="script.js"></script>
    <title>Formulaire client</title>
</head>
<body>

    <h1 class="title_h1">Formulaire d'ajout d'un client</h1>
    <form id="formClient" action=myserver.php method="POST">
        <label for="lname">Nom : </label>
        <input type="text" name="lastname" id ="lname" placeholder ="Votre nom ici"/>

        <label for="fname">Prénom : </label>
        <input type="text" name="firstname" id ="fname"  placeholder ="Votre prenom ici"/>
        <div id="radioInput">
            <label>Sexe : </label>
            <input type="radio" name="sex" value="male" /> Masculin :
            <input type="radio" name="sex" value="female" />Féminin :
            <input type="radio" name="sex" value="other" /> Autre
        </div>
        
        <label for="age">Age : </label>
        <select name="age" id="age">
        <option value="" class="default_select"  selected disabled hidden>Votre âge ici</option>
        <option value="moins de 18 ans">- de 18 ans</option>
        <option value="entre 18 et 40 ans">18 à 40 ans</option>
        <option value="entre 41 et 60 ans">+ de 40 ans</option>
        </select>

        <label for="email">Email : </label>
        <input type="email" name="email" id ="email" placeholder ="Votre email ici"/>

        <input type="reset" value="Effacer" />
        <input type="submit" value="Soumettre" />
    </form>
    <a class="page_accueil" href="index.php">Retour a la page accueil</a>
</body>
</html>