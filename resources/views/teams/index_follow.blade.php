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
                <div class="leftbar  lg:w-2/12 w-3/12 h-5/6 overflow-y-scroll text-left pt-8">
                    <div class="post_select text-center mt-5">
                        <a href="/" class="flex flex-col w-3/5 bg-white break-words rounded-xl">home</a>
                        <a href="/teams/{{$team->id}}" class="flex flex-col w-3/5 bg-white break-words rounded-xl">all</a>
                        <a href="/teams/{{$team->id}}/follow" class="flex flex-col w-3/5 bg-white break-words rounded-xl">following</a>
                    </div>
                    <div class='category_index text-center mt-5'>
                        <p class="border-b border-gray-300 border-solid">categories</p>
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
                            @foreach($post->teams as $team)
                                <form action="/teams/{{$team->id}}">
                                    <input type="text" name="keyword" placeholder="キーワード" class="serchword mb-2.5">
                                    <br>
                                    <input type="submit" value="検索" class="serch_button">
                                    <a href="/teams/{{$team->id}}">クリア</a>
                                </form>
                            @endforeach
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
                                        <a href="/categories/{{ $post->category->id }}" class="category" >{{ $post->category->name }}</a>
                                        @foreach($post->teams as $team)   
                                            <a href="/teams/{{$team->id}}" class="team">{{ $team->name }}</a>
                                        @endforeach
                                        <a href="/users/{{$post->user->id}}" class="user">{{ $post->user->name }}</a>
                                        <small>{{ substr($post->created_at,0,16)}}</small>
                                        <div class="flex ">
                                            <p><span class="fa-solid fa-heart" style="color: #ff0000;"></span>{{$post->likes->count()}}</p>
                                            <p class="ml-4"><span class="fa-regular fa-comment"></span>{{$post->comments->count()}}</p>
                                        </div>
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
                        
                    </div>
                    <div class='fixtures text-center m-10 bg-white'>
                        <h1 class="text-center">fixtures</h1>
                        
                    </div>
                 </div>
            </div>
        </body>
    </x-app-layout>
</html>