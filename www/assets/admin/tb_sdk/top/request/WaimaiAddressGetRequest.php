<?php
/**
 * TOP API: taobao.waimai.address.get request
 * 
 * @author auto create
 * @since 1.0, 2015-01-04 12:32:17
 */
class WaimaiAddressGetRequest
{
	
	private $apiParas = array();
	
	public function getApiMethodName()
	{
		return "taobao.waimai.address.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
	}
	
	public function putOtherTextParam($key, $value) {
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}
