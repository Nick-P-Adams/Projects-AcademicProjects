<?php
/*
Nick Adams
CSCD 378-025 

This is the city object class used to store information from the Json file for each city in the file. Having the object also makes it 
slightly easier to sort the cities later. 
*/
	class City
	{
		private $_name;
		private $_pop00;
		private $_pop10;
		private $_pop20;
		
		public function __construct($name, $pop00, $pop10, $pop20)
		{
			$this->_name = $name;
			$this->_pop00 = $pop00;
			$this->_pop10 = $pop10;
			$this->_pop20 = $pop20;
		}
		
		public function getName(){return $this->_name;}
		public function getPop00(){return $this->_pop00;}
		public function getPop10(){return $this->_pop10;}
		public function getPop20(){return $this->_pop20;}
	}
?>