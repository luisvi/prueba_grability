<?php 
/**********************************************************************************************************/ 
/* OBJETIVO:                                                                                              */
/**********************************************************************************************************/ 
/* Crear un aplicativo que maneje una matriz tridimencional. La oordenada inicial es (1,1,1). El usuario  */
/* define el tamaño de la matriz, la matriz en un principio tiene todos sus elementos en 0. Debe soportar */
/* dos tipos de acciones "UPDATE" el cual permite cambiar un valor en la matriz y QUERY el cual debe      */
/* calcular la suma de todas las posiciones del array indicando posicion inciial y posicion final.        */
/**********************************************************************************************************/

/***********************************************************************************************************************/
/* DATOS DE ENTRADA                                                                                                    */
/***********************************************************************************************************************/
/* 1. Casos de prueba: Indica la cantidad de casos de pruebas que se ejecutaran en el aplicativo. Valor entero.        */
/* 2. Tamaño de la matriz: Con unico numero indica el tamaño de la matriz en todas sus tres dimensiones. Valor entero. */ 
/* 3. Para el caso de la accion UPDATE: coordenda de la matriz (x,y,z) y su valor numerico.                            */
/* 4. Para el caso de la accion QUERY: Calcular la suma de cada una de las posiciones de la matriz iniciando con la    */
/* coordenada (x1,y1,z1) hasta la coordenada (x2,y2,z2).                                                               */
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
/* 8. El valor posible de cada posiociond ebe estar en tre -10000000000 y 10000000000.                        */
/* 9. en caso de que se presente algun error por inconsistencias de datos se debe presentar el detalle del    */
/* error.
/**************************************************************************************************************/

/*************************************************************************************************************/
/* REQUERIMIENTOS NO FUNCIONALES                                                                             */
/*************************************************************************************************************/
/* 1. Una vez se ingresa un valor se deben conservar estos valores a nivel de capa de presentacion           */
/* para conocer los valores ingreasados.                                                                     */
/* 2. El ingreso de datos se debe realizar en aplicativo WEB.                                                */
/* 3. El desarrollo debe estar en un solo archivo                                                            */
/* 4. Para uso de pruebas unitarias y no ensuciar la presenteacion del aplicativo se utiliza el framework de */  
/* debug FirePHP                                                                                             */
/* 5. Para esta version se debe utilizar programacion secuencial.                                            */
/* 6. Para adicionar seguridad al aplicativo las variables se deben pasar por metodo POST.                   */
/* 7. Para conservar la informacion entre las multiples acciones se manejan SESIONES.                        */
/*************************************************************************************************************/

/********************************************************/ 
/* DESARROLLADOR Y VERSION DE APLICATIVO                */
/********************************************************/ 
/* Ingeniero Luis Vicente Peña Leal.                    */
/* Fecha: 04 de Febrero de 2016.                        */
/* Version: BETA 1.                                     */
/* Detalle de codigo: Version inicial de la aplicacion. */
/********************************************************/ 

/********************************/
/* CONFIGURACION DEL APLICATIVO */
/********************************/
session_start(); //Configura el manejo de sesiones.
require ("include_principal.php"); //Configura el aplicativo incluyendo framework especiales.
$GLOBALS["firephp"]; //Variable global de herramienbta de DEBUG.
/************************************/
/* VARIABLES LOCALES DEL APLICATIVO */
/************************************/
$pasada=0; //Define que accion o parte del proecso se encuentra.
$T=""; //Numero de casos de pruebas a ejecutar
$N=""; //Tamaño de la matriz
$M=""; //Numero de acciones a ejecutar por caso de prueba
$x=""; //Coordenada x para accion de de UPDATE.
$y=""; //Coordenada y para accion de de UPDATE.
$z=""; //Coordenada z para accion de de UPDATE.
$w=""; //Valor el cual sera actualizado en la accion UPDATE de la matriz.
$x1=""; //Coordenada x1 para accion de de QUERY.
$y1=""; //Coordenada y1 para accion de de QUERY.
$z1=""; //Coordenada z1 para accion de de QUERY.
$x2=""; //Coordenada x2 para accion de de QUERY.
$y2=""; //Coordenada y2 para accion de de QUERY.
$z2=""; //Coordenada z2 para accion de de QUERY.
$error = 0; //Variable de control de errores y recuperaciones de los mismos.
$check_radio1='checked="checked"'; //Opciones de check de las posiblesa cciones UPDATE o QUERY.
$check_radio2= "";
$mensaje_ayuda="";
if (isset($_POST["pasada"]))
	$pasada=$_POST["pasada"];
else
	$mensaje_ayuda="En espera para iniciar el proceso.";
if ($pasada > 0) {
	/*******************************************************************/
	/* Este bloque configura la cantidad de casos de prueba a ejecutar */
	/*******************************************************************/
	if ($pasada == 1) {
		$casos_prueba = $_POST["casos_de_pruebas"];
		if ($casos_prueba <1 || $casos_prueba >50) {
			$mensaje_ayuda="El valor de T esta fuera de rango, debe estar entre 1 y 50. ";
			$error = 10;
		}
		else {
			$_SESSION["casos_prueba_ejecutados"]=1;
			$_SESSION["operaciones_ejecutadas"]=0;
			$mensaje_ayuda="En espera de la inicializacion del Test-case. ";
		}
		$_SESSION["T"]=$casos_prueba;
		if (isset($_SESSION["matriz"]))
			unset ($_SESSION["matriz"]);
		if (isset($_SESSION["N"]))
			unset ($_SESSION["N"]);
		if (isset($_SESSION["M"]))
			unset ($_SESSION["M"]);
	}
	/***************************************************************************************************/
	/* Este bloque configura el caso de prueba, tamaño de la matriz y cantidad de acciones a ejecutar. */
	/***************************************************************************************************/
	if ($pasada == 2) {
		$N=$_POST["tamano_matriz"];
		$M=$_POST["operaciones"];
		if ($N<1 || $N>100){
			$mensaje_ayuda.="El valor de N esta fuera de rango, debe estar entre 1 y 100. ";
			$error = 20;
		}
		if ($M<1 || $M>1000) {
			$mensaje_ayuda.="El valor de M esta fuera de rango, debe estar entre 1 y 1000.";
			$error = 30;
		}
		if ($mensaje_ayuda == "")
			$mensaje_ayuda="En espera de datos para iniciar test-case.";
		$_SESSION["N"]=$N;
		$_SESSION["M"]=$M;
	}
	/***********************************************/
	/* Recupera valores previamente seleccionados. */
	/***********************************************/
	if (isset($_SESSION["T"]))
		$T=$_SESSION["T"];
	if (isset($_SESSION["N"]))
		$N=$_SESSION["N"];
	if (isset($_SESSION["M"]))
		$M=$_SESSION["M"];
	if (isset($_POST["x"]))
		$x=$_POST["x"];
	if (isset($_POST["y"]))
		$y=$_POST["y"];
	if (isset($_POST["z"]))
		$z=$_POST["z"];
	if (isset($_POST["w"]))
		$w=$_POST["w"];
	if (isset($_POST["x1"]))
		$x1=$_POST["x1"];
	if (isset($_POST["y1"]))
		$y1=$_POST["y1"];
	if (isset($_POST["z1"]))
		$z1=$_POST["z1"];
	if (isset($_POST["x2"]))
		$x2=$_POST["x2"];
	if (isset($_POST["y2"]))
		$y2=$_POST["y2"];
	if (isset($_POST["z2"]))
		$z2=$_POST["z2"];
	/*************************************/
	/* Este bloque ejecuta las acciones. */
	/*************************************/
	if ($_POST["pasada"] == 3) {
		$_SESSION["operaciones_ejecutadas"]=$_SESSION["operaciones_ejecutadas"]+1;
		if (isset($_POST["operacion"]) && $_POST["operacion"] == "consulta"){
			$check_radio1="";
			$check_radio2='checked="checked"';
			$x=$y=$z=$w="";
			$mensaje_ayuda = "";
			if ($x1<1 || $x1>$N) {
				$mensaje_ayuda="El valor de X1 esta fuera de rango, debe estar entre 1 y ".$N.". ";
				$error=40;
			}
			if ($y1<1 || $y1>$N){
				$mensaje_ayuda.="El valor de Y1 esta fuera de rango, debe estar entre 1 y ".$N.". ";
				$error=50;
			}
			if ($z1<1 || $z1>$N){
				$mensaje_ayuda.="El valor de Z1 esta fuera de rango, debe estar entre 1 y ".$N.". ";
				$error=60;
			}
			if ($x2<1 || $x2>$N){
				$mensaje_ayuda.="El valor de X2 esta fuera de rango, debe estar entre 1 y ".$N.". ";
				$error=70;
			}
			if ($y2 <1 || $y2>$N) {
				$mensaje_ayuda.="El valor de Y2 esta fuera de rango, debe estar entre 1 y ".$N.". ";
				$error=80;
			}
			if ($z2 <1 || $z2>$N){
				$mensaje_ayuda.="El valor de Z2 esta fuera de rango, debe estar entre 1 y ".$N.". ";
				$error=90;
			}
			$_SESSION["operaciones_ejecutadas"]=$_SESSION["operaciones_ejecutadas"]--;
		}
		else {
			$x1=$y1=$z1=$x2=$y2=$z2="";
			if ($x<1 || $x>$N) {
				$mensaje_ayuda="El valor de X esta fuera de rango, debe estar entre 1 y ".$N.". ";
				$error=100;
			}	
			if ($y<1 || $y>$N){
				$mensaje_ayuda.="El valor de Y esta fuera de rango, debe estar entre 1 y ".$N.". ";
				$error=110;
			}
			if ($z<1 || $z>$N) {
				$mensaje_ayuda.="El valor de Z esta fuera de rango, debe estar entre 1 y ".$N.". ";
				$error=120;
			}
			if ($w == "" || ($w<-10000000000 || $w>10000000000)){
				$mensaje_ayuda.="El valor de W esta fuera de rango, debe estar entre -10000000000  y 10000000000. ";
				$error=130;
			}
		}
		if ($mensaje_ayuda == "")
			$mensaje_ayuda="En espera de datos para iniciar ejecuciones.";
		if ($error == 0){
			/* Proceso del aplicativo */
			$firephp->info('Inicio de las acciones');
			$firephp->log($_POST["operacion"],"operacion");
			if (isset($_SESSION["matriz"]))
				$matriz = $_SESSION["matriz"];
			else {
				$matriz = array();
				for ($i=0;$i<$N;$i++) 
					for ($j=0;$j<$N;$j++)
						for ($k=0;$k<$N;$k++)
							$matriz[$i][$j][$k]=0;
			}
			$firephp->log($matriz,"matriz recuperada");
			if ($_POST["operacion"]=="actualizacion"){
				$matriz[$_POST["x"]-1][$_POST["y"]-1][$_POST["z"]-1] = $_POST["w"];
				unset ($_SESSION["matriz"]);
				$_SESSION["matriz"]=$matriz;
			}
			if ($_POST["operacion"]=="consulta"){
				$x1_real=$_POST["x1"]-1;
				$y1_real=$_POST["y1"]-1;
				$z1_real=$_POST["z1"]-1;
				$x2_real=$_POST["x2"]-1;
				$y2_real=$_POST["y2"]-1;
				$z2_real=$_POST["z2"]-1;
				$total = 0;
				for ($i=$x1_real;$i<=$x2_real;$i++) 
					for ($j=$y1_real;$j<=$y2_real;$j++)
						for ($k=$z1_real;$k<=$z2_real;$k++)
							$total+=$matriz[$i][$j][$k];
				$firephp->log($total,"total de operacion.");
				$mensaje_ayuda=$total;
				
			}	
			$firephp->log($matriz,"matriz modificada");
		}
	}
	/***************************************************************************/
	/* Este bloque reinicia las ocpines para ejecutar un nuevo caso de prueba. */
	/**************************************************************************/
	if ($pasada==4){
		$pasada = 2;
		$_SESSION["casos_prueba_ejecutados"]=$_SESSION["casos_prueba_ejecutados"] + 1;
		$_SESSION["operaciones_ejecutadas"]=0;
		$error = 140;
		if (isset($_SESSION["matriz"]))
			unset ($_SESSION["matriz"]);
	}
}
$firephp->log($pasada,"pasada");
$firephp->log($error,"error");
$firephp->log($T,"casos_de_pruebas");
$firephp->log($N,"tamano_matriz");
$firephp->log($M,"operaciones");
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
	font-size: 20px;
	color: red; 
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
				<td align="center"><input type="text" name="casos_de_pruebas" size="10" maxlength="10" value="<?php echo $T;?>"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" value="Validar"></td>
			</tr>
			<input type="hidden" name="pasada" value="1" />
		</table>
	</form>
<?php
if ($pasada > 0 && ($error == 0 || ($error >= 20 && $error <= 140))) { 
	/**************************************************************************************************/
	/* Genera configuracion del caso de prueba y bloque de consulta del estado actual del aplicativo. */
	/**************************************************************************************************/
	$disabled = "";
	if ($error == 0 || ($error >= 40 && $error <= 140))
		$disabled='disabled="disabled"';
	if ($pasada >= 2 && $error == 0 || ($error >= 20 && $error <= 130)) {
		$valor1 = $_SESSION["casos_prueba_ejecutados"];
		$valor2 = $N;
		$valor3 = $M;
		$valor4 = $_SESSION["operaciones_ejecutadas"];
		$valor5 = $M - $_SESSION["operaciones_ejecutadas"];
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
				<td align="center"><input type="text" name="tamano_matriz" size="10" maxlength="10" value="<?php echo $N;?>" <?php echo $disabled;?>></td>
			</tr>
			<tr>
				<td bgcolor="#99CCFF" align="center"><span class="EstiloCampo">Number of operations (M)</span></td>
				<td align="center"><input type="text" name="operaciones" size="10" maxlength="10" value="<?php echo $M;?>" <?php echo $disabled;?>></td>
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
			<td align="center"><input type="text" disabled="disabled" size="10" maxlength="10" value="<?php echo $T;?>"></td>
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
		if ($valor5 == 0 && $valor1 < $T) {
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
	if ($pasada >= 2 && ($error == 0 || ($error >= 20 && $error <= 140))) {
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
							<td><input type="text"name="x" value="<?php echo $x;?>" size="2" maxlength="3"/></td>
							<td><span class="EstiloTexto">Y</span></td>
							<td><input type="text" name="y" value="<?php echo $y;?>"size="2" maxlength="3"/></td>
							<td><span class="EstiloTexto">Z</span></td>
							<td><input type="text" name="z" value="<?php echo $z;?>" size="2" maxlength="3"/></td>
							<td><span class="EstiloTexto">W</span></td>
							<td><input type="text" name="w" value="<?php echo $w;?>" size="9" maxlength="11"/></td>
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
							<td><input type="text" name="x1" value="<?php echo $x1;?>"size="2" maxlength="3"/></td>
							<td><span class="EstiloTexto">Y1</span></td>
							<td><input type="text" name="y1" value="<?php echo $y1;?>"size="2" maxlength="3"/></td>
							<td><span class="EstiloTexto">Z1</span></td>
							<td><input type="text" name="z1"value="<?php echo $z1;?>"size="2" maxlength="3"/></td>
							<td><span class="EstiloTexto">X2</span></td>
							<td><input type="text" name="x2" value="<?php echo $x2;?>" size="2" maxlength="3"/></td>
							<td><span class="EstiloTexto">Y2</span></td>
							<td><input type="text" name="y2" value="<?php echo $y2;?>" size="2" maxlength="3"/></td>
							<td><span class="EstiloTexto">Z2</span></td>
							<td><input type="text" name="z2" value="<?php echo $z2;?>" size="2" maxlength="3"/></td>
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
?>		
	</p>
	<table border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#111111" bordercolorlight="#000000" bordercolordark="#000000" style="border-collapse: collapse">
		<tr>
			<td align="center"><span class="EstiloTitulo">Ayuda</span></td>
		</tr>
		<tr>
			<td align="justify"><?php echo $mensaje_ayuda;?></td>
		</tr>
	</table>
</body>
</html>
