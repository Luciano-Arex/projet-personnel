$(document).ready(function () {
    // Envoi de la requête AJAX
    $.ajax({
        url: 'serverListClient.php', // Script côté serveur
        type: 'GET',                // Type de requête
        dataType: 'json',           // Attente de la réponse au format JSON
        success: function (response) {
            // Vérification du statut dans la réponse JSON
            if (response.status === "success") {
                // console.log("Données reçues :", response.data); // Affiche les données
                
                // Exemple de traitement des données
                console.log(response.data.length);
                if (response.data.length > 0) {
                    response.data.forEach(client => {
                        $('#list_client').append('<li>'+`Nom : ${client.lastname}, Prénom : ${client.firstname}, sex : ${client.sex}, âge : ${client.age}, email : ${client.email}`+'<span class="voir_activite"><a href="client.php?id='+`${client.id_client}`+'">Voir activitées client</a></span></li>');
                        //console.log(`Nom : ${client.lastname}, Prénom : ${client.firstname}`);
                    });
                }else{
                    $('#list_client').append('<li class="aucun_client">Aucun client enregistrer pour le moment !!!</li>')
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
            $('#list_client').append('<a class="page_accueil" href="index.php">Retour a la page accueil</a>')
            // alert("Requête terminée (success ou error).");
        }
    });
});
