<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <a href='/posts/create'>create</a>
        <div class='posts'>
                @foreach ($posts as $post)
                    <div class='post'>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                        <p class='body'>{{ $post->body }}</p>
                        <a href="">{{ $post->category->name }}</a>
                        <small>{{ $post->user->name }}</small>
                        <small>{{ $post->created_at}}</small>
                    </div>
                @endforeach
            </div>
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
    </body>
</html>