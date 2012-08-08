<?php
namespace happpi;
if(!class_exists('Helper')){
	include_once 'Helpers.php';
}
if(!class_exists('Configuration')){
	include_once 'Configuration.php';
}
class Vehicle {
	protected $config = null;
	protected $helper = null;

	// Vehicle Properties
	private $vehicleID = 0;
	private $mount = "";
	// new properties
	private $yearID = 0;
	private $makeID = 0;
	private $modelID = 0;
	private $styleID = 0;
	private $aaiaID = 0;
	//more Vehicle Properties
	private $year = 0;
	private $make = "";
	private $model = "";
	private $style = "";
	private $installTime = "";
	private $drilling = "";
	private $exposed = "";
	private $attributes = array();
	// keyvalue array of the two different types of mounts
	private $mountOptions = array("rear" => "Rear Mount", "front" => "Front Mount");

	public function __construct($mount = "", $year = 0, $make = "", $model = "", $style = ""){
		$this->mount = $mount;
		$this->year = $year;
		$this->make = $make;
		$this->model = $model;
		$this->style = $style;

		$this->config = new Configuration;
		$this->helper = new Helper;
	}

	public function __destruct(){
		
		// Handle garbage cleanup
	}

	/*** Getters/Setters ***/

	/*
	*	Retrieves the value of the mount property
	*
	*	@returns: string
	*/
	public function getMount(){
		return $this->mount;
	}

	/*
	*	Sets the value of the mount property, unless the mount
	*	property already contains this value
	*/
	public function setMount($mount = ""){
		if($mount != $this->mount){
			$this->mount = urlencode($mount);
		}
	}


	/**
	 * [getYearID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getYearID()
	{
	    return $this->yearID;
	}
	
	/**
	 * [setYearID() description here]
	 *
	 * @param  [type] $yearID [description]
	 */
	public function setYearID($newYearID)
	{
	    $this->yearID = $newYearID;
	}


	/**
	 * [getMakeID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getMakeID()
	{
	    return $this->makeID;
	}
	
	/**
	 * [setMakeID() description here]
	 *
	 * @param  [type] $makeID [description]
	 */
	public function setMakeID($newMakeID)
	{
	    $this->makeID = $newMakeID;
	}


	/**
	 * [getModelID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getModelID()
	{
	    return $this->modelID;
	}
	
	/**
	 * [setModelID() description here]
	 *
	 * @param  [type] $modelID [description]
	 */
	public function setModelID($newModelID)
	{
	    $this->modelID = $newModelID;
	}


	/**
	 * [getStyleID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getStyleID()
	{
	    return $this->styleID;
	}
	
	/**
	 * [setStyleID() description here]
	 *
	 * @param  [type] $styleID [description]
	 */
	public function setStyleID($newStyleID)
	{
	    $this->styleID = $newStyleID;
	}


	/**
	 * [getAaiaID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getAaiaID()
	{
	    return $this->aaiaID;
	}
	
	/**
	 * [setAaiaID() description here]
	 *
	 * @param  [type] $aaiaID [description]
	 */
	public function setAaiaID($newAaiaID)
	{
	    $this->aaiaID = $newAaiaID;
	}

	/*
	*	Retrieves the value of the year property
	*
	*	@returns: int
	*/
	public function getYear(){
		return $this->year;
	}

	/*
	*	Sets the value of the year property, unless the year
	*	property already contains this value
	*/
	public function setYear($year = 0){
		if($year != $this->year){
			$this->year = $year;
		}
	}

	/*
	*	Retrieves the value of the make property
	*
	*	@returns: string
	*/
	public function getMake(){
		return $this->make;
	}

	/*
	*	Sets the value of the make property, unless the make
	*	property already contains this value
	*/
	public function setMake($make = ""){
		if($make != $this->make){
			$this->make = $make;
		}
	}

	/*
	*	Retrieves the value of the model property
	*
	*	@returns: string
	*/
	public function getModel(){
		return $this->model;
	}

	/*
	*	Sets the value of the model property, unless the model
	*	property already contains this value
	*/
	public function setModel($model = ""){
		if($model != $this->model){
			$this->model = $model;
		}
	}

	/*
	*	Retrieves the value of the style property
	*
	*	@returns: string
	*/
	public function getStyle(){
		return $this->style;
	}

	/*
	*	Sets the value of the style property, unless the style
	*	property already contains this value
	*/
	public function setStyle($style = ""){
		if($style != $this->style){
			$this->style = $style;
		}
	}

	public function getVehicleID(){
		return $this->vehicleID;
	}

	public function setVehicleID($vehicleID = 0){
		if($vehicleID != $this->vehicleID){
			$this->vehicleID = $vehicleID;
		}
	}

	public function getMounts(){
		return $this->mountOptions;
	}

	//end of getters and setters

	public function getYears(){
		$request = $this->config->getDomain() . "GetYear?mount=" . $this->getMount() . "&dataType=" . $this->config->getDataType();
		$response = $this->helper->curlGet($request);
		return json_decode($response);
	}

	public function getMakes(){
		$request = $this->config->getDomain() . "GetMake?mount=" . $this->mount;
		$request .= "&year=" . $this->year;
		$request .= "&dataType=" . $this->config->getDataType();
		$resp = $this->helper->curlGet($request);
		return json_decode($resp);
	}

	public function getModels(){
		$request = $this->config->getDomain() . "GetModel?mount=" . $this->mount;
		$request .= "&year=" . $this->year;
		$request .= "&make=" . urlencode($this->make);
		$request .= "&dataType=" . $this->config->getDataType();
		$resp = $this->helper->curlGet($request);
		return json_decode($resp);
	}

	public function getStyles(){
		$request = $this->config->getDomain() . "GetStyle?mount=" . $this->mount;
		$request .= "&year=" . $this->year;
		$request .= "&make=" . urlencode($this->make);
		$request .= "&model=" . urlencode($this->model);
		$request .= "&dataType=" . $this->config->getDataType();
		echo $request;
		$resp = $this->helper->curlGet($request);
		return json_decode($resp);
	}

	public function getVehicle(){
		$req = $this->config->getDomain() . "GetVehicle";
		$req .= "?year=" . $this->year;
		$req .= "&make=" . urlencode($this->make);
		$req .= "&model=" . urlencode($this->model);
		$req .= "&style=" . urlencode($this->style);
		$req .= "&dataType=" . $this->config->getDataType();
		$resp = $this->helper->curlGet($req);
		$obj_arr = json_decode($resp);
		$vehicle_arr = array();
		foreach ($obj_arr as $obj) {
			$v = $this->castToVehicle($obj);
		}
		return $v;
	}

	public function getPartVehicles($partID = 0){
		$req = $this->config->getDomain() . "GetPartVehicles";
		$req .= "?dataType=" . $this->config->getDataType();
		$req .= "&partID=" . $partID;
		$resp = $this->helper->curlGet($req);
		$vehicle_arr = array();
		foreach (json_decode($resp) as $obj) {
			$v = $this->castToVehicle($obj);
			array_push($vehicle_arr, $v);
		}
		return $vehicle_arr;
	}

	public function getParts(){
		$req = $this->config->getDomain() . "GetParts";
		$req .= "?year=" . $this->getYear();
		if($this->getVehicleID() != ""){
			$req .= "&vehicleID=" . $this->getVehicleID();
		}
		if($this->config->getCustomerID() != 0){
			$req .= "&cust_id=" . $this->config->getCustomerID();
		}
		$req .= "&make=" . urlencode($this->getMake());
		$req .= "&model=" . urlencode($this->getModel());
		$req .= "&style=" . urlencode($this->getStyle());
		$req .= "&dataType=" . urlencode($this->config->getDataType());
		$resp = $this->helper->curlGet($req);
		$parts_arr = array();
		foreach (json_decode($resp) as $obj) {
			$part = new Part();
			$p = $part->castToPart($obj);
			array_push($parts_arr, $p);
		}
		return $parts_arr;
	}

	public function getConnector(){
		$req = $this->config->getDomain() . "GetConnector";
		if($this->getVehicleID()!= 0){
			$req .= "?vehicleID=" . $this->getVehicleID();
		}else{
			$req .= "?year=" . $this->year;
			$req .= "&make=" . urlencode($this->make);
			$req .= "&model=" . urlencode($this->model);
			$req .= "&style=" . urlencode($this->style);
		}

		$req .= "&dataType=" . $this->config->getDataType();
		$resp = $this->helper->curlGet($req);
		$connector_arr = array();
		foreach (json_decode($resp) as $obj) {
			$part = new Part();
			$p = $part->castToPart($obj);
			array_push($connector_arr, $p);
		}
		return $connector_arr;
	}

	public function castToVehicle($obj){
		$v = new Vehicle();
		if(isset($obj->mount)){
			$v->setMount($obj->mount); 
		}
		if(isset($obj->yearID)){
			$v->setYearID($obj->yearID);
		}
		if(isset($obj->makeID)){
			$v->setMakeID($obj->makeID);
		}
		if(isset($obj->modelID)){
			$v->setModelID($obj->modelID);
		}
		if(isset($obj->styleID)){
			$v->setStyleID($obj->styleID);
		}
		if(isset($obj->aaiaID)){
			$v->setAaiaID($obj->aaiaID);
		}
		if(isset($obj->year)){
			$v->setYear($obj->year); 
		}
		if(isset($obj->make)){
			$v->setMake($obj->make); 
		}
		if(isset($obj->model)){
			$v->setModel($obj->model); 
		}
		if(isset($obj->style)){
			$v->setStyle($obj->style); 
		}
		if(isset($obj->vehicleID)){
			$v->vehicleID = $obj->vehicleID;
		}
		if(isset($obj->installTime)){
			$v->installTime = $obj->installTime; 
		}
		if(isset($obj->drilling)){
			$v->drilling = $obj->drilling; 
		}
		if(isset($obj->exposed)){
			$v->exposed = $obj->exposed; 
		}
		if(isset($obj->attributes)){
			$v->attributes = $obj->attributes; 
		}
		return $v;
	}// end castToVehicle function
} // end of vehicle class
?>