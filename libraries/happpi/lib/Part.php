<?php
namespace happpi;
if(!class_exists('Helper')){
	include_once 'helpers.php';
}
if(!class_exists('Configuration')){
	include_once 'Configuration.php';
}

class Part{
	protected $config = null;
	protected $helper = null;

	private $partID = 0;
	private $custPartID = 0;
	private $status = 0;
	private $dateModified = "";
	private $dateAdded = "";
	private $shortDesc = "";
	private $oldPartNumber = "";
	private $listPrice = "";
	private $attributes = array(); // Array KeyValue Objects
	private $vehicleAttributes = array(); // Array KeyValue Objects
	private $content = array(); // Array KeyValue Objects
	private $pricing = array(); // Array KeyValue Objects
	private $reviews = array(); // Array Review objects
	private $images = array(); // Array Image objects
	private $videos = array(); // Array Video objects
	private $pClass = "";
	private $relatedCount = 0;
	private $installTime = 0;
	private $averageReview = 0;
	private $drilling = "";
	private $exposed = "";
	private $vehicleID = 0;
	private $priceCode = 0;

	public function __construct($partID = 0, $custPartID = 0, $status = 0){
		$this->partID = $partID;
		$this->custPartID = $custPartID;
		$this->status = $status;
		$this->config = new Configuration;
		$this->helper = new Helper;
	}

	public function __destruct(){
		// Handle garbage cleanup
	}

	// Getters and Setters
	public function setPartID($partID){
		if($partID != $this->partID){
			$this->partID = $partID;
		}
	}

	public function getPartID(){

		return $this->partID;
	}

	public function setCustPartID($custPartID){
		if($custPartID != $this->custPartID){
			$this->custPartID = $custPartID;
		}
	}

	public function getCustPartID(){

		return $this->custPartID;
	}

	public function setStatus($status){
		if($status != $this->status){
			$this->status = $status;
		}
	}

	public function getStatus(){

		return $this->status;
	}

	public function getDateModified(){

		return $this->dateModified;
	}


	public function getDateAdded(){

		return $this->dateAdded;
	}

	public function getShortDesc(){

		return $this->shortDesc;
	}

	public function getOldPartNumber(){

		return $this->oldPartNumber;
	}

	public function getListPrice(){

		return $this->listPrice;
	}

	public function getAttributes(){

		return $this->attributes;
	}

	public function getVehicleAttributes(){

		return $this->vehicleAttributes;
	}

	public function getContent(){

		return $this->content;
	}

	public function getPricing(){

		return $this->pricing;
	}

	public function getReviews(){

		return $this->reviews;
	}

	public function getImages(){

		return $this->images;
	}

	public function getVideos(){

		return $this->videos;
	}

	public function getPClass(){

		return $this->pClass;
	}

	public function getRelatedCount(){

		return $this->getRelatedCount();
	}

	public function getInstallTime(){

		return $this->getInstallTime;
	}

	public function getAverageReview(){

		return $this->averageReview;
	}

	public function getDrilling(){

		return $this->drilling;
	}

	public function getExposed(){

		return $this->exposed;
	}

	public function getVehicleID(){

		return $this->vehicleID;
	}

	public function getPriceCode(){

		return $this->priceCode;
	}

	// end of getters and setters

	public function getRelatedParts() {
		if($this->getPartID() > 0) {
			$req = $this->config->getDomain() . "GetRelatedParts";
			$req .= "?partID=" . $this->getPartID();
			if($this->config->getCustomerID() > 0){$req .= "&cust_id=" . $this->config->getCustomerID();}
			if($this->config->isIntegrated() == true){$req .= "&integrated=true";}
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req); // raw response
			$relatedParts_array = array(); // instaniate array of parts that are related	
			// step through the json and cast json objects to php objects
			foreach (json_decode($resp) as $obj) { 
				$p = $this->castToPart($obj); // cast json part objects to php part objects
				array_push($relatedParts_array, $p); // push part objects into relatedParts Array
			}
			return $relatedParts_array;
		}// end if
	}

	public function getPart(){
		if($this->getPartID() > 0){
			$req = $this->config->getDomain() . "GetPart";
			$req .= "?partID=" . $this->getPartID();
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			return $this->castToPart(json_decode($resp));
		}
	}

	public function getAllParts($status = ""){
		if($status != ""){
			$req = $this->config->getDomain() . "GetAllParts";
			$req .= "?status=" . $status;
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			$allParts_array = array(); // instaniate array of parts	
			// step through the json and cast json objects to php objects
			foreach (json_decode($resp) as $obj) { 
				$p = $this->castToPart($obj); // cast json part objects to php part objects
				array_push($allParts_array, $p); // push part objects into allParts Array
			}
			return $allParts_array;
		}
	}

	public function getAllPartID(){
		$req = $this->config->getDomain() . "GetAllPartID";
		$req .= "?dataType=" . $this->config->getDataType();
		$resp = $this->helper->curlGet($req);
		$allPartID_array = array();
		foreach (json_decode($resp) as $obj){
			array_push($allPartID_array, $obj);
		}
		return $allPartID_array;
	}

	public function getCategoryParts($catID = 0, $page = 0, $perpage = 0){
		$parts_array = array();	
		if($catID > 0 && $perpage > 0){
			$req = $this->config->getDomain() . "GetCategoryParts";
			$req .= "?catID=" . $catID;
			$req .= "&page=" . $page;
			$req .= "&perpage=" . $perpage;
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			foreach (json_decode($resp) as $obj) { 
				$p = $this->castToPart($obj); 
				array_push($parts_array, $p); 
			}
		}
		return $parts_array;
	}

	public function getCategoryPartsByName($catName = "", $page = 0, $perpage = 0){
		$parts_array = array();
		if($catName != "" && $perpage > 0){
			$req = $this->config->getDomain() . "GetCategoryPartsByName";
			$req .= "?catName=" . $catName;
			$req .= "&page=" . $page;
			$req .= "&perpage=" . $perpage;
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			foreach (json_decode($resp) as $obj) { 
				$p = $this->castToPart($obj); 
				array_push($parts_array, $p); 
			}// end foreach
		}//end if
		return $parts_array;
	}

	public function getCategoryPartsCount($catID = 0, $status = "800,900"){
		if($catID > 0){
			$req = $this->config->getDomain() . "GetCategoryPartsCount";
			$req .= "?catID=" . $catID;
			$req .= "&cust_id=" . $this->config->getCustomerID();
			$req .= "&status=" . $status;
			if($this->config->isIntegrated()){$req .= "&integrated=true";}
			else{$req .= "&integrated=false";}
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			return $resp;
		}
	}

	public function getPartBreadCrumbs($catID = 0){
		$req = $this->config->getDomain() . "GetPartBreadCrumbs";
		if($this->getPartID() != 0){
			$req .= "?partID=" .$this->getPartID();
			$req .= "&catID=" . $catID;
			$req .= "&dataType=" . $this->config->getDataType();
		}
		$resp = $this->helper->curlGet($req);
		$categories_array = array(); 
		foreach(json_decode($resp) as $obj){ 
			$c = new Category();
			$c = $c->castToCategory($obj);
			array_push($categories_array, $c); 
		}
		return array_reverse($categories_array);
	}

	public function getInstallSheet(){
		if($this->getPartID() > 0){
			$req = $this->config->getDomain() . "GetInstallSheet";
			$req .= "?partID=" . $this->getPartID();
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			return json_decode($resp)->content;
		}
	}

	public function getLatestParts($count = 0){
		$req = $this->config->getDomain() . "GetLatestParts";
		$req .= "?count=" . $count;
		$req .= "&dataType=" . $this->config->getDataType();
		$resp = $this->helper->curlGet($req);
		$Parts_array = array(); 
		foreach (json_decode($resp) as $obj) { 
			$p = $this->castToPart($obj); 
			array_push($Parts_array, $p); 
		}
		return $Parts_array;
	}

	public function getPartCategories(){
		if($this->getPartID() > 0) {
			$req = $this->config->getDomain() . "GetPartCategories";
			$req .= "?partID=" . $this->getPartID();
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			$categories_array = array(); 
			foreach (json_decode($resp) as $obj) { 
				$c = new APICategory();
				$c = $c->castToAPICategory($obj);
				array_push($categories_array, $c); 
			}
			return $categories_array;
		}
	}

	public function getPartImage($index = "a", $size = "Grande"){
		if($this->getPartID() > 0) {
			$req = $this->config->getDomain() . "GetPartImage";
			$req .= "?partID=" . $this->getPartID();
			$req .= "&index=" . $index;
			$req .= "&size=" . $size;
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			return $resp;
		}
	}

	public function getPartImages(){
		if($this->getPartID() > 0){
			$req = $this->config->getDomain() . "GetPartImages";
			$req .= "?partID=" . $this->getPartID();
			if($this->config->isIntegrated()){$req .= "&integrated=true";}
			else{$req .= "&integrated=false";}
			$req .= "&cust_id=" . $this->config->getCustomerID();
			$req .= "&dataType=XML";
			$resp = $this->helper->curlGet($req);
			$reader = new XMLReader();
			$reader->open($req);

			$images_array = array();
			$sort = "";
			while ($reader->read()) {
				$Image = new Image(); 
				if ($reader->nodeType == XMLREADER::ELEMENT && $reader->depth == 1){
						$sort = $reader->getAttribute("name");
				} // end of depth 1
				if ($reader->nodeType == XMLREADER::ELEMENT && $reader->depth == 2) {
					    $Image->setSize($reader->name);
					    $Image->setImageID($imageID = $reader->getAttribute("imageID"));
					    $Image->setPath($reader->getAttribute("path"));
					    $Image->setHeight($reader->getAttribute("height"));
					    $Image->setWidth($reader->getAttribute("width"));
					    $Image->setPartID($this->getPartID());
					    $Image->setSort($sort);
						array_push($images_array, $Image);
				} // end of depth 2
			} // end while
			$reader->close();
			return $images_array;
		}// end if
	}

	public function getPartImagesByIndex($index = ""){
		if($this->getPartID() > 0){
			$req = $this->config->getDomain() . "GetPartImagesByIndex";
			$req .= "?index=" . $index;
			$req .= "&cust_id=" . $this->config->getCustomerID();
			if($this->config->isIntegrated()){$req .= "&integrated=true";}
			else{$req .= "&integrated=false";}
			$req .= "&dataType=XML";
			$resp = $this->helper->curlGet($req);
			$reader = new XMLReader();
			$reader->open($req);
			$images_array = array();
			$imgPartID = 0;
			while ($reader->read()){
				$Image = new Image(); 
				if ($reader->nodeType == XMLREADER::ELEMENT && $reader->depth == 1){
						$imgPartID = $reader->getAttribute("partID");
				} // end of depth 1
				if ($reader->nodeType == XMLREADER::ELEMENT && $reader->depth == 2) {
					    $Image->setSize($reader->name);
					    $Image->setImageID($imageID = $reader->getAttribute("imageID"));
					    $Image->setPath($reader->getAttribute("path"));
					    $Image->setHeight($reader->getAttribute("height"));
					    $Image->setWidth($reader->getAttribute("width"));
					    $Image->setPartID($imgPartID);
					    $Image->setSort($index);
						array_push($images_array, $Image);
				} // end of depth 2
				
			} // end while
			$reader->close();
			return $images_array;
		} // end if
	}

	public function getDefaultPartImages(){
		if($this->getPartID() > 0){
			$req = $this->config->getDomain() . "GetDefaultPartImages";
			$req .= "?cust_id=" . $this->config->getCustomerID();
			if($this->config->isIntegrated()){$req .= "&integrated=true";}
			else{$req .= "&integrated=false";}
			$req .= "&dataType=XML";
			$resp = $this->helper->curlGet($req);
			$reader = new XMLReader();
			$reader->open($req);
			$images_array = array();
			$imgPartID = 0;
			while ($reader->read()){
				$Image = new Image(); 
				if ($reader->nodeType == XMLREADER::ELEMENT && $reader->depth == 1){
						$imgPartID = $reader->getAttribute("partID");
				} // end of depth 1
				if ($reader->nodeType == XMLREADER::ELEMENT && $reader->depth == 2) {
					    $Image->setSize($reader->name);
					    $Image->setImageID($imageID = $reader->getAttribute("imageID"));
					    $Image->setPath($reader->getAttribute("path"));
					    $Image->setHeight($reader->getAttribute("height"));
					    $Image->setWidth($reader->getAttribute("width"));
					    $Image->setPartID($imgPartID);
					    $Image->setSort("a");
						array_push($images_array, $Image);
				} // end of depth 2	
			} // end while
			$reader->close();
			return $images_array;
		} // end if
	}

	public function getPartsByDateModified($date = ""){
		if($date !=""){
			$req = $this->config->getDomain() . "GetPartsByDateModified";
			$req .= "?date=" . $date;
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			$Parts_array = array(); 
			foreach (json_decode($resp) as $obj) { 
				$p = $this->castToPart($obj); 
				array_push($Parts_array, $p); 
			} // end foreach
			return $Parts_array;
		}// end if
	}

	public function getPartsByList($partList = ""){
		if($partList != ""){
			$req = $this->config->getDomain() . "GetPartsByList";
			$req .= "?partlist=" . $partList;
			if($this->config->isIntegrated()){$req .= "&integrated=true";}
			else{$req .= "&integrated=false";}
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			$Parts_array = array(); 
			foreach (json_decode($resp) as $obj) { 
				$p = $this->castToPart($obj); 
				array_push($Parts_array, $p); 
			}
			return $Parts_array;
		} // end if
	}

	public function getSPGridData(){
		if($this->getPartID() > 0){
			$req = $this->config->getDomain() . "GetSPGridData";
			$req .= "?partID=" . $this->getPartID();
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			$spGridData = new SPGridData();
			return  $spGridData->castToSPGridData(json_decode($resp));
		} // end if
	}

	public function submitReview($rating = 5, $subject ="", $review_text="", $name = "", $email = ""){
		if($subject != "" && $review_text != "" && $this->config->getCustomerID() > 0){
			$req = $this->config->getDomain() . "SubmitReview";
			$req .= "?partID=" . $this->getPartID();
			$req .= "&cust_id=" . $this->config->getCustomerID();
			$req .= "&name=" . $name;
			$req .= "&email=" . $email;
			$req .= "&rating=" . $rating;
			$req .= "&subject=" . $subject;
			$req .= "&review_text=" . $review_text;
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			return $resp;
		} // end if
	}

	public function getReviewsByPart($page = 1, $perpage = 10){		
		if($this->getPartID() != 0){
			$req = $this->config->getDomain() . "GetReviewsByPart";
			$req .= "?partID=" . $this->getPartID();
			$req .= "&page=" . $page;
			$req .= "&perpage=" . $perpage;
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			$reviews_array = array(); 
			foreach (json_decode($resp) as $obj) { 
				$r = new Review();
				$r = $r->castToReview($obj);
				array_push($reviews_array, $r); 
			}
			return $reviews_array;	
		} // end if
	}

	public function castToPart($obj){
		$p = new Part();
		if(isset($obj->partID)){
			$p->partID = $obj->partID;
		}
		if(isset($obj->custPartID)){
			$p->custPartID = $obj->custPartID;
		}
		if(isset($obj->status)){
			$p->status = $obj->status;
		}
		if(isset($obj->dateModified)){
			$p->dateModified = $obj->dateModified;
		}
		if(isset($obj->dateAdded)){
			$p->dateAdded = $obj->dateAdded;
		}
		if(isset($obj->shortDesc)){
			$p->shortDesc = $obj->shortDesc;
		}
		if(isset($obj->oldPartNumber)){
			$p->oldPartNumber = $obj->oldPartNumber;
		}
		if(isset($obj->listPrice)){
			$p->listPrice = $obj->listPrice;
		}
		if(isset($obj->attributes)){
			$attr_array = array();
			foreach($obj->attributes as $attr){
				$kv = new KeyValue();
				$kv = $kv->castToKeyValue($attr);
				array_push($attr_array, $kv);
			}
			$p->attributes = $attr_array;
		}
		if(isset($obj->vehicleAttributes)){
			$p->vehicleAttributes = $obj->vehicleAttributes;
			$vAttr_array = array();
			foreach($obj->vehicleAttributes as $vAttr){
				$kv = new KeyValue();
				$kv = $kv->castToKeyValue($vAttr);
				array_push($vAttr_array, $kv);
			}
			$p->vehicleAttributes = $vAttr_array;
		}
		if(isset($obj->content)){
			$content_array = array();
			foreach($obj->content as $cont){
				$kv = new KeyValue();
				$kv = $kv->castToKeyValue($cont);
				array_push($content_array, $kv);
			}
			$p->content = $content_array;
		}
		if(isset($obj->pricing)){
			$p->pricing = $obj->pricing;
			$pricing_array = array();
			foreach($obj->pricing as $pricing){
				$kv = new KeyValue();
				$kv = $kv->castToKeyValue($pricing);
				array_push($pricing_array, $kv);
			}
			$p->pricing = $pricing_array;
		}
		if(isset($obj->reviews)){
			$review_array = array();
			foreach($obj->reviews as $review){
				$r = new Review();
				$r = $r->castToReview($review);
				array_push($review_array, $r); 
			}
			$p->reviews = $review_array;
		}
		if(isset($obj->images)){
			$images_array = array();
			foreach($obj->images as $image){
				$i = new Image();
				$i = $i->castToImage($image);
				array_push($images_array, $i); 
			}
			$p->images = $images_array;
		}
		if(isset($obj->videos)){
			$videos_array = array();
			foreach($obj->videos as $video){
				$v = new Video();
				$v = $v->castToVideo($video);
				array_push($videos_array, $v); 
			}
			$p->videos = $videos_array;
		}
		if(isset($obj->pClass)){
			$p->pClass = $obj->pClass;
		}
		if(isset($obj->relatedCount)){
			$p->relatedCount = $obj->relatedCount;
		}
		if(isset($obj->installTime)){
			$p->installTime = $obj->installTime;
		}
		if(isset($obj->averageReview)){
			$p->averageReview = $obj->averageReview;
		}
		if(isset($obj->drilling)){
			$p->drilling = $obj->drilling;
		}
		if(isset($obj->exposed)){
			$p->exposed = $obj->exposed;
		}
		if(isset($obj->vehicleID)){
			$p->vehicleID = $obj->vehicleID;
		}
		if(isset($obj->priceCode)){
			$p->priceCode = $obj->priceCode;
		}
		return $p;
	}
} // end of part class

class SPGridData{
	private $upc = "";
	private $weight = "";
	private $jobber = 0.00;
	private $map = 0.00;


	public function __construct($upc = "", $weight = "", $jobber = 0.00, $map = 0.00 ){
		$this->upc = $upc;
		$this->weight = $weight;
		$this->jobber = $jobber;
		$this->map = $map;
	}

	// getters and setters

	/**
	 * [getUpc() description here]
	 *
	 * @return [type] [description]
	 */
	public function getUpc()
	{
	    return $this->upc;
	}
	
	/**
	 * [setUpc() description here]
	 *
	 * @param  [type] $upc [description]
	 */
	public function setUpc($newUpc)
	{
	    $this->upc = $newUpc;
	}

	/**
	 * [getWeight() description here]
	 *
	 * @return [type] [description]
	 */
	public function getWeight()
	{
	    return $this->weight;
	}
	
	/**
	 * [setWeight() description here]
	 *
	 * @param  [type] $weight [description]
	 */
	public function setWeight($newWeight)
	{
	    $this->weight = $newWeight;
	}

	/**
	 * [getJobber() description here]
	 *
	 * @return [type] [description]
	 */
	public function getJobber()
	{
	    return $this->jobber;
	}
	
	/**
	 * [setJobber() description here]
	 *
	 * @param  [type] $jobber [description]
	 */
	public function setJobber($newJobber)
	{
	    $this->jobber = $newJobber;
	}

	/**
	 * [getMap() description here]
	 *
	 * @return [type] [description]
	 */
	public function getMap()
	{
	    return $this->map;
	}
	
	/**
	 * [setMap() description here]
	 *
	 * @param  [type] $map [description]
	 */
	public function setMap($newMap)
	{
	    $this->map = $newMap;
	}
	// end of getters and setters

	public function castToSPGridData($obj){
		$spgd = new SPGridData();
		if(isset($obj->upc)){
			$spgd->setUpc($obj->upc); 
		}
		if(isset($obj->weight)){
			$spgd->setWeight($obj->weight); 
		}
		if(isset($obj->jobber)){
			$spgd->setJobber($obj->jobber); 
		}
		if(isset($obj->map)){
			$spgd->setMap($obj->map); 
		}
		return $spgd;
	}
} // end of class

class Review{

	private $reviewID = 0;
	private $partID = 0;
	private $rating = 0;
	private $subject = "";
	private $review_text = "";
	private $name = "";
	private $email = "";
	private $createdDate = "";

	public function __construct($reviewID = 0, $partID = 0, $rating = 0, $subject = "", $review_text = "", $name = "", $email = "", $createDate = ""){
		
		$this->reviewID = $reviewID;
		$this->partID = $partID;
		$this->rating = $rating;
		$this->subject = $subject;
		$this->review_text = $review_text;
		$this->name = $name;
		$this->email = $email;
		$this->createDate = $createDate;
	}

	// getters and setters

	/**
	 * [getReviewID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getReviewID()
	{
	    return $this->reviewID;
	}
	
	/**
	 * [setReviewID() description here]
	 *
	 * @param  [type] $reviewID [description]
	 */
	public function setReviewID($newReviewID)
	{
	    $this->reviewID = $newReviewID;
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
	 * [getRating() description here]
	 *
	 * @return [type] [description]
	 */
	public function getRating()
	{
	    return $this->rating;
	}
	
	/**
	 * [setRating() description here]
	 *
	 * @param  [type] $rating [description]
	 */
	public function setRating($newRating)
	{
	    $this->rating = $newRating;
	}

	/**
	 * [getSubject() description here]
	 *
	 * @return [type] [description]
	 */
	public function getSubject()
	{
	    return $this->subject;
	}
	
	/**
	 * [setSubject() description here]
	 *
	 * @param  [type] $subject [description]
	 */
	public function setSubject($newSubject)
	{
	    $this->subject = $newSubject;
	}

	/**
	 * [getReview_text() description here]
	 *
	 * @return [type] [description]
	 */
	public function getReview_text()
	{
	    return $this->review_text;
	}
	
	/**
	 * [setReview_text() description here]
	 *
	 * @param  [type] $review_text [description]
	 */
	public function setReview_text($newReview_text)
	{
	    $this->review_text = $newReview_text;
	}

	/**
	 * [getName() description here]
	 *
	 * @return [type] [description]
	 */
	public function getName()
	{
	    return $this->name;
	}
	
	/**
	 * [setName() description here]
	 *
	 * @param  [type] $name [description]
	 */
	public function setName($newName)
	{
	    $this->name = $newName;
	}

	/**
	 * [getEmail() description here]
	 *
	 * @return [type] [description]
	 */
	public function getEmail()
	{
	    return $this->email;
	}
	
	/**
	 * [setEmail() description here]
	 *
	 * @param  [type] $email [description]
	 */
	public function setEmail($newEmail)
	{
	    $this->email = $newEmail;
	}

	/**
	 * [getCreateDate() description here]
	 *
	 * @return [type] [description]
	 */
	public function getCreateDate()
	{
	    return $this->createDate;
	}
	
	/**
	 * [setCreateDate() description here]
	 *
	 * @param  [type] $createDate [description]
	 */
	public function setCreateDate($newCreateDate)
	{
	    $this->createDate = $newCreateDate;
	}

	// end of getters and setters

	public function castToReview($obj){
		$r = new Review();
		if(isset($obj->reviewID)){
			$r->setReviewID($obj->reviewID); 
		}
		if(isset($obj->partID)){
			$r->setPartID($obj->partID); 
		}
		if(isset($obj->rating)){
			$r->setRating($obj->rating); 
		}
		if(isset($obj->subject)){
			$r->setSubject($obj->subject); 
		}
		if(isset($obj->review_text)){
			$r->setReview_text($obj->review_text); 
		}
		if(isset($obj->name)){
			$r->setName($obj->name); 
		}
		if(isset($obj->email)){
			$r->setEmail($obj->email); 
		}
		if(isset($obj->createdDate)){
			$r->setCreateDate($obj->createdDate); 
		}
		return $r;
	}
} // end of class

class Image{

	private $imageID = 0;
	private $size = "";
	private $path = "";
	private $height = 0;
	private $width = 0;
	private $partID = 0;
	private $sort = "";


	public function __construct($imageID = 0, $size = "", $path = "", $height = 0, $width = 0, $partID = 0, $sort = ""){
		
		$this->imageID = $imageID;
		$this->size = $size;
		$this->path = $path;
		$this->height = $height;
		$this->width = $width;
		$this->partID = $partID;
		$this->sort = $sort;
	}

	/**
	 * [getImageID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getImageID()
	{
	    return $this->imageID;
	}
	
	/**
	 * [setImageID() description here]
	 *
	 * @param  [type] $imageID [description]
	 */
	public function setImageID($newImageID)
	{
	    $this->imageID = $newImageID;
	}

	/**
	 * [getSize() description here]
	 *
	 * @return [type] [description]
	 */
	public function getSize()
	{
	    return $this->size;
	}
	
	/**
	 * [setSize() description here]
	 *
	 * @param  [type] $size [description]
	 */
	public function setSize($newSize)
	{
	    $this->size = $newSize;
	}

	/**
	 * [getPath() description here]
	 *
	 * @return [type] [description]
	 */
	public function getPath()
	{
	    return $this->path;
	}
	
	/**
	 * [setPath() description here]
	 *
	 * @param  [type] $path [description]
	 */
	public function setPath($newPath)
	{
	    $this->path = $newPath;
	}

	/**
	 * [getHeight() description here]
	 *
	 * @return [type] [description]
	 */
	public function getHeight()
	{
	    return $this->height;
	}
	
	/**
	 * [setHeight() description here]
	 *
	 * @param  [type] $height [description]
	 */
	public function setHeight($newHeight)
	{
	    $this->height = $newHeight;
	}

	/**
	 * [getWidth() description here]
	 *
	 * @return [type] [description]
	 */
	public function getWidth()
	{
	    return $this->width;
	}
	
	/**
	 * [setWidth() description here]
	 *
	 * @param  [type] $width [description]
	 */
	public function setWidth($newWidth)
	{
	    $this->width = $newWidth;
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
	 * [getSort() description here]
	 *
	 * @return [type] [description]
	 */
	public function getSort()
	{
	    return $this->sort;
	}
	
	/**
	 * [setSort() description here]
	 *
	 * @param  [type] $sort [description]
	 */
	public function setSort($newSort)
	{
	    $this->sort = $newSort;
	}

	// end of getters and setters

	public function castToImage($obj){
		$i = new Image();
		if(isset($obj->imageID)){
			$i->setImageID($obj->imageID); 
		}
		if(isset($obj->size)){
			$i->setSize($obj->size); 
		}
		if(isset($obj->path)){
			$i->setPath($obj->path); 
		}
		if(isset($obj->height)){
			$i->setHeight($obj->height); 
		}
		if(isset($obj->width)){
			$i->setWidth($obj->width); 
		}
		if(isset($obj->partID)){
			$i->setPartID($obj->partID); 
		}
		if(isset($obj->sort)){
			$i->setSort($obj->sort); 
		}
		return $i;
	}
} // end of class

class Video{
	private $videoID = 0;
	private $youTubeVideoID = "";
	private $isPrimary = false;
	private $typeID = 0;
	private $type = "";
	private $typeicon = "";

	public function __construct($videoID = 0, $youTubeVideoID = "", $isPrimary = false, $typeID = 0, $type="", $typeicon = ""){
		$this->videoID = $videoID;
		$this->youTubeVideoID = $youTubeVideoID;
		$this->isPrimary = $isPrimary;
		$this->typeID = $typeID;
		$this->type = $type;
		$this->typeicon = $typeicon;
	}


	/**
	 * [getVideoID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getVideoID()
	{
	    return $this->videoID;
	}
	
	/**
	 * [setVideoID() description here]
	 *
	 * @param  [type] $videoID [description]
	 */
	public function setVideoID($newVideoID)
	{
	    $this->videoID = $newVideoID;
	}


	/**
	 * [getYouTubeVideoID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getYouTubeVideoID()
	{
	    return $this->youTubeVideoID;
	}
	
	/**
	 * [setYouTubeVideoID() description here]
	 *
	 * @param  [type] $youTubeVideoID [description]
	 */
	public function setYouTubeVideoID($newYouTubeVideoID)
	{
	    $this->youTubeVideoID = $newYouTubeVideoID;
	}


	/**
	 * [getIsPrimary() description here]
	 *
	 * @return [type] [description]
	 */
	public function getIsPrimary()
	{
	    return $this->isPrimary;
	}
	
	/**
	 * [setIsPrimary() description here]
	 *
	 * @param  [type] $isPrimary [description]
	 */
	public function setIsPrimary($newIsPrimary)
	{
	    $this->isPrimary = $newIsPrimary;
	}


	/**
	 * [getTypeID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getTypeID()
	{
	    return $this->typeID;
	}
	
	/**
	 * [setTypeID() description here]
	 *
	 * @param  [type] $typeID [description]
	 */
	public function setTypeID($newTypeID)
	{
	    $this->typeID = $newTypeID;
	}


	/**
	 * [getType() description here]
	 *
	 * @return [type] [description]
	 */
	public function getType()
	{
	    return $this->type;
	}
	
	/**
	 * [setType() description here]
	 *
	 * @param  [type] $type [description]
	 */
	public function setType($newType)
	{
	    $this->type = $newType;
	}


	/**
	 * [getTypeicon() description here]
	 *
	 * @return [type] [description]
	 */
	public function getTypeicon()
	{
	    return $this->typeicon;
	}
	
	/**
	 * [setTypeicon() description here]
	 *
	 * @param  [type] $typeicon [description]
	 */
	public function setTypeicon($newTypeicon)
	{
	    $this->typeicon = $newTypeicon;
	}

	public function castToVideo($obj){
		$v = new Video();
		if(isset($obj->videoID)){
			$v->setVideoID($obj->videoID); 
		}
		if(isset($obj->youTubeVideoID)){
			$v->setYouTubeVideoID($obj->youTubeVideoID); 
		}
		if(isset($obj->isPrimary)){
			$v->setIsPrimary($obj->isPrimary); 
		}
		if(isset($obj->typeID)){
			$v->setTypeID($obj->typeID); 
		}
		if(isset($obj->type)){
			$v->setType($obj->type); 
		}
		if(isset($obj->typeicon)){
			$v->setTypeicon($obj->typeicon); 
		}
		return $v;
	} // end of castToVideo
}// end of Video Class

class KeyValue{

	private $key;
	private $value;

	public function __construct($key = null, $value = null){
		if(isset($key)){
			$this->key = $key;
		}
		if(isset($value)){
			$this->value = $value;
		}
	}

	/**
	 * [getKey() description here]
	 *
	 * @return [type] [description]
	 */
	public function getKey()
	{
	    return $this->key;
	}
	
	/**
	 * [setKey() description here]
	 *
	 * @param  [type] $key [description]
	 */
	public function setKey($newKey)
	{
	    $this->key = $newKey;
	}


	/**
	 * [getValue() description here]
	 *
	 * @return [type] [description]
	 */
	public function getValue()
	{
	    return $this->value;
	}
	
	/**
	 * [setValue() description here]
	 *
	 * @param  [type] $value [description]
	 */
	public function setValue($newValue)
	{
	    $this->value = $newValue;
	}

	public function display(){ // just a handy function for displaying both the key and value
		return "<strong>" . $this->getKey() . ":</strong> " . $this->getValue();
	}

	public function castToKeyValue($obj){
		$kv = new KeyValue();
		if(isset($obj->key)){
			$kv->setKey($obj->key); 
		}
		if(isset($obj->value)){
			$kv->setValue($obj->value); 
		}
		return $kv;
	}
} // end of KeyValue class

?>