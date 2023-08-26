<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Football review</title>
        <script src="https://kit.fontawesome.com/e881b85793.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
    </head>
    <x-app-layout>
    <body>
        <div class="create_component h-screen w-3/4 lg:w-1/2">
            <div class="form rounded-2xl mt-24 p-1">
                <form action="/posts" method="POST" name="post" id="post" enctype="multipart/form-data">
                    @csrf
                        <div class="title">
                            <h2 class="text-2xl">タイトル</h2>
                            <input type="text" class="w-1/2 title_form text-4xl" name="post[title]" placeholder="タイトル" onkeyup="ShowLength_title(value);" value="{{ old('post.title') }}" autocomplete="off"/>
                            <p><span id="inputlength_title">0文字</span>/100文字</p>
                            @if($errors->first('post.title'))
                            <p class="title__error" style="color:red">タイトルを書きましょう</p>
                            @endif
                        </div>
                        <div class="create_option flex flex-col md:flex-row items-start">
                            <div class="category">
                                <h2>Category</h2>
                                <select name="post[category_id]">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="team">
                                <h2>Team</h2>
                                <select name="teams_array[]" class="ml-2">
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="body">
                            <h2 class="text-xl">本文</h2>
                            <textarea name="post[body]" placeholder="今日の試合もお疲れ様です" class="w-full h-72 text-2xl" onkeyup="ShowLength_body(value);">{{ old('post.body') }}</textarea>
                            <p><span id="inputlength_body">0文字</span>/4000文字</p>
                            @if($errors->first('post.body'))
                            <p class="body__error" style="color:red">本文を書きましょう</p>
                            @endif
                        </div>
                        <div class="image text-center ml-12">
                            <input type="file" name="files[]"  multiple>
                        </div>
                        <div class="save text-center">
                            <input type="submit" class="  bg-green-700 text-white" value="投稿する"/>
                        </div>
                </form>
            </div>
            <div class="footer text-center">
                <a href="{{ url($prevUrl) }}">戻る</a>
            </div>
        </div>
    </body>
    </x-app-layout>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js">
    </script>
    <script>
        
        function elementClone() {
            
            let cloneObj = $($('input[name="files[]"]')[0]).clone();
            cloneObj.attr('name', `files[]`);
            cloneObj.appendTo('#post');
           console.log(cloneObj);
        }
        function ShowLength_title( str ) {
           document.getElementById("inputlength_title").innerHTML = str.length + "文字";
        }
        function ShowLength_body( str ) {
           document.getElementById("inputlength_body").innerHTML = str.length + "文字";
        }
    </script>
</html>