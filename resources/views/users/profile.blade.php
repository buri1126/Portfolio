<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Football review</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://kit.fontawesome.com/e881b85793.js" crossorigin="anonymous"></script>
        <script   src="https://code.jquery.com/jquery-3.7.0.min.js"   integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="   crossorigin="anonymous"></script>
    </head>
    <x-app-layout>
        <body>
            <div class="profile_component h-screen w-3/4 md:w-1/2 mt-16">
                <div class="profile  w-9/12">
                    <div class="flex flex-row justify-between">
                        <h2 class="user_name text-center text-3xl">{{$user->name}}</h2>
                        @if($user->id===$Auth)
                            <div class="edit_info text-center mr-2 mt-1">
                                <a href="/users/{{$user->id}}/edit" class="info_link"><button class="bg-green-700 text-white"><i class="fa-solid fa-user-pen"></i></button></a>
                            </div>
                        @else    
                            @if(Auth::id() != $user->id)
                                <div class="follow_user text-center mr-4">
                                    @if (Auth::user()->isFollowing($user->id))
                                        @if(!Auth::user()->isFollowed($user->id))
                                            <button onclick="follow({{ $user->id }})" id="follow" class="bg-white text-black hidden  follow_button">フォローする</button>
                                        @else
                                            <button onclick="follow({{ $user->id }})" id="follow" class="bg-white text-black hidden follow_button">フォローバック</button>
                                        @endif
                                            <button onclick="unfollow({{ $user->id }})" id="unfollow" class="bg-black text-white ">フォロー中</button>
                                    @else
                                        @if(!Auth::user()->isFollowed($user->id))
                                            <button onclick="follow({{ $user->id }})" id="follow" class="bg-white text-black border follow_button">フォローする</button>
                                        @else
                                            <button onclick="follow({{ $user->id }})" id="follow" class="bg-white text-black border follow_button">フォローバック</button>
                                        @endif
                                        <button onclick="unfollow({{ $user->id }})" id="unfollow" class="bg-black text-white hidden">フォロー中</button>
                                    @endif
                                </div>    
                            @endif
                         @endif
                    </div>
                    @if(Auth::user()->isFollowed($user->id))
                    <small class="follow_notificate">フォローされています</small>
                    @endif
                    <div class="follow_follower flex justify-start">
                        <a href="{{route('follow',['user'=>$user->id])}}">フォロー中{{$followcounts}}</a>
                        <a  class="ml-2" href="{{route('follower',['user'=>$user->id])}}">フォロワー<span class="follower_counter">{{$followercounts}}</span></a>
                   </div>
                    <div class="user_favorite flex justify-start">
                        <p>推しチーム:{{ $user->favoriteTeam }}</p>
                         <p class="ml-2">推し選手:{{$user->favoritePlayer}}</p>
                    </div>
                    <hr>
                    <div class="user_info">
                        <p class="text-left break-words">{!! nl2br($user->info) !!}</p>
                    </div>
                </div>
                <div class='posts overflow-y-scroll w-3/4 pb-4'>
                    @if($postscount===0)
                        <p class="text-center">投稿はありません</p>
                    @else
                        <p class="text-center">{{$postscount}}件の投稿があります</p>
                    @endif
                    @foreach($posts as $post)
                        <div class='post text-left bg-white rounded-xl hover:scale-110'>
                            <div class="ml-8">
                                <a href="/posts/{{ $post->id }}" class="title text-3xl break-words">{{ $post->title }}</a>
                                <br>
                                <div class="post_info">
                                    <a href="/categories/{{ $post->category->id }}" class="category">{{ $post->category->name }}</a>
                                    @foreach($post->teams as $team)   
                                        <a href="/teams/{{$team->id}}" class="team">{{ $team->name }}</a>
                                    @endforeach
                                </div>
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
                <div class="footer text-center">
                    <a href="{{ url($prevUrl) }}">戻る</a>
                </div>
            </div>
           
        </body>
    </x-app-layout>
    <script>
        function follow(userId) {
    $.ajax({
      // これがないと419エラーが出ます
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: `/follow/${userId}`,
      type: "POST",
    })
      .done((data) => {
      $('#follow').toggleClass('hidden')
      $('#unfollow').toggleClass('hidden')
      $('.follower_counter').html(data.follower_count)
        console.log("ok");
      })
      .fail((data) => {
        console.log("fail");
      });
  }  
  function unfollow(userId) {
    $.ajax({
      // これがないと419エラーが出ます
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: `/unfollow/${userId}`,
      type: "POST",
    })
      .done((data) => {
      $('#follow').toggleClass('hidden')
      $('#unfollow').toggleClass('hidden')
      $('.follower_counter').html(data.follower_count)
        console.log("ok");
      })
      .fail((data) => {
        console.log("fail");
      });
  }  
    </script>
</html>