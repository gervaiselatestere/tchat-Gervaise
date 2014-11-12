<?php

// index.php

// Vous pouvez ignorer ces 2 lignes de code qui sont spécifiques à la configuration de mon PHP
//ini_set('display_errors', 'On');
//ini_set('error_reporting', E_ALL);

header('Content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');


/*
	On démarre la session
	ATTENTION : on la démarre avant d'écrire le moindre HTML
	(comme pour la fonction header())
 */
session_start();

// Création de l'objet PDO qui représente la connexion à la BDD
require_once 'dbconnect.php';

// Chargement des librairies :
//require_once 'library/Model.class.php';
//require_once 'library/SQLQueryManager.class.php';

// Chargement des modèles :
require_once 'model/model.class.php';
require_once 'model/Messages.class.php';
require_once 'model/Users.class.php';


// Chargement du contrôleur
require_once 'controller/controller.php';

// Chargement des vues (templates)
//require_once '../APP/top.phtml';
//require_once '../APP/' . $menu . '.html';
//require_once '../APP/bottom.phtml';

