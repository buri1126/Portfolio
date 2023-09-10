<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Football review</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script   src="https://code.jquery.com/jquery-3.7.0.min.js"   integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="   crossorigin="anonymous"></script>
    </head>
    <x-app-layout>
        <body>
            <div class="follow_follower_component h-screen w-3/4 md:w-1/2 border-x border-solid border-gray">
                <div class="followers overflow-y-scroll w-full py-3">
                    @if(Auth::id()===$user->id)
                    <p class="text-center follow_count"><a href="/users/{{$user->id}}">あなた</a>は{{$follower_count}}人にフォローされています</p>
                    @else
                    <p class="text-center follow_count"><a href="/users/{{$user->id}}">{{$user->name}}</a>は{{$follower_count}}人にフォローされています</p>
                    @endif
                    <a href="/users/{{$user->id}}/follow" class="text-center block">フォロー中を見る</a>
                    <div class="list">
                        @foreach($followers as $follower)
                        <div class="follower border border-black border-solid  bg-white w-3/4 md:w-1/2 hover:scale-110">
                            <div class="flex justify-between border-b border-solid border-gray">
                                <div class="flex flex-col">
                                <a href="/users/{{$follower->id}}"><i class="fa-solid fa-user"></i>{{$follower->name}}</a>
                                @if(Auth::user()->isFollowed($follower->id))
                                <small class="follow_notificate text-xs">フォローされています</small>
                                @endif
                                </div>
                                @if(Auth::id() != $follower->id)
                                    @if(Auth::id()!=$follower->id) 
                                        @if (Auth::user()->isFollowing($follower->id))
                                            @if(!Auth::user()->isFollowed($follower->id))
                                            <button onclick="follow({{ $follower->id }})" id="follow{{ $follower->id }}" class="bg-white text-black hidden follow_button mr-3">フォローする</button>
                                            @else
                                            <button onclick="follow({{ $follower->id }})" id="follow{{ $follower->id }}" class="bg-white text-black hidden follow_button mr-3">フォローバック</button>
                                            @endif
                                            <button onclick="unfollow({{ $follower->id }})" id="unfollow{{ $follower->id }}" class="bg-black text-white mr-3">フォロー中</button>
                                        @else 
                                            @if(!Auth::user()->isFollowed($follower->id))
                                            <button onclick="follow({{ $follower->id }})" id="follow{{ $follower->id }}" class="bg-white text-black follow_button mr-3">フォローする</button>
                                            @else
                                            <button onclick="follow({{ $follower->id }})" id="follow{{ $follower->id }}" class="bg-white text-black follow_button mr-3">フォローバック</button>
                                            @endif
                                            <button onclick="unfollow({{ $follower->id }})" id="unfollow{{ $follower->id }}" class="bg-black text-white hidden mr-3">フォロー中</button>
                                        @endif 
                                    @endif 
                                @endif
                            </div>
                            <div>
                                <small>推しチーム:<span>{{$follower->favoriteTeam}}</span></small>
                                <small>推し選手:<span>{{$follower->favoritePlayer}}</span></small>
                                <br />
                                <small>{!! nl2br($follower->info) !!}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
        
                <div class="footer text-center">
                    <button><a href="{{route('profile',['user'=>$user->id])}}">戻る</a></button>
                </div>
            </div>
        </body>
    </x-app-layout>
     <script>
        function follow(userId) {
            let user_id=userId;
    $.ajax({
      // これがないと419エラーが出ます
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: `/follow/${userId}`,
      type: "POST",
    })
      .done((data) => {
      $('#follow'+user_id).toggleClass('hidden')
      $('#unfollow'+user_id).toggleClass('hidden')
      $('.follow_counter').html(data.follow_count)
        console.log("ok");
      })
      .fail((data) => {
        console.log("fail");
      });
  }  
  function unfollow(userId) {
      let user_id=userId;
    $.ajax({
      // これがないと419エラーが出ます
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: `/unfollow/${userId}`,
      type: "POST",
    })
      .done((data) => {
      $('#follow'+user_id).toggleClass('hidden')
      $('#unfollow'+user_id).toggleClass('hidden')
      $('.follow_counter').html(data.follow_count)
        console.log('ok');
      })
      .fail((data) => {
        console.log("fail");
      });
  }  
    </script>
</html>