<?php
/********************************************************************************/
/* OBJETIVO:                                                                    */
/********************************************************************************/
/* Clase en la que se controlan todos los aspectos de la matriz tridimencional. */
/********************************************************************************/

/*******************************************************/ 
/* DESARROLLADOR Y VERSION DE APLICATIVO               */
/*******************************************************/ 
/* Ingeniero Luis Vicente Peña Leal.                   */
/* Fecha: 05 de Febrero de 2016.                       */
/* Version: 1.0.0.                                     */
/* Detalle de codigo: Se convierte en POO.             */
/*******************************************************/ 

class Matriz {
	var $matriz; //Matriz tridimencional
	var $tamano; //Tamaño de la matriz
	var $suma; //Valor final de la suma de cada uno de las posiciones 
	var $x; //Coordenada x
	var $y; //Coordenada y
	var $z; //Coordenada z
	var $w; //Valor para la posicion de la coordena (x,y,z) 
	var $x1; //Coordenada x1
	var $y1; //Coordenada y1
	var $z1; //Coordenada z1
	var $x2; //Coordenadax2
	var $y2; //Coordenada y2
	var $z2; //Coordenan z2
	
	/***************************/
	/* Constructor de la calse */
	/***************************/
	function Matriz () {
		$this->set_matriz(NULL);
		$this->set_tamano(NULL);
		$this->set_suma(NULL);
		$this->set_x(NULL);
		$this->set_y(NULL);
		$this->set_z(NULL);
		$this->set_w(NULL);
		$this->set_x1(NULL);
		$this->set_y1(NULL);
		$this->set_z1(NULL);
		$this->set_x2(NULL);
		$this->set_y2(NULL);
		$this->set_z2(NULL);
	}
	
	/**************************************************************************/
	/* Inicializa la matriz de cualquier tamaño a atodos sus componentes a 0. */
	/**************************************************************************/
	function inicializacion () {
		$matriz = array();
		for ($i=0;$i<$this->get_tamano();$i++) 
			for ($j=0;$j<$this->get_tamano();$j++)
				for ($k=0;$k<$this->get_tamano();$k++)
					$matriz[$i][$j][$k]=0;
		$this->set_matriz($matriz);
	}
	
	/***********************************************************************/
	/* Cambia el valor de una posicion especifica indicando la coordenada. */
	/***********************************************************************/
	function update() {
		$matriz=$this->get_matriz();
		$matriz[$this->get_x()][$this->get_y()][$this->get_z()]=$this->get_w();
		$this->set_matriz($matriz);
	}
	
	/*******************************************************************************************************/
	/* Calcula la sumatoria de cada una de las posiciones indicando coordenada inicial y coordenada final. */
	/*******************************************************************************************************/
	function query() {
		$total = 0;
		$matriz = $this->get_matriz();
		for ($i=$this->get_x1();$i<=$this->get_x2();$i++) 
			for ($j=$this->get_y1();$j<=$this->get_y2();$j++)
				for ($k=$this->get_z1();$k<=$this->get_z2();$k++)
					$total+=$matriz[$i][$j][$k];
		$this->set_suma($total);
	}
	
	/*******************/
	/* SETTER Y GETTER */
	/*******************/
	function set_matriz($matriz){
		$this->matriz=$matriz;
	}
	function get_matriz(){
		return ($this->matriz);
	}
	function set_tamano($tamano){
		$this->tamano=$tamano;
	}
	function get_tamano(){
		return ($this->tamano);
	}	
	function set_suma($suma){
		$this->suma=$suma;
	}
	function get_suma(){
		return ($this->suma);
	}
	function set_x($x){
		$this->x=$x;
	}
	function get_x(){
		return ($this->x);
	}
	function set_y($y){
		$this->y=$y;
	}
	function get_y(){
		return ($this->y);
	}
	function set_z($z){
		$this->z=$z;
	}
	function get_z(){
		return ($this->z);
	}
	function set_w($w){
		$this->w=$w;
	}
	function get_w(){
		return ($this->w);
	}
	function set_x1($x1){
		$this->x1=$x1;
	}
	function get_x1(){
		return ($this->x1);
	}
	function set_y1($y1){
		$this->y1=$y1;
	}
	function get_y1(){
		return ($this->y1);
	}
	function set_z1($z1){
		$this->z1=$z1;
	}
	function get_z1(){
		return ($this->z1);
	}
	function set_x2($x2){
		$this->x2=$x2;
	}
	function get_x2(){
		return ($this->x2);
	}
	function set_y2($y2){
		$this->y2=$y2;
	}
	function get_y2(){
		return ($this->y2);
	}
	function set_z2($z2){
		$this->z2=$z2;
	}
	function get_z2(){
		return ($this->z2);
	}
}
