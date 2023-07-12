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
        <div class="serch">
            <form action="/">
                <input type="text" name="keyword" >
                <input type="submit" value="検索">
            </form>
            <form action="/">
                <input type="submit" value="クリア">
            </form>
        </div>
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
            <!--のちにサイドバー化-->
            <div class="sidebar">
                <div class='category_index'>
                     @foreach($categories as $category)
                        <a href="/categories/{{ $category->id }}">{{ $category->name }}</a>
                    @endforeach
                </div>
                <div class="team_index">
                    @foreach($teams as $team)
                        <a href="/teams/{{$team->id}}">{{$team->name}}</p>
                    @endforeach
                </div>
            </div>
           
           
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
    </body>
    </x-app-layout>
</html>