<?php
/************************************************************************************/
/* OBJETIVO:                                                                        */
/************************************************************************************/
/* Por medio del manejo de constantes parametriza todos los valores del aplicativo. */
/************************************************************************************/

/*******************************************************/ 
/* DESARROLLADOR Y VERSION DE APLICATIVO               */
/*******************************************************/ 
/* Ingeniero Luis Vicente Peña Leal.                   */
/* Fecha: 05 de Febrero de 2016.                       */
/* Version: 1.0.0.                                     */
/* Detalle de codigo: Se convierte en POO.             */
/*******************************************************/ 

//carpetas del aplicativo
define ("_CARPETA_LIBRERIAS","librerias/");
define ("_CARPETA_CLASES","clases/");
//carpetas de las librerias
define ("_CARPETA_LIBRERIAS_FIREPHP","FirePHPCore/");
//Rutas locales del aplicativo
define ("_PATH_LIBRERIAS",_PATH._CARPETA_LIBRERIAS);
define ("_PATH_CLASES",_PATH._CARPETA_CLASES);
//Librerias del aplicativo
define ("_LIBRERIA_FIREPHP",_PATH_LIBRERIAS._CARPETA_LIBRERIAS_FIREPHP);
//Clases del aplicativo
define ("_CLASE_MATRIZ",_PATH_CLASES."matriz.class.php");
define ("_CLASE_VALIDACIONES",_PATH_CLASES."validaciones.class.php");
define ("_CLASE_ERRORES",_PATH_CLASES."errores.class.php");
define ("_CLASE_EJECUCION",_PATH_CLASES."ejecuciones.class.php");
