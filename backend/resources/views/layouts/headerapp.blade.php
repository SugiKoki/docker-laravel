<html>
<head>
    <title>@yield('title')</title>
    <link href="{{ asset('css/common/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/common/common.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/common/blackboard.css') }}" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
    @section('header')
    <header>
        <div class="content">
          <ul class="top-head">
            <li class="system-name"><a href="calendar">予定管理システム　～くろのん～</a></li>
            <li class="company-name"><img class="top-head-image" alt="くろ☆のすロゴ" src="{{ asset('img/star/logo_header.png') }}">（株）くろ☆のす</li>
          </ul>
          <ul class="nav">
            <li><a href="calendar">予定確認</a></li>
            <li><a href="schedulenew">予定登録</a></li>
            <li><a href="actualindex">実績確認</a></li>
            <div class="nav-right">
              <div class="nav-right-img">
                <a type="button" class="logout-button"><img class="logout-icon" alt="ログアウト" src="{{ asset('img/logout_icon.png') }}"></a>
              </div>
              <div class="nav-right-user"><c:out value="${userName}"></c:out>としてログイン中</div>
            </div>
          </ul>
        </div>
        <div class="popup-wrapper back-popup">
          <div class="pop-container">
            <div class="close-popup"> <img src="{{ asset('img/close_button_orange.png') }}" alt="閉じる" class="back-button"> </div>
            <div class="pop-container-inner">
              <div class="message-container">
                <p> </p><br>
                <h2 class="message-title">本当にログアウトする？</h2>
              </div>
              <a href="../logout"><span class="ok-button">OK</span></a>
              <div class="ng-button close-popup">キャンセル</div>
              <img src="{{ asset('img/star/star_angry.png') }}" class="pop-img-top">
            </div>
            </div>
        </div>
        <script src="{{ asset('js/logout.js') }}"></script>
        <script src="{{ asset('js/common/common.js') }}"></script>
    </header>
    @show
    {{--  <h1>@yield('title')</h1>  --}}
    {{--  @section('menubar')
    <h2 class="menutitle">※メニュー</h2>
    <ul>
        <li>@show</li>
    </ul>
    <hr size="1">
    <div class="content">
        @yield('content')
    </div>
    <div class="footer">
        @yield('footer')
    </div>  --}}
</body>
</html>