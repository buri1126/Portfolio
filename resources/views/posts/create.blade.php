<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <x-app-layout>
    <body>
        <h1>Blog Name</h1>
        <form action="/posts" method="POST" name="post" id="post" enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
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
            <div class="image">
                <input type="file" name="files[]"  multiple>
            </div>
            
            <input type="submit" value="保存"/>
        </form>
        <div class="back"><a href="/">back</a></div>
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
    </script>
</html>