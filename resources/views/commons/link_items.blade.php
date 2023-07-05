@if (Auth::check())
    {{-- ユーザ一覧ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('Aqours.create') }}">ライブ登録</a></li>

    <li><a class="link link-hover" href="#" onclick="event.preventDefault();this.closest('form').submit();">ログアウト</a></li>
@else
    {{-- ユーザ登録ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('register') }}">アカウント登録</a></li>
    <li class="divider lg:hidden"></li>
    {{-- ログインページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('login') }}">ログイン</a></li>
@endif