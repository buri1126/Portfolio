<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
    <body>
        <h1 class="title">
            {{ $post->title }}
        </h1>
        <a href="">{{ $post->category->name }}</a>
        @foreach($post->teams as $team)   
            <a href="">{{ $team->name }}</a>
        @endforeach
        <small>{{ $post->user->name }}</small>
        <small>{{ $post->created_at}}</small>
        
        <div class="content">
            <div class="content__post">
                <h3>本文</h3>
                <p>{{ $post->body }}</p>    
            </div>
        </div>
        <div class="edit"><a href="/posts/{{ $post->id }}/edit">edit</a></div>
        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
            @csrf
            @method('DELETE')
            <button type="button" onclick="deletePost({{ $post->id }})">delete</button> 
        </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
    <!--あとでjsファイルに移動-->
    <script>
        function deletePost(id) {
            'use strict'
    
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
    </x-app-layout>
</html>
