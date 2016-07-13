<?php 
class errorCodes{
	
	public $errors;
	function __construct() {
		$this->errors  = array();
	}
	
	public function AddError($errorCode,$errorMessage)
	{
		array_push($this->errors,$errorCode. $errorMessage);
	}
	
	public function GetErrors()
	{
		return $this->errors;
	}
	
	public function GetError($errorCode)
	{
		return $errors[$errorCode];
	}
	
	public function HasError()
	{
		if (!empty($this->errors)) {
			return true;
		}
		return false;
	}
}
?>