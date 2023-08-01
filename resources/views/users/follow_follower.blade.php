<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
        <body>
            <br>
            <br>
            <br>
            
           <div class="follow_follower_component">
               <div class="follows">
                   <p>{{$follow_count}}</p>
                   <br>
                   @foreach($follows as $follow)
                        <a href="/users/{{$follow->id}}">{{$follow->name}}</a>
                   @endforeach
               </div>
               <br>
               <div class="followers">
                   <p>{{$follower_count}}</p>
                   <br>
                   @foreach($followers as $follower)
                        <a href="/users/{{$follower->id}}">{{$follower->name}}</a>
                   @endforeach
               </div>
           </div>
        </body>
    </x-app-layout>
</html>