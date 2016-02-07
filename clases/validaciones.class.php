<?php 
/****************************************************************************************************/
/* OBJETIVO:                                                                                        */
/***************************************************************************************************/
/* Clase en la que se controlan todos los aspectos de las validaciones que requiere el aplicativo. */
/***************************************************************************************************/

/*******************************************************/ 
/* DESARROLLADOR Y VERSION DE APLICATIVO               */
/*******************************************************/ 
/* Ingeniero Luis Vicente Peña Leal.                   */
/* Fecha: 05 de Febrero de 2016.                       */
/* Version: 1.0.0.                                     */
/* Detalle de codigo: Se convierte en POO.             */
/*******************************************************/ 
class Validaciones {
	var $numero; //Caracter que se espera sea un numero parav realizar validaciones y garantizar que efectivamente sea un valor numerico
	var $valor_minimo; //Valor minimo que un numero debe tener.
	var $valor_maximo; //Valor maximo que un numero debe tener.
	var $resultado; //Resultado textual para resultados especiales segun el elemento que lo haya requerido.
	var $error; //Codigo de error del proceso de validacion
	
	/************************************************/
	/* Verifica si un carcater indicado es numerico */
	/************************************************/
	function valor_es_numerico() {
		if (is_numeric($this->get_numero()))
			$this->set_resultado("SI");
		else
			$this->set_resultado("NO");
	}
	
	/**********************************************************************************/
	/* Verifica que un numero dado esta entre el rango de otros dos valores indicados */
	/**********************************************************************************/
	function numero_en_rango() {
		if ($this->get_numero() >= $this->get_valor_minimo() && $this->get_numero() <= $this->get_valor_maximo())
			$this->set_resultado("SI");
		else
			$this->set_resultado("NO");
	}
	
	/*************************************************************/
	/* Union de funciones de valor_es_numerico y numero_en_rango */
	/*************************************************************/
	function valor_numerico_y_numero_en_rango() {
		$this->valor_es_numerico();
		if ($this->get_resultado() == "SI")
			$this->numero_en_rango();
		else
			$this->set_resultado("NO-NUMERICO");
	}
	
	/*******************/
	/* SETTER Y GETTER */
	/*******************/
	function set_numero($numero){
		$this->numero=$numero;
	}
	function get_numero(){
		return ($this->numero);
	}
	function set_valor_minimo($valor_minimo){
		$this->valor_minimo=$valor_minimo;
	}
	function get_valor_minimo(){
		return ($this->valor_minimo);
	}
	function set_valor_maximo($valor_maximo){
		$this->valor_maximo=$valor_maximo;
	}
	function get_valor_maximo(){
		return ($this->valor_maximo);
	}
	function set_resultado($resultado){
		$this->resultado=$resultado;
	}
	function get_resultado(){
		return ($this->resultado);
	}
	function set_error($error){
		$this->error=$error;
	}
	function get_error(){
		return ($this->error);
	}
}
