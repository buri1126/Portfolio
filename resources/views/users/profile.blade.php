<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
        <body>
            <div class="profile_component">
                <div class="profile">
                    <h2 class="user_name">{{$user->name}}</h2>
                    <div class="follow_user">
                        @if(Auth::id() != $user->id)
                           @if (Auth::user()->isFollowing($user->id))
                               <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                                   {{ csrf_field() }}
                                   {{ method_field('DELETE') }}
                
                                   <button type="submit" class="unfollow">フォロー解除</button>
                               </form>
                           @else
                               <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                                   {{ csrf_field() }}
                                   <button type="submit" class="follow">フォローする</button>
                               </form>
                           @endif
                        @endif
                    </div>
                    <div class="follow_follower">
                        <a href="{{route('follow',['user'=>$user->id])}}">フォロー中{{$followcounts}}</a>
                        <a href="{{route('follower',['user'=>$user->id])}}">フォロワー{{$followercounts}}</a>
                   </div>
                    <div class="user_favorite">
                        <p>推しチーム:{{ $user->favoriteTeam }}</p>
                         <p>推し選手:{{$user->favoritePlayer}}</p>
                    </div>
                    <hr>
                    <div class="user_info">
                        <p>{{$user->info}}</p>
                    </div>
                   
                    <div class="edit_info">
                        @if($user->id===$Auth)
                            <a href="/users/{{$user->id}}/edit" class="info_link">edit info</a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class='posts'>
                    @if($postscount===0)
                    <p class="text-center">投稿はありません</p>
                    @else
                    <p class="text-center">{{$postscount}}件の投稿があります</p>
                    @endif
                    <hr>
                    @foreach($posts as $post)
                        <div class='post'>
                            <a href="/posts/{{ $post->id }}" class="title">{{ $post->title }}</a>
                            <br>
                            <div class="post_info">
                                <a href="/categories/{{ $post->category->id }}" class="category">{{ $post->category->name }}</a>
                                @foreach($post->teams as $team)   
                                    <a href="/teams/{{$team->id}}" class="team">{{ $team->name }}</a>
                                @endforeach
                            </div>
                         <small>{{ $post->created_at}}</small>
                        </div>
                        <hr>
                    @endforeach
                 </div>
            </div>
            <div class="footer">
                    <a href="/">戻る</a>
                </div>
        </body>
    </x-app-layout>
</html>