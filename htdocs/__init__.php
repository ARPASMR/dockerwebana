<?php

/**
 * \file	__init__.php
 * \brief	Upper level configuration file
 * 			Contains database credentials setup 
 * 			for both production and development
 * 			machines
 */

	/**
	 *	\var	$dbParams
	 *	\brief	Array contenente i parametri per la connessione a database
	 */
    $dbParams = array();

     // ###############################################
     // #####  Macchina di PRODUZIONE (Sinergico) #####
     // ###############################################

        if(substr_count($_SERVER['HTTP_HOST'], '10.10.')>0){

            // Error reporting
            ini_set('error_reporting', E_ALL);
            ini_set('display_errors', 1);

            // Parametri connessione al DATABASE (dbMeteo)
            $dbParams['host'] =     'localhost';
            $dbParams['db'] =       'METEO';
            $dbParams['username'] = 'root';
            $dbParams['password'] = 'radice';
        }

     // ##########################################
     // #####  Macchina di SVILUPPO (locale) #####
     // ##########################################

        else if(substr_count($_SERVER['HTTP_HOST'], 'localhost')>0
            || substr_count($_SERVER['HTTP_HOST'], '192.168.')>0){

            // Error reporting
            ini_set('error_reporting', E_ALL);
            ini_set('display_errors', 1);

            // Parametri connessione al DATABASE (dbMeteo)
            $dbParams['host'] =     '127.0.0.1';
            $dbParams['db'] =       'METEO';
            $dbParams['username'] = 'root';
            $dbParams['password'] = 'chi66rone;';
        }
     // ##########################################
     // ##### docker container               #####
     // ##########################################
	else {
            // Error reporting
            ini_set('error_reporting', E_ALL);
            ini_set('display_errors', 1);

            // Parametri connessione al DATABASE (dbMeteo)
            $dbParams['host'] =     '127.0.0.1';
            $dbParams['db'] =       'METEO';
            $dbParams['username'] = 'root';
            $dbParams['password'] = 'chi66rone;';
	}

    // ####  Importa librerie e classi  ####
    require_once("resources/__init__.php");

    // ####  Set web root PATH and URL  ####
    define("BASE_PATH", Config::initServerRoot(__FILE__, 'PATH'));
    define("BASE_URL", Config::initServerRoot(__FILE__, 'URL'));

    // ####  Instaura la connessione al database  ####
    $connection_dbMeteo = new DBConnection($dbParams);
    unset($dbParams);

    // ####  Autenticazione Utente  ####
    if(isset($_SESSION['IDutente']) && $_SESSION['IDutente']!=''){
        $IDutente = $_SESSION['IDutente'];
    } else {
        $IDutente = '';
        unset($_SESSION['IDutente']);
    }
    $utente = new Utente($IDutente);
