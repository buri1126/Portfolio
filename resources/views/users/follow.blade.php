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
                   <div class="follows">
                       <p class="text-center">{{$follow_count}}人をフォローしています</p>
                       <br>
                       
                        @foreach($follows as $follow)
                        <div class="follow">
                            <a href="/users/{{$follow->id}}">{{$follow->name}}</a>
                            @if(Auth::id()!=$follow->id)
                                @if(Auth::user()->isFollowed($follow->id))
                                    <small>フォローされています</small>
                                    <form action="{{ route('unfollow', ['user' => $follow->id]) }}" method="POST">
                                       {{ csrf_field() }}
                                       {{ method_field('DELETE') }}
                                       <button type="submit" class="unfollows">フォロー解除</button>
                                    </form>
                                @elseif(Auth::id()===$user->id)<!--本人なら-->
                                    <form action="{{ route('unfollow', ['user' => $follow->id]) }}" method="POST">
                                           {{ csrf_field() }}
                                           {{ method_field('DELETE') }}
                                           <button type="submit" class="unfollows">フォロー解除</button>
                                    </form>
                                @else
                                    @if (Auth::user()->isFollowing($follow->id))
                                       <form action="{{ route('unfollow', ['user' => $follow->id]) }}" method="POST">
                                           {{ csrf_field() }}
                                           {{ method_field('DELETE') }}
                        
                                           <button type="submit" class="unfollows">フォロー解除</button>
                                       </form>
                                    @else
                                       <form action="{{ route('follow', ['user' => $follow->id]) }}" method="POST">
                                           {{ csrf_field() }}
                                           <button type="submit" class="follows">フォローする</button>
                                       </form>
                                    @endif
                                @endif
                            @endif
                        </div>
                       @endforeach
                   </div>
                    <div class="footer"><a href="{{route('profile',['user'=>Auth::id()])}}">back</a></div>

           </div>
        </body>
    </x-app-layout>
</html>