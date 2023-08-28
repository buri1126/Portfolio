<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Football review</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
        <script src="https://kit.fontawesome.com/e881b85793.js" crossorigin="anonymous"></script>
    </head>
    <x-app-layout>
        <body>
            <div class="component flex mt-16 h-screen">
                <div class="leftbar   lg:w-2/12 w-3/12 h-11/12 overflow-y-scroll text-left pt-8">
                    <div class="post_select text-center mt-5">
                        <a href="/" class="flex flex-col w-3/5 bg-white break-words rounded-xl">home</a>
                        <a href="/categories/{{$category->id}}" class="flex flex-col w-3/5 bg-white break-words rounded-xl">all</a>
                        <a href="/categories/{{$category->id}}/follow" class="flex flex-col w-3/5 bg-white break-words rounded-xl">following</a>
                    </div>
                    <div class='category_index text-center mt-5'>
                        <p class="border-b border-gray-300 border-solid ">categories</p>
                        @foreach($categories as $category)
                            @if($category->id===1)
                            @else
                                <a href="/categories/{{ $category->id }}/follow" class="category flex flex-col w-3/5 bg-white break-words rounded-xl">{{ $category->name }}</a>
                            @endif
                        @endforeach
                    </div>
                    <br>
                    <div class="team_index text-center mt-5">
                        <p class="border-b border-gray-300 border-solid">teams</p>
                        <div class="teams">
                            @foreach($teams as $team)
                                @if($team->id===1)
                                @else
                                    <a href="/teams/{{$team->id}}/follow" class="team flex flex-col w-3/5 bg-white break-words rounded-xl">{{$team->name}}</a>
                                 @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="index lg:w-6/12 w-9/12 text-center border-r border-l border-gray-300 border-solid">
                    <div>
                        <button class="create_button hover:scale-110"><a href="/posts/create"><i class="fa-solid fa-plus"></i></a></button>
                    </div>
                    <div class="serch text-center">
                        @foreach($posts as $post)
                        <form action="/categories/{{$post->category->id}}" class="serch_form">
                            <input type="text" name="keyword" placeholder="キーワード" class="serchword" autocomplete="off">
                            <button type="submit" class="serch_button p-4"><i class="fas fa-search"></i></button>
                        </form>
                        @break
                        @endforeach
                    </div>
                    <p>フォロー中のユーザーの投稿</p>
                    <div class='posts w-3/4 overflow-y-scroll h-4/5'>
                         @if($postscount===0)
                            <p>投稿がありません</p>
                        @else
                            <p>{{$postscount}}件の投稿があります</p>
                        @endif
                        @foreach ($posts as $post)
                            @if($post->user->id!==Auth::id())   
                                <div class='post text-left bg-white rounded-xl hover:scale-110'>
                                    <div class="ml-8">
                                        <div class="title">
                                        <a href="/posts/{{ $post->id }}" class="text-3xl">{{ $post->title }}</a>
                                        </div>
                                        <a href="/categories/{{ $post->category->id }}" class="category" >{{ $post->category->name }}</a>
                                        @foreach($post->teams as $team)   
                                            <a href="/teams/{{$team->id}}" class="team">{{ $team->name }}</a>
                                        @endforeach
                                        <br>
                                        <a href="/users/{{$post->user->id}}" class="user">{{ $post->user->name }}</a>
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
                            @else
                            @endif
                        @endforeach
                    </div>
                    <div class="footer text-center">
                        <a href="#" onclick="history.back(); return false;">戻る</a>
                    </div>

                </div>
                <div class="rightbar lg:w-4/12 h-11/12 lg:block hidden  text-left overflow-y-scroll pt-8">
                    <div class='like_ranking_section text-center mb-10 pb-10 rounded-xl overflow-y-scroll w-full'>
                        <p class="like_title"><span>いいねランキング</span></p>
                        <div class="ranking_table flex flex-col ">
                            <table class="like_ranking  rounded-xl">
                                @foreach($likes_ranking as $like_rank)
                                    <tbody>
                                        <tr class="border-2 border-solid border-white ">
                                            <td class="bg-red-300  px-3">
                                                <div class="rank flex">
                                                    @if($like_rank->like_sum_rank===1)
                                                        <i class="fa-solid fa-medal" style="color: gold;"></i>
                                                    @elseif($like_rank->like_sum_rank===2)
                                                        <i class="fa-solid fa-medal" style="color: #d6d6d6;"></i>
                                                    @elseif($like_rank->like_sum_rank===3)
                                                        <i class="fa-solid fa-medal" style="color: brown;"></i>
                                                    @endif
                                                    <p>{{$like_rank->like_sum_rank}}位</p>
                                                </div>
                                            </td>
                                            <td class="bg-red-300">
                                                @if(Auth::id()===$like_rank->user_id)
                                                    <div class="mypost flex flex-col rank_post_info bg-white m-3 rounded-xl px-3 hover:scale-110">
                                                        <div class="like_rank  ml-2 text-left">
                                                            <a href="/posts/{{$like_rank->id}}" class="text-3xl text-left break-words">{{$like_rank->title}}</a>
                                                        </div>
                                                        <div class="like_rank_info flex flex-col ml-2">
                                                            <p class="text-left"><i class="fa-solid fa-user"></i>{{$like_rank->user->name}}</p>
                                                            <small class="break-words text-left">{{$like_rank->created_at}}</small>
                                                        </div>
                                                            <p class="text-left ml-2"><span class="fa-solid fa-heart" style="color: #ff0000;"></span>{{$like_rank->like_sum}}</p>
                                                    </div>
                                                @else
                                                    <div class="userpost flex flex-col rank_post_info bg-white m-3 rounded-xl px-3 hover:scale-110">
                                                        <div class="like_rank  ml-2 text-left" >
                                                            <a href="/posts/{{$like_rank->id}}" class="text-3xl text-left break-words">{{$like_rank->title}}</a>
                                                        </div>
                                                        <div class="like_rank_info flex flex-col ml-2">
                                                            <p class="text-left"><i class="fa-solid fa-user"></i>{{$like_rank->user->name}}</p>
                                                            <small class="break-words text-left">{{$like_rank->created_at}}</small>
                                                        </div>
                                                            <p class="text-left ml-2"><span class="fa-solid fa-heart" style="color: #ff0000;"></span>{{$like_rank->like_sum}}</p>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class='comment_ranking_section text-center mt-10 pb-10 rounded-xl overflow-y-scroll w-full'>
                        <p class="comment_title"><span>コメントランキング</span></p>
                        <div class="ranking_table">
                            <table class="comment_ranking">
                                @foreach($comments_ranking as $comment_rank)
                                        <tbody >
                                           <tr class="border-2 border-solid border-white ">
                                                <td class="bg-blue-300  px-3">
                                                    <div class="flex mt-3">
                                                    @if($comment_rank->comment_sum_rank===1)
                                                        <i class="fa-solid fa-medal" style="color: gold;"></i>
                                                    @elseif($comment_rank->comment_sum_rank===2)
                                                        <i class="fa-solid fa-medal" style="color: #d6d6d6;"></i>
                                                    @elseif($comment_rank->comment_sum_rank===3)
                                                        <i class="fa-solid fa-medal" style="color: brown;"></i>
                                                    @endif
                                                    <p>{{$comment_rank->comment_sum_rank}}位</p>
                                                    </div>
                                                </td>
                                                <td class="bg-blue-300">
                                                    @if(Auth::id()===$comment_rank->user_id)
                                                        <div class="mypost flex flex-col rank_post_info bg-white m-3 px-3 rounded-xl hover:scale-110">
                                                            <div class="comment_rank ml-2 text-left">
                                                                <a href="/posts/{{$comment_rank->id}}" class="text-3xl text-left break-words">{{$comment_rank->title}}</a>
                                                            </div>
                                                            <div class="comment_rank_info ml-2 flex flex-col">
                                                                <p class="text-left"><i class="fa-solid fa-user"></i>{{$comment_rank->user->name}}</p>
                                                                <small class="break-words text-left">{{$comment_rank->created_at}}</small>
                                                            </div>
                                                                <p class="text-left ml-2"><span class="fa-regular fa-comment"></span>{{$comment_rank->comment_sum}}</p>
                                                        </div>
                                                    @else
                                                        <div class="userpost flex flex-col rank_post_info bg-white m-3 px-3 rounded-xl hover:scale-110">
                                                            <div class="comment_rank ml-2 text-left">
                                                                <a href="/posts/{{$comment_rank->id}}" class="text-3xl text-left break-words">{{$comment_rank->title}}</a>
                                                            </div>
                                                            <div class="comment_rank_info ml-2 flex flex-col">
                                                                <p class="text-left"><i class="fa-solid fa-user"></i>{{$comment_rank->user->name}}</p>
                                                                <small class="break-words text-left">{{$comment_rank->created_at}}</small>
                                                            </div>
                                                                <p class="text-left ml-2"><span class="fa-regular fa-comment"></span>{{$comment_rank->comment_sum}}</p>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                @endforeach
                            </table>
                        </div>
                 </div>
            </div>
        </body>
    </x-app-layout>
</html>