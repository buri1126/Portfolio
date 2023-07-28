<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Review_blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
    </head>
    <x-app-layout>
    <body>
        
        
        <div class="component">
            <div class="leftbar">
                <div class='category_index'>
                    <p>categories</p>
                     @foreach($categories as $category)
                        <a href="/categories/{{ $category->id }}" class="category">{{ $category->name }}</a>
                    @endforeach
                </div>
                <br>
                <div class="team_index">
                    <p>teams</p>
                    @foreach($teams as $team)
                        <a href="/teams/{{$team->id}}" class="team">{{$team->name}}</a>
                    @endforeach
                </div>
        </div>
            <div class="index">
                <div class="serch">
                    <form action="/teams/{{$team->id}}">
                        <input type="text" name="keyword" >
                        <br>
                        <input type="submit" value="検索">
                         <a href="/users/{{$team->id}}">クリア</a>
                    </form>
                   <hr>
                </div>
                <div class='posts'>
                    @foreach ($posts as $post)
                        <div class='post'>
                            <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                            <br>
                            <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                            @foreach($post->teams as $team)   
                                <a href="/teams/{{$team->id}}">{{ $team->name }}</a>
                            @endforeach
                            <a href="/users/{{$post->user->id}}">{{ $post->user->name }}</a>
                            <small>{{ $post->created_at}}</small>
                        </div>
                    @endforeach
                </div>
        </div>
            <div class="rightbar">
                <div class='standings'>
                    <h1>standings</h1>
                    <table>
                        <thead>
                            <tr>
                            <th>順位</th>
                            <th>クラブ</th>
                            <th>試合</th>
                            <th>勝</th>
                            <th>分</th>
                            <th>負</th>
                            <th>+/-</th>
                            <th>差</th>
                            <th>Pts</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($standings["response"][0]["league"]["standings"][0] as $standing)
                                <tr>
                                    <td>{{$standing['rank']}}</td>
                                    <td>{{$standing['team']['name']}}</td>
                                    <td>{{$standing['all']['played']}}</td>
                                    <td>{{$standing['all']['win']}}</td>
                                    <td>{{$standing['all']['draw']}}</td>
                                    <td>{{$standing['all']['lose']}}</td>
                                    <td>{{$standing['all']['goals']['for']}}/{{$standing['all']['goals']['against']}}</td>
                                    <td>{{$standing['goalsDiff']}}</td>
                                    <td>{{$standing['points']}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class='fixtures'>
                    <table>
                        <thead>
                            <tr>
                            <th>節</th>
                            <th>ホーム</th>
                            <th>vs</th>
                            <th>アウェイ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @if($fixturedatas)
                                   @foreach($fixturedatas as $fixture)
                                        <td>{{$fixture['league']['round']}}</td>
                                        <td>{{$fixture['teams']['home']['name']}}</td>
                                        <td>vs</td>
                                        <td>{{$fixture['teams']['away']['name']}}</td>
                                   @endforeach
                                @else
                                <p>今日の試合はありません</p>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
            <div class="footer">
                <a href="/">戻る</a>
            </div>
        
    </body>
    </x-app-layout>
</html>