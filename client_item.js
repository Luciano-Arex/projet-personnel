$(document).ready(function () {
    $.ajax({
        url: 'serverClientItem.php?id=' + new URLSearchParams(window.location.search).get('id'), //
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === "success") {
                console.log("Client :", response);
                $('#mes_information').html(response.dataClient.email);
               
                if (response.dataActivity.length > 0) {
                    response.dataActivity.forEach(element => {
                        $('#list_activity').append('<li>'+`Nom : ${element.name}, season : ${element.season}, description : ${element.description}`+'<span class="linkAjoutActivity">Ajouter activitee</span></li>');
                    });
                }else{
                    $('#list_activity').append('<li class="aucun_activity">Aucun activity enregistrer pour le moment !!!</li>')
                }

            } else {
                console.error("Erreur :", response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("Erreur AJAX :", error);
        },
        complete: function () {
            $('#list_client').append('<a class="page_accueil" href="index.php">Retour a la page accueil</a>')
            // alert("Requête terminée (success ou error).");
        }
    });
    
});