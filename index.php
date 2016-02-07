<?php 
/***********************************************************************************************************/ 
/* OBJETIVO:                                                                                               */
/***********************************************************************************************************/ 
/* Crear un aplicativo que maneje una matriz tridimencional. La coordenada inicial es (1,1,1). El usuario  */
/* define el tamaño de la matriz, la matriz en un principio tiene todos sus elementos en 0. Debe soportar  */
/* dos tipos de acciones "UPDATE" el cual permite cambiar un valor en la matriz y QUERY el cual debe       */
/* calcular la suma de todas las posiciones del array indicando posicion inicial y posicion final.         */
/***********************************************************************************************************/

/***********************************************************************************************************************/
/* DATOS DE ENTRADA                                                                                                    */
/***********************************************************************************************************************/
/* 1. Casos de prueba: Indica la cantidad de casos de pruebas que se ejecutaran en el aplicativo. Valor entero.        */
/* 2. Tamaño de la matriz: Un unico valor indica el tamaño de la matriz en todas sus tres dimensiones. Valor entero.   */ 
/* 3. Para el caso de la accion UPDATE: Coordenda de la matriz (x,y,z) y su valor numerico.                            */
/* 4. Para el caso de la accion QUERY: Indicar las posiciones de la matriz iniciando con la coordenada (x1,y1,z1)      */
/* hasta la coordenada (x2,y2,z2).                                                                                     */
/***********************************************************************************************************************/

/**************************************************************************************************************/
/* REQUERIMIENTOS FUNCIONALES                                                                                 */
/**************************************************************************************************************/
/* 1. Cada vez que se inicia un caso de prueba se debe configurar la matriz nuevamente (Tamaño de la matriz   */
/* y numero de operaciones).                                                                                  */
/* 2. Cada vez que se inicia un caso de prueba la matriz debe ser reiniciada nuevamente a 0.                  */       
/* 3. El numero de casos de pruebas debe ser entre 1 y 50.                                                    */
/* 4. El tamaño de la matriz debe ser entre 1 y 100.                                                          */
/* 5. La cantidad de operaciones debe estar entre 1 y 1000.                                                   */
/* 6. La primera posicion de la matriz debe ser (1,1,1) y la ultima (tamaño de la matriz,tamaño de la matriz, */
/* tamaño de la matriz).                                                                                      */
/* 7. El valor de la cordenada en la operaciones debe estar entre (1,1,1) y (tamaño de la matriz,             */
/* tamaño de la matriz,tamaño de la matriz).                                                                  */
/* 8. El valor posible de cada posicion debe estar entre -10000000000 y 10000000000.                          */
/* 9. en caso de que se presente algun error por inconsistencias de datos se debe presentar el detalle del    */
/* error.                                                                                                     */
/**************************************************************************************************************/

/*************************************************************************************************************/
/* REQUERIMIENTOS NO FUNCIONALES                                                                             */
/*************************************************************************************************************/
/* 1. Una vez se ingresa un valor se deben conservar estos valores a nivel de capa de presentacion           */
/* para conocer los valores ingreasados.                                                                     */
/* 2. El ingreso de datos se debe realizar en aplicativo WEB.                                                */
/* 3. Para uso de pruebas unitarias y no ensuciar la presenteacion del aplicativo se utiliza el framework de */  
/* debug FirePHP.                                                                                            */
/* 5. Para esta version se debe utilizar programacion orientada a objetos.                                   */
/* 6. Para adicionar seguridad al aplicativo las variables se deben pasar por metodo POST.                   */
/* 7. Para conservar la informacion entre las multiples acciones se manejan SESIONES.                        */
/*************************************************************************************************************/

/*******************************************************/ 
/* DESARROLLADOR Y VERSION DE APLICATIVO               */
/*******************************************************/ 
/* Ingeniero Luis Vicente Peña Leal.                   */
/* Fecha: 05 de Febrero de 2016.                       */
/* Version: 1.0.0.                                     */
/* Detalle de codigo: Se convierte en POO.             */
/*******************************************************/ 
/********************************/
/* CONFIGURACION DEL APLICATIVO */
/********************************/
session_start(); //Configura el manejo de sesiones.
require ("include_principal.php"); //Configura el aplicativo incluyendo framework especiales.
/*********************/
/* CLASES REQUERIDAS */
/*********************/
require (_CLASE_MATRIZ); //Clase de matriz
require(_CLASE_VALIDACIONES); //Clase que realiza todas las validaciones 
require(_CLASE_ERRORES); //Clase que controla errores 
require(_CLASE_EJECUCION); //Clase que controla los datos de cada ejecucion. 
$GLOBALS["firephp"]; //Variable global de herramienta de DEBUG.
/*******************************************/
/* TODAS LAS VARIABLES DE SESION RECIBIDAS */
/*******************************************/
if (isset($_SESSION))
	$firephp->info($_SESSION,"SESIONES RECIBIDAS");
/************************************/
/* OBJETOS LOCALES DEL APLICATIVO */
/************************************/
$ejecucion = new Ejecuciones();
$validador = new Validaciones();
$error = new Errores();
$matriz_poo = new Matriz();
/*************************************************************/
/* RECUPERACION DE VARIABLES PARA EL CORRECTO FUNCIONAMIENTO */
/*************************************************************/
$firephp->Group("SESIONES RECIBIDAS");
if (isset ($_SESSION["T"]))	{
	$ejecucion->set_casos_de_prueba($_SESSION["T"]);
	unset($_SESSION["T"]);
	$firephp->log("Los casos de prueba se recuperan por sesion.");
}
else
	$firephp->log("Los casos de prueba no tienen sesion.");
if (isset ($_SESSION["casos_prueba_ejecutados"]))	{
	$ejecucion->set_caso_de_prueba_en_ejecucion($_SESSION["casos_prueba_ejecutados"]);
	unset($_SESSION["casos_prueba_ejecutados"]);
	$firephp->log("El caso de prueba ejecutados se recupera por sesion.");
}
else
	$firephp->log("El caso de prueba ejecutados no tienen sesion.");
if (isset ($_SESSION["objeto_matriz"])) {
	$matriz_poo->set_matriz($_SESSION["objeto_matriz"]);
	unset($_SESSION["objeto_matriz"]);
	$firephp->log("La matriz se recupera por sesion.");
}
else
	$firephp->log("La matriz no tiene sesion.");
if (isset ($_SESSION["N"]))	{
	$matriz_poo->set_tamano($_SESSION["N"]);
	unset($_SESSION["N"]);
	$firephp->log("El tamaño de la matriz se recupera por sesion.");
}
else
	$firephp->log("El tamaño de la matriz no tienen sesion.");
if (isset ($_SESSION["M"]))	{
	$ejecucion->set_operaciones($_SESSION["M"]);
	unset($_SESSION["M"]);
	$firephp->log("El total de operacion se recupera por sesion.");
}
else
	$firephp->log("El total de operaciones no tienen sesion.");
if (isset ($_SESSION["operaciones_ejecutadas"]))	{
	$ejecucion->set_operacion_en_ejecucion($_SESSION["operaciones_ejecutadas"]);
	unset($_SESSION["operaciones_ejecutadas"]);
	$firephp->log("La ejecucion actual se recupera por sesion.");
}
else
	$firephp->log("La ejecucion actual no tienen sesion.");
$firephp->GroupEnd();
if (isset($_POST["pasada"]))
	$ejecucion->set_pasada($_POST["pasada"]);
$error->set_estado($ejecucion->get_pasada());
/********************************************/
/* ACCIONES RECIBIDAS DESDE LA INTERFAZ WEB */
/********************************************/
if ($ejecucion->get_pasada() > 0) {
	/*******************************************************************/
	/* Este bloque configura la cantidad de casos de prueba a ejecutar */
	/*******************************************************************/
	if ($ejecucion->get_pasada() == 1) {
		$ejecucion->set_casos_de_prueba($_POST["casos_de_pruebas"]);
		$validador->set_numero($ejecucion->get_casos_de_prueba());
		$validador->valor_es_numerico();
		if ($validador->get_resultado() == "SI"){
			$validador->set_valor_minimo(1);
			$validador->set_valor_maximo(50);
			$validador->numero_en_rango();
			if ($validador->get_resultado() == "NO")
				$error->set_error(10);
		}
		else
			$error->set_error(9);
		$ejecucion->set_caso_de_prueba_en_ejecucion(NULL);
		$matriz_poo->set_matriz(NULL);
		$matriz_poo->set_tamano(NULL);
		$ejecucion->set_operaciones(NULL);
		$ejecucion->set_operacion_en_ejecucion(NULL);
	}
	/***************************************************************************************************/
	/* Este bloque configura el caso de prueba, tamaño de la matriz y cantidad de acciones a ejecutar. */
	/***************************************************************************************************/
	if ($ejecucion->get_pasada() == 2) {
		$check_radio1='checked="checked"'; //Opciones de check de las posiblesa cciones UPDATE o QUERY.
		$check_radio2= "";
		$matriz_poo->set_matriz(NULL);
		$validador->set_numero($_POST["tamano_matriz"]);
		$validador->valor_es_numerico();
		if ($validador->get_resultado() == "SI"){
			$validador->set_valor_minimo(1);
			$validador->set_valor_maximo(100);
			$validador->numero_en_rango();
			if ($validador->get_resultado() == "SI") {
				$matriz_poo->set_tamano($_POST["tamano_matriz"]);
				$matriz_poo->inicializacion();
			}
			else
				$error->set_error(20);
		}
		else
			$error->set_error(19);
		if ($error->get_error() == 0) {
			$validador->set_numero($_POST["operaciones"]);
			$validador->valor_es_numerico();
			if ($validador->get_resultado() == "SI"){
				$validador->set_valor_maximo(1000);
				$validador->numero_en_rango();
				if ($validador->get_resultado() == "SI")
					$ejecucion->set_operaciones($_POST["operaciones"]);
				else
					$error->set_error(30);
			}
			else
				$error->set_error(18);
		}
		if ($error->get_error() == 0) {
			$matriz_poo->set_matriz(NULL);
			$matriz_poo->inicializacion();
			$ejecucion->set_caso_de_prueba_en_ejecucion(1);
			$ejecucion->set_operacion_en_ejecucion(0);
		}
	}
	/*************************************/
	/* Este bloque ejecuta las acciones. */
	/*************************************/
	if ($ejecucion->get_pasada() == 3) {
		$ejecucion->set_accion($_POST["operacion"]);
		$ejecucion->set_operacion_en_ejecucion($ejecucion->get_operacion_en_ejecucion() + 1);
		$error->set_detalle1($matriz_poo->get_tamano());
		$validador->set_valor_minimo(1);
		$validador->set_valor_maximo($matriz_poo->get_tamano());
		if ($ejecucion->get_accion() == "consulta"){
			$check_radio1="";
			$check_radio2='checked="checked"';
			$validador->set_numero($_POST["x1"]);
			$validador->valor_numerico_y_numero_en_rango();
			if ($validador->get_resultado() == "NO-NUMERICO")
				$error->set_error(39);
			else if($validador->get_resultado() == "NO")
				$error->set_error(40);
			else 
				$matriz_poo->set_x1($_POST["x1"]-1);
			if ($error->get_error() == 0) {
				$validador->set_numero($_POST["y1"]);
				$validador->valor_numerico_y_numero_en_rango();
				if ($validador->get_resultado() == "NO-NUMERICO")
					$error->set_error(49);
				else if($validador->get_resultado() == "NO")
					$error->set_error(50);
				else 
					$matriz_poo->set_y1($_POST["y1"]-1);
			}
			if ($error->get_error() == 0) {
				$validador->set_numero($_POST["z1"]);
				$validador->valor_numerico_y_numero_en_rango();
				if ($validador->get_resultado() == "NO-NUMERICO")
					$error->set_error(59);
				else if($validador->get_resultado() == "NO")
					$error->set_error(60);
				else 
					$matriz_poo->set_z1($_POST["z1"]-1);
			}
			if ($error->get_error() == 0) {
				$validador->set_numero($_POST["x2"]);
				$validador->valor_numerico_y_numero_en_rango();
				if ($validador->get_resultado() == "NO-NUMERICO")
					$error->set_error(69);
				else if($validador->get_resultado() == "NO")
					$error->set_error(70);
				else 
					$matriz_poo->set_x2($_POST["x2"]-1);	
			}
			if ($error->get_error() == 0) {
				$validador->set_numero($_POST["y2"]);
				$validador->valor_numerico_y_numero_en_rango();
				if ($validador->get_resultado() == "NO-NUMERICO")
					$error->set_error(79);
				else if($validador->get_resultado() == "NO")
					$error->set_error(80);
				else 
					$matriz_poo->set_y2($_POST["y2"]-1);
			}
			if ($error->get_error() == 0) {
				$validador->set_numero($_POST["z2"]);
				$validador->valor_numerico_y_numero_en_rango();
				if ($validador->get_resultado() == "NO-NUMERICO")
					$error->set_error(89);
				else if($validador->get_resultado() == "NO")
					$error->set_error(90);
				else 
					$matriz_poo->set_z2($_POST["z2"]-1);
			}
			if ($error->get_error() == 0) {
				$matriz_poo->query();
				$error->set_detalle1("CONSULTA");
				$error->set_detalle2($matriz_poo->get_suma());
			}
		}
		else {
			$check_radio1='checked="checked"';
			$check_radio2="";
			if ($error->get_error() == 0) {
				$validador->set_numero($_POST["x"]);
				$validador->valor_numerico_y_numero_en_rango();
				if ($validador->get_resultado() == "NO-NUMERICO")
					$error->set_error(99);
				else if($validador->get_resultado() == "NO")
					$error->set_error(100);
				else
					$matriz_poo->set_x($_POST["x"]-1);
			}
			if ($error->get_error() == 0) {
				$validador->set_numero($_POST["y"]);
				$validador->valor_numerico_y_numero_en_rango();
				if ($validador->get_resultado() == "NO-NUMERICO")
					$error->set_error(109);
				else if($validador->get_resultado() == "NO")
					$error->set_error(110);
				else
					$matriz_poo->set_y($_POST["y"]-1);
			}
			if ($error->get_error() == 0) {
				$validador->set_numero($_POST["z"]);
				$validador->valor_numerico_y_numero_en_rango();
				if ($validador->get_resultado() == "NO-NUMERICO")
					$error->set_error(119);
				else if($validador->get_resultado() == "NO")
					$error->set_error(120);
				else
					$matriz_poo->set_z($_POST["z"]-1);
			}
			if ($error->get_error() == 0) {
				$validador->set_numero($_POST["w"]);
				$validador->set_valor_minimo(-10000000000);
				$validador->set_valor_maximo(10000000000);
				$validador->valor_numerico_y_numero_en_rango();
				if ($validador->get_resultado() == "NO-NUMERICO")
					$error->set_error(129);
				else if($validador->get_resultado() == "NO")
				{
					$error->set_detalle1($validador->get_valor_minimo());
					$error->set_detalle2($validador->get_valor_maximo());
					$error->set_error(130);
				}
				else 
					$matriz_poo->set_w($_POST["w"]);
			}
			if ($error->get_error() == 0) {
				$matriz_poo->update();
				$error->set_detalle1("ACTUALIZACION");
			}
		}
	}
	/*******************************************************************************************************/
	/* Este bloque reinicia las opciones cuando se acaba un caso de prueba y el usuario indico querer mas. */
	/*******************************************************************************************************/
	if ($ejecucion->get_pasada()==4){
		$ejecucion->set_pasada(2);
		$ejecucion->set_caso_de_prueba_en_ejecucion($ejecucion->get_caso_de_prueba_en_ejecucion()+1);
		$ejecucion->set_operacion_en_ejecucion(0);
		$error->set_error(140);
	}
}
$error->recupera_mensaje();
/********************************************************************************************/
/* SE GENERA EL SIGUIENTE GRUPO DE SESIONES PARA GARANTIZAR LA FUNCIONALIDAD DEL APLICATIVO */
/********************************************************************************************/
if ($ejecucion->get_casos_de_prueba() != NULL)
	$_SESSION["T"] = $ejecucion->get_casos_de_prueba();
if ($ejecucion->get_caso_de_prueba_en_ejecucion() != NULL)
	$_SESSION["casos_prueba_ejecutados"] = $ejecucion->get_caso_de_prueba_en_ejecucion();
if ($matriz_poo->get_matriz() != NULL)
	$_SESSION["objeto_matriz"] = $matriz_poo->get_matriz();
if ($matriz_poo->get_tamano() != NULL)
	$_SESSION["N"] = $matriz_poo->get_tamano();
if ($ejecucion->get_operaciones() != NULL)
	$_SESSION["M"] = $ejecucion->get_operaciones();
if ($ejecucion->get_operacion_en_ejecucion() != NULL)
	$_SESSION["operaciones_ejecutadas"] = $ejecucion->get_operacion_en_ejecucion();
/*******************************************/
/* TODAS LAS VARIABLES DE SESION GENERADAS */
/*******************************************/
if (isset($_SESSION))
	$firephp->info($_SESSION,"SESIONES GENERADAS");
/*******************************/
/* TODAS LOS OBJETOS GENERADOS */
/*******************************/
$firephp->Group("ESTADO FINAL DE LAS CLASES.");
$firephp->Log($matriz_poo,"Matriz final en la clase");
$firephp->log($ejecucion,"Datos de la ejecucion actual");
$firephp->log($error,"error");
$firephp->log($validador,"validador"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Prueba ingeniero Luis Vicente Pe&ntilde;a Leal</title>
<style type="text/css">
<!--
.EstiloTitulo {
	font-family: Tahoma, Verdana, Arial;
	font-size: 17px;
	color: red; 
	font-weight: bold;
}
.EstiloCampo {
	font-family: Tahoma, Verdana, Arial;
	font-size: 12px;
}
.EstiloTexto {
	font-family: Tahoma, Verdana, Arial;
	font-size: 10px;
}
-->
    </style>
</head>
<body>
<?php
/*************************************************/
/* Presentacion WEB de total de casos de prueba. */
/*************************************************/
?>	
	<form method="post" action="index.php">
		<table border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#111111" bordercolorlight="#000000" bordercolordark="#000000" style="border-collapse: collapse">
			<tr>
				<td colspan="2" align="center"><span class="EstiloTitulo">Ingreso de datos inciales</span></td>
			</tr>
			<tr>
				<td width="200" height="20" bgcolor="#99CCFF" align="center"><span class="EstiloCampo">Number of test-cases (T)</span></td>
				<td align="center"><input type="text" name="casos_de_pruebas" size="10" maxlength="10" value="<?php echo $ejecucion->get_casos_de_prueba();?>"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" value="Validar"></td>
			</tr>
			<input type="hidden" name="pasada" value="1" />
		</table>
	</form>
<?php
if ($ejecucion->get_pasada() > 0 && ($error->get_error() == 0 || ($error->get_error() >= 18 && $error->get_error() <= 140))) { 
	/**************************************************************************************************/
	/* Genera configuracion del caso de prueba y bloque de consulta del estado actual del aplicativo. */
	/**************************************************************************************************/
	$disabled = "";
	if ($error->get_error() == 0 || ($error->get_error() >= 40 && $error->get_error() <= 140))
		$disabled='disabled="disabled"';
	if ($ejecucion->get_pasada() >= 2 && $error->get_error() == 0 || ($error->get_error() >= 20 && $error->get_error() <= 130)) {
		$valor1 = $ejecucion->get_caso_de_prueba_en_ejecucion(); //$_SESSION["casos_prueba_ejecutados"];
		$valor2 = $matriz_poo->get_tamano(); // $ejecucion->get_  $N;
		$valor3 = $ejecucion->get_operaciones(); //$M;
		$valor4 = $ejecucion->get_operacion_en_ejecucion(); 
		$valor5 = $ejecucion->get_operaciones() - $ejecucion->get_operacion_en_ejecucion();
	}
	else {
		$valor1 = "PENDIENTE";
		$valor2 = "PENDIENTE";
		$valor3 = "PENDIENTE";
		$valor4 = "PENDIENTE";
		$valor5 = "PENDIENTE";
		$disabled = "";
	}
	?>
	</p>
	<form method="post" action="index.php">
		<table border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#111111" bordercolorlight="#000000" bordercolordark="#000000" style="border-collapse: collapse">
			<tr>
				<td colspan="2" align="center"><span class="EstiloTitulo">Ingreso de datos del test-case</span></td>
			</tr>
			<tr>
				<td bgcolor="#99CCFF" align="center"><span class="EstiloCampo">Matrix size (N)</span></td>
				<td align="center"><input type="text" name="tamano_matriz" size="10" maxlength="10" value="<?php echo $matriz_poo->get_tamano();?>" <?php echo $disabled;?>></td>
			</tr>
			<tr>
				<td bgcolor="#99CCFF" align="center"><span class="EstiloCampo">Number of operations (M)</span></td>
				<td align="center"><input type="text" name="operaciones" size="10" maxlength="10" value="<?php echo $ejecucion->get_operaciones();?>" <?php echo $disabled;?>></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" value="Validar" <?php echo $disabled;?>></td>
			</tr>
			<input type="hidden" name="pasada" value="2" />
		</table>
	</form>
	</p>
	<table border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#111111" bordercolorlight="#000000" bordercolordark="#000000" style="border-collapse: collapse">
		<tr>
			<td colspan="2" align="center"><span class="EstiloTitulo">Datos ingresados para el test-case</span></td>
		</tr>
		<tr>
			<td bgcolor="#99CCFF" align="center"><span class="EstiloCampo">Numero de Test-case a ejecutar (T)</span></td>
			<td align="center"><input type="text" disabled="disabled" size="10" maxlength="10" value="<?php echo $ejecucion->get_casos_de_prueba();?>"></td>
		</tr>
		<tr>
			<td bgcolor="#99CCFF" align="center"><span class="EstiloCampo">Test-case en ejecucion</span></td>
			<td align="center"><input type="text" disabled="disabled" size="10" maxlength="10" value="<?php echo $valor1;?>"></td>
		</tr>
		<tr>
			<td bgcolor="#99CCFF" align="center"><span class="EstiloCampo">Matrix size (N)</span></td>
			<td align="center"><input type="text" disabled="disabled" size="10" maxlength="10" value="<?php echo $valor2;?>"></td>
		</tr>
		<tr>
			<td bgcolor="#99CCFF" align="center"><span class="EstiloCampo">Number of operations (M)</span></td>
			<td align="center"><input type="text" disabled="disabled" size="10" maxlength="10" value="<?php echo $valor3;?>"></td>
		</tr>
		<tr>
			<td bgcolor="#99CCFF" align="center"><span class="EstiloCampo">Operacion actual</span></td>
			<td align="center"><input type="text" disabled="disabled" size="10" maxlength="10" value="<?php echo $valor4;?>"></td>
		</tr>
		<tr>
			<td bgcolor="#99CCFF" align="center"><span class="EstiloCampo">Operaciones faltantes</span></td>
			<td align="center"><input type="text" disabled="disabled" size="10" maxlength="10" value="<?php echo $valor5;?>"></td>
		</tr>
		<?php
		if ($valor5 == 0 && $valor1 < $ejecucion->get_casos_de_prueba()) {
			/********************************************/
			/* Activa el boton de nuevo caso de prueba. */ 
			/********************************************/
			?>
		<tr>
			<form method="post" action="index.php">
				<td colspan="2" align="center"><input type="submit" value="Siguiente Test-Case" ></td>
				<input type="hidden" name="pasada" value="4" />
			</form>	
		</tr>
			<?php
		}
		?>
	</table>
	<?php
	if ($ejecucion->get_pasada() >= 2 && ($error->get_error() == 0 || ($error->get_error() >= 20 && $error->get_error() <= 140))) {
		if ( $valor5 > 0 ) {
			?>
	<p></p>	
	<form method="post" action="index.php">
		<table border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#111111" bordercolorlight="#000000" bordercolordark="#000000" style="border-collapse: collapse">
			<tr>
				<td colspan="2" align="center"><span class="EstiloTitulo">Ingreso de datos para la ejecucion</span></td>
			</tr>
			<tr>
				<td width="80" height="20" bgcolor="#99CCFF" align="center"><span class="EstiloCampo">Accion</span></td>
				<td width="120" height="20" bgcolor="#99CCFF" align="center"><span class="EstiloCampo">Parametros</span></td>
			</tr>
			<tr>
				<td align="left"><input type="radio" name="operacion" value="actualizacion" <?php echo $check_radio1;?> /><span class="EstiloTexto">Update</span></td>
				<td>
					<table border="0">
						<tr>
							<td><span class="EstiloTexto">X</span></td>
							<td><input type="text" name="x" value="<?php if (is_numeric($matriz_poo->get_x())) echo $matriz_poo->get_x()+1; ?>" size="2" maxlength="3"/></td>
							<td><span class="EstiloTexto">Y</span></td>
							<td><input type="text" name="y" value="<?php if (is_numeric($matriz_poo->get_y())) echo $matriz_poo->get_y()+1; ?>" size="2" maxlength="3"/></td>
							<td><span class="EstiloTexto">Z</span></td>
							<td><input type="text" name="z" value="<?php if (is_numeric($matriz_poo->get_z())) echo $matriz_poo->get_y()+1; ?>" size="2" maxlength="3"/></td>
							<td><span class="EstiloTexto">W</span></td>
							<td><input type="text" name="w" value="<?php echo $matriz_poo->get_w(); ?>" size="9" maxlength="11"/></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td align="left"><input type="radio" name="operacion" value="consulta" <?php echo $check_radio2;?>><span class="EstiloTexto">Query</span></td>
				<td>
					<table border="0">
						<tr>
							<td><span class="EstiloTexto">X1</span></td>
							<td><input type="text" name="x1" value="<?php if (is_numeric($matriz_poo->get_x1())) echo $matriz_poo->get_x1()+1; ?>" size="2" maxlength="3"/></td>
							<td><span class="EstiloTexto">Y1</span></td>
							<td><input type="text" name="y1" value="<?php if (is_numeric($matriz_poo->get_y1())) echo $matriz_poo->get_y1()+1; ?>" size="2" maxlength="3"/></td>
							<td><span class="EstiloTexto">Z1</span></td>
							<td><input type="text" name="z1" value="<?php if (is_numeric($matriz_poo->get_z1())) echo $matriz_poo->get_z1()+1; ?>" size="2" maxlength="3"/></td>
							<td><span class="EstiloTexto">X2</span></td>
							<td><input type="text" name="x2" value="<?php if (is_numeric($matriz_poo->get_x2())) echo $matriz_poo->get_x2()+1; ?>" size="2" maxlength="3"/></td>
							<td><span class="EstiloTexto">Y2</span></td>
							<td><input type="text" name="y2" value="<?php if (is_numeric($matriz_poo->get_y2())) echo $matriz_poo->get_y2()+1; ?>" size="2" maxlength="3"/></td>
							<td><span class="EstiloTexto">Z2</span></td>
							<td><input type="text" name="z2" value="<?php if (is_numeric($matriz_poo->get_z2())) echo $matriz_poo->get_z2()+1; ?>" size="2" maxlength="3"/></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" value="Ejecutar"></td>
			</tr>
		<input type="hidden" name="pasada" value="3"/>
		</table>
	</form>
			<?php
		}
	}
}
/*********************/
/* Seccion de ayuda. */
/*********************/
if ($error->get_mensaje() != "") {
	?>		
	</p>
	<table border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#111111" bordercolorlight="#000000" bordercolordark="#000000" style="border-collapse: collapse">
		<tr>
			<td align="center"><span class="EstiloTitulo">Ayuda</span></td>
		</tr>
		<tr>
			<td align="justify"><?php echo $error->get_mensaje();?></td>
		</tr>
	</table>
	<?php
}
?>
</body>
</html>
