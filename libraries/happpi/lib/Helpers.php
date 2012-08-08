<?php
namespace happpi;
class Helper{

	public function curlGet($request = ""){
		if(strlen($request) > 0){
			$session = curl_init($request);

			curl_setopt($session, CURLOPT_HEADER, false);
			curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

			$response = curl_exec($session);
			curl_close($session);

			return $response;
		}else{
			return "";
		}
	} // end of curlGET

	public function curlPOST($url="", $fields = array()){
		if(count($fields) > 0){
			$fields_string = "";
			foreach($fields as $key=>$value) {
				$fields_string .= $key . '=' . $value . '&';
			}
			rtrim($fields_string, '&');
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_POST, count($fields));
			curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$resp = curl_exec($ch);
			curl_close($ch);
			return $resp;
		}else{
			return "";
		}	
	} // end of curlPOST
	
}// end of Helper class
?>