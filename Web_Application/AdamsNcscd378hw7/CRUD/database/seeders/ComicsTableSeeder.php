<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comic;
use GuzzleHttp\Client;
use Faker\Factory as Faker;

class ComicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $_apiKeyURL = "?api_key=49d27edaafa930c3184091f93ce1cc9e0e0a791c&sort=cover_date:desc&offset=250500&format=json";
	
	private function fetchComicsAPI($base_URL)
	{
		$client = new Client([
			'verify' => false,
			'debug' => true
		]);
			
		$res = $client->request('GET', $base_URL . $this->_apiKeyURL);
		$result = json_decode($res->getBody()->getContents(), true);

		return $result;
	}

    private function randomCondition()
    {
        $choice = rand(0,7);

        if($choice == 0)
            return "MT";
        elseif($choice == 1)
            return "NM";
        elseif($choice == 2)
            return "VF";
        elseif($choice == 3)
            return "FN";
        elseif($choice == 4)
            return "VG";
        elseif($choice == 5)
            return "GD";
        elseif($choice == 6)
            return "FA";
        elseif($choice == 7)
            return "PO";
    }

    public function run()
    {
        $faker = Faker::create();
		$comicsJson = $this->fetchComicsAPI("https://comicvine.gamespot.com/api/issues/");

        foreach($comicsJson['results'] as $issue)
        {
            $comicJson = $this->fetchComicsAPI($issue["api_detail_url"]);
            $comic = new Comic();

            if($issue["name"] != null)
            {
                $comic->title = $issue["name"];
            }
            else
            {
                $comic->title = $issue["volume"]["name"];
            }

            $comic->volume = $issue["volume"]["name"];
            $comic->volume_id = $issue["volume"]["id"];
            $comic->issue_num = $issue["issue_number"];
            $comic->pub_date = $issue["cover_date"];
            $comic->condition = $this->randomCondition();

            if(count($comicJson["results"]["person_credits"]) >= 2)
            {
                $comic->writer_name = $comicJson["results"]["person_credits"][0]["name"];
                $comic->artist_name = $comicJson["results"]["person_credits"][1]["name"];
            }
            elseif(count($comicJson["results"]["person_credits"]) == 1)
            {
                $comic->writer_name = $comicJson["results"]["person_credits"][0]["name"];
                $comic->artist_name = $faker->name;
            }
            else
            {
                $comic->writer_name = $faker->name;
                $comic->artist_name = $faker->name;
            }

            $comic->image_URL = $issue["image"]["original_url"];

            if($issue["description"] != null)
            {
                $comic->description = $issue["description"];
            }
            else
            {
                $comic->description = $faker->text(500);
            }

            $comic->save();
        }
    }
}
