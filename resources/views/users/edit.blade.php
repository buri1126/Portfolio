<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <x-app-layout>
    <body>
        <div class="edit_profile_component">
            <h1>プロフィール編集</h1>
            <form action="/users/{{$user->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="user_name">
                    <h2>{{$user->name}}</h2>
                </div>
                <div class="favorite">
                     <div class="favoriteplayer">
                        <h2>favoriteplayer</h2>
                        <input type="text" name="user[favoritePlayer]" placeholder="選手名" value="{{ $user->favoritePlayer }}"/>
                    </div>
                    <div class="favoriteteam">
                        <h2>favorite team</h2>
                        <input type="text" name="user[favoriteTeam]" placeholder="チーム名" value="{{ $user->favoriteTeam }}"/>
                    </div>
                   
                </div>
                <br>
                <div class="info">
                    <textarea name="user[info]">{{ $user->info }}</textarea>
                </div>
                
                <div class="save_profile">
                    <input type="submit" value="保存"/>
                </div>
            </form>
        </div>
        <div class="back">
            <a href="/">back</a>
        </div>
    </body>
    </x-app-layout>
</html>