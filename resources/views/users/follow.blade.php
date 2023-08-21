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
            
            
           <div class="follow_follower_component h-screen w-3/4 md:w-1/2">
                   <div class="follows w-full overflow-y-scroll">
                       @if(Auth::id()===$user->id)
                       <p class="text-center follow_count">あなたは<span class="follow_counter">{{$follow_count}}</span>人をフォローしています</p>
                       @else
                       <p class="text-center">{{$user->name}}は{{$follow_count}}人をフォローしています</p>
                       @endif
                       <hr>
                       <div class="list">
                        @foreach($follows as $follow)
                        <div class="follow border border-black border-solid text-center bg-white w-3/4 md:w-1/2 hover:scale-110">
                            <a href="/users/{{$follow->id}}">{{$follow->name}}</a>
                            @if(Auth::user()->isFollowed($follow->id))
                            <small>フォローされています</small>
                            @endif
                            <br>
                            @if(Auth::id()!=$follow->id)
                                   @if (Auth::user()->isFollowing($follow->id))
                                        @if(!Auth::user()->isFollowed($follow->id))
                                            <button onclick="follow({{ $follow->id }})" id="follow{{ $follow->id }}" class="follow-toggle bg-white text-black hidden">フォローする</button>
                                        @else
                                            <button onclick="follow({{ $follow->id }})" id="follow{{ $follow->id }}" class="follow-toggle bg-white text-black hidden">フォローバック</button>
                                        @endif
                                        <button onclick="unfollow({{ $follow->id }})" id="unfollow{{ $follow->id }}" class="follow-toggle bg-black text-white ">フォロー中</button>
                                    @else
                                        @if(!Auth::user()->isFollowed($follow->id))
                                            <button onclick="follow({{ $follow->id }})" id="follow{{ $follow->id }}" class="follow-toggle bg-white text-black ">フォローする</button>
                                        @else
                                            <button onclick="follow({{ $follow->id }})" id="follow{{ $follow->id }}" class="follow-toggle bg-white text-black">フォローバック</button>
                                        @endif
                                        <button onclick="unfollow({{ $follow->id }})" id="unfollow{{ $follow->id }}" class="follow-toggle bg-black text-white hidden">フォロー中</button>
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