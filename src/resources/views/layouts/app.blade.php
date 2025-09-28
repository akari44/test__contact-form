<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
<!--文字 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')


</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__inner-logo">
                <h1 class="header__logo-title">
                Fashionably Late
                </h1>
            </div>
            
            <div class="header__inner-btn">
                <a href="@yield('header_btn_route')" class="header__title-btn">
                @yield('title_btn_text')
                </a>
            </div>

        </div>
    </header>

    <main>
    @yield('content')
    </main>

</body>

</html>