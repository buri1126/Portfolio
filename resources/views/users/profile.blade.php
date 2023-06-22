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
       
        
        
                @foreach ($posts as $post)
                    <h2>{{$post->user->name}}</h2>
                    <a href="/profile">edit name email</a>
                    <p>{{$post->user->favoriteplayer}}</p>
                    @foreach($user->teams as $team)   
                        <a href="/teams/{{$team->id}}">{{ $team->name }}</a>
                    @endforeach
                    <p>{{$post->user->info}}</p>
                    <a href="/users/{{$post->user->id}}/edit">edit info</a>
                    <br>
                    <hr>
                    <div class='posts'>
                        <div class='post'>
                            <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                            <p class='body'>{{ $post->body }}</p>
                            <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                            @foreach($post->teams as $team)   
                                <a href="/teams/{{$team->id}}">{{ $team->name }}</a>
                            @endforeach
                            <small>{{ $post->user->name }}</small>
                            <small>{{ $post->created_at}}</small>
                        </div>
                    </div>
                @endforeach
            
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
    </x-app-layout>
</html>