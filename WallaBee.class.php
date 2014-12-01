<?php require_once('CURL.class.php') ?>
<?php

class WallaBee
{
	// set up some constants
	const API_BASE_URL = 'http://api.wallab.ee/';
	
	// mmm variables... tasty, tasty variables
	public $json = '';
	public $obj = array();
	public $url = '';
	public $code = array();
	private $apiKey = 'YOUR-KEY-HERE - Get an API Key at http://wallab.ee/developers/keys/';
	private $opts = array();
	public $error = false;
	
	function __construct($url)
	{
		$this->url = self::API_BASE_URL.$url;
		
		$curl = new CURL();
		$curl->retry = 2;
		$this->opts = array( CURLOPT_SSL_VERIFYHOST => false, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => true,  CURLOPT_HTTPHEADER => array('X-WallaBee-API-Key: '.$this->apiKey));
				
		$curl->addSession($this->url, $this->opts);
		
		$this->json = utf8_encode($curl->exec());
				
		$this->code = $curl->info(false, CURLINFO_HTTP_CODE);
		if ($this->json) {
			$this->obj = json_decode($this->json);
		}
		$curl->clear();
		
		if ($this->obj->error) {
			$this->error = true;
		}
	}
	
	function __tostring()
	{
		$output = '<h2>'.$this->url.'</h2>';
		$output .= '<h3>Response Codes</h3>';
		$output .= '<pre>'.print_r($this->code, true).'</pre>';
		$output .= '<h3>Returned Object</h3>';
		$output .= '<pre>'.print_r($this->obj,true).'</pre>';
		$output .= '<h3>cURL Request</h3>';
		$output .= '<pre>'.print_r($this->opts,true).'</pre>';
		
		$output .= '<h2>Output</h2>';
		$output .= $this->json;
		return $output;
	}
	
	
}

?>