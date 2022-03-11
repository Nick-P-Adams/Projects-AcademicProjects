<?php
/*
Nick Adams
CSCD 378-025 

The CityAnalyzer class processes the data that came from the Json file creating a City object, containing the relevant data, for each city. 
There are various functions for sorting and formating rows however all that needs to be called from the object is printHighestPopulatedCities(),
printLowestPopulatedCities(), or printRandomCity(). 
*/
	require_once "City.php";
	require_once "CensusAPI.php";
	
	class CityAnalyzer
	{
		private $_citiesJson;
		private $_cities;
		private $_columnWidthLarge = 35;
		private	$_columnWidthSmall = 20;
		
		public function __construct($citiesJson)
		{
			$this->_citiesJson = $citiesJson;
			$this->_cities = array();
			$this->_intializeCities();
		}
		
		private function _intializeCities()
		{
			foreach($this->_citiesJson as $city)
			{
				$name = $city["jurisdiction"];
				$pop00 = $city["pop_2000"];
				$pop10 = $city["pop_2010"];
				$pop20 = $city["pop_2020"];
				
				$cityObject = new City($name, $pop00, $pop10, $pop20);
				array_push($this->_cities, $cityObject);
			}
		}
		
		public function printHighestPopulatedCities()
		{
			usort($this->_cities, "CityAnalyzer::compareAscending");
			echo "\n10 Highest Populated Cities:";
			$this->printTableHeader();
			$this->printRows();
		}
		
		public function printLowestPopulatedCities()
		{
			usort($this->_cities, "CityAnalyzer::compareDescending");
			echo "\n10 Lowest Populated Cities:";
			$this->printTableHeader();
			$this->printRows();
		}
		
		public function printRandomCity()
		{
			$index = rand(0, sizeof($this->_cities));
			$city = $this->_cities[$index];
			echo "\nRandom City:\n";
			$row = $this->rowFormatter((string)$city->getName(), (string)$city->getPop20(), (string)$city->getPop10(), (string)$city->getPop00());
			echo $row;
		}
		
		private function printTableHeader()
		{
			$name = "Name";
			$pop20 = "2020 Population";
			$pop10 = "2010 Population";
			$pop00 = "2000 Population";
			
			$header = "";
			$header .= "\n";
			$header .= $this->postFormat($name, ($this->_columnWidthLarge - strlen($name)));
			$header .= $this->preFormat($pop20, ($this->_columnWidthSmall - strlen($pop20))); 
			$header .= $this->preFormat($pop10, ($this->_columnWidthSmall - strlen($pop10)));
			$header .= $this->preFormat($pop00, ($this->_columnWidthSmall - strlen($pop00)));
			$header .= "\n";
			$header .= $this->headerSeperatorFormatter($this->_columnWidthLarge) . " ";
			$header .= " " . $this->headerSeperatorFormatter($this->_columnWidthSmall);
			$header .= " " . $this->headerSeperatorFormatter($this->_columnWidthSmall);
			$header .= " " . $this->headerSeperatorFormatter($this->_columnWidthSmall);
			$header .= "\n";
			
			echo $header;
		}
		
		private function headerSeperatorFormatter($columnWidth)
		{
			$row = "";
			for($i=0; $i<($columnWidth-1); $i++)
			{
				$row .= "-";
			}
			return $row;
		}
		
		private function printRows()
		{
			$i = 0;
			foreach($this->_cities as $city)
			{
				if($i > 9)break;
				$row = $this->rowFormatter((string)$city->getName(), (string)$city->getPop20(), (string)$city->getPop10(), (string)$city->getPop00());
				echo $row;
				$i++;
			}
		}
		
		private function rowFormatter($name, $pop20, $pop10, $pop00)
		{
			$formattedRow = $this->postFormat($name, ($this->_columnWidthLarge - strlen($name)));
			$formattedRow .= $this->preFormat($pop20, ($this->_columnWidthSmall - strlen($pop20)));
			$formattedRow .= $this->preFormat($pop10, ($this->_columnWidthSmall - strlen($pop10)));
			$formattedRow .= $this->preFormat($pop00, ($this->_columnWidthSmall - strlen($pop00)));
			
			return $formattedRow . "\n";
		}
		
		private function preFormat($element, $spaceCount)
		{
			$formattedElement = "";
			for($i = 0; $i < $spaceCount; $i++)
			{
				$formattedElement .= " ";
			}
			$formattedElement .= $element;
			
			return $formattedElement;
		}
		
		private function postFormat($element, $spaceCount)
		{
			$formattedElement = $element;
			for($i = 0; $i < $spaceCount; $i++)
			{
				$formattedElement .= " ";
			}
			
			return $formattedElement;
		}
		
		private function compareAscending($a,$b)
		{
			return $a->getPop20() < $b->getPop20();
		}
		
		private function compareDescending($a,$b)
		{
			return $a->getPop20() > $b->getPop20();
		}
	}
?>