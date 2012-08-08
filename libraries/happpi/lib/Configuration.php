<?php
namespace happpi;
class Configuration{

	private $domain = "http://api.curtmfg.com/v2/";
	private $data_type = "json"; // dont change this, it grabs all the data and converts them to php objects.
	private $customerID = 0;
	private $integrated = false;
	private $key = "";

	public function getDomain(){
		return $this->domain;
	}

	public function getDataType(){
		return $this->data_type;
	}

	public function getCustomerID(){
		return $this->customerID;
	}

	public function isIntegrated(){
		return $this->integrated;
	}

	public function getKey(){
		return $this->key;
	}

}

?>