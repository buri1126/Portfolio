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
            <div class="league_component flex flex-col w-11/12 md:w-1/2 mt-16 h-screen">
                <div class='standings text-center  w-full mb-10'>
                    <h1 class="text-center">standings</h1>
                    <p>現在の順位</p>
                    
                </div>
                <div class='fixtures text-center w-full'>
                    <h1 class="text-center">fixtures</h1>
                    <p>今月の試合日程</p>
                    
                </div>
                <div class="footer text-center">
                     <a href="{{ url($prevUrl) }}">戻る</a>
            </div>
        </body>
    </x-app-layout>
</html>