<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Review_blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
        <body>
            <div class="serch">
                <form action="/">
                    <input type="text" name="keyword" >
                    <input type="submit" value="検索">
                </form>
                <form action="/">
                    <input type="submit" value="クリア">
                </form>
            </div>
            <a href='/posts/create'>create</a>
            <div class='posts'>
                @foreach ($posts as $post)
                    <div class='post'>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                        <p class='body'>{{ $post->body }}</p>
                        <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                        @foreach($post->teams as $team)   
                            <a href="/teams/{{$team->id}}">{{ $team->name }}</a>
                        @endforeach
                        <a href="/users/{{$post->user->id}}">{{ $post->user->name }}</a>
                        <small>{{ $post->created_at}}</small>
                    </div>
                @endforeach
            </div>
            <div class='paginate'>
                {{ $posts->links() }}
            </div>
            
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
                    @if($fixturedatas)
                       @foreach($fixturedatas as $fixture)
                           <tr>
                            <td>{{$fixture['league']['round']}}</td>
                            <td>{{$fixture['teams']['home']['name']}}</td>
                            <td>vs</td>
                            <td>{{$fixture['teams']['away']['name']}}</td>
                           </tr>
                       @endforeach
                    @else
                    <p>今日の試合はありません</p>
                    @endif
                   
                </tbody>
            </table>
               
            </div>
                <!--のちにサイドバー化-->
                <div class="sidebar">
                    <div class='category_index'>
                         @foreach($categories as $category)
                            <a href="/categories/{{ $category->id }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                    <div class="team_index">
                        @foreach($teams as $team)
                            <a href="/teams/{{$team->id}}">{{$team->name}}</p>
                        @endforeach
                    </div>
                </div>
        </body>
    </x-app-layout>
</html>