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
                    <div class='like_ranking_section text-center mt-12  mb-10 pb-10 rounded-xl overflow-y-scroll w-full'>
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
                                                    <div class="mypost flex flex-col rank_post_info bg-white m-3 rounded-xl hover:scale-110">
                                                        <div class="like_rank flex ml-2">
                                                            <a href="/posts/{{$like_rank->id}}" class="text-3xl">{{$like_rank->title}}</a>
                                                            <p><span class="fa-solid fa-heart" style="color: #ff0000;"></span>{{$like_rank->like_sum}}</p>
                                                        </div>
                                                        <div class="like_rank_info flex ml-2">
                                                            <p><i class="fa-solid fa-user"></i>{{$like_rank->user->name}}</p>
                                                            <small class="break-words">{{$like_rank->created_at}}</small>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="flex flex-col rank_post_info bg-white m-3 rounded-xl hover:scale-110">
                                                        <div class="like_rank flex ml-2">
                                                            <a href="/posts/{{$like_rank->id}}" class="text-3xl">{{$like_rank->title}}</a>
                                                            <p><span class="fa-solid fa-heart" style="color: #ff0000;"></span>{{$like_rank->like_sum}}</p>
                                                        </div>
                                                        <div class="like_rank_info flex ml-2">
                                                            <p><i class="fa-solid fa-user"></i>{{$like_rank->user->name}}</p>
                                                            <small class="break-words">{{$like_rank->created_at}}</small>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class='comment_ranking_section text-center mt-12 pb-10 rounded-xl overflow-y-scroll w-full'>
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
                                                        <div class="mypost flex flex-col rank_post_info bg-white m-3 rounded-xl hover:scale-110">
                                                            <div class="comment_rank ml-2 flex">
                                                                <a href="/posts/{{$comment_rank->id}}" class="text-3xl">{{$comment_rank->title}}</a>
                                                                <p><span class="fa-regular fa-comment"></span>{{$comment_rank->comment_sum}}</p>
                                                            </div>
                                                            <div class="comment_rank_info ml-2 flex">
                                                                <p><i class="fa-solid fa-user"></i>{{$comment_rank->user->name}}</p>
                                                                <small class="break-words">{{$comment_rank->created_at}}</small>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="flex flex-col rank_post_info bg-white m-3 rounded-xl hover:scale-110">
                                                            <div class="comment_rank ml-2 flex">
                                                                <a href="/posts/{{$comment_rank->id}}" class="text-3xl">{{$comment_rank->title}}</a>
                                                                <p><span class="fa-regular fa-comment"></span>{{$comment_rank->comment_sum}}</p>
                                                            </div>
                                                            <div class="comment_rank_info ml-2 flex">
                                                                <p><i class="fa-solid fa-user"></i>{{$comment_rank->user->name}}</p>
                                                                <small class="break-words">{{$comment_rank->created_at}}</small>
                                                            </div>
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
                    <a href="{{ url($prevUrl) }}">戻る</a>
                </div>
            </div>
        </body>
    </x-app-layout>
</html>