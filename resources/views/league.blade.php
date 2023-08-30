<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Football review</title>
        <!-- Fonts -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
        <script   src="https://code.jquery.com/jquery-3.7.0.min.js"   integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="   crossorigin="anonymous"></script>
    </head>
    <x-app-layout>
        <body>
            <div class="league_component flex flex-col w-11/12 md:w-4/6 mt-16 h-screen">
                <div class='standings text-center  w-3/4 mb-10'>
                    <div class="mb-3">
                    <p class="text-3xl standings_title mb-3"><span>現在の順位</span></p>
                    </div>
                    <table class="w-full bg-white">
                        <thead>
                            <tr>
                            <th class="border border-green-400 border-solid">順位</th>
                            <th class="border border-green-400 border-solid">クラブ</th>
                            <th class="border border-green-400 border-solid">試合</th>
                            <th class="border border-green-400 border-solid">勝</th>
                            <th class="border border-green-400 border-solid">分</th>
                            <th class="border border-green-400 border-solid">負</th>
                            <th class="border border-green-400 border-solid">+/-</th>
                            <th class="border border-green-400 border-solid">差</th>
                            <th class="border border-green-400 border-solid">Pts</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
                <div class='fixtures text-center w-3/4 this_Month'>
                    <p class="text-3xl fixtures_title"><span>今月の試合日程</span></p>
                    <div class="fixture_button flex justify-between mb-3">
                        <button onclick=prev()><i class="fa-solid fa-angles-left"></i></button>
                        <button onclick=next()><i class="fa-solid fa-angles-right"></i></button>
                    </div>
                    <table class="w-full bg-white">
                        <thead>
                            <tr class="border border-green-400 border-solid">
                            <th class="border border-green-400 border-solid">日付</th>
                            <th class="border border-green-400 border-solid">節</th>
                            <th class="border border-green-400 border-solid">ホーム</th>
                            <th class="border border-green-400 border-solid">vs</th>
                            <th class="border border-green-400 border-solid">アウェイ</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
                <div class='fixtures text-center w-3/4 prev_Month hidden'>
                        <p class="text-3xl fixtures_title "><span>先月の試合日程</span></p>
                    <div class="fixture_label flex justify-end mb-3">
                        <button onclick=prevToThis()><i class="fa-solid fa-angles-right"></i></button>
                    </div>
                    
                     
                </div>
                <div class='fixtures text-center w-3/4 next_Month hidden'>
                   
                        <p class="text-3xl fixtures_title"><span>来月の試合日程</span></p>
                     <div class="fixture_button flex justify-start mb-3">
                        <button onclick=nextToThis()><i class="fa-solid fa-angles-left"></i></button>
                    </div>
                    <table class="w-full bg-white">
                        <thead>
                            <tr class="border border-green-400 border-solid">
                            <th class="border border-green-400 border-solid">日付</th>
                            <th class="border border-green-400 border-solid">節</th>
                            <th class="border border-green-400 border-solid">ホーム</th>
                            <th class="border border-green-400 border-solid">vs</th>
                            <th class="border border-green-400 border-solid">アウェイ</th>
                            </tr>
                        </thead>
                        <tbody >
                            
                        </tbody>
                    </table>
                </div>
                <div class="footer text-center">
                     <a href="{{ url($prevUrl) }}">戻る</a>
            </div>
        </body>
    </x-app-layout>
    <script>
        function next(){
            console.log("a");
            $(".next_Month").toggleClass('hidden');
            $(".this_Month").toggleClass('hidden');

        };
         function prev(){
             $(".prev_Month").toggleClass('hidden');
            $(".this_Month").toggleClass('hidden');
        };
        function nextToThis(){
             $(".next_Month").toggleClass('hidden');
            $(".this_Month").toggleClass('hidden');
        };
        function prevToThis(){
             $(".prev_Month").toggleClass('hidden');
            $(".this_Month").toggleClass('hidden');
        };
    </script>
</html>