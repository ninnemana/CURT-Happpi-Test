<?php
namespace happpi;
if(!class_exists('Helper')){
	include_once 'Helpers.php';
}
if(!class_exists('Configuration')){
	include_once 'Configuration.php';
}
class Customer {

	protected $config = null;
	protected $helper = null;

	private $customerID = 0;
	private $email = "";
	private $name = "";
	private $key = "";
	private $website = "";

	public function __construct($customerID = 0, $email = "", $name = "", $key = "", $website = ""){
		$this->config = new Configuration;
		$this->helper = new Helper;

		// try to grab the customerID from the config
		if($this->config->getCustomerID() != 0){
			$this->customerID = $this->config->getCustomerID();
		}else{
			$this->customerID = $customerID;
		}
		//try to grab the key from the config
		if($this->config->getKey() != ""){
			$this->key = $this->config->getKey();
		}else{
			$this->key = $key;
		}

		$this->email = $email;
		$this->name = $name;
		$this->website = $website;
	}

	// Getters
	public function getCustomerID(){
		return $this->customerID;
	}
	public function getEmail(){
		return $this->email;
	}
	public function getName(){
		return $this->name;
	}
	public function getKey(){
		return $this->key;
	}
	public function getWebsite(){
		return $this->website;
	}
	// end of getters

	//setters
	public function setCustomerID($customerID){
		if($customerID != $this->customerID){
			$this->customerID = $customerID;
		}
	}

	public function setEmail($email){
		if($email != $this->email){
			$this->email = $email;
		}
	}

	public function setName($name){
		if($name != $this->name){
			$this->name = $name;
		}
	}

	public function setKey($key){
		if($key != $this->key){
			$this->key = $key;
		}
	}

	public function setWebsite($website){
		if($website != $this->website){
			$this->website = $website;
		}
	}
	// end of setters

	public function getCustomer(){
		if($this->getEmail() != ""){
			$url = $this->config->getDomain() . "GetCustomer";
			$fields = array(
				'customerID'=>urlencode($this->config->getCustomerID()),
				'email'=>urlencode($this->getEmail()),
				'dataType'=>urlencode($this->config->getDataType())
				);
			// curlPOST is important as the API only returns via POST for this method
			$resp = $this->helper->curlPOST($url, $fields);
			return $this->castToCustomer(json_decode($resp));
		}
	}

	public function setCustomerPart($partID = 0, $customerPartID = 0){
		if($this->getKey() !=""){
			$url = $this->config->getDomain() . "SetCustomerPart";
			$fields = array(
				'customerID'=>urlencode($this->config->getCustomerID()),
				'key'=>urlencode($this->getKey()),
				'partID'=>urlencode($partID),
				'customerPartID'=>urlencode($customerPartID),
				'dataType'=>urlencode($this->config->getDataType())
				);
			// curlPOST is important as the API only returns via POST for this method
			$resp = $this->helper->curlPOST($url, $fields);
			$sPart = new SimplePart();
			$sPart = $sPart->castToSimplePart(json_decode($resp));
			return $sPart;
		}
	} // end of setCustomerPart

	public function setCustomerPartAndPrice($simplePricing = null){
		$spOld = new SimplePricing();
		if($simplePricing != null){		
			$spOld = $simplePricing;
		}
		if($this->getKey() !=""){
			$url = $this->config->getDomain() . "SetCustomerPartandPrice";
			$fields = array(
				'customerID'=>urlencode($this->config->getCustomerID()),
				'key'=>urlencode($this->getKey()),
				'partID'=>urlencode($spOld->getPartID()),
				'customerPartID'=>urlencode($spOld->getCustPartID()),
				'price'=>urlencode($spOld->getPrice()),
				'isSale'=>urlencode($spOld->getIsSale()),
				'sale_start'=>urlencode($spOld->getSale_start()),
				'sale_end'=>urlencode($spOld->getSale_end()),
				'dataType'=>urlencode($this->config->getDataType())
				);
			// curlPOST is important as the API only returns via POST for this method
			$resp = $this->helper->curlPOST($url, $fields);
			$PaP = new PartAndPrice();
			$sP = new SimplePricing();
			$sPart = new SimplePart();
			$resp = json_decode($resp);
			$partObj = $sPart->castToSimplePart($resp[0]);
			$priceObj = $sP->castToSimplePricing($resp[1]);
			$PaP = $PaP->castToPartAndPrice($priceObj, $partObj);
			return $PaP;
		} // end if
	} // end of setCustomerPart

	public function getPricing(){	
		if($this->getKey() !=""){
			$url = $this->config->getDomain() . "GetPricing";
			$fields = array(
				'customerID'=>urlencode($this->config->getCustomerID()),
				'key'=>urlencode($this->getKey()),
				'dataType'=>urlencode($this->config->getDataType())
				);
			// curlPOST is important as the API only returns via POST for this method
			$resp = $this->helper->curlPOST($url, $fields);
			$pricing_array = array();
			foreach (json_decode($resp) as $obj) {
				$sP = new SimplePricing();
				$sP = $sP->castToSimplePricing($obj);
				array_push($pricing_array, $sP); 
			}
			return $pricing_array;
		}
	} // end of get pricing

	public function setPrice($simplePricing = null){
		$sp = new SimplePricing();
		if($simplePricing != null){		
			$sp = $simplePricing;
		}
		if($this->getKey() !=""){
			$url = $this->config->getDomain() . "SetPrice";
			$fields = array(		
				'customerID'=>urlencode($this->config->getCustomerID()),
				'key'=>urlencode($this->getKey()),
				'partID'=>urlencode($sp->getPartID()),
				'price'=>urlencode($sp->getPrice()),
				'isSale'=>urlencode($sp->getIsSale()),
				'sale_start'=>urlencode($sp->getSale_start()),
				'sale_end'=>urlencode($sp->getSale_end()),
				'dataType'=>urlencode($this->config->getDataType())
				);
			// curlPOST is important as the API only returns via POST for this method
			$resp = $this->helper->curlPOST($url, $fields);	
			$simpPrice = new SimplePricing();
			$simpPrice = $simpPrice->castToSimplePricing(json_decode($resp));
			return $simpPrice;
		}
	}

	public function resetToList($partID = 0){
		if($this->getKey() !=""){
			$url = $this->config->getDomain() . "ResetToList";
			$fields = array(	
				'key'=>urlencode($this->getKey()),
				'customerID'=>urlencode($this->config->getCustomerID()),
				'partID'=>urlencode($partID),
				'dataType'=>urlencode($this->config->getDataType())
				);
			// curlPOST is important as the API only returns via POST for this method
			$resp = $this->helper->curlPOST($url, $fields);
			$simpPrice = new SimplePricing();
			$simpPrice = $simpPrice->castToSimplePricing(json_decode($resp));
			return $simpPrice;
		} // end if
	} // end of resetToList function

	// returns an error
	public function removeSale($simplePricing = null){
		$sp = new SimplePricing();
		if($simplePricing != null){		
			$sp = $simplePricing;
		}
		$partID =  $sp->getPartID();
		$price = $sp->getPrice();
		if($sp->getPartID() != 0){
			$url = $this->config->getDomain() . "RemoveSale";
			$fields = array(		
				'key'=>urlencode($this->getKey()),
				'customerID'=>urlencode($this->config->getCustomerID()),
				'partID'=>urlencode($partID),
				'price'=>urlencode($price),
				'dataType'=>urlencode($this->config->getDataType())
				);
			// curlPOST is important as the API only returns via POST for this method
			$resp = $this->helper->curlPOST($url, $fields);	
			return json_decode($resp);
		}
	}

	public function castToCustomer($obj){
		$c = new Customer();
		if(isset($obj->customerID)){		
			$c->setCustomerID($obj->customerID); 
		}
		if(isset($obj->email)){
			$c->setEmail($obj->email); 
		}
		if(isset($obj->name)){
			$c->setName($obj->name); 
		}
		if(isset($obj->key)){
			$c->setKey($obj->key); 
		}
		if(isset($obj->website)){
			$c->setWebsite($obj->website); 
		}
		return $c;
	}
} // end of Customer class

class SimplePricing {
	
	private $cust_id = 0;
	private $custPartID = 0;
	private $partID = 0;
	private $price = 0.00;
	private $isSale = 0;
	private $sale_start = "";
	private $sale_end = "";

	public function __construct($cust_id = 0, $custPartID = 0, $partID = 0, $price = 0.00, $isSale = 0, $sale_start = "", $sale_end = ""){
		$this->cust_id = $cust_id;
		$this->custPartID = $custPartID;
		$this->partID = $partID;
		$this->price = $price;
		$this->isSale = $isSale;
		$this->sale_start = $sale_start;
		$this->sale_end = $sale_end;
	}


	/**
	 * [getCust_id() description here]
	 *
	 * @return [type] [description]
	 */
	public function getCust_id()
	{
	    return $this->cust_id;
	}
	
	/**
	 * [setCust_id() description here]
	 *
	 * @param  [type] $cust_id [description]
	 * @return [class type]    $this
	 */
	public function setCust_id($newCust_id)
	{
	    $this->cust_id = $newCust_id;
	}


	/**
	 * [getCustPartID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getCustPartID()
	{
	    return $this->custPartID;
	}
	
	/**
	 * [setCustPartID() description here]
	 *
	 * @param  [type] $custPartID [description]
	 */
	public function setCustPartID($newCustPartID)
	{
	    $this->custPartID = $newCustPartID;
	}


	/**
	 * [getPartID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getPartID()
	{
	    return $this->partID;
	}
	
	/**
	 * [setPartID() description here]
	 *
	 * @param  [type] $partID [description]
	 */
	public function setPartID($newPartID)
	{
	    $this->partID = $newPartID;
	}


	/**
	 * [getPrice() description here]
	 *
	 * @return [type] [description]
	 */
	public function getPrice()
	{
	    return $this->price;
	}
	
	/**
	 * [setPrice() description here]
	 *
	 * @param  [type] $price [description]
	 */
	public function setPrice($newPrice)
	{
	    $this->price = $newPrice;
	}


	/**
	 * [getIsSale() description here]
	 *
	 * @return [type] [description]
	 */
	public function getIsSale()
	{
	    return $this->isSale;
	}
	
	/**
	 * [setIsSale() description here]
	 *
	 * @param  [type] $isSale [description]
	 */
	public function setIsSale($newIsSale)
	{
	    $this->isSale = $newIsSale;
	}


	/**
	 * [getSale_start() description here]
	 *
	 * @return [type] [description]
	 */
	public function getSale_start()
	{
	    return $this->sale_start;
	}
	
	/**
	 * [setSale_start() description here]
	 *
	 * @param  [type] $sale_start [description]
	 */
	public function setSale_start($newSale_start)
	{
	    $this->sale_start = $newSale_start;
	}


	/**
	 * [getSale_end() description here]
	 *
	 * @return [type] [description]
	 */
	public function getSale_end()
	{
	    return $this->sale_end;
	}
	
	/**
	 * [setSale_end() description here]
	 *
	 * @param  [type] $sale_end [description]
	 */
	public function setSale_end($newSale_end)
	{
	    $this->sale_end = $newSale_end;
	}

	// end of getters and setters

	public function castToSimplePricing($obj){
		$sP = new SimplePricing();
		if(isset($obj->cust_id)){
			$sP->setCust_id($obj->cust_id); 
		}
		if(isset($obj->custPartID)){
			$sP->setCustPartID($obj->custPartID); 
		}
		if(isset($obj->partID)){
			$sP->setPartID($obj->partID); 
		}
		if(isset($obj->price)){
			$sP->setPrice($obj->price); 
		}
		if(isset($obj->isSale)){
			$sP->setIsSale($obj->isSale); 
		}
		if(isset($obj->sale_start)){
			$sP->setSale_start($obj->sale_start); 
		}
		if(isset($obj->sale_end)){
			$sP->setSale_end($obj->sale_end); 
		}
		return $sP;
	}
} // end of SimplePricing class

class SimplePart {
	private $referenceID = 0;
	private $partID = 0;
	private $custPartID = 0;
	private $custID = 0;

	public function __construct($referenceID = 0, $partID = 0, $custPartID = 0, $custID = 0){
		$this->custID = $custID;
		$this->custPartID = $custPartID;
		$this->partID = $partID;
		$this->referenceID = $referenceID;
	}

	/**
	 * [getReferenceID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getReferenceID()
	{
	    return $this->referenceID;
	}
	
	/**
	 * [setReferenceID() description here]
	 *
	 * @param  [type] $referenceID [description]
	 */
	public function setReferenceID($newReferenceID)
	{
	    $this->referenceID = $newReferenceID;
	}


	/**
	 * [getPartID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getPartID()
	{
	    return $this->partID;
	}
	
	/**
	 * [setPartID() description here]
	 *
	 * @param  [type] $partID [description]
	 */
	public function setPartID($newPartID)
	{
	    $this->partID = $newPartID;
	}


	/**
	 * [getCustPartID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getCustPartID()
	{
	    return $this->custPartID;
	}
	
	/**
	 * [setCustPartID() description here]
	 *
	 * @param  [type] $custPartID [description]
	 */
	public function setCustPartID($newCustPartID)
	{
	    $this->custPartID = $newCustPartID;
	}


	/**
	 * [getCustID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getCustID()
	{
	    return $this->custID;
	}
	
	/**
	 * [setCustID() description here]
	 *
	 * @param  [type] $custID [description]
	 */
	public function setCustID($newCustID)
	{
	    $this->custID = $newCustID;
	}

	public function castToSimplePart($obj){
		$spart = new SimplePart();
		if(isset($obj->referenceID)){	
			$spart->setReferenceID($obj->referenceID); 
		}
		if(isset($obj->partID)){
			$spart->setPartID($obj->partID); 
		}
		if(isset($obj->custPartID)){
			$spart->setCustPartID($obj->custPartID); 
		}
		if(isset($obj->custID)){
			$spart->setCustID($obj->custID); 
		}
		return $spart;
	}
} // end of SimplePart class

class PartAndPrice {
	private $priceObj = null;
	private $partObj = null;

	public function __construct($priceObj = null, $partObj = null){
		$this->priceObj= $priceObj;
		$this->partObj = $partObj;
	}

	/**
	 * [getPriceObj() description here]
	 *
	 * @return [type] [description]
	 */
	public function getPriceObj()
	{
	    return $this->priceObj;
	}
	
	/**
	 * [setPriceObj() description here]
	 *
	 * @param  [type] $priceObj [description]
	 */
	public function setPriceObj($newPriceObj)
	{
	    $this->priceObj = $newPriceObj;
	}


	/**
	 * [getPartObj() description here]
	 *
	 * @return [type] [description]
	 */
	public function getPartObj()
	{
	    return $this->partObj;
	}
	
	/**
	 * [setPartObj() description here]
	 *
	 * @param  [type] $partObj [description]
	 */
	public function setPartObj($newPartObj)
	{
	    $this->partObj = $newPartObj;
	}

	public function castToPartAndPrice($priceObj, $partObj){
		$this->setPriceObj($priceObj);
		$this->setPartObj($partObj);
		$PaP = new PartAndPrice();
		if(isset($priceObj)){	
			$PaP->setPriceObj($priceObj);
		}
		if(isset($partObj)){	
			$PaP->setPartObj($partObj);
		}
		return $PaP;
	}
} // end of PartAndPrice class
?>