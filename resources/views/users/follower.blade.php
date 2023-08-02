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
            
            
           <div class="follow_follower_component">
                   <div class="followers">
                       <p class="text-center">{{$follower_count}}人にフォローされています</p>
                       <br>
                       @foreach($followers as $follower)
                       <div class="follower">
                            <a href="/users/{{$follower->id}}">{{$follower->name}}</a>
                           @if(Auth::id() != $follower->id)
                               @if (Auth::user()->isFollowing($follower->id))
                               @if(Auth::user()->isFollowed($follower->id))
                               <small>フォローされています</small>
                               @endif
                                   <form action="{{ route('unfollow', ['user' => $follower->id]) }}" method="POST">
                                       {{ csrf_field() }}
                                       {{ method_field('DELETE') }}
                    
                                       <button type="submit" class="unfollows">フォロー解除</button>
                                   </form>
                                @elseif(Auth::id()===$user->id)<!--本人なら-->
                               <small>フォローされています</small>
                                   <form action="{{ route('follow', ['user' => $follower->id]) }}" method="POST">
                                       {{ csrf_field() }}
                                       <button type="submit" class="follows">フォローバック</button>
                                   </form>
                                @else
                                     @if (Auth::user()->isFollowing($follower->id))
                                       <form action="{{ route('unfollow', ['user' => $follow->id]) }}" method="POST">
                                           {{ csrf_field() }}
                                           {{ method_field('DELETE') }}
                        
                                           <button type="submit" class="unfollows">フォロー解除</button>
                                       </form>
                                    @else
                                       <form action="{{ route('follow', ['user' => $follower->id]) }}" method="POST">
                                           {{ csrf_field() }}
                                           <button type="submit" class="follows">フォローする</button>
                                       </form>
                                    @endif
                               @endif
                            @endif
                        </div>    
                       @endforeach
                   </div>
                   <div class="back"><a href="{{route('profile',['user'=>Auth::id()])}}">back</a></div>
           </div>
        </body>
    </x-app-layout>
</html>