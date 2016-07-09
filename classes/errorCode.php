<?php 
class errorCodes{
	
	public $errors;
	function __construct() {
		$this->errors  = array();
	}
	
	public function AddError($errorCode,$errorMessage)
	{
		$error[$errorCode] = $errorMessage;
	}
	
	public function GetErrors()
	{
		return $errors;
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