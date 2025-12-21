$(document).ready(function () {
    // Envoi de la requête AJAX
    $.ajax({
        url: 'serverListActivity.php', // Script côté serveur
        type: 'GET',                // Type de requête
        dataType: 'json',           // Attente de la réponse au format JSON
        success: function (response) {
            // Vérification du statut dans la réponse JSON
            if (response.status === "success") {
                // console.log("Données reçues :", response.data); // Affiche les données
                
                // Exemple de traitement des données
                console.log(response.data.length);
                if (response.data.length > 0) {
                    response.data.forEach(activity => {
                        $('#list_activity').append('<li>'+`Nom : ${activity.name}, season : ${activity.season}, description : ${activity.description}`+'</li>');
                        //console.log(`Nom : ${activity.lastname}, Prénom : ${activity.firstname}`);
                    });
                }else{
                    $('#list_activity').append('<li class="aucun_activity">Aucun activity enregistrer pour le moment !!!</li>')
                }
            } else {
                console.error("Erreur serveur :", response.message); // Affiche le message d'erreur
            }
        },
        error: function (xhr, status, error) {
            // Gestion des erreurs AJAX
            console.error("Erreur AJAX :", error); // Message d'erreur technique
            console.log("Statut :", status);      // Statut de la requête
            console.log("Réponse brute :", xhr.responseText); // Réponse complète du serveur
            alert("Une erreur est survenue !");
        },
        complete: function () {
            $('#list_activity').append('<a class="page_accueil" href="index.php">Retour a la page accueil</a>')
            // alert("Requête terminée (success ou error).");
        }
    });
});
