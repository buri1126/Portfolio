<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Football review</title>
    </head>
    <x-app-layout>
    <body>
        <div class="edit_profile_component h-screen w-3/4 lg:w-1/2 ">
            <h1 class="text-center">プロフィール編集</h1>
            <form action="/users/{{$user->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="user_name">
                    <h2>{{$user->name}}</h2>
                </div>
                <div class="favorite flex justify-center">
                     <div class="favoriteplayer mx-5">
                        <h2>favoriteplayer</h2>
                        <input type="text" name="user[favoritePlayer]" placeholder="選手名" value="{{ $user->favoritePlayer }}"/>
                    </div>
                    <div class="favoriteteam mx-5">
                        <h2>favorite team</h2>
                        <input type="text" name="user[favoriteTeam]" placeholder="チーム名" value="{{ $user->favoriteTeam }}"/>
                    </div>
                   
                </div>
                <br>
                <div class="info text-center">
                    <textarea name="user[info]" class="w-1/2 h-25" onkeyup="ShowLength(value);">{{ $user->info }}</textarea>
                        <p><span id="inputlength">{{mb_strlen($user->info)}}文字</span>/300文字</p>
                </div>
                
                <div class="save_profile text-center">
                    <input type="submit" class="bg-green-700 text-white" value="保存"/>
                </div>
            </form>
            <div class="footer text-center">
            <a href="/users/{{$user->id}}" >戻る</a>
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