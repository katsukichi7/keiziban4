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
                        <input type="text" placeholder="キーワードを入力してね" id="search" name="search">
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

    <div class="side">
        @component('components.sidebar', ['categories' => $categories, 'major_category_names' => $major_category_names])
        @endcomponent
    </div>

    @component('components.footer')
    @endcomponent
</body>

</html>