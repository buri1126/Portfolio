<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Football review</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
        <script src="https://kit.fontawesome.com/e881b85793.js" crossorigin="anonymous"></script>
        <script   src="https://code.jquery.com/jquery-3.7.0.min.js"   integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="   crossorigin="anonymous"></script>
    </head>
    <x-app-layout>
    <body>
         <div class="img w-3/4 lg:w-1/2">
                    <div class="swiper-container w-full mt-16">
                        <div class="swiper-wrapper">
                            @foreach($images as $image)
                                <img src="{{$image->image_url}}" class="swiper-slide bg-white w-full" alt="画像が読み込めません"/>
                            @endforeach
                            <div class="swiper-button-prev"></div>
        		            <div class="swiper-button-next"></div>
                            <div class="swiper-pagination"></div>
                        </div>
                	
                    </div>
            </div>
        <div class="show_component h-screen w-3/4 lg:w-1/2 mt-16">
            <div class="post m-5">
                <div class="title_option ">
                    <div class="flex justify-between">
                        <div>
                            <h1 class="title text-4xl">
                                {{ $post->title }}
                            </h1>
                            <div class="like">
                                @if (!$post->isLikedBy(Auth::user()))
                                    <span class="likes">
                                        <i class="fa-solid fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
                                        <span class="like-counter">{{$post->likes->count()}}</span>
                                    </span>
                                 @else
                                    <span class="likes">
                                        <i class="fa-solid fa-heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
                                        <span class="like-counter">{{$post->likes->count()}}</span>
                                    </span>
                                 @endif
                            </div>
                            <div class="flex flex-col">
                                <div class="user flex">
                                    <a href="/users/{{$post->user->id}}"><i class="fa-solid fa-user"></i>{{ $post->user->name }}</a>
                                     @if(Auth::id() != $post->user->id)
                                       @if (Auth::user()->isFollowing($post->user->id))
                                            @if(!Auth::user()->isFollowed($post->user->id))
                                                <button onclick="follow({{ $post->user->id }})" id="follow" class="bg-white text-black hidden ml-1 follow_button">フォローする</button>
                                            @else
                                                <button onclick="follow({{ $post->user->id }})" id="follow" class="bg-white text-black hidden ml-1 follow_button">フォローバック</button>
                                            @endif
                                            <button onclick="unfollow({{ $post->user->id }})" id="unfollow" class="bg-black text-white ml-1">フォロー中</button>
                                        @else
                                            @if(!Auth::user()->isFollowed($post->user->id))
                                                <button onclick="follow({{ $post->user->id }})" id="follow" class="bg-white text-black ml-1 follow_button">フォローする</button>
                                            @else
                                                <button onclick="follow({{ $post->user->id }})" id="follow" class="bg-white text-black ml-1 follow_button">フォローバック</button>
                                            @endif
                                            <button onclick="unfollow({{ $post->user->id }})" id="unfollow" class="bg-black text-white hidden ml-1">フォロー中</button>
                                        @endif
                                    @endif
                                </div>
                                <small>{{ $post->created_at}}</small>
                            </div>
                        </div>
                        <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                            </button>
                        </x-slot>
    
                        <x-slot name="content">
                             <x-dropdown-link href="/posts/{{$post->id}}/edit" class="hover:text-blue-600">
                               <p>edit</p>
                            </x-dropdown-link>
                            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <x-dropdown-link onclick="deletePost({{ $post->id }})" class="hover:text-red-600">
                                        <p>delete</p>
                                    </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                    </div>
                </div>
                <div class="my-4">
                    <div class="category_team">
                    <a class="category" href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                        @foreach($post->teams as $team)   
                            <a class="team" href="/teams/{{$team->id}}">{{ $team->name }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="post_content">
                    <p class="text-2xl break-words">{!!nl2br($introduction)!!}</p>    
                </div>
            </div>
            <div class="comments text-center  border-y border-solid border-gray-300">
                <h2 >comment</h2>
                <div class="comment_content overflow-y-scroll w-1/2 ">
                    @foreach($comments as $comment)
                        <div class="comment mb-8">
                            <div class="flex flex-row justify-between">
                            <div class="comment_info text-left flex flex-col">
                                <a href="/users/{{$post->user->id}}"><i class="fa-regular fa-user"></i>{{$comment->user->name}}</a>
                                <small class="text-xs">{{$comment->created_at}}</small>
                            </div>
                             @if($comment->user->id===Auth::id())
                                <x-dropdown align="left" width="48">
                                    <x-slot name="trigger">
                                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                        </button>
                                    </x-slot>
                
                                    <x-slot name="content">
                                        <form action="/posts/comments/{{ $comment->id }}" id="form_{{ $comment->id }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <x-dropdown-link onclick="deleteComment({{ $comment->id }})" class="hover:text-red-600">
                                                    <p>delete</p>
                                                </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @endif
                            </div>
                            <div class="comment_body mt-1">
                                 <p class="text-left break-words">{!!nl2br(e($comment->body))!!}</p>
                            </div>
                           
                        </div>    
                    @endforeach
                </div>
                <form action="/posts/{{$post->id}}/comments" method="POST" >
                    @csrf
                    <div class="comment_form">
                        <textarea name="comment[body]" class="w-1/2" placeholder="筆者と意見を交換しましょう"></textarea>
                        <br>
                        <button class="comment_button hover:bg-green-600 hover:text-white bg-white text-green-600"><input class="inline" type="submit" value="コメントする"/></button>
                    </div>
                </form>
            </div>
            <div class="footer text-center mt-3">
                <a href="/">ホームに戻る</a>
                 <a href="/users/{{$post->user->id}}">アカウントに戻る</a>
            </div>
        </div>
    </body>
    <script>
    $(function () {
  let like = $('.like-toggle'); 
  let likePostId; 
  like.on('click', function () { 
    let $this = $(this);
    likePostId = $this.data('post-id'); 

    $.ajax({
      headers: { 
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
      }, 
      url: '/like',
      method: 'POST', 
      data: {
        'post_id': likePostId 
      },
    })
   
    .done(function (data) {
      $this.toggleClass('liked'); 
      $this.next('.like-counter').html(data.post_likes_count);
    })
    .fail(function () {
      console.log('fail'); 
    });
  });
  });
  
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
        console.log("ok");
      })
      .fail((data) => {
        console.log("fail");
      });
  }  
        function deletePost(id) {
            'use strict'
           
      console.log(document.getElementById(`form_${id}`));
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    
        function deleteComment(id) {
            'use strict'
          
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="{{asset('/js/app.js')}}"></script>
    </x-app-layout>
</html>
