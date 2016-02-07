<?php
/*******************************************/
/* OBJETIVO:                               */
/*******************************************/
/* Configura la libreria de debug FirePHP. */
/*******************************************/

/********************************************************/ 
/* DESARROLLADOR Y VERSION DE APLICATIVO                */
/********************************************************/ 
/* Ingeniero Luis Vicente Peña Leal.                    */
/* Fecha: 04 de Febrero de 2016.                        */
/* Version: BETA 1.                                     */
/* Detalle de codigo: Version inicial de la aplicacion. */
/********************************************************/ 

require(_LIBRERIA_FIREPHP."FirePHP.class.php");
ob_start();
$firephp = FirePHP::getInstance(true); //Activa la libreria
$GLOBALS["firephp"]; //Define variable global para que este disponible en cualquier pagina que la invoque
