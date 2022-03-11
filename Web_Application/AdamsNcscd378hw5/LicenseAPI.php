<?php
/*
Nick Adams
CSCD 378-025 

This is the CensusAPI class which has a static method for handling retrieval of the Json file from the API endpoint. 
*/
	require "vendor/autoload.php";
	use kamermans\OAuth2\GrantType\ClientCredentials;
	use kamermans\OAuth2\OAuth2Middleware;
	use GuzzleHttp\HandlerStack;

	class LicenseAPI
	{
		public static function fetchComics()
		{
			$client = new GuzzleHttp\Client([
				'verify' => false,
				'debug' => true,
				'headers' => [
					'apikey' => '49d27edaafa930c3184091f93ce1cc9e0e0a791c'
				]
			]);
			
			echo("hi \n\n");
			$res = $client->request('GET', 'https://comicvine.gamespot.com/api/issues/?api_key=49d27edaafa930c3184091f93ce1cc9e0e0a791c&format=json');
			echo("hi2 \n");
			$result = json_decode($res->getBody()->getContents(), true);
			var_dump($result);
			return $result;
		}
	}
?>