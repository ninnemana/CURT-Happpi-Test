<?php
namespace happpi;
if(!class_exists('Helper')){
	include_once 'Helpers.php';
}
if(!class_exists('Configuration')){
	include_once 'Configuration.php';
}
class SearchResult {

	protected $config = null;
	protected $helper = null;

	private $categoryID = "";
	private $partID = 0;
	private $type = "";
	private $isHitch = false;
	private $description = "";
	private $long_description = "";
	private $relevance = 0;

	public function __construct($categoryID = "", $partID = 0, $type = "", $isHitch = false, $description = "", $long_description = "", $relevance = 0){
		$this->categoryID = $categoryID;
		$this->partID = $partID;
		$this->type = $type;
		$this->isHitch = $isHitch;
		$this->description = $description;
		$this->long_description = $long_description;
		$this->relevance = $relevance;

		$this->config = new Configuration;
		$this->helper = new Helper;
	}


	/**
	 * [getCategoryID() description here]
	 *
	 * @return [type] [description]
	 */
	public function getCategoryID()
	{
	    return $this->categoryID;
	}
	
	/**
	 * [setCategoryID() description here]
	 *
	 * @param  [type] $categoryID [description]
	 */
	public function setCategoryID($newCategoryID)
	{
	    $this->categoryID = $newCategoryID;
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
	 * [getIsHitch() description here]
	 *
	 * @return [type] [description]
	 */
	public function getIsHitch()
	{
	    return $this->isHitch;
	}
	
	/**
	 * [setIsHitch() description here]
	 *
	 * @param  [type] $isHitch [description]
	 */
	public function setIsHitch($newIsHitch)
	{
	    $this->isHitch = $newIsHitch;
	}



	/**
	 * [getDescription() description here]
	 *
	 * @return [type] [description]
	 */
	public function getDescription()
	{
	    return $this->description;
	}
	
	/**
	 * [setDescription() description here]
	 *
	 * @param  [type] $description [description]
	 */
	public function setDescription($newDescription)
	{
	    $this->description = $newDescription;
	}


	/**
	 * [getLong_description() description here]
	 *
	 * @return [type] [description]
	 */
	public function getLong_description()
	{
	    return $this->long_description;
	}
	
	/**
	 * [setLong_description() description here]
	 *
	 * @param  [type] $long_description [description]
	 */
	public function setLong_description($newLong_description)
	{
	    $this->long_description = $newLong_description;
	}

	/**
	 * [getRelevance() description here]
	 *
	 * @return [type] [description]
	 */
	public function getRelevance()
	{
	    return $this->relevance;
	}
	
	/**
	 * [setRelevance() description here]
	 *
	 * @param  [type] $relevance [description]
	 */
	public function setRelevance($newRelevance)
	{
	    $this->relevance = $newRelevance;
	}

	// end of getters and setters

	public function search($search_term = ""){
		if($search_term != ""){
			$req = $this->config->getDomain() . "Search";
			$req .= "?search_term=" . $search_term;
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			$resultsArray = array();
			foreach (json_decode($resp) as $obj){
				$searchResult = new SearchResult;
				$sR = $searchResult->castToSearchResult($obj);
				array_push($resultsArray, $sR);
			}
			return $resultsArray;
		} // end if
	}

	public function powerSearch($search_term = "", $status = "800,900"){
		if($search_term != ""){
			$req = $this->config->getDomain() . "PowerSearch";
			$req .= "?search_term=" . $search_term;
			if($this->config->isIntegrated()){$req .= "&integrated=true";}
			else{$req .= "&integrated=false";}
			$req .= "&status=" . $status;
			$req .= "&customerID=" . $this->config->getCustomerID();
			$req .= "&dataType=" . $this->config->getDataType();
			$resp = $this->helper->curlGet($req);
			$Parts_array = array();
			$Part = new Part();
			foreach (json_decode($resp) as $obj) { 
				$p = $Part->castToPart($obj); 
				array_push($Parts_array, $p); 
			}
			return $Parts_array;
		} // end if
	}

	public function castToSearchResult($obj){
		$sR = new SearchResult();
		if(isset($obj->categoryID)){
			$sR->setCategoryID($obj->categoryID); 
		}
		if(isset($obj->partID)){
			$sR->setPartID($obj->partID); 
		}
		if(isset($obj->type)){
			$sR->setType($obj->type); 
		}
		if(isset($obj->isHitch)){
			$sR->setIsHitch($obj->isHitch); 
		}
		if(isset($obj->description)){
			$sR->setDescription($obj->description); 
		}
		if(isset($obj->long_description)){
			$sR->setLong_description($obj->long_description); 
		}
		if(isset($obj->relevance)){
			$sR->setRelevance($obj->relevance); 
		}
		return $sR;
	}
} // end of class
?>