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
            <form action="/users/{{$user->id}}" method="POST"  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="name">
                    <h2>{{$user->name}}</h2>
                </div>
                <div class="favorite">
                    <div class="favoriteteam">
                        <h2>favorite team</h2>
                        <select name="teams_array[]">
                            @foreach($teams as $team)
                                @foreach($user->teams as $team_selected)
                                    @if($team_selected->id===$team->id)
                                    <option value="{{ $team->id }}" selected>{{ $team->name }}</option>
                                    @else
                                    <option value="{{ $team->id }}" >{{ $team->name }}</option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="favoriteplayer">
                        <h2>favoriteplayer</h2>
                        <input type="text" name="user[favoriteplayer]" placeholder="選手名" value="{{ $user->favoriteplayer }}"/>
                    </div>
                </div>
                <br>
                <div class="info">
                    <textarea name="user[info]">{{ $user->info }}</textarea>
                </div>
                <div class="image">
                    <input type="file" name="image">
                </div>
                <div class="save_profile">
                    <input type="submit" value="保存"/>
                </div>
            </form>
            <div class="back"><a href="/">back</a></div>
        </div>
    </body>
    </x-app-layout>
</html>