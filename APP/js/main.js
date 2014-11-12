
// On définit une constante globale
// représentant l'URL de l'API
//const API_URL = 'http://test.mittet.fr/api/index.php';
//const API_URL = 'http://localhost/tchat-Gervaise/API/index.php';
const API_URL = 'http://192.168.1.100/tchat/API/index.php'; // Nga
//const API_URL = 'http://192.168.1.98/tchat/API/index.php';
// On définit une variable globale
// permettant de stocker l'identifiant de l'utilisateur
var userId = 0;

// Une fois que le DOM est bien chargé
$(function () {


    // Si l'utilisateur appuie sur une touche
    // dans le champ imput d'id #userNickname
    $('#userNickname').keypress(function(eventObject) {
        // Si cette touche est la touche "entrée"
        if (eventObject.which == 13)
        {
            // On appelle la fonction userConnect()
            userConnect();
            //$("#show").show();
            //console.log('#show');
        }
    });

    $('#messageValue').keypress(function(eventObject) {
        // Si cette touche est la touche "entrée"
        if (eventObject.which == 13)
        {
            // On appelle la fonction messageSend()
            console.log("nouveau message1");
            messageSend();
            console.log("Fin nouveau message1");
            messageListRefresh();
        }
    });

    messageListRefresh();
    usersListResfresh();

});


// Fonction de connection au t'chat du nouvel utilisateur
function userConnect()
{
    $.ajax({
        // On définit l'URL appelée
        url: API_URL,
         //url: 'http://localhost/tchat/API/index.php',

        //url: 'http://192.168.1.104/tchat/API/index.php',
        // On définit la méthode HTTP
        type: 'GET',
        // On définit les données qui seront envoyées
        data: {
            action: 'userAdd',
            userNickname: $('#userNickname').val()
        },
        // l'équivalent d'un "case" avec les codes de statut HTTP
        statusCode: {
            // Si l'utilisateur est bien créé
            201: function (response) {
                // On stocke l'identifiant récupéré dans la variable globale userId
                window.userId = response;
                // On masque la fenêtre, puis on rafraichit la liste de utilisateurs
                // (à faire...)
                usersListResfresh();


                console.log(response);
                console.log(userId);
                console.log("nouveau nom");

                $("#show").show();
                $("#userNickname").hide();

                console.log('#show');

                //$('#userNickname').val(response);
                //console.log($('#userNickname').val());

            },
            // Si l'utilisateur existe déjà et n'est pas creer
            208: function (response) {
                // On fait bouger la fenêtre de gauche à droite
                // et de droite à gauche 3 fois
                // (à faire...)
                console.log("Nom deja creer");
                window.userId = response;

                console.log(window.userId);
                usersListResfresh();

                $("#show").show();
                $("#userNickname").hide();
            }
        }
    })
}

function messageSend()
{
    $.ajax({
        // On définit l'URL appelée
        url: API_URL,
        //url: 'http://localhost/tchat/API/index.php',
        //url: 'http://192.168.1.104/tchat/API/index.php',
        // On définit la méthode HTTP
        type: 'GET',
        // On définit les données qui seront envoyées
        data: {
            action: 'addMessage',
            messageValue:$('#messageValue').val(),
            userId:window.userId
        },
        statusCode: {

            // Si le message est bien créé
            201: function (response) {
                console.log(" message ?");
                console.log($('#userNickname').val());

                // On masque la fenêtre, puis on rafraichit la liste de utilisateurs
                // (à faire...)

                //$(".article").hide();
                //messageListRefresh();
                console.log("nouveau message");
                $('#messageValue').val("");
            }
        }
    })

}


function usersListResfresh()
{
    // affichage liste des utilisateurs dans la page
    $.ajax({
        url: API_URL,
        //url: "../API/index.php?action=listUsers",
        //url: "http://192.168.1.104/tchat/API/index.php?action=listUsers",
        type: "GET",
        data: {
            action: 'listUsers'
                }
    }).done(function(response) {

        $('#listUsers li').remove();
        $.each(response, function(cle, valeur)
        {
            $('#listUsers').append('<li>' + valeur["userNickName"] + '</li>');
        });
    })
    .done(function() {
    // on relance l'appel AJAX dans 0.5 secondes
    window.setTimeout(usersListResfresh, 500);
});
}

function messageListRefresh()
{

// affichage liste des messages dans la page
    $.ajax({
        url: API_URL,
        //url: "../API/index.php?action=listMessages",
        //url: "http://192.168.1.104/tchat/API/index.php?action=listMessages",
        type: "GET",
        data: {
            action: 'listMessages'
        }
    }).done(function(response) {

        $('#principal article').remove();
        // console.log(reponse2);
        $.each(response, function(cle, valeur)
        {
            $('#principal').append('<article class="article"><p> ' + valeur["messageDate"] + ' - ' + valeur["userNickName"] + '<br>' + valeur["messageValue"] + '</p></article>');
        });
    })
        // Une fois la réponse HTTP reçue,
        .done(function() {
            // on relance l'appel AJAX dans 0.5 secondes
            window.setTimeout(messageListRefresh, 500);
        });

}



/***
 $(function() {

//console.log("Début Ajax");


$.ajax({
            url: "../API/index.php?action=addMessage2&userId=4&messageValue=" + valeur['messageValue'],
            type: "POST"
        }).done(function(reponse3) {

            console.log(reponse3);
            $.each(reponse3, function(cle, valeur)
            {
                $('#principal').append(

                    '<article class="article"><p> ' + valeur["messageDate"] + ' - ' + valeur["userNickName"] + '<br>' + valeur["messageValue"] + '</p></article>'

                );
            });
        });




// affichage liste utilisateur dans le formulaire

    $.ajax({
        url: "../API/index.php?action=listUsers",
        type: "GET"
    }).done(function(reponse) {
//console.log(reponse);
        $.each(reponse, function(cle, valeur)
        {
            $('#liste').append('<option value="' + valeur["userId"] + '">' + valeur["userNickName"] + '</option>');
        });
    });


    // Liste officielle des réponses HTTP (Status Codes) :
    //  http://www.ietf.org/assignments/http-status-codes/http-status-codes.xml

}); ***/