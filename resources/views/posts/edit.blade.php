<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Football review</title>
        <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
    </head>
    <x-app-layout>
    <body>
        <div class="edit_component h-screen w-3/4 lg:w-1/2 mt-16">
            <h1 class="title">編集画面</h1>
            <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class='content_title'>
                    <h2>タイトル</h2>
                    <input type='text' name='post[title]' value="{{ $post->title }}">
                </div>
                <div class='content_body'>
                    <h2>本文</h2>
                    <textarea type='text' class="w-full h-72"name='post[body]' onkeyup="ShowLength(value);">{{ $post->body }}</textarea>
                        <p><span id="inputlength">0文字</span>/4000文字</p>
                </div>
                <div class="edit_option flex flex-row justify-evenly">
                    <div class="category">
                        <h2>Category</h2>
                        <select name="post[category_id]">
                            @foreach($categories as $category)
                                @if($post->category_id===$category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                <option value="{{ $category->id }}" >{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="team">
                        <h2>Team</h2>
                        <select name="teams_array[]">
                            @foreach($teams as $team)
                                @foreach($post->teams as $team_selected)
                                    @if($team_selected->id===$team->id)
                                    <option value="{{ $team->id }}" selected>{{ $team->name }}</option>
                                    @else
                                    <option value="{{ $team->id }}" >{{ $team->name }}</option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="image text-center ml-12">
                    <input type="file" name="files[]"  multiple>
                </div>
                <div class="update text-center bg-green-700 w-1/4 text-white">
                    <input type="submit" value="編集する"/>
                </div>
            </form>
             <div class="footer text-center">
                <a href="/posts/{{$post->id}}">戻る</a>
            </div>
        </div>
    </body>
    </x-app-layout>
    <script>
        function ShowLength( str ) {
           document.getElementById("inputlength").innerHTML = str.length + "文字";
        }
    </script>
</html>