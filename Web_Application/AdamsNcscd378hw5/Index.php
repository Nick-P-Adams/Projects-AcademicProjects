<?php
/*
Nick Adams
CSCD 378-025

This is the main program that creates our CityAnalyzer object and then feeds it the Json data to be analyzed.
This is the php file that will be called from the command line. 
*/
	require_once "CityAnalyzer.php";
	require_once "CensusAPI.php";
	
	$citiesJson = CensusAPI::fetchCities();
	$analyzer = new CityAnalyzer($citiesJson);
	$analyzer->printHighestPopulatedCities();
	$analyzer->printLowestPopulatedCities();
	$analyzer->printRandomCity();
?>