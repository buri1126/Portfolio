<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;


class LeagueController extends Controller
{
    //
    public function league(){
          //API処理
        $client = new \GuzzleHttp\Client();
        $response_standings = $client->request('GET', 'https://api-football-v1.p.rapidapi.com/v3/standings?season=2023&league=39', [
        	'headers' => [
        		'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
        		'X-RapidAPI-Key' =>config('services.footballdata.token'),
        	],
        ]);
        //dd($response);
        $standings=json_decode($response_standings->getBody(),true);
        
      $response_fixtures = $client->request('GET', 'https://api-football-v1.p.rapidapi.com/v3/fixtures?league=39&season=2023&from=2023-08-11&to=2024-05-21', [
	'headers' => [
		'X-RapidAPI-Host' => 'api-football-v1.p.rapidapi.com',
		'X-RapidAPI-Key' => config('services.footballdata.token'),
	],
]);
        $fixtures=json_decode($response_fixtures->getBody(),true);
        //dd($fixtures);
        //日時取得
        $date_prev=Carbon::now()->addMonthNoOverflow(-1)->format("Y-m");
         $date=Carbon::now()->format("Y-m");
         $date_next=Carbon::now()->addMonthNoOverflow()->format("Y-m");
        // 繰り返し処理
        $fixturedatas=array();
        $fixturedata_prev=collect();
        $fixturedata=collect();
        $fixturedata_next=collect();
        for($i=0;$i<380;$i++){
            
            $fixture=$fixtures['response'][$i];
            $fixture_date=$fixtures['response'][$i]['fixture']['date'];
            $fixture_date_new=substr( $fixture_date,0,7);
            
          if($fixture_date_new===$date){
               array_push($fixture,$fixture_date);
              $fixturedata->push($fixture);
             }elseif($fixture_date_new===$date_prev){
                 array_push($fixture,$fixture_date);
              $fixturedata_prev->push($fixture);
             }elseif($fixture_date_new===$date_next){
                 array_push($fixture,$fixture_date);
              $fixturedata_next->push($fixture);
             }
           
        }
        $sorteddata = $fixturedata->sortBy('0')->values()->toArray();
         $sorteddata_prev = $fixturedata_prev->sortBy('0')->values()->toArray();
          $sorteddata_next = $fixturedata_next->sortBy('0')->values()->toArray();
        $prevUrl = url()->previous();
        return view('league')->with(['prevUrl'=>$prevUrl,'standings'=>$standings,'fixturedata'=>$sorteddata,'fixturedata_prev'=>$sorteddata_prev,'fixturedata_next'=>$sorteddata_next]);
    }
}
