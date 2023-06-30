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
            <div class="profile">
                <img src="{{$user->image_url}}">
                <!--あとでサイズ設定-->
                <h2>{{$user->name}}</h2>
                @if($user->id===$Auth)
                <a href="/profile">edit name email</a>
                @endif
                <p>{{$user->favoriteplayer}}</p>
                @foreach($user->teams as $team)   
                    <a href="/teams/{{$team->id}}">{{ $team->name }}</a>
                @endforeach
                <p>{{$user->info}}</p>
                @if($user->id===$Auth)
                <a href="/users/{{$user->id}}/edit">edit info</a>
                @endif
            </div>
            <hr>
            @foreach($posts as $post)
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
                    <hr>
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