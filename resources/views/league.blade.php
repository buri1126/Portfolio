<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Review_blog</title>
        <!-- Fonts -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
    </head>
    <x-app-layout>
        <body>
            <div class="component flex mt-16 h-screen">
                <div class="rightbar lg:w-4/12 lg:block hidden h-5/6 text-left overflow-y-scroll ">
                    <div class='standings text-center m-10 bg-white'>
                        <h1>standings</h1>
                        <table class="inline">
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
                                <!--class="border-r border-gray-300 border-solid"-->
                            </tbody>
                        </table>
                    </div>
                    <div class='fixtures text-center m-10 bg-white'>
                        <table class="inline">
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
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                 </div>
            </div>
        </body>
    </x-app-layout>
</html>