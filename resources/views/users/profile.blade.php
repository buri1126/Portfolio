<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Football review</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
        <body>
            <div class="profile_component h-screen w-3/4 md:w-1/2 mt-16">
                <div class="profile bg-white">
                    <h2 class="user_name text-center text-xl">{{$user->name}}</h2>
                    <div class="follow_user">
                        @if(Auth::id() != $user->id)
                           @if (Auth::user()->isFollowing($user->id))
                               <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                                   {{ csrf_field() }}
                                   {{ method_field('DELETE') }}
                
                                   <button type="submit" class="unfollow block bg-black text-white ">フォロー解除</button>
                               </form>
                           @else
                               <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                                   {{ csrf_field() }}
                                   <button type="submit" class="follow block bg-white text-black border border-solid border-black">フォローする</button>
                               </form>
                           @endif
                        @endif
                    </div>
                    <div class="follow_follower flex justify-evenly">
                        <a href="{{route('follow',['user'=>$user->id])}}">フォロー中{{$followcounts}}</a>
                        <a href="{{route('follower',['user'=>$user->id])}}">フォロワー{{$followercounts}}</a>
                   </div>
                    <div class="user_favorite flex justify-evenly">
                        <p>推しチーム:{{ $user->favoriteTeam }}</p>
                         <p>推し選手:{{$user->favoritePlayer}}</p>
                    </div>
                    <hr>
                    <div class="user_info w-1/2">
                        <p class="text-left break-words">{!! nl2br($introduction) !!}</p>
                    </div>
                   
                    <div class="edit_info text-center">
                        @if($user->id===$Auth)
                            <a href="/users/{{$user->id}}/edit" class="info_link"><button class="bg-green-700 text-white">edit info</button></a>
                        @endif
                    </div>
                </div>
                <div class='posts overflow-y-scroll h-3/4 w-3/4'>
                    @if($postscount===0)
                    <p class="text-center">投稿はありません</p>
                    @else
                    <p class="text-center">{{$postscount}}件の投稿があります</p>
                    @endif
                    <hr>
                    @foreach($posts as $post)
                        <div class='post text-left bg-white rounded-xl hover:scale-110'>
                            <div class="ml-8">
                                <a href="/posts/{{ $post->id }}" class="title">{{ $post->title }}</a>
                                <br>
                                <div class="post_info">
                                    <a href="/categories/{{ $post->category->id }}" class="category">{{ $post->category->name }}</a>
                                    @foreach($post->teams as $team)   
                                        <a href="/teams/{{$team->id}}" class="team">{{ $team->name }}</a>
                                    @endforeach
                                </div>
                                <small>{{ $post->created_at}}</small>
                                <div class="flex ">
                                    <p><span class="fa-solid fa-heart" style="color: #ff0000;"></span>{{$post->likes->count()}}</p>
                                    <p class="ml-4"><span class="fa-regular fa-comment"></span>{{$post->comments->count()}}</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                 </div>
                  <div class="footer text-center">
                    <a href="{{ url($prevUrl) }}">戻る</a>
                </div>
            </div>
           
        </body>
    </x-app-layout>
</html>