<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Football review</title>
        <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
    </head>
    <x-app-layout>
    <body>
        <div class="create_component h-screen w-3/4 lg:w-1/2">
            <div class="form  bg-white rounded-2xl mt-24">
                <form action="/posts" method="POST" name="post" id="post" enctype="multipart/form-data">
                    @csrf
                        <div class="title">
                            <h2>Title</h2>
                            <input type="text" class="w-1/2" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
                            <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
                        </div>
                        <div class="body">
                            <h2>Body</h2>
                            <textarea name="post[body]" placeholder="今日の試合もお疲れ様です" class="w-full h-72" onkeyup="ShowLength(value);">{{ old('post.body') }}</textarea>
                            <p><span id="inputlength">0文字</span>/4000文字</p>
                            <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                        </div>
                        <div class="create_option flex justify-around mb-7 flex-col md:flex-row items-center">
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
                                <select name="teams_array[]">
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
        
        function ShowLength( str ) {
           document.getElementById("inputlength").innerHTML = str.length + "文字";
        }
    </script>
</html>