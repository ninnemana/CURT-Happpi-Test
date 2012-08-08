<?php
namespace happpi;
if(!class_exists('Helper')){
	include_once 'Helpers.php';
}
if(!class_exists('Configuration')){
	include_once 'Configuration.php';
}


class Category {

	protected $config = null;
	protected $helper = null;

	private $catID = 0;
	private $dateAdded = "";
	private $parentID = 0;
	private $catTitle = "";
	private $shortDesc = "";
	private $longDesc = "";
	private $image = "";
	private $isLifestyle = 0;
	private $codeID = 0;
	private $sort = 0;
	private $vehicleSpecific = false;
	private $Lifestyle_Trailers = array();
	private $ContentBridges = array();

	public function __construct($catID = 0, $dateAdded = "", $parentID = 0, $catTitle = "", $shortDesc = "", $longDesc = "", $image = "", $isLifestyle = 0, $codeID = 0, $sort = 0, $vehicleSpecific = false, $Lifestyle_Trailers = null, $ContentBridges = null){
		
		$this->catID = $catID;
		$this->dateAdded = $dateAdded;
		$this->parentID = $parentID;
		$this->catTitle = $catTitle;
		$this->shortDesc = $shortDesc;
		$this->longDesc = $longDesc;
		$this->image = $image;
		$this->isLifestyle = $isLifestyle;
		$this->codeID = $codeID;
		$this->sort = $sort;
		$this->vehicleSpecific = $vehicleSpecific;
		$this->Lifestyle_Trailers = $Lifestyle_Trailers;
		$this->ContentBridges = $ContentBridges;

		$this->config = new Configuration;
		$this->helper = new Helper;
	}

	/**
	 * [getDateAdded() description here]
	 *
	 * @return [type] [description]
	 */
	public function getDateAdded()
	{
	    return $this->dateAdded;
	}
	
	/**
	 * [setDateAdded() description here]
	 *
	 * @param  [type] $dateAdded [description]
	 */
	public function setDateAdded($newDateAdded)
	{
	    $this->dateAdded = $newDateAdded;
	}

	/**
	 * [getCatID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getCatID()
	{
	    return $this->catID;
	}
	
	/**
	 * [setCatID() description here]
	 *
	 * @param  [type] $catID [description]
	 */
	public function setCatID($newCatID)
	{
	    $this->catID = $newCatID;
	}

	/**
	 * [getParentID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getParentID()
	{
	    return $this->parentID;
	}
	
	/**
	 * [setParentID() description here]
	 *
	 * @param  [type] $parentID [description]
	 */
	public function setParentID($newParentID)
	{
	    $this->parentID = $newParentID;
	}


	/**
	 * [getCatTitle() description here]
	 *
	 * @return [type] [description]
	 */
	public function getCatTitle()
	{
	    return $this->catTitle;
	}
	
	/**
	 * [setCatTitle() description here]
	 *
	 * @param  [type] $catTitle [description]
	 */
	public function setCatTitle($newCatTitle)
	{
	    $this->catTitle = $newCatTitle;
	}

	/**
	 * [getShortDesc() description here]
	 *
	 * @return [type] [description]
	 */
	public function getShortDesc()
	{
	    return $this->shortDesc;
	}
	
	/**
	 * [setShortDesc() description here]
	 *
	 * @param  [type] $shortDesc [description]
	 */
	public function setShortDesc($newShortDesc)
	{
	    $this->shortDesc = $newShortDesc;
	}


	/**
	 * [getLongDesc() description here]
	 *
	 * @return [type] [description]
	 */
	public function getLongDesc()
	{
	    return $this->longDesc;
	}
	
	/**
	 * [setLongDesc() description here]
	 *
	 * @param  [type] $longDesc [description]
	 */
	public function setLongDesc($newLongDesc)
	{
	    $this->longDesc = $newLongDesc;
	}


	/**
	 * [getImage() description here]
	 *
	 * @return [type] [description]
	 */
	public function getImage()
	{
	    return $this->image;
	}
	
	/**
	 * [setImage() description here]
	 *
	 * @param  [type] $image [description]
	 */
	public function setImage($newImage)
	{
	    $this->image = $newImage;
	}

	/**
	 * [getIsLifestyle() description here]
	 *
	 * @return [type] [description]
	 */
	public function getIsLifestyle()
	{
	    return $this->isLifestyle;
	}
	
	/**
	 * [setIsLifestyle() description here]
	 *
	 * @param  [type] $isLifestyle [description]
	 */
	public function setIsLifestyle($newIsLifestyle)
	{
	    $this->isLifestyle = $newIsLifestyle;
	}


	/**
	 * [getCodeID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getCodeID()
	{
	    return $this->codeID;
	}
	
	/**
	 * [setCodeID() description here]
	 *
	 * @param  [type] $codeID [description]
	 */
	public function setCodeID($newCodeID)
	{
	    $this->codeID = $newCodeID;
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


	/**
	 * [getVehicleSpecific() description here]
	 *
	 * @return [type] [description]
	 */
	public function getVehicleSpecific()
	{
	    return $this->vehicleSpecific;
	}
	
	/**
	 * [setVehicleSpecific() description here]
	 *
	 * @param  [type] $vehicleSpecific [description]
	 */
	public function setVehicleSpecific($newVehicleSpecific)
	{
	    $this->vehicleSpecific = $newVehicleSpecific;
	}

	/**
	 * [getLifestyle_Trailers() description here]
	 *
	 * @return [type] [description]
	 */
	public function getLifestyle_Trailers()
	{
	    return $this->Lifestyle_Trailers;
	}
	
	/**
	 * [setLifestyle_Trailers() description here]
	 *
	 * @param  [type] $Lifestyle_Trailers [description]
	 */
	public function setLifestyle_Trailers($newLifestyle_Trailers)
	{
	    $this->Lifestyle_Trailers = $newLifestyle_Trailers;
	}


	/**
	 * [getContentBridges() description here]
	 *
	 * @return [type] [description]
	 */
	public function getContentBridges()
	{
	    return $this->ContentBridges;
	}
	
	/**
	 * [setContentBridges() description here]
	 *
	 * @param  [type] $ContentBridges [description]
	 */
	public function setContentBridges($newContentBridges)
	{
	    $this->ContentBridges = $newContentBridges;
	}

	// end of getters and setters

	public function getCategory(){
		if($this->getCatID() != 0){
			$req = $this->config->getDomain() . "GetCategory";
			$req .= "?catID=" . $this->getCatID();
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			$cat = new FullCategory();
			$cat = $cat->castToFullCategory(json_decode($resp));
			return $cat;
		}
	}

	public function getCategories(){
		if($this->getParentID() != 0){
			$req = $this->config->getDomain() . "GetCategories";
			$req .= "?parentID=" . $this->getParentID();
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			$categories_array = array(); 
			foreach (json_decode($resp) as $obj) { 
				$c = new APICategory();
				$c = $c->castToAPICategory($obj);
				array_push($categories_array, $c); 
			}
			return $categories_array;	
		} // end if
	}

	public function getLifestyle($lifestyleID = 0){
		if($lifestyleID != 0){
			$req = $this->config->getDomain() . "GetLifestyle";
			$req .= "?lifestyleid=" . $lifestyleID;
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			$cat = new APICategory();
			$cat = $cat->castToAPICategory(json_decode($resp));
			return $cat;
		}
	}

	public function getLifestyles(){
		$req = $this->config->getDomain() . "GetLifestyles";
		$req .= "?dataType=" . $this->config->getDataType();
		$resp = $this->helper->curlGet($req);
		$categories_array = array(); 
			foreach (json_decode($resp) as $obj) { 
				$c = new APICategory();
				$c = $c->castToAPICategory($obj);
				array_push($categories_array, $c); 
			}
		return $categories_array;
	}

	public function getCategoryAttributes(){
		if($this->getCatID() != 0){
			$req = $this->config->getDomain() . "GetCategoryAttributes";
			$req .= "?catID=" . $this->getCatID();
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			return json_decode($resp);
		}// end if
	}

	public function getCategoryBreadcrumbs(){
		if($this->getCatID() != 0){
			$req = $this->config->getDomain() . "GetCategoryBreadcrumbs";
			$req .= "?catID=" . $this->getCatID();
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			$categories_array = array(); 
			foreach(json_decode($resp) as $obj){ 
				$c = new Category();
				$c = $c->castToCategory($obj);
				array_push($categories_array, $c); 
			}

			return array_reverse($categories_array);
		} // end if
	}

	public function getCategoryByName($catName = ""){
		if($catName != ""){
			$req = $this->config->getDomain() . "GetCategoryByName";
			$req .= "?catName=" . $catName;
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			$cat = new FullCategory();
			$cat = $cat->castToFullCategory(json_decode($resp));
			return $cat;
		}
	}

	public function getParentCategories(){
		$req = $this->config->getDomain() . "GetParentCategories";
		$req .= "?dataType=" . $this->config->getDataType();
		$resp = $this->helper->curlGet($req);
		$categories_array = array(); 
		foreach(json_decode($resp) as $obj){ 
			$c = new Category();
			$c = $c->castToCategory($obj);
			array_push($categories_array, $c); 
		}
		return $categories_array;
	}

	public function castToCategory($obj){
	$c = new Category();
		if(isset($obj->catID)){
			$c->catID = $obj->catID;
		}
		if(isset($obj->dateAdded)){
			$c->dateAdded = $obj->dateAdded;
		}		
		if(isset($obj->parentID)){
			$c->parentID = $obj->parentID;
		}
		if(isset($obj->catTitle)){
			$c->catTitle = $obj->catTitle;
		}
		if(isset($obj->shortDesc)){
			$c->shortDesc = $obj->shortDesc;
		}
		if(isset($obj->longDesc)){
			$c->longDesc = $obj->longDesc;
		}
		if(isset($obj->image)){
			$c->image = $obj->image;
		}
		if(isset($obj->isLifestyle)){
			$c->isLifestyle = $obj->isLifestyle;
		}
		if(isset($obj->codeID)){
			$c->codeID = $obj->codeID;
		}
		if(isset($obj->sort)){
			$c->sort = $obj->sort;
		}
		if(isset($obj->vehicleSpecific)){
			$c->vehicleSpecific = $obj->vehicleSpecific;
		}
		if(isset($obj->Lifestyle_Trailers)){
			$c->Lifestyle_Trailers = $obj->Lifestyle_Trailers;
		}
		if(isset($obj->ContentBridges)){
			$ContentBridges_array = array();
			foreach($obj->ContentBridges as $ContentBridge){
				$cb = new ContentBridges();
				$cb = $cb->castToContentBridges($ContentBridge);
				array_push($ContentBridges_array, $cb); 
			}
			$c->ContentBridges = $ContentBridges_array;
		}														
		return $c;
	} 
} // end of category class

class ContentBridges {

	private $cBridgeID = 0;
	private $catID = 0;
	private $partID = 0;
	private $contentID = 0;
	private $Content = null;
	private $Part = 0;

	public function __construct($cBridgeID = 0, $catID = 0, $partID = 0, $contentID = 0, $Content = null, $Part = 0){		
		$this->cBridgeID = $cBridgeID;
		$this->catID = $catID;
		$this->partID = $partID;
		$this->contentID = $contentID;
		$this->Content = $Content;
		$this->Part = $Part;
	}


	/**
	 * [getCBridgeID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getCBridgeID()
	{
	    return $this->cBridgeID;
	}
	
	/**
	 * [setCBridgeID() description here]
	 *
	 * @param  [type] $cBridgeID [description]
	 */
	public function setCBridgeID($newCBridgeID)
	{
	    $this->cBridgeID = $newCBridgeID;
	}


	/**
	 * [getCatID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getCatID()
	{
	    return $this->catID;
	}
	
	/**
	 * [setCatID() description here]
	 *
	 * @param  [type] $catID [description]
	 */
	public function setCatID($newCatID)
	{
	    $this->catID = $newCatID;
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
	 * [getContentID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getContentID()
	{
	    return $this->contentID;
	}
	
	/**
	 * [setContentID() description here]
	 *
	 * @param  [type] $contentID [description]
	 */
	public function setContentID($newContentID)
	{
	    $this->contentID = $newContentID;
	}

	/**
	 * [getContent() description here]
	 *
	 * @return [type] [description]
	 */
	public function getContent()
	{
	    return $this->Content;
	}
	
	/**
	 * [setContent() description here]
	 *
	 * @param  [type] $content [description]
	 */
	public function setContent($newContent)
	{
	    $this->Content = $newContent;
	}


	/**
	 * [getPart() description here]
	 *
	 * @return [type] [description]
	 */
	public function getPart()
	{
	    return $this->Part;
	}
	
	/**
	 * [setPart() description here]
	 *
	 * @param  [type] $Part [description]
	 */
	public function setPart($newPart)
	{
	    $this->Part = $newPart;
	}

	// end of getters and setters

	public function castToContentBridges($obj){
		$cb = new ContentBridges();
		if(isset($obj->cBridgeID)){
			$cb->cBridgeID = $obj->cBridgeID;
		}
		if(isset($obj->catID)){
			$cb->catID = $obj->catID;
		}
		if(isset($obj->partID)){
			$cb->partID = $obj->partID;
		}
		if(isset($obj->contentID)){
			$cb->contentID = $obj->contentID;
		}
		if(isset($obj->Content)){
			$c = new content();
			$cb->Content = $c->castToContent($obj->Content);
		}
		if(isset($obj->Part)){
			$cb->Part = $obj->Part;
		}											
		return $cb;
	}
} // end of ContentBridges class

class Content {
	private $contentID = 0;
	private $text = "";
	private $cTypeID = 0;
	private $ContentType = null;

	public function __construct($contentID = 0, $text = "", $cTypeID = "", $ContentType = null){		
		$this->contentID = $contentID;
		$this->text = $text;
		$this->cTypeID = $cTypeID;
		$this->ContentType = $ContentType;
	}

	/**
	 * [getContentID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getContentID()
	{
	    return $this->contentID;
	}
	
	/**
	 * [setContentID() description here]
	 *
	 * @param  [type] $contentID [description]
	 */
	public function setContentID($newContentID)
	{
	    $this->contentID = $newContentID;
	}


	/**
	 * [getText() description here]
	 *
	 * @return [type] [description]
	 */
	public function getText()
	{
	    return $this->text;
	}
	
	/**
	 * [setText() description here]
	 *
	 * @param  [type] $text [description]
	 */
	public function setText($newText)
	{
	    $this->text = $newText;
	}


	/**
	 * [getCTypeID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getCTypeID()
	{
	    return $this->cTypeID;
	}
	
	/**
	 * [setCTypeID() description here]
	 *
	 * @param  [type] $cTypeID [description]
	 */
	public function setCTypeID($newCTypeID)
	{
	    $this->cTypeID = $newCTypeID;
	}

	
	/**
	 * [getContentType() description here]
	 *
	 * @return [type] [description]
	 */
	public function getContentType()
	{
	    return $this->ContentType;
	}
	
	/**
	 * [setContentType() description here]
	 *
	 * @param  [type] $ContentType [description]
	 */
	public function setContentType($newContentType)
	{
	    $this->ContentType = $newContentType;
	}

	// end of getters and setters

	public function castToContent($obj){
		$c = new Content();
		if(isset($obj->contentID)){
			$c->contentID = $obj->contentID;
		}
		if(isset($obj->text)){
			$c->text = $obj->text;
		}
		if(isset($obj->cTypeID)){
			$c->cTypeID = $obj->cTypeID;
		}
		if(isset($obj->ContentType)){
			$ct = new ContentType();
			$c->ContentType = $ct->castToContentType($obj->ContentType);
		}																
		return $c;
	}
}// end of Content class

class ContentType{
	private $cTypeID = 0;
	private $type = "";
	private $allowHTML = false;

	public function __construct($cTypeID = 0, $type = "", $allowHTML = false){		
		$this->cTypeID = $cTypeID;
		$this->type = $type;
		$this->allowHTML = $allowHTML;
	}

	/**
	 * [getCTypeID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getCTypeID()
	{
	    return $this->cTypeID;
	}
	
	/**
	 * [setCTypeID() description here]
	 *
	 * @param  [type] $cTypeID [description]
	 */
	public function setCTypeID($newCTypeID)
	{
	    $this->cTypeID = $newCTypeID;
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
	 * [getAllowHTML() description here]
	 *
	 * @return [type] [description]
	 */
	public function getAllowHTML()
	{
	    return $this->allowHTML;
	}
	
	/**
	 * [setAllowHTML() description here]
	 *
	 * @param  [type] $allowHTML [description]
	 */
	public function setAllowHTML($newAllowHTML)
	{
	    $this->allowHTML = $newAllowHTML;
	}

	public function castToContentType($obj){
		$ct = new ContentType();
		if(isset($obj->cTypeID)){
			$ct->cTypeID = $obj->cTypeID;
		}
		if(isset($obj->type)){
			$ct->type = $obj->type;
		}
		if(isset($obj->allowHTML)){
			$ct->allowHTML = $obj->allowHTML;
		}														
		return $ct;			
	}
} // end of ContentType class

class FullCategory {
	private $parent = null;
	private $content = array();
	private $sub_categories = array();

	public function __construct($parent = null, $content = null, $sub_categories = null){		
		$this->parent = $parent;
		$this->content = $content;
		$this->sub_categories = $sub_categories;
	}
	/**
	 * [getParent() description here]
	 *
	 * @return [type] [description]
	 */
	public function getParent()
	{
	    return $this->parent;
	}
	/**
	 * [setParent() description here]
	 *
	 * @param  [type] $parent [description]
	 */
	public function setParent($newParent)
	{
	    $this->parent = $newParent;
	}
	/**
	 * [getContent() description here]
	 *
	 * @return [type] [description]
	 */
	public function getContent()
	{
	    return $this->content;
	}
	/**
	 * [setContent() description here]
	 *
	 * @param  [type] $content [description]
	 */
	public function setContent($newContent)
	{
	    $this->content = $newContent;
	}
	/**
	 * [getSub_categories() description here]
	 *
	 * @return [type] [description]
	 */
	public function getSub_categories()
	{
	    return $this->sub_categories;
	}	
	/**
	 * [setSub_categories() description here]
	 *
	 * @param  [type] $sub_categories [description]
	 */
	public function setSub_categories($newSub_categories)
	{
	    $this->sub_categories = $newSub_categories;
	}

	public function castToFullCategory($obj){
		$fc = new FullCategory();
		if(isset($obj->parent)){
			$cat = new Category();
			$fc->parent = $cat->castToCategory($obj->parent);
		}
		if(isset($obj->content)){
			$apiCont_array = array();
			foreach($obj->content as $cont){
				$content = new APIContent();
				$content = $content->castToAPIContent($cont);
				array_push($apiCont_array, $content); 
			}
			$fc->content = $apiCont_array;
		}
		if(isset($obj->sub_categories)){
			$subCat_array = array();
			foreach($obj->sub_categories as $sCat){
				$subCat = new Category();
				$subCat = $subCat->castToCategory($sCat);
				array_push($subCat_array, $subCat); 
			}
			$fc->sub_categories = $subCat_array;
		}
		return $fc;

	}
}// end of FullCategory Class

class APICategory {
	
	private $catID = 0;
	private $dateAdded = "";
	private $parentID = 0;
	private $catTitle = "";
	private $shortDesc = "";
	private $longDesc = "";
	private $image = "";
	private $isLifestyle = 0;
	private $partCount = 0;
	private $content = array();
	// lifestyle fields
	private $towables = array();
	private $sort = 0;

	public function __construct($catID = 0, $dateAdded = "", $parentID = 0, $catTitle = "", $shortDesc = "", $longDesc = "", $image = "", $isLifestyle = 0, $partCount = 0, $content = null, $sort = 0, $towables = null){
		$this->catID = $catID;
		$this->dateAdded = $dateAdded;
		$this->parentID = $parentID;
		$this->catTitle = $catTitle;
		$this->shortDesc = $shortDesc;
		$this->longDesc = $longDesc;
		$this->image = $image;
		$this->isLifestyle = $isLifestyle;
		$this->partCount = $partCount;
		$this->content = $content;
		// lifestyle fields
		$this->towables = $towables;
		$this->sort = $sort;
	}



	/**
	 * [getDateAdded() description here]
	 *
	 * @return [type] [description]
	 */
	public function getDateAdded()
	{
	    return $this->dateAdded;
	}
	
	/**
	 * [setDateAdded() description here]
	 *
	 * @param  [type] $dateAdded [description]
	 */
	public function setDateAdded($newDateAdded)
	{
	    $this->dateAdded = $newDateAdded;
	}

	/**
	 * [getCatID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getCatID()
	{
	    return $this->catID;
	}
	
	/**
	 * [setCatID() description here]
	 *
	 * @param  [type] $catID [description]
	 */
	public function setCatID($newCatID)
	{
	    $this->catID = $newCatID;
	}

	/**
	 * [getParentID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getParentID()
	{
	    return $this->parentID;
	}
	
	/**
	 * [setParentID() description here]
	 *
	 * @param  [type] $parentID [description]
	 */
	public function setParentID($newParentID)
	{
	    $this->parentID = $newParentID;
	}


	/**
	 * [getCatTitle() description here]
	 *
	 * @return [type] [description]
	 */
	public function getCatTitle()
	{
	    return $this->catTitle;
	}
	
	/**
	 * [setCatTitle() description here]
	 *
	 * @param  [type] $catTitle [description]
	 */
	public function setCatTitle($newCatTitle)
	{
	    $this->catTitle = $newCatTitle;
	}

	/**
	 * [getShortDesc() description here]
	 *
	 * @return [type] [description]
	 */
	public function getShortDesc()
	{
	    return $this->shortDesc;
	}
	
	/**
	 * [setShortDesc() description here]
	 *
	 * @param  [type] $shortDesc [description]
	 */
	public function setShortDesc($newShortDesc)
	{
	    $this->shortDesc = $newShortDesc;
	}


	/**
	 * [getLongDesc() description here]
	 *
	 * @return [type] [description]
	 */
	public function getLongDesc()
	{
	    return $this->longDesc;
	}
	
	/**
	 * [setLongDesc() description here]
	 *
	 * @param  [type] $longDesc [description]
	 */
	public function setLongDesc($newLongDesc)
	{
	    $this->longDesc = $newLongDesc;
	}


	/**
	 * [getImage() description here]
	 *
	 * @return [type] [description]
	 */
	public function getImage()
	{
	    return $this->image;
	}
	
	/**
	 * [setImage() description here]
	 *
	 * @param  [type] $image [description]
	 */
	public function setImage($newImage)
	{
	    $this->image = $newImage;
	}

	/**
	 * [getIsLifestyle() description here]
	 *
	 * @return [type] [description]
	 */
	public function getIsLifestyle()
	{
	    return $this->isLifestyle;
	}
	
	/**
	 * [setIsLifestyle() description here]
	 *
	 * @param  [type] $isLifestyle [description]
	 */
	public function setIsLifestyle($newIsLifestyle)
	{
	    $this->isLifestyle = $newIsLifestyle;
	}

	/**
	 * [getPartCount() description here]
	 *
	 * @return [type] [description]
	 */
	public function getPartCount()
	{
	    return $this->partCount;
	}
	
	/**
	 * [setPartCount() description here]
	 *
	 * @param  [type] $partCount [description]
	 */
	public function setPartCount($newPartCount)
	{
	    $this->partCount = $newPartCount;
	}


	/**
	 * [getContent() description here]
	 *
	 * @return [type] [description]
	 */
	public function getContent()
	{
	    return $this->content;
	}
	
	/**
	 * [setContent() description here]
	 *
	 * @param  [type] $content [description]
	 */
	public function setContent($newContent)
	{
	    $this->content = $newContent;
	}
	/**
	 * [getTowables() description here]
	 *
	 * @return [type] [description]
	 */
	public function getTowables()
	{
	    return $this->towables;
	}
	/**
	 * [setTowables() description here]
	 *
	 * @param  [type] $towables [description]
	 */
	public function setTowables($newTowables)
	{
	    $this->towables = $newTowables;
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

	public function castToAPICategory($obj){
		$c = new APICategory();
		if(isset($obj->catID)){
			$c->catID = $obj->catID;
		}
		if(isset($obj->dateAdded)){
			$c->dateAdded = $obj->dateAdded;
		}		
		if(isset($obj->parentID)){
			$c->parentID = $obj->parentID;
		}
		if(isset($obj->catTitle)){
			$c->catTitle = $obj->catTitle;
		}
		if(isset($obj->shortDesc)){
			$c->shortDesc = $obj->shortDesc;
		}
		if(isset($obj->longDesc)){
			$c->longDesc = $obj->longDesc;
		}
		if(isset($obj->image)){
			$c->image = $obj->image;
		}
		if(isset($obj->isLifestyle)){
			$c->isLifestyle = $obj->isLifestyle;
		}
		if(isset($obj->partCount)){
			$c->partCount = $obj->partCount;
		}
		if(isset($obj->content)){
			$apiCont_array = array();
			foreach($obj->content as $cont){
				$content = new APIContent();
				$content = $content->castToAPIContent($cont);
				array_push($apiCont_array, $content); 
			}
			$c->content = $apiCont_array;
		}
		if(isset($obj->towables)){
			$towables_array = array();
			foreach($obj->towables as $tow){
				$towables = new Trailer();
				$towables = $towables->castToTrailer($tow);
				array_push($towables_array, $towables); 
			}
			$c->towables = $towables_array;
		}
		if(isset($obj->sort)){
			$c->sort = $obj->sort;
		}
		return $c;
	}
} // end of APICategory Class

class Trailer{

	private $trailerID = 0;
	private $image = "";
	private $name = "";
	private $TW = 0;
	private $GTW = 0;
	private $hitchClass = "";
	private $shortDesc = "";
	private $message = "";
	private $Lifestyle_Trailers = array();

	public function __construct($trailerID = 0, $image = "", $name = "", $TW = 0, $GTW = 0, $hitchClass = "", $shortDesc = "", $message = "", $Lifestyle_Trailers = null){
		
		$this->trailerID = $trailerID;
		$this->image = $image;
		$this->name = $name;
		$this->TW = $TW;
		$this->GTW = $GTW;
		$this->hitchClass = $hitchClass;
		$this->shortDesc = $shortDesc;
		$this->message = $message;
		$this->Lifestyle_Trailers = $Lifestyle_Trailers;

	}

	/**
	 * [getTrailerID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getTrailerID()
	{
	    return $this->trailerID;
	}
	
	/**
	 * [setTrailerID() description here]
	 *
	 * @param  [type] $trailerID [description]
	 */
	public function setTrailerID($newTrailerID)
	{
	    $this->trailerID = $newTrailerID;
	}


	/**
	 * [getImage() description here]
	 *
	 * @return [type] [description]
	 */
	public function getImage()
	{
	    return $this->image;
	}
	
	/**
	 * [setImage() description here]
	 *
	 * @param  [type] $image [description]
	 */
	public function setImage($newImage)
	{
	    $this->image = $newImage;
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
	 * [getTW() description here]
	 *
	 * @return [type] [description]
	 */
	public function getTW()
	{
	    return $this->TW;
	}
	
	/**
	 * [setTW() description here]
	 *
	 * @param  [type] $TW [description]
	 */
	public function setTW($newTW)
	{
	    $this->TW = $newTW;
	}


	/**
	 * [getGTW() description here]
	 *
	 * @return [type] [description]
	 */
	public function getGTW()
	{
	    return $this->GTW;
	}
	
	/**
	 * [setGTW() description here]
	 *
	 * @param  [type] $GTW [description]
	 */
	public function setGTW($newGTW)
	{
	    $this->GTW = $newGTW;
	}


	/**
	 * [getHitchClass() description here]
	 *
	 * @return [type] [description]
	 */
	public function getHitchClass()
	{
	    return $this->hitchClass;
	}
	
	/**
	 * [setHitchClass() description here]
	 *
	 * @param  [type] $hitchClass [description]
	 */
	public function setHitchClass($newHitchClass)
	{
	    $this->hitchClass = $newHitchClass;
	}


	/**
	 * [getShortDesc() description here]
	 *
	 * @return [type] [description]
	 */
	public function getShortDesc()
	{
	    return $this->shortDesc;
	}
	
	/**
	 * [setShortDesc() description here]
	 *
	 * @param  [type] $shortDesc [description]
	 */
	public function setShortDesc($newShortDesc)
	{
	    $this->shortDesc = $newShortDesc;
	}


	/**
	 * [getMessage() description here]
	 *
	 * @return [type] [description]
	 */
	public function getMessage()
	{
	    return $this->message;
	}
	
	/**
	 * [setMessage() description here]
	 *
	 * @param  [type] $message [description]
	 */
	public function setMessage($newMessage)
	{
	    $this->message = $newMessage;
	}


	/**
	 * [getLifestyle_Trailers() description here]
	 *
	 * @return [type] [description]
	 */
	public function getLifestyle_Trailers()
	{
	    return $this->Lifestyle_Trailers;
	}
	
	/**
	 * [setLifestyle_Trailers() description here]
	 *
	 * @param  [type] $Lifestyle_Trailers [description]
	 */
	public function setLifestyle_Trailers($newLifestyle_Trailers)
	{
	    $this->Lifestyle_Trailers = $newLifestyle_Trailers;
	}
	public function castToTrailer($obj){
		$t = new Trailer();
		if(isset($obj->trailerID)){
			$t->trailerID = $obj->trailerID;
		}
		if(isset($obj->image)){
			$t->image = $obj->image;
		}
		if(isset($obj->name)){
			$t->name = $obj->name;
		}
		if(isset($obj->TW)){
			$t->TW = $obj->TW;
		}
		if(isset($obj->GTW)){
			$t->GTW = $obj->GTW;
		}
		if(isset($obj->hitchClass)){
			$t->hitchClass = $obj->hitchClass;
		}		
		if(isset($obj->shortDesc)){
			$t->shortDesc = $obj->shortDesc;
		}
		if(isset($obj->message)){
			$t->message = $obj->message;
		}		
		if(isset($obj->Lifestyle_Trailers)){
			$t->content = $obj->Lifestyle_Trailers;
		}
		return $t;	
	}
} // end of Trailer Class

class APIContent {
	private $isHTML = false;
	private $type = "";
	private $content = "";

	public function __construct($isHTML = false, $type = "", $content = ""){		
		$this->isHTML = $isHTML;
		$this->type = $type;
		$this->content = $content;
	}

	/**
	 * [getIsHTML() description here]
	 *
	 * @return [type] [description]
	 */
	public function getIsHTML()
	{
	    return $this->isHTML;
	}
	
	/**
	 * [setIsHTML() description here]
	 *
	 * @param  [type] $isHTML [description]
	 */
	public function setIsHTML($newIsHTML)
	{
	    $this->isHTML = $newIsHTML;
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
	 * [getContent() description here]
	 *
	 * @return [type] [description]
	 */
	public function getContent()
	{
	    return $this->content;
	}
	
	/**
	 * [setContent() description here]
	 *
	 * @param  [type] $content [description]
	 */
	public function setContent($newContent)
	{
	    $this->content = $newContent;
	}

	public function castToAPIContent($obj){
		$c = new APIContent();
		if(isset($obj->isHTML)){
			$c->isHTML = $obj->isHTML;
		}
		if(isset($obj->type)){
			$c->type = $obj->type;
		}		
		if(isset($obj->content)){
			$c->content = $obj->content;
		}
		return $c;
	}
} // end of APIContent Class
