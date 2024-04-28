<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>けいじばん</title>

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

    <div class="wrapper">

        <div class="thread-item">
            @if ($category)
            <a href="{{route('posts.index')}}">トップ</a> > <a href="{{route('posts.index',['category'=>$category->id])}}">{{$category->name}}</a> > {{ $post->name }}
            @endif
            <h1 class="thread-title">
                {{$post->name}}
            </h1>

            <div class="message">
                @foreach($sorted as $item)
                @if($item instanceof App\Models\Message)
                <div>
                    <label>
                        <span>{{$item->serial_number}}</span>
                        <span>名前:{{$item->name}}</span>
                        <span>:{{$item->created_at}}</span>
                    </label>
                    @if(isset($reply))
                    <a href="{{route('replies.create',['post'=>$post,'message'=>$item->id,'reply'=>$item->id])}}" class="reply">返信</a>
                    @else
                    <a href="{{route('replies.create',['post'=>$post,'message'=>$item->id])}}" class="reply">返信</a>
                    @endif
                    </label>
                </div>
                <div>
                    <p>{{$item->content}}</p>
                </div>
                @if($item->replies()->count() >=1)
                <div class="reply-count">
                    <a href="{{route('replies.show',['post'=>$post,'message'=>$item->id])}}">{{$item->replies->count()}}件の返信</a>
                </div>
                @endif
                <div class="favorite-count">
                    <img src="{{asset('img/yuc0jy8d.png')}}">
                    <a href="{{route('message_favorite',['message'=>$item->id])}}" class="favorite-btn">
                        いいね
                        <span class="badge">
                            {{$item->message_favorites->count()}}
                        </span>
                    </a>
                </div>


                @elseif($item instanceof App\Models\Reply)
                <div>
                    <label>
                        <span>{{$item->serial_number}}</span>
                        <span>名前:{{$item->name}}</span>
                        <span>:{{$item->created_at}}</span>
                    </label>
                     @if(isset($reply))
                    <a href="{{route('replies.create',['post'=>$post,'message'=>$item->id,'reply'=>$item->id])}}" class="reply">返信</a>
                    @else
                    <a href="{{route('replies.create',['post'=>$post,'message'=>$item->id])}}" class="reply">返信</a>
                    @endif
                    </label>
                </div>
                <div>
                    <p>{{$item->content}}</p>
                </div>
                @if($item->childReplies()->count() >=1)
                <div class="reply-count">
                    <a href="{{route('replies.show',['post'=>$post,'message'=>$item->id,'reply'=>$item->id])}}">{{$item->childReplies()->count()}}件の返信</a>
                </div>
                @endif
                <div class="favorite-count">
                    <img src="{{asset('img/yuc0jy8d.png')}}">
                    <a href="{{route('reply_favorite',['reply'=>$item->id])}}" class="favorite-btn">
                        いいね
                        <span class="badge">
                            {{$item->reply_favorites->count()}}
                        </span>
                    </a>
                </div>
                @endif
                @endforeach
            </div>

            <div class="message-form">
                <form method="POST" action="{{route('messages.store')}}" class="message-area">
                    @csrf
                    @error('content')
                    <strong>投稿内容を入力してください</strong>
                    @enderror
                    <label>
                        名前
                        <input type="string" name="name" class="name-input" size="19">
                    </label>
                    <div>
                        <textarea name="content" id="messageContent" rows="6" cols="90" placeholder="コメントを書く"></textarea>
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                    </div>
                    <input id="btn" class="message-button" type="submit" value="コメントを投稿する" disabled="true">
                </form>
            </div>
        </div>


        <div class="aside">
            @component('components.sidebar', ['categories' => $categories, 'major_category_names' => $major_category_names])
            @endcomponent
        </div>
    </div>




    @component('components.footer')
    @endcomponent
    <script>
        /*const inputText = document.querySelector('#messageContent');
        const btn = document.querySelector('#btn');

        inputText.addEventListener('input', () => {
            if (inputText.value.trim() !== "") {
                btn.removeAttribute('disabled');
            } else {
                btn.setAttribute('disabled', 'disabled');
            }
        });*/
    </script>

</body>

</html>