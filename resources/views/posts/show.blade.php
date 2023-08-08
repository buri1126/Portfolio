<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Football review</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
        <script src="https://kit.fontawesome.com/e881b85793.js" crossorigin="anonymous"></script>
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
                <div class="title_option flex justify-between border-b border-solid border-gray-300">
                    <h1 class="title text-3xl">
                    {{ $post->title }}
                </h1>
                <!--投稿者専用機能-->
                    <div class="post_option flex ">
                        @if($post->user->id===$Auth)
                            <a href="/posts/{{ $post->id }}/edit"><button class="edit bg-blue-600 text-white text-center">edit</button></a>
                            <div class="delete bg-red-600 text-white w-1/2 text-center">
                            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deletePost({{ $post->id }})" >delete</button> 
                            </form>
                            </div>
                        @endif
                </div>
                </div>
                <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                @foreach($post->teams as $team)   
                    <a href="/teams/{{$team->id}}">{{ $team->name }}</a>
                @endforeach
                <br>
                <div class="user flex">
                    <a href="/users/{{$post->user->id}}">{{ $post->user->name }}</a>
                    @if(Auth::id() != $post->user->id)
                       @if (Auth::user()->isFollowing($post->user->id))
                           <form action="{{ route('unfollow', ['user' => $post->user->id]) }}" method="POST">
                               {{ csrf_field() }}
                               {{ method_field('DELETE') }}
            
                               <button type="submit" class="unfollow">フォロー解除</button>
                           </form>
                       @else
                           <form action="{{ route('follow', ['user' => $post->user->id]) }}" method="POST">
                               {{ csrf_field() }}
            
                               <button type="submit" class="follow">フォローする</button>
                           </form>
                       @endif
                    @endif
                </div>
                <small>{{ $post->created_at}}</small>
                <div class="like border-b border-solid border-gray-300">
                  @if($post->is_liked_by_auth_user())
                    <a href="{{ route('unlike', ['id' => $post->id]) }}" class="btn btn-success btn-sm">いいねを取り消す<span class="fa-solid fa-heart" style="color: #ff0000;"></span><span class="badge">{{ $post->likes->count() }}</span></a>
                  @else
                    <a href="{{ route('like', ['id' => $post->id]) }}" class="btn btn-secondary btn-sm">いいね<span class="fa-regular fa-heart" style="color: #050505;"></span><span class="badge">{{ $post->likes->count() }}</span></a>
                  @endif
                </div>
                <div class="post_content">
                    <p class="text-xl break-words">{{ $post->body }}</p>    
                </div>
            </div>
            <hr>
            <div class="comment text-center overflow-y-scroll h-4/6">
                <hr>
                <form action="/posts/{{$post->id}}/comments" method="POST" >
                    @csrf
                    <div class="comment_form">
                        <h2>comment</h2>
                        <textarea name="comment[body]"></textarea>
                        <br>
                        <input class="inline" type="submit" value="コメントする"/>
                    </div>
                </form>
                <hr>
                <div class="comment_content w-1/2 ">
                    @foreach($comments as $comment)
                        <div class="comment_info text-left">
                            <small>{{$comment->created_at}}</small>
                            <br>
                            <a href="/users/{{$post->user->id}}">{{$comment->user->name}}より</a>
                        </div>
                        <div class="comment_body">
                             <p class="text-left break-words">{{$comment->body}}</p>
                        </div>
                        @if($comment->user->id===$Auth)
                            <form action="/posts/comments/{{$comment->id}}" id="form_{{ $comment->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="deleteComment({{ $comment->id }})">delete</button> 
                            </form>
                        @endif
                        <hr>
                    @endforeach
                </div>
            </div>
             <div class="footer text-center">
                <a href="{{ url($prevUrl) }}">戻る</a>
            </div>
        </div>
    </body>
    <script>
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
