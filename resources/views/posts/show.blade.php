<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
    <body>
        <div class="show_component">
            <div class="post">
                @foreach($images as $image)
                    <div class="image">
                        <img src="{{$image->image_url}}" alt="画像が読み込めません"/>
                    </div>
                @endforeach
                <div class="title_option">
                    <h1 class="title">
                    {{ $post->title }}
                </h1>
                <!--投稿者専用機能-->
                <div class="post_option">
                    @if($post->user->id===$Auth)
                        <div class="edit"><a href="/posts/{{ $post->id }}/edit">edit</a></div>
                        
                        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deletePost({{ $post->id }})">delete</button> 
                        </form>
                    @endif
                </div>
                </div>
            
                <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                @foreach($post->teams as $team)   
                    <a href="/teams/{{$team->id}}">{{ $team->name }}</a>
                @endforeach
                <br>
                <div class="user">
                    <a href="/users/{{$post->user->id}}">{{ $post->user->name }}</a>
                    @if(Auth::id() != $post->user->id)
                       @if (Auth::user()->isFollowing($post->user->id))
                           <form action="{{ route('unfollow', ['user' => $post->user->id]) }}" method="POST">
                               {{ csrf_field() }}
                               {{ method_field('DELETE') }}
            
                               <button type="submit" >フォロー解除</button>
                           </form>
                       @else
                           <form action="{{ route('follow', ['user' => $post->user->id]) }}" method="POST">
                               {{ csrf_field() }}
            
                               <button type="submit" >フォローする</button>
                           </form>
                       @endif
                    @endif
                </div>
                <small>{{ $post->created_at}}</small>
                <div class="like">
                  @if($post->is_liked_by_auth_user())
                    <a href="{{ route('unlike', ['id' => $post->id]) }}" class="btn btn-success btn-sm">いいねを取り消す<span class="badge">{{ $post->likes->count() }}</span></a>
                  @else
                    <a href="{{ route('like', ['id' => $post->id]) }}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
                  @endif
                </div>
                
                <div class="post_content">
                    <h3>本文</h3>
                    <p>{{ $post->body }}</p>    
                </div>
            </div>
            <hr>
            <div class="comment">
                <hr>
                <form action="/posts/{{$post->id}}/comments" method="POST" >
                    @csrf
                    <div class="comment_form">
                        <h2>comment</h2>
                        <textarea name="comment[body]"></textarea>
                        <br>
                        <input type="submit" value="コメントする"/>
                    </div>
                </form>
                <hr>
                <div class="comment_content">
                    @foreach($comments as $comment)
                        <a href="/users/{{$post->user->id}}">{{$comment->user->name}}より</a>
                        <small>{{$comment->created_at}}</small>
                        <p>{{$comment->body}}</p>
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
            <div class="footer">
                <a href="/">戻る</a>
            </div>
        </div>
        
    </body>
    <!--あとでjsファイルに移動-->
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
    </x-app-layout>
</html>
