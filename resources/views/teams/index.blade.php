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
                 <div class="post_select">
                        <a href="/teams/{{$team->id}}">all</a>
                        <br>
                        <a href="/teams/{{$team->id}}/follow">following</a>
                    </div>
                <div class='category_index'>
                    <p>categories</p>
                    @foreach($categories as $category)
                        @if($category->id===1)
                          @else
                            <a href="/categories/{{ $category->id }}" class="category">{{ $category->name }}</a>
                         @endif
                    @endforeach
                </div>
                <br>
                <div class="team_index">
                    <p>teams</p>
                    @foreach($teams as $team)
                        @if($team->id===1)
                        @else
                            <a href="/teams/{{$team->id}}" class="team">{{$team->name}}</a>
                        @endif
                    @endforeach
                </div>
        </div>
            <div class="index">
                <div class="serch">
                   @foreach($posts as $post)
                        @foreach($post->teams as $team)
                            <form action="/teams/{{$team->id}}">
                                <input type="text" name="keyword" >
                                <br>
                                <input type="submit" value="検索">
                                <a href="/teams/{{$team->id}}">クリア</a>
                            </form>
                        @endforeach
                    @break
                    @endforeach
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
                 <div class="footer">
                    <a href="/">戻る</a>
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
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
           
        
    </body>
    </x-app-layout>
</html>