<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Football review</title>
        <!-- Fonts -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
    </head>
    <x-app-layout>
        <body>
            <div class="league_component flex flex-col w-3/4 md:w-1/2 mt-16 h-screen">
                <div class='standings text-center  w-full mb-10'>
                    <h1 class="text-center">standings</h1>
                    <p>現在の順位</p>
                    <table class="w-full bg-white">
                        <thead>
                            <tr class="border border-gray-300 border-solid">
                            <th class="border border-gray-300 border-solid">順位</th>
                            <th class="border border-gray-300 border-solid">クラブ</th>
                            <th class="border border-gray-300 border-solid">試合</th>
                            <th class="border border-gray-300 border-solid">勝</th>
                            <th class="border border-gray-300 border-solid">分</th>
                            <th class="border border-gray-300 border-solid">負</th>
                            <th class="border border-gray-300 border-solid">+/-</th>
                            <th class="border border-gray-300 border-solid">差</th>
                            <th class="border border-gray-300 border-solid">Pts</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($standings["response"][0]["league"]["standings"][0] as $standing)
                                <tr>
                                    <td class="border border-gray-300 border-solid">{{$standing['rank']}}</td>
                                    <td class="border border-gray-300 border-solid">{{$standing['team']['name']}}</td>
                                    <td class="border border-gray-300 border-solid">{{$standing['all']['played']}}</td>
                                    <td class="border border-gray-300 border-solid">{{$standing['all']['win']}}</td>
                                    <td class="border border-gray-300 border-solid">{{$standing['all']['draw']}}</td>
                                    <td class="border border-gray-300 border-solid">{{$standing['all']['lose']}}</td>
                                    <td class="border border-gray-300 border-solid">{{$standing['all']['goals']['for']}}/{{$standing['all']['goals']['against']}}</td>
                                    <td class="border border-gray-300 border-solid">{{$standing['goalsDiff']}}</td>
                                    <td class="border border-gray-300 border-solid">{{$standing['points']}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class='fixtures text-center w-full'>
                    <h1 class="text-center">fixtures</h1>
                    <p>今月の試合日程</p>
                    <table class="w-full bg-white">
                        <thead>
                            <tr class="border border-gray-300 border-solid">
                            <th class="border border-gray-300 border-solid">日付</th>
                            <th class="border border-gray-300 border-solid">節</th>
                            <th class="border border-gray-300 border-solid">ホーム</th>
                            <th class="border border-gray-300 border-solid">vs</th>
                            <th class="border border-gray-300 border-solid">アウェイ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @if($fixturedatas)
                                   @foreach($fixturedatas as $fixture)
                                        <tr>
                                            <td class="border border-gray-300 border-solid">{{substr($fixture['fixture']['date'],0,10)}}<br>{{substr($fixture['fixture']['date'],11,5)}}</td>
                                            <td class="border border-gray-300 border-solid">{{substr($fixture['league']['round'],17,2)}}</td>
                                            <td class="border border-gray-300 border-solid">{{$fixture['teams']['home']['name']}}</td>
                                            <td class="border border-gray-300 border-solid">vs</td>
                                            <td class="border border-gray-300 border-solid">{{$fixture['teams']['away']['name']}}</td>
                                        </tr>
                                   @endforeach
                                @else
                                <p>今日の試合はありません</p>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="footer text-center">
                     <a href="{{ url($prevUrl) }}">戻る</a>
            </div>
        </body>
    </x-app-layout>
</html>