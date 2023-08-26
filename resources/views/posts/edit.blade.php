<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Football review</title>
        <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
    </head>
    <x-app-layout>
    <body>
        <div class="edit_component h-screen w-3/4 lg:w-1/2">
            <div class="form  rounded-2xl mt-24 p-1">
            <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class='content_title'>
                    <h2 class="text-2xl">タイトル</h2>
                    <input type='text' class="w-1/2 text-4xl" name='post[title]' onkeyup="ShowLength_title(value);" value="{{ $post->title }}">
                    <p><span id="inputlength_title">{{mb_strlen($post->title)}}文字</span>/100文字</p>
                </div>
                <div class="edit_option flex flex-col md:flex-row items-start">
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
                        <select name="teams_array[]" class="ml-2">
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
                <div class='content_body'>
                    <h2 class="text-xl">本文</h2>
                    <textarea type='text' class="w-full h-72 text-2xl"name='post[body]' onkeyup="ShowLength_body(value);">{{ $post->body }}</textarea>
                        <p><span id="inputlength_body">{{mb_strlen($post->body)}}文字</span>/4000文字</p>
                </div>
                <div class="image text-center ml-12">
                    <input type="file" name="files[]"  multiple>
                </div>
                <div class="update text-center ">
                    <input type="submit" class="bg-green-700 w-1/4 text-white" value="編集する"/>
                </div>
            </form>
            </div>
             <div class="footer text-center">
                <a href="/posts/{{$post->id}}">戻る</a>
            </div>
        </div>
    </body>
    </x-app-layout>
    <script>
        function ShowLength_title( str ) {
           document.getElementById("inputlength_title").innerHTML = str.length + "文字";
        }
        function ShowLength_body( str ) {
           document.getElementById("inputlength_body").innerHTML = str.length + "文字";
        }
    </script>
</html>