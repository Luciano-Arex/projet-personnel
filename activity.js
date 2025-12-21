$(document).ready(function(){

    //creation des variable
    var inputTExt = $('form>input[type=text]');
    var textarea = $('form>textarea[name=description]');
    var inputRadio = $('form>div>input[name=sex]');
    var selectOption = $('form>option');

    $('form').on('submit', function(event){
        event.preventDefault(); // Empêche l'envoi par défaut
        let submitConfirm = 0;


        $("span").remove(".messageError");
        $(inputTExt).each(function() {
            if ($(this).val().length === 0) {
                $(this).addClass('inputError').focus();
                $(this).after( "<span class='messageError'>le champ "+ $(this).attr('name') + " ne doit pas etre vide</span>" );
                submitConfirm++;
            }else{
                $(this).removeClass('inputError').addClass('inputSucces');
                $('messageError').remove();
            }
        });

        $(textarea).each(function() {
            if ($(this).val().length === 0) {
                errorDisplay($(this), "ne doit pas etre vide")
                submitConfirm++;
            }else{
                $(this).removeClass('inputError').addClass('inputSucces');
                $('messageError').remove();
            }
        });

        if($('input[name="season"]:checked').length === 0){         
            $("#saison").addClass('inputError');
            $("#saison").after( "<span class='messageError'>le champ "+  $('input[name="season"]').attr('name') + " ne doit pas etre vide</span>" );
            submitConfirm++;
        }else{
            $("#saison").removeClass('inputError').addClass('inputSucces');
            $('messageError').remove();
        }


        if (submitConfirm == 0) {

            console.log($(this));
            
            // Envoi de la requête AJAX
            $.ajax({
             url: 'serverActivity.php',
             type: 'POST',
             data: $(this).serialize(),
             success: function(response) {
                  // Action en cas de succès
                  responses = JSON.parse(response);
                  console.log('Requête réussie :', responses); // Affiche la réponse du serveur
                  alert('success');
             },
             error: function(xhr, status, error) {
                // Action en cas d'erreur
               console.error('Erreur AJAX :', error); // Affiche les erreurs dans la console
               alert('error');
             },
             complete: function() {
                 // appele au retour après succes ou error
                 // exécuté toujours : echech/succes
             }
           });
        }
        
    })


    // check if input is empty
   function errorDisplay(input, message){
        input.addClass('inputError').focus();       
        input.after( "<span class='messageError'>le champ "+ input.attr('name') + " " + message + "</span>" );
   }
});