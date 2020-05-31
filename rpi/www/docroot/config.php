<?php

// Database configuration
$DBHOST = '10.91.91.22';      // Do not change
$DBPORT = '3306';             // Do not change
$DBNAME = 'www';              // Do not change
$DBUSER = 'www';              // Do not change
$DBUSER_RO = 'www_ro';
$DBPASS = 'DEVS-UPDATE-THIS'; // Update this password on the database, too, thanks Admin#0302401-32
$DSN = 'mysql:host=' . $DBHOST . ';dbname=' . $DBNAME . ';port=' . $DBPORT;
$DB_LOGIN_TABLE = 'login';
$DB_NOTES_TABLE = 'notes';

// Start Session
session_start();

// Create database connect
$pdo = new PDO($DSN, $DBUSER, $DBPASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo_ro = new PDO($DSN, $DBUSER_RO, $DBPASS);
$pdo_ro->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Pages: login, register, notes, notes_add

// Trying out PHP - All the clones are talking about it, so here we
// are... Sometimes I wish a blaster was all my world. #clonelife

?>