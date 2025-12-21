$(document).ready(function(){

    //creation des variable
    var inputTExt = $('form>input[type=text]');
    var inputEmail = $('form>input[type=email]');

    $('form').on('submit', function(event){
        event.preventDefault(); // Empêche l'envoi par défaut
        let submitConfirm = 0;
        
        $("span").remove(".messageError");
        $(inputTExt).each(function() {
            if ($(this).val().length === 0) {
                errorDisplay($(this), "ne doit pas etre vide");
                submitConfirm++;
            }else{
                $(this).removeClass('inputError').addClass('inputSucces');
                $('messageError').remove();
            }
        });
        
        $(inputEmail).each(function() {
            if ($(this).val().length === 0) {
                errorDisplay($(this), "ne doit pas etre vide")
                submitConfirm++;
                }else{
                $(this).removeClass('inputError').addClass('inputSucces');
                $('messageError').remove();
            }
        });
       

        if ($('#age').val() === null) {            
            $('#age').addClass('inputError');
            $('#age').after( "<span class='messageError'>le champ "+ $('#age').attr('name') + " ne doit pas etre vide</span>" );
            submitConfirm++;
        } else {
            $('#age').removeClass('inputError').addClass('inputSucces');
            $('messageError').remove();
        }
        
        
        if($('input[name="sex"]:checked').length === 0){       
            $("#radioInput").addClass('inputError');
            $("#radioInput").after( "<span class='messageError'>le champ "+  $('input[name="sex"]').attr('name') + " ne doit pas etre vide</span>" );
            submitConfirm++;
        }else{
            $("#radioInput").removeClass('inputError').addClass('inputSucces');
            $('messageError').remove();
        }
        
        
        if (submitConfirm == 0) {            
            // Envoi de la requête AJAX
            $("form>input[type='submit']").after('<img src="loader.gif" id="loader"/>')
            $.ajax({
             url: 'serverClient.php',
             type: 'POST',
             data: $(this).serialize(),
             success: function(response) {
                 if (response.status === "exists") {
                    errorDisplay($("form>input[type='email']"), " existe déja dans la base de donnée")
                    submitConfirm++;
                 }else{
                    $("form>input[type='email']").removeClass('inputError').addClass('inputSucces');
                    $('messageError').remove();
                 }

                 $("#loader").remove();
             },
             error: function(xhr, status, error) {
                $("#loader").remove();
                // Action en cas d'erreur
               console.error('Erreur AJAX :', error); // Affiche les erreurs dans la console
               alert('error');
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