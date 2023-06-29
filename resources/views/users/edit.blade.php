<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <x-app-layout>
    <body>
        <h1>プロフィール編集</h1>
        <form action="/users/{{$user->id}}" method="POST"  enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="name">
                <h2>{{$user->name}}</h2>
                <a href="/profile">edit name email</a>
            </div>
            <div class="favoriteteam">
                <h2>favorite team</h2>
                <select name="teams_array[]">
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="favoriteplayer">
                <input type="text" name="user[favoriteplayer]" placeholder="favoriteplayer" value="{{ $user->favoriteplayer }}"/>
            </div>
            <div class="info">
                <textarea name="user[info]">{{ $user->info }}</textarea>
            </div>
            <div class="image">
                <input type="file" name="image">
            </div>
            
            <input type="submit" value="保存"/>
        </form>
        <div class="back"><a href="/">back</a></div>
    </body>
    </x-app-layout>
</html>