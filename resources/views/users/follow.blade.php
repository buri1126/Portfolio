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
            
            
           <div class="follow_follower_component h-screen w-3/4 md:w-1/2">
                   <div class="follows w-full overflow-y-scroll">
                       @if(Auth::id()===$user->id)
                       <p class="text-center">あなたは{{$follow_count}}人をフォローしています</p>
                       @else
                       <p class="text-center">{{$user->name}}は{{$follow_count}}人をフォローしています</p>
                       @endif
                       <hr>
                       <div class="list">
                        @foreach($follows as $follow)
                        <div class="follow border border-black border-solid text-center bg-white w-3/4 md:w-1/2 hover:scale-110">
                            <a href="/users/{{$follow->id}}">{{$follow->name}}</a>
                            @if(Auth::id()!=$follow->id)
                                @if(Auth::user()->isFollowed($follow->id))
                                    <small>フォローされています</small>
                                    <form action="{{ route('unfollow', ['user' => $follow->id]) }}" method="POST">
                                       {{ csrf_field() }}
                                       {{ method_field('DELETE') }}
                                       <button type="submit" class="unfollows bg-black text-white">フォロー解除</button>
                                    </form>
                                @elseif(Auth::id()===$user->id)<!--本人なら-->
                                    <form action="{{ route('unfollow', ['user' => $follow->id]) }}" method="POST">
                                           {{ csrf_field() }}
                                           {{ method_field('DELETE') }}
                                           <button type="submit" class="unfollows  bg-black text-white">フォロー解除</button>
                                    </form>
                                @else
                                    @if (Auth::user()->isFollowing($follow->id))
                                       <form action="{{ route('unfollow', ['user' => $follow->id]) }}" method="POST">
                                           {{ csrf_field() }}
                                           {{ method_field('DELETE') }}
                        
                                           <button type="submit" class="unfollows  bg-black text-white">フォロー解除</button>
                                       </form>
                                    @else
                                       <form action="{{ route('follow', ['user' => $follow->id]) }}" method="POST">
                                           {{ csrf_field() }}
                                           <button type="submit" class="follows bg-white text-white border border-solid border-black">フォローする</button>
                                       </form>
                                    @endif
                                @endif
                            @endif
                        </div>
                       @endforeach
                       </div>
                    <div class="footer text-center"><a href="{{route('profile',['user'=>Auth::id()])}}">back</a></div>
                   </div>

           </div>
        </body>
    </x-app-layout>
</html>