<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500&display=swap" rel="stylesheet">

    <!-- <link rel="stylesheet" href="https://unpkg.com/destyle.css@1.0.5/destyle.css"> -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <header>
        <div class="container">
            <div class="title">
                <a href="{{route('posts.index')}}">けいじばん</a>
            </div>
            <div class="form">
                <form action="{{route('posts.index')}}" method="GET" class="search-form">
                    <div class="search-input">
                        <input type="text" placeholder="キーワードを入力してね" id="search" name="keyword">
                    </div>
                    <button type="submit" class="search-button">検索</button>
                </form>
                <div id="color-select">
                    <p id="colorText">背景色を選択</p>
                    <input id="colorPicker" type="color">
                </div>
            </div>
        </div>
    </header>

    <div class="thread-item">
        @if ($category)
        <a href="{{route('posts.index')}}">トップ</a> > <a href="{{route('posts.index',['category'=>$category->id])}}">{{$category->name}}</a> > {{ $post->name }}
        @endif
        <h1 class="thread-title">
            {{$post->name}}
        </h1>

        <div class="message">
            @if(is_null($reply->id))
            @foreach($replies as $reply)
            <div>
                <label>
                    <span>{{$reply->serial_number}}</span>
                    <span>名前:{{$reply->name}}</span>
                    <span>:{{$reply->created_at}}</span>
                </label>
                <a href="{{route('replies.create',['post'=>$post,'message'=>$message->id,'reply'=>$reply->id])}}" class="reply">返信</a>
                </label>
            </div>
            <div>
                <p>{{$reply->content}}</p>
            </div>
            @if($reply->childReplies->count() >=1)
            <div class="reply-count">
                <a href="{{route('replies.show',['post'=>$post,'message'=>$message->id,'reply'=>$reply->id])}}">{{$reply->childReplies->count()}}件の返信</a>
            </div>
            @endif
            <div class="favorite-count">
                <img src="{{asset('img/yuc0jy8d.png')}}">
                <a href="{{route('reply_favorite',$reply)}}" class="favorite-btn">
                    いいね
                    <span class="badge">
                        {{$reply->reply_favorites->count()}}
                    </span>
                </a>
            </div>
            @endforeach
            @elseif(!is_null($reply->id))
            @foreach($childReplies as $childReply)
            <div>
                <label>
                    <span>{{$childReply->serial_number}}</span>
                    <span>名前:{{$childReply->name}}</span>
                    <span>:{{$childReply->created_at}}</span>
                </label>
                <a href="{{route('replies.create',['post'=>$post,'message'=>$message->id,'reply'=>$childReply->id])}}" class="reply">返信</a>
                </label>
            </div>
            <div>
                <p>{{ $childReply->content }}</p>
            </div>
            @if($childReply->childReplies->count()>0)
            <div class="reply-count">
                <a href="{{route('replies.show',['post'=>$post,'message'=>$message->id,'reply'=>$childReply->id])}}">{{$childReply->childReplies->count()}}件の返信</a>
            </div>
            @endif
            <div class="favorite-count">
                <img src="{{asset('img/yuc0jy8d.png')}}">
                <a href="{{route('reply_favorite',$reply)}}" class="favorite-btn">
                    いいね
                    <span class="badge">
                        {{$reply->reply_favorites->count()}}
                    </span>
                </a>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</body>