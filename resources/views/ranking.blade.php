<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Football review</title>
        <!-- Fonts -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/style.css')  }}">
    </head>
    <x-app-layout>
        <body>
            <div class="ranking_component flex flex-col  w-11/12 md:w-4/6 mt-16 h-fit">
                <div class="flex flex-col md:flex-row mt-16">
                    <div class='like_ranking_section text-center mb-10 pb-10 rounded-xl  w-full'>
                        <p class="like_title"><span>いいねランキング</span></p>
                        <div class="ranking_table flex flex-col overflow-y-scroll">
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
                    <div class='comment_ranking_section text-center mb-10 pb-10 rounded-xl  w-full'>
                        <p class="comment_title"><span>コメントランキング</span></p>
                        <div class="ranking_table overflow-y-scroll flex flex-col">
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
                <div class="footer text-center">
                    <button><a href="{{ url($prevUrl) }}">戻る</a></button>
                </div>
            </div>
        </body>
    </x-app-layout>
</html>