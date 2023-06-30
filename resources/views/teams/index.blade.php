<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Review_blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
    <body>
        <a href='/posts/create'>create</a>
        <div class='posts'>
                @foreach ($posts as $post)
                    <div class='post'>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                        <p class='body'>{{ $post->body }}</p>
                        <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                        @foreach($post->teams as $team)   
                            <a href="/teams/{{$team->id}}">{{ $team->name }}</a>
                        @endforeach
                        <a href="/users/{{$post->user->id}}">{{ $post->user->name }}</a>
                        <small>{{ $post->created_at}}</small>
                    </div>
                @endforeach
            </div>
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
    </x-app-layout>
</html>