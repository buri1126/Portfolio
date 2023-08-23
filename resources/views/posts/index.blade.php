<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Football review</title>
        <!-- Fonts -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
        <script src="https://kit.fontawesome.com/e881b85793.js" crossorigin="anonymous"></script>
    </head>
    <x-app-layout>
        <body>
            <div class="component flex mt-16 h-screen">
                <div class="leftbar lg:w-2/12 w-3/12 h-11/12 overflow-y-scroll text-left pt-8">
                    <div class="post_select text-center mt-5">
                        <a href="/" class="flex flex-col w-3/5 bg-white break-words  rounded-xl">all</a>
                        <a href="/posts/follow" class="flex flex-col w-3/5 bg-white break-words  rounded-xl">following</a>
                    </div>
                    <div class='category_index text-center mt-5'>
                        <p class="text-xl">categories</p>
                        @foreach($categories as $category)
                            @if($category->id===1)
                            @else
                                <a href="/categories/{{ $category->id }}" class="category flex flex-col w-3/5 bg-white break-words  rounded-xl">{{ $category->name }}</a>
                            @endif
                        @endforeach
                    </div>
                    <br>
                    <div class="team_index text-center mt-5">
                        <p class="text-xl">teams</p>
                        <div class="teams">
                            @foreach($teams as $team)
                                @if($team->id===1)
                                @else
                                    <a href="/teams/{{$team->id}}" class="team flex flex-col w-3/5 bg-white break-words  rounded-xl">{{$team->name}}</a>
                                 @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="index  lg:w-6/12 w-9/12 text-center border-r border-l border-gray-300 border-solid">
                    <div class="serch text-center m-5">
                        <form action="/">
                            <input type="text" name="keyword" placeholder="キーワード" class="serchword mb-2.5">
                            <a href="{{route('index')}}"><input type="button" value="クリア"  class="serch_button"></a>
                        </form>
                        <hr>
                    </div>
                    <div class='posts w-3/4 overflow-y-scroll '>
                        @if($postscount===0)
                            <p>投稿がありません</p>
                        @else
                            <p>{{$postscount}}件の投稿があります</p>
                        @endif
                        @foreach ($posts as $post)
                            <div class='post text-left bg-white rounded-xl hover:scale-110'>
                                <div class="ml-8">
                                    <div class="title">
                                    <a href="/posts/{{ $post->id }}" class="text-3xl">{{ $post->title }}</a>
                                    </div>
                                    <a href="/categories/{{ $post->category->id }}" class="category " >{{ $post->category->name }}</a>
                                    @foreach($post->teams as $team)   
                                        <a href="/teams/{{$team->id}}" class="team ">{{ $team->name }}</a>
                                    @endforeach
                                    <a href="/users/{{$post->user->id}}" class="user">{{ $post->user->name }}</a>
                                    <small>{{ substr($post->created_at,0,16)}}</small>
                                    <div class="body_preview">
                                        <small>{{mb_substr($post->body,0,30)}}</small>
                                    </div>
                                    <div class="flex ">
                                        <p><span class="fa-solid fa-heart" style="color: #ff0000;"></span>{{$post->likes->count()}}</p>
                                        <p class="ml-4"><span class="fa-regular fa-comment"></span>{{$post->comments->count()}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="rightbar lg:w-4/12 lg:block hidden  text-left overflow-y-scroll pt-8">
                    <div class='standings text-center mb-10 pb-10 bg-white rounded-xl w-full'>
                        <p class="text-xl text-center">standings</p>
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
                                    <td class="border border-gray-300 border-solid"><img src="{{$standing['team']['logo']}}" class="w-2/12 inline">{{$standing['team']['name']}}</td>
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
                    <div class='fixtures text-center mt-10 pb-10 bg-white rounded-xl w-full'>
                        <p class="text-xl text-center">fixtures</p>
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
                                            @if($fixture['teams']['home']['winner']===true)
                                                <td class="border border-gray-300 border-solid bg-white text-black">
                                                    <img src="{{$fixture['teams']['home']['logo']}}" class="inline w-1/5">
                                                    {{$fixture['teams']['home']['name']}}
                                                    <span class="ml-2">{{$fixture['goals']['home']}}</span>
                                                </td>
                                            @elseif($fixture['teams']['home']['winner']===false)
                                                <td class="border border-gray-300 border-solid bg-black text-white">
                                                    <img src="{{$fixture['teams']['home']['logo']}}" class="inline w-1/5">
                                                    {{$fixture['teams']['home']['name']}}
                                                    <span class="ml-2">{{$fixture['goals']['home']}}</span>
                                                </td>
                                            @else
                                                <td class="border border-gray-300 border-solid">
                                                    <img src="{{$fixture['teams']['home']['logo']}}" class="inline w-1/5">
                                                    {{$fixture['teams']['home']['name']}}
                                                    <span class="ml-2">{{$fixture['goals']['home']}}</span>
                                                </td>
                                            @endif
                                            <td class="border border-gray-300 border-solid">vs</td>
                                            @if($fixture['teams']['away']['winner']===true)
                                                <td class="border border-gray-300 border-solid bg-white text-black">
                                                    <span class="mr-2">{{$fixture['goals']['away']}}</span>
                                                    {{$fixture['teams']['away']['name']}}
                                                    <img src="{{$fixture['teams']['away']['logo']}}" class="inline w-1/5">
                                                </td>
                                            @elseif($fixture['teams']['away']['winner']===false)
                                                <td class="border border-gray-300 border-solid bg-black text-white">
                                                    <span class="mr-2">{{$fixture['goals']['away']}}</span>
                                                    {{$fixture['teams']['away']['name']}}
                                                    <img src="{{$fixture['teams']['away']['logo']}}" class="inline w-1/5">
                                                </td>
                                            @else
                                                <td class="border border-gray-300 border-solid">
                                                    <span class="mr-2">{{$fixture['goals']['away']}}</span>
                                                    {{$fixture['teams']['away']['name']}}
                                                    <img src="{{$fixture['teams']['away']['logo']}}" class="inline w-1/5">
                                                </td>
                                            @endif
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