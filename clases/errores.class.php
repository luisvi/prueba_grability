<?php
/***************************************************************************************/
/* OBJETIVO:                                                                           */
/***************************************************************************************/
/* Clase en la que se controlan todos los aspectos de los errores y el manejo adecuado */
/* mostrarlos por la interfaz WEB.                                                     */
/***************************************************************************************/

/*******************************************************/ 
/* DESARROLLADOR Y VERSION DE APLICATIVO               */
/*******************************************************/ 
/* Ingeniero Luis Vicente Peña Leal.                   */
/* Fecha: 05 de Febrero de 2016.                       */
/* Version: 1.0.0.                                     */
/* Detalle de codigo: Se convierte en POO.             */
/*******************************************************/  

class Errores {
	var $error; //Variable de control de errores y recuperaciones de los mismos.
	var $estado; //Valor equivalante a la pasada
	var $mensaje; //Mensaje textual para presentar en al ayuda de la aplicaicon WEB. 
	var $detalle1; //Valor adicional para completar una descripcion completa.
	var $detalle2; //Valor adicional para completar una descripcion completa.
	
	/***************************/
	/* Constructor de la clase */
	/***************************/
	function Errores() {
		$this->set_error(0);
		$this->set_estado(0);
		$this->set_mensaje("");
		$this->set_detalle1("");
	}
	
	/************************************************************************************/
	/* Segun el valor del codigo del error asigna un mensaje presentado en interfaz WEB */
	/************************************************************************************/
	function recupera_mensaje() {
		if ($this->get_error() == 0){
			if ($this->get_estado() == 0)
				$this->set_mensaje("Esperando configuracion del total de casos de prueba.");
			else if ($this->get_estado() == 1)
				$this->set_mensaje("Esperando configuracion del caso de prueba en ejecucion.");
			else if ($this->get_estado() == 2)
				$this->set_mensaje("Esperando datos para la ejecucion.");
			else if ($this->get_estado() == 3) {
					if ($this->get_detalle1() == "CONSULTA")
						$this->set_mensaje("El resultado de la consulta es: ".$this->get_detalle2().".");
					else if ($this->get_detalle1() == "ACTUALIZACION")
						$this->set_mensaje("Actulizacion correcta");
			}
		}
		else {
			if ($this->get_error() == 10)
				$this->set_mensaje("El valor de T esta fuera de rango, debe estar entre 1 y 50.");
			else if ($this->get_error() == 9)
				$this->set_mensaje("El valor ingresado en el campo T no es numerico.");
			if ($this->get_error() == 20)
				$this->set_mensaje("El valor de N esta fuera de rango, debe estar entre 1 y 100.");
			else if ($this->get_error() == 19)
				$this->set_mensaje("El valor ingresado en el campo N no es numerico.");
			if ($this->get_error() == 30)
				$this->set_mensaje("El valor de M esta fuera de rango, debe estar entre 1 y 1000.");
			else if ($this->get_error() == 18)
				$this->set_mensaje("El valor ingresado en el campo M no es numerico.");
			if ($this->get_error() == 40)
				$this->set_mensaje("El valor de X1 esta fuera de rango, debe estar entre 1 y ".$this->get_detalle1().".");
			else if ($this->get_error() == 39)
				$this->set_mensaje("El valor ingresado en el campo X1 no es numerico.");
			if ($this->get_error() == 50)
				$this->set_mensaje("El valor de Y1 esta fuera de rango, debe estar entre 1 y ".$this->get_detalle1().".");
			else if ($this->get_error() == 49)
				$this->set_mensaje("El valor ingresado en el campo Y1 no es numerico.");
			if ($this->get_error() == 60)
				$this->set_mensaje("El valor de Z1 esta fuera de rango, debe estar entre 1 y ".$this->get_detalle1().".");
			else if ($this->get_error() == 59)
				$this->set_mensaje("El valor ingresado en el campo Z1 no es numerico.");
			if ($this->get_error() == 70)
				$this->set_mensaje("El valor de X2 esta fuera de rango, debe estar entre 1 y ".$this->get_detalle1().".");
			else if ($this->get_error() == 69)
				$this->set_mensaje("El valor ingresado en el campo X2 no es numerico.");
			if ($this->get_error() == 80)
				$this->set_mensaje("El valor de Y2 esta fuera de rango, debe estar entre 1 y ".$this->get_detalle1().".");
			else if ($this->get_error() == 79)
				$this->set_mensaje("El valor ingresado en el campo Y2 no es numerico.");
			if ($this->get_error() == 90)
				$this->set_mensaje("El valor de Z2 esta fuera de rango, debe estar entre 1 y ".$this->get_detalle1().".");
			else if ($this->get_error() == 89)
				$this->set_mensaje("El valor ingresado en el campo Z2 no es numerico.");
			if ($this->get_error() == 100)
				$this->set_mensaje("El valor de X esta fuera de rango, debe estar entre 1 y ".$this->get_detalle1().".");
			else if ($this->get_error() == 99)
				$this->set_mensaje("El valor ingresado en el campo X no es numerico.");
			if ($this->get_error() == 110)
				$this->set_mensaje("El valor de Y esta fuera de rango, debe estar entre 1 y ".$this->get_detalle1().".");
			else if ($this->get_error() == 109)
				$this->set_mensaje("El valor ingresado en el campo Y no es numerico.");
			if ($this->get_error() == 120)
				$this->set_mensaje("El valor de Z esta fuera de rango, debe estar entre 1 y ".$this->get_detalle1().".");
			else if ($this->get_error() == 119)
				$this->set_mensaje("El valor ingresado en el campo Z no es numerico.");
			if ($this->get_error() == 130)
				$this->set_mensaje("El valor de W esta fuera de rango, debe estar entre ".$this->get_detalle1()." y ".$this->get_detalle2().".");
			else if ($this->get_error() == 129)
				$this->set_mensaje("El valor ingresado en el campo W no es numerico.");
		}	
	}	
		 
	/*******************/
	/* SETTER Y GETTER */
	/*******************/
	function set_error($error){
		$this->error=$error;
	}
	function get_error(){
		return ($this->error);
	}
	function set_estado($estado){
		$this->estado=$estado;
	}
	function get_estado(){
		return ($this->estado);
	}
	function set_mensaje($mensaje){
		$this->mensaje=$mensaje;
	}
	function get_mensaje(){
		return ($this->mensaje);
	}
	function set_detalle1($detalle1){
		$this->detalle1=$detalle1;
	}
	function get_detalle1(){
		return ($this->detalle1);
	}
	function set_detalle2($detalle2){
		$this->detalle2=$detalle2;
	}
	function get_detalle2(){
		return ($this->detalle2);
	}
}	
