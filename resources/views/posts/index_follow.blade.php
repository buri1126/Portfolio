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
            <!--移動する-->
            <!--<a href='/posts/create'>create</a>-->
            <div class="component">
                <div class="leftbar">
                    <div class="post_select">
                        <a href="/">all</a>
                        <br>
                        <a href="/posts/follow">following</a>
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
                        <div class="teams">
                            @foreach($teams as $team)
                                @if($team->id===1)
                                @else
                                    <a href="/teams/{{$team->id}}" class="team">{{$team->name}}</a>
                                 @endif
                            @endforeach
                        </div>
                       
                    </div>
                </div>
                <div class="index">
                    <div class="serch">
                        <form action="/posts/follow">
                            <input type="text" name="keyword" placeholder="キーワード" class="serchword">
                            <br>
                            <input type="submit" value="検索" class="serch_button">
                            <a href="{{route('index_follow')}}">クリア</a>
                        </form>
                        <hr>
                    </div>
                    <p>フォロー中</p>
                    <div class='posts'>
                        @foreach ($posts as $post)
                            @if($post->user->id!==Auth::id())
                                <div class='post'>
                                    <a href="/posts/{{ $post->id }}" class="title">{{ $post->title }}</a>
                                    <br>
                                    <a href="/categories/{{ $post->category->id }}" class="category">{{ $post->category->name }}</a>
                                    @foreach($post->teams as $team)   
                                        <a href="/teams/{{$team->id}}" class="team">{{ $team->name }}</a>
                                    @endforeach
                                    <a href="/users/{{$post->user->id}}" class="user">{{ $post->user->name }}</a>
                                    <small>{{ $post->created_at}}</small>
                                </div>
                            @else
                            @endif
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
                                
                            </tbody>
                        </table>
                    </div>
                    <div class='fixtures'>
                        <table>
                            <thead>
                                <tr>
                                <th>日付</th>
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