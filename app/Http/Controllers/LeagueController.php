<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;


class LeagueController extends Controller
{
    //
    public function league(){
        //   API処理
        $client = new \GuzzleHttp\Client();
        $response_standings = $client->request('GET', 'https://api-football-v1.p.rapidapi.com/v3/standings?season=2023&league=39', [
        	'headers' => [
        		'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
        		'X-RapidAPI-Key' => 'bec5700bc8msh8eebc62e717579bp173f67jsnb80be10b42c4',
        	],
        ]);
        //dd($response);
        $standings=json_decode($response_standings->getBody(),true);
        
      $response_fixtures = $client->request('GET', 'https://api-football-v1.p.rapidapi.com/v3/fixtures?league=39&season=2023&timezone=asia%2Ftokyo', [
    	'headers' => [
    		'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
    		'X-RapidAPI-Key' => 'bec5700bc8msh8eebc62e717579bp173f67jsnb80be10b42c4',
    	],
    ]);
        $fixtures=json_decode($response_fixtures->getBody(),true);
        // 日時取得
         $date=Carbon::now()->format("Y-m");
        // 繰り返し処理
        $fixturedatas=array();
        for($i=0;$i<380;$i++){
            $fixturedata=$fixtures['response'][$i];
            $fixture_date=$fixtures['response'][$i]['fixture']['date'];
            $fixture_date_new=substr( $fixture_date,0,7);
            if($fixture_date_new===$date){
                array_push($fixturedatas,$fixturedata);
            }
            //dd( $fixturedatas);
        }
        $prevUrl = url()->previous();
        return view('league')->with(['prevUrl'=>$prevUrl,'standings'=>$standings,'fixturedatas'=>$fixturedatas]);
    }
}
