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
        <script   src="https://code.jquery.com/jquery-3.7.0.min.js"   integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="   crossorigin="anonymous"></script>
    </head>
    <x-app-layout>
        <body>
    <div class="league_component flex flex-col w-11/12 md:w-4/6 mt-16 h-screen">
        
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