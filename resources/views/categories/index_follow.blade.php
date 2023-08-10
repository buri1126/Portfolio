<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Football review</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
    </head>
    <x-app-layout>
        <body>
            <div class="component flex mt-16 h-screen">
                <div class="leftbar   lg:w-2/12 w-3/12 h-5/6 overflow-y-scroll text-left pt-8">
                    <div class="post_select text-center mt-5">
                        <a href="/" class="flex flex-col w-3/5 bg-white break-words rounded-xl">home</a>
                        <a href="/categories/{{$category->id}}" class="flex flex-col w-3/5 bg-white break-words rounded-xl">all</a>
                        <a href="/categories/{{$category->id}}/follow" class="flex flex-col w-3/5 bg-white break-words rounded-xl">following</a>
                    </div>
                    <div class='category_index text-center mt-5'>
                        <p class="border-b border-gray-300 border-solid ">categories</p>
                        @foreach($categories as $category)
                            @if($category->id===1)
                            @else
                                <a href="/categories/{{ $category->id }}/follow" class="category flex flex-col w-3/5 bg-white break-words rounded-xl">{{ $category->name }}</a>
                            @endif
                        @endforeach
                    </div>
                    <br>
                    <div class="team_index text-center mt-5">
                        <p class="border-b border-gray-300 border-solid">teams</p>
                        <div class="teams">
                            @foreach($teams as $team)
                                @if($team->id===1)
                                @else
                                    <a href="/teams/{{$team->id}}/follow" class="team flex flex-col w-3/5 bg-white break-words rounded-xl">{{$team->name}}</a>
                                 @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="index lg:w-6/12 w-9/12 text-center border-r border-l border-gray-300 border-solid">
                    <div class="serch text-center m-5">
                        @foreach($posts as $post)
                        <form action="/categories/{{$post->category->id}}">
                            <input type="text" name="keyword" placeholder="キーワード" class="serchword mb-2.5">
                            <br>
                            <input type="submit" value="検索" class="serch_button">
                            <a href="/categories/{{$post->category->id}}">クリア</a>
                        </form>
                        @break
                        @endforeach
                        <hr>
                    </div>
                    <p>フォロー中のユーザーの投稿</p>
                    <div class='posts w-3/4 overflow-y-scroll h-3/4'>
                         @if($postscount===0)
                            <p>投稿がありません</p>
                        @else
                            <p>{{$postscount}}件の投稿があります</p>
                        @endif
                        @foreach ($posts as $post)
                            @if($post->user->id!==Auth::id())   
                                <div class='post text-left bg-white rounded-xl hover:scale-110'>
                                    <div class="ml-8">
                                        <div class="title">
                                        <a href="/posts/{{ $post->id }}" class="text-3xl">{{ $post->title }}</a>
                                        </div>
                                        <a href="/categories/{{ $post->category->id }}" class="category border border-gray-300 rounded-sm ml-8" >{{ $post->category->name }}</a>
                                        @foreach($post->teams as $team)   
                                            <a href="/teams/{{$team->id}}" class="team border border-gray-300 border-solid rounded-sm">{{ $team->name }}</a>
                                        @endforeach
                                        <a href="/users/{{$post->user->id}}" class="user">{{ $post->user->name }}</a>
                                        <small>{{ substr($post->created_at,0,16)}}</small>
                                    </div>
                                </div>
                            @else
                            @endif
                        @endforeach
                    </div>
                    <div class="footer text-center">
                        <a href="#" onclick="history.back(); return false;">戻る</a>
                    </div>

                </div>
                <div class="rightbar lg:w-4/12 lg:block hidden h-5/6 text-left overflow-y-scroll pt-8">
                    <div class='standings text-center mb-10 bg-white'>
                        <h1 class="text-center">standings</h1>
                        <table class="inline">
                            <thead>
                                <tr class="border border-gray-300 border-solid">
                                <th class="border border-gray-300 border-solid">順位</th>
                                <th class="border border-gray-300 border-solid">クラブ</th>
                                <th class="border border-gray-300 border-solid">試合</th>
                                <th class="border border-gray-300 border-solid">勝</th>
                                <th class="border border-gray-300 border-solid">分</th>
                                <th class="border border-gray-300 border-solid">負</th>
                                <th class="border border-gray-300 border-solid">+/-</th>
                                <th class="border border-gray-300 border-solid">差</th>
                                <th class="border border-gray-300 border-solid">Pts</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--class="border border-gray-300 border-solid"-->
                                @foreach($standings["response"][0]["league"]["standings"][0] as $standing)
                                <tr>
                                    <td class="border border-gray-300 border-solid">{{$standing['rank']}}</td>
                                    <td class="border border-gray-300 border-solid">{{$standing['team']['name']}}</td>
                                    <td class="border border-gray-300 border-solid">{{$standing['all']['played']}}</td>
                                    <td class="border border-gray-300 border-solid">{{$standing['all']['win']}}</td>
                                    <td class="border border-gray-300 border-solid">{{$standing['all']['draw']}}</td>
                                    <td class="border border-gray-300 border-solid">{{$standing['all']['lose']}}</td>
                                    <td class="border border-gray-300 border-solid">{{$standing['all']['goals']['for']}}/{{$standing['all']['goals']['against']}}</td>
                                    <td class="border border-gray-300 border-solid">{{$standing['goalsDiff']}}</td>
                                    <td class="border border-gray-300 border-solid">{{$standing['points']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class='fixtures text-center m-10 bg-white'>
                        <h1 class="text-center">fixtures</h1>
                        <table class="inline">
                            <thead>
                                <tr class="border border-gray-300 border-solid">
                                <th class="border border-gray-300 border-solid">日付</th>
                                <th class="border border-gray-300 border-solid">節</th>
                                <th class="border border-gray-300 border-solid">ホーム</th>
                                <th class="border border-gray-300 border-solid">vs</th>
                                <th class="border border-gray-300 border-solid">アウェイ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @if($fixturedatas)
                                   @foreach($fixturedatas as $fixture)
                                        <tr>
                                            <td class="border border-gray-300 border-solid">{{substr($fixture['fixture']['date'],0,10)}}<br>{{substr($fixture['fixture']['date'],11,5)}}</td>
                                            <td class="border border-gray-300 border-solid">{{substr($fixture['league']['round'],17,2)}}</td>
                                            <td class="border border-gray-300 border-solid">{{$fixture['teams']['home']['name']}}</td>
                                            <td class="border border-gray-300 border-solid">vs</td>
                                            <td class="border border-gray-300 border-solid">{{$fixture['teams']['away']['name']}}</td>
                                        </tr>
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
        </body>
    </x-app-layout>
</html>