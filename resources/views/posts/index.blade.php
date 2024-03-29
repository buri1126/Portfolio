<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Football review</title>
        <!-- Fonts -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
        <script   src="https://code.jquery.com/jquery-3.7.0.min.js"   integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="   crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/e881b85793.js" crossorigin="anonymous"></script>
    </head>
    <x-app-layout>
        <body>
            <div class="component flex mt-16 h-screen">
                <div class="leftbar lg:w-2/12 w-3/12 h-screen overflow-y-scroll text-left pt-8">
                    <div class="post_select text-center mt-5">
                        <a href="/" class="flex flex-col w-3/5 bg-white break-words  rounded-xl">all</a>
                        <a href="/posts/follow" class="flex flex-col w-3/5 bg-white break-words  rounded-xl">following</a>
                    </div>
                    <div class='category_index text-center mt-5'>
                        <p class="text-xl">categories</p>
                        @foreach($categories as $category)
                            @if($category->id===1)
                            @else
                                <a href="/categories/{{ $category->id }}" class="category flex flex-col w-3/5 bg-white break-words  rounded-xl">{{ $category->name }}</a>
                            @endif
                        @endforeach
                    </div>
                    <br>
                    <div class="team_index text-center mt-5">
                        <p class="text-xl">teams</p>
                        <div class="teams">
                            @foreach($teams as $team)
                                @if($team->id===1)
                                @else
                                    <a href="/teams/{{$team->id}}" class="team flex flex-col w-3/5 bg-white break-words  rounded-xl">{{$team->name}}</a>
                                 @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="index  lg:w-6/12 w-9/12 h-screen text-center border-r border-l border-gray-300 border-solid">
                    <div>
                        <button class="create_button hover:scale-110"><a href="/posts/create"><i class="fa-solid fa-plus"></i></a></button>
                    </div>
                    <div class="serch text-center w-fit">
                        <form action="/" class="serch_form flex w-fit justify-between">
                            <input type="text" name="keyword" placeholder="キーワード" class="serchword" value="{{request('keyword')}}" autocomplete = "off">
                            <div class="flex">
                                <i class="fa-solid fa-delete-left delete_word"></i>
                                <button type="submit" class="serch_button p-4"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class='posts w-3/4 overflow-y-scroll rounded'>
                        @if($postscount===0)
                            <p>投稿がありません</p>
                        @else
                            <p>{{$postscount}}件の投稿があります</p>
                        @endif
                        @foreach ($posts as $post)
                            <div class='post text-left bg-white rounded-xl hover:scale-110'>
                                <div class="ml-8">
                                    <div class="title">
                                    <a href="/posts/{{ $post->id }}" class="text-3xl break-words">{{ $post->title }}</a>
                                    </div>
                                    <a href="/categories/{{ $post->category->id }}" class="category " >{{ $post->category->name }}</a>
                                    @foreach($post->teams as $team)   
                                        <a href="/teams/{{$team->id}}" class="team ">{{ $team->name }}</a>
                                    @endforeach
                                    <br>
                                    <a href="/users/{{$post->user->id}}" class="user"><i class="fa-solid fa-user"></i>{{ $post->user->name }}</a>
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
                </div>
                <div class="rightbar lg:w-4/12 h-screen lg:block hidden  text-left overflow-y-scroll pt-8">
                    <div class='like_ranking_section text-center mb-10 pb-10 rounded-xl w-full'>
                        <p class="like_title"><span>いいねランキング</span></p>
                        <div class="ranking_table overflow-y-scroll flex flex-col ">
                            @if(isset($likes_ranking[0]))
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
                            @else
                                <p class="ranking_frase px-3 py-5 text-center bg-white w-3/4">ランクインする投稿はありません</p>
                            @endif
                        </div>
                    </div>
                    <div class='comment_ranking_section text-center mt-10 pb-10 rounded-xl  w-full'>
                        <p class="comment_title"><span>コメントランキング</span></p>
                        <div class="ranking_table overflow-y-scroll flex flex-col">
                            @if(isset($comments_ranking[0]))
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
                            @else
                                <p class="ranking_frase px-3 py-5 text-center bg-white w-3/4">ランクインする投稿はありません</p>
                            @endif
                        </div>
                 </div>
            </div>
        </body>
    </x-app-layout>
    <script>
         $(".delete_word").on("click", function(){
            $(".serchword").val('');
          });
    </script>
</html>