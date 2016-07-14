<?php 
class configuration{

  public $configuration;
  
   
  function __construct() {
	
		$this->configuration = array();
		$query = 'SELECT * FROM configuration ';
		$sql = mysql_query($query);
		while($row = mysql_fetch_assoc($sql))
		{
			$this->configuration[$row['option']] = $row['value'];
			
		}
		
   }
   
   function getOption($option)
   {
		
		return $this->configuration[$option];
   }
   
   
}
?>