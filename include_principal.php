<?php
/*****************************************************************************************************/
/* OBJETIVO:                                                                                         */
/*****************************************************************************************************/
/* Crear un aplicativo que funcione en cualquier sistema operativo.  */
/* Esta portabilidad se crea con parametros de configuracion indicando principalmente 3 componentes. */
/* 1. Ruta donde se ubica el servidor apavhe en la variable _RUTA_LOCAL                              */
/* 2. Indicando la carpeta interna donde quedara el aplicativo dentro del servidor apache.           */
/* 3. Indicar la URL del aplicativo al cual respondera la pagina principal.                          */
/*                                                                                                   */
/* La forma como esta diseñada y desarrollada el aplicativo permite que con estos pocos valores      */
/* el aoplicativo se pueda correr en cualquier servidor apache independiente de su sitema operativo. */
/*****************************************************************************************************/

/********************************************************/ 
/* DESARROLLADOR Y VERSION DE APLICATIVO                */
/********************************************************/ 
/* Ingeniero Luis Vicente Peña Leal.                    */
/* Fecha: 04 de Febrero de 2016.                        */
/* Version: BETA 1.                                     */
/* Detalle de codigo: Version inicial de la aplicacion. */
/********************************************************/ 

// Ruta principal
define("_RUTA_LOCAL","/var/www/html/"); //Ruta fisica donde se encuentra el DOCUMENT ROOT de Apache.
define ("_APLICACION","prueba_tecnica/"); // Carpeta interna donde queda el aplicativo
define ("_URL","http://localhost/"._APLICACION); //Direccion WEB como se accesaria el aplicativo
define ("_PATH",_RUTA_LOCAL._APLICACION); //Ruta fisica indicada desde la raiz del disco duro hasta el aplicativo
//Archivos de configuracion
require (_PATH."configuracion/constantes.php"); //Ruteo automatico de todo el aplicativo
require (_PATH."configuracion/debug.php"); //Configuracion del Framework de debug
