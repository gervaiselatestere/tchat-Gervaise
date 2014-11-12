<?php

// controller/controller.php

/* =========================================================
|                          GENERAL                         |
========================================================= */

// -------------------------------------------------------
// Création des objets permettant de gérer les données
// à partir des modèles

$users = new users($PDO);
$messages = new messages($PDO);

// -------------------------------------------------------
// Gestion des actions du client

// liste des clients
if (isset($_GET['action']) && $_GET['action'] === 'listUsers')
    {
        $users->ListAll();
    }

// liste des messages
if (isset($_GET['action']) && $_GET['action'] === 'listMessages')
    {
        $messages->ListAll();
    }


// ajoute d'un message
if (isset($_GET['action']) && $_GET['action'] === 'addMessage')
{
    http_response_code(201);
    $messages->add($_GET['messageValue'],$_GET['userId']);
}

// liste des clients
if (isset($_GET['action']) && $_GET['action'] === 'TestUsers')
{
    $users->exists($_GET['userNickName']);
}


// ajoute d'un user
if (isset($_GET['action']) && $_GET['action'] === 'userAdd')
{
   $userExists = $users->exists($_GET['userNickname']);

    if ($userExists === false)
        {
            http_response_code(201);
            $id=$users->add($_GET['userNickname']);
            echo json_encode($id);
            //echo("Nouvelle inscription : " .$_GET['userNickname'] . " + NouveauID : " . $id );
        }

    else
        {
            http_response_code(208);

            $connectId=$users->existeId($_GET['userNickname']);
            //echo json_encode($id);
           echo json_encode($connectId);
        }

}

// ajoute d'un message
if (isset($_POST['action']) && $_POST['action'] === 'addMessage2')
{
    $messages->add($_POST['messageValue'],$_POST['userId']);
}


// -------------------------------------------------------
// Récupération des listes à afficher




/* =====================  ! GENERAL  ==================== */

/* =========================================================
|                           SHOP                           |
========================================================= */


/* ======================  ! SHOP  ====================== */

/* =========================================================
|                       INSCRIPTION                        |
========================================================= */


/* ==================  ! INSCRIPTION  =================== */

/* =========================================================
|                      ADMINISTRATION                      |
========================================================= */


    // -------------------------------------------------------
    // Récupération des tableaux à afficher




/* =================  ! ADMINISTRATION  ================= */
