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
                <div class="title_option  border-b border-solid border-gray-300">
                    <h1 class="title text-3xl">
                    {{ $post->title }}
                </h1>
                    
                </div>
                <div class="flex justify-between">
                    <div class="category_team">
                    <a class="category" href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                        @foreach($post->teams as $team)   
                            <a class="team" href="/teams/{{$team->id}}">{{ $team->name }}</a>
                        @endforeach
                    </div>
                <!--投稿者専用機能-->
                <div class="post_option flex ">
                        @if($post->user->id===$Auth)
                            <a href="/posts/{{ $post->id }}/edit"><button class="edit bg-blue-600 text-white text-center">edit</button></a>
                            <div>
                            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deletePost({{ $post->id }})" class="delete bg-red-600 text-white text-center">delete</button> 
                            </form>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="user flex">
                    <a href="/users/{{$post->user->id}}">{{ $post->user->name }}</a>
                    @if(Auth::id() != $post->user->id)
                       @if (Auth::user()->isFollowing($post->user->id))
                           <form action="{{ route('unfollow', ['user' => $post->user->id]) }}" method="POST">
                               {{ csrf_field() }}
                               {{ method_field('DELETE') }}
            
                               <button type="submit" class="unfollow bg-black text-white">フォロー解除</button>
                           </form>
                       @else
                           <form action="{{ route('follow', ['user' => $post->user->id]) }}" method="POST">
                               {{ csrf_field() }}
            
                               <button type="submit" class="follow bg-white text-black">フォローする</button>
                           </form>
                       @endif
                    @endif
                </div>
                <small>{{ $post->created_at}}</small>
                <div class="like border-b border-solid border-gray-300">
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
                <div class="post_content">
                    <p class="text-xl break-words">{!!nl2br($introduction)!!}</p>    
                </div>
            </div>
            <hr>
            <div class="comments text-center overflow-y-scroll h-4/6">
                <hr>
                <form action="/posts/{{$post->id}}/comments" method="POST" >
                    @csrf
                    <div class="comment_form">
                        <h2>comment</h2>
                        <textarea name="comment[body]" class="w-1/2"></textarea>
                        <br>
                        <input class="inline" type="submit" value="コメントする"/>
                    </div>
                </form>
                <hr>
                <div class="comment_content w-1/2 ">
                    @foreach($comments as $comment)
                        <div class="comment bg-white my-8">
                            <div class="comment_info text-left">
                                <small>{{$comment->created_at}}</small>
                                <br>
                                <a href="/users/{{$post->user->id}}">{{$comment->user->name}}より</a>
                            </div>
                            <div class="comment_body">
                                 <p class="text-left break-words">{{$comment->body}}</p>
                            </div>
                            @if($comment->user->id===Auth::id())
                                <form action="/posts/comments/{{$comment->id}}" id="form_{{ $comment->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="deleteComment({{ $comment->id }})" class="delete bg-red-600 text-white text-center">delete</button> 
                                </form>
                            @endif
                        </div>    
                    @endforeach
                </div>
            </div>
             <div class="footer text-center">
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
