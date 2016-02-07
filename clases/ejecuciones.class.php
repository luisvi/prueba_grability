<?php
/***********************************************************************************/
/* OBJETIVO:                                                                       */
/***********************************************************************************/
/* Clase en la que se controlan todos los aspectos de la ejecucion del aplicativo. */
/***********************************************************************************/

/*******************************************************/ 
/* DESARROLLADOR Y VERSION DE APLICATIVO               */
/*******************************************************/ 
/* Ingeniero Luis Vicente Peña Leal.                   */
/* Fecha: 05 de Febrero de 2016.                       */
/* Version: 1.0.0.                                     */
/* Detalle de codigo: Se convierte en POO.             */
/*******************************************************/ 

class Ejecuciones {
	var $casos_de_prueba; //Define el total de casos de prueba.
	var $caso_de_prueba_en_ejecucion; //Define que caso de prueba se esta ejecutando.
	var $operaciones; //Define la cantidad de ejecuciones que un caso de prueba tiene en particular.
	var $operacion_en_ejecucion; //Leva el valor de la operacion que se esta ejecutando
	var $pasada; //Define que accion o parte del proecso se encuentra. ---- $_POST["pasada"]
	var $accion; //define la accion que el usuario desea ejecutar sobre la matriz
	
	/***************************/
	/* Constructor de la clase */
	/***************************/
	function Ejecuciones() {
		$this->set_casos_de_prueba(NULL);
		$this->set_caso_de_prueba_en_ejecucion(NULL);
		$this->set_operaciones(NULL);
		$this->set_operacion_en_ejecucion(NULL);
		$this->set_pasada(0);
	}
	
	/*******************/
	/* SETTER Y GETTER */
	/*******************/
	function set_casos_de_prueba($casos_de_prueba){
		$this->casos_de_prueba=$casos_de_prueba;
	}
	function get_casos_de_prueba(){
		return ($this->casos_de_prueba);
	}
	function set_caso_de_prueba_en_ejecucion($caso_de_prueba_en_ejecucion){
		$this->caso_de_prueba_en_ejecucion=$caso_de_prueba_en_ejecucion;
	}
	function get_caso_de_prueba_en_ejecucion(){
		return ($this->caso_de_prueba_en_ejecucion);
	}
	function set_operaciones($operaciones){
		$this->operaciones=$operaciones;
	}
	function get_operaciones(){
		return ($this->operaciones);
	}
	function set_operacion_en_ejecucion($operacion_en_ejecucion){
		$this->operacion_en_ejecucion=$operacion_en_ejecucion;
	}
	function get_operacion_en_ejecucion(){
		return ($this->operacion_en_ejecucion);
	}
	function set_pasada($pasada){
		$this->pasada=$pasada;
	}
	function get_pasada(){
		return ($this->pasada);
	}
	function set_accion($accion){
		$this->accion=$accion;
	}
	function get_accion(){
		return ($this->accion);
	}
}
