<?php
/*
Nick Adams
CSCD 378-025 

This is the CensusAPI class which has a static method for handling retrieval of the Json file from the API endpoint. 
*/
	require "vendor/autoload.php"; 

	class CensusAPI
	{
		public static function fetchCities()
		{
			$client = new \GuzzleHttp\Client(['verify' => false]);
			$res = $client->request("GET", "https://data.wa.gov/resource/2hia-rqet.json");
			$result = json_decode($res->getBody()->getContents(), true);
			
			return $result;
		}
	}
?>