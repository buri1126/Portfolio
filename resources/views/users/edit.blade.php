<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Football review</title>
        <script src="https://kit.fontawesome.com/e881b85793.js" crossorigin="anonymous"></script>
    </head>
    <x-app-layout>
    <body>
        <div class="edit_profile_component h-screen w-3/4 lg:w-1/2 ">
            <div class="form  rounded-2xl mt-24">
            <form action="/users/{{$user->id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="user_name text-left">
                    <h2 class="text-3xl">{{$user->name}}</h2>
                </div>
                <div class="favorite flex justify-start flex-col md:flex-row items-center">
                     <div class="favoriteteam">
                        <h2>favorite team</h2>
                        <input type="text" name="user[favoriteTeam]" placeholder="チーム名" autocomplete="off" value="{{ $user->favoriteTeam }}"/>
                    </div>
                     <div class="favoriteplayer ml-3">
                        <h2>favoriteplayer</h2>
                        <input type="text" name="user[favoritePlayer]" placeholder="選手名" autocomplete="off" value="{{ $user->favoritePlayer }}"/>
                    </div>
                </div>
                <br>
                <div class="info">
                    <textarea name="user[info]" class=" h-52 text-2xl" onkeyup="ShowLength(value);">{{ $user->info }}</textarea>
                        <p><span id="inputlength">{{mb_strlen($user->info)}}文字</span>/300文字</p>
                </div>
                
                <div class="save_profile text-center">
                    <input type="submit" class="bg-green-700 text-white" value="編集"/>
                </div>
            </form>
            </div>
            <div class="footer text-center">
            <button><a href="/users/{{$user->id}}" >戻る</a></button>
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