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
               <div class="followers overflow-y-scroll w-full">
                   @if(Auth::id()===$user->id)
                       <p class="text-center">あなたは{{$follower_count}}人にフォローされています</p>
                       @else
                       <p class="text-center">{{$user->name}}は{{$follower_count}}人にフォローされています</p>
                       @endif
                       <hr>
                    <div class="list">
                   @foreach($followers as $follower)
                   <div class="follower border border-black border-solid text-center bg-white w-3/4 md:w-1/2 hover:scale-110">
                        <a href="/users/{{$follower->id}}">{{$follower->name}}</a>
                       @if(Auth::id() != $follower->id)
                           @if (Auth::user()->isFollowing($follower->id))
                           @if(Auth::user()->isFollowed($follower->id))
                           <small>フォローされています</small>
                           @endif
                               <form action="{{ route('unfollow', ['user' => $follower->id]) }}" method="POST">
                                   {{ csrf_field() }}
                                   {{ method_field('DELETE') }}
                
                                   <button type="submit" class="unfollows bg-black text-white">フォロー解除</button>
                               </form>
                            @elseif(Auth::id()===$user->id)<!--本人なら-->
                           <small>フォローされています</small>
                               <form action="{{ route('follow', ['user' => $follower->id]) }}" method="POST">
                                   {{ csrf_field() }}
                                   <button type="submit" class="follows bg-white text-black border border-solid border-black">フォローバック</button>
                               </form>
                            @else
                                 @if (Auth::user()->isFollowing($follower->id))
                                   <form action="{{ route('unfollow', ['user' => $follow->id]) }}" method="POST">
                                       {{ csrf_field() }}
                                       {{ method_field('DELETE') }}
                    
                                       <button type="submit" class="unfollows bg-black text-white">フォロー解除</button>
                                   </form>
                                @else
                                   <form action="{{ route('follow', ['user' => $follower->id]) }}" method="POST">
                                       {{ csrf_field() }}
                                       <button type="submit" class="follows bg-white text-black border border-solid border-black">フォローする</button>
                                   </form>
                                @endif
                           @endif
                        @endif
                    </div>    
                   @endforeach
                   </div>
               </div>
                <div class="footer text-center">
                <a href="{{route('profile',['user'=>Auth::id()])}}">back</a>
            </div>
           </div>
           
        </body>
    </x-app-layout>
</html>