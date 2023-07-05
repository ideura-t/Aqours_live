@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="sm:grid sm:grid-cols-3 sm:gap-10">
            <div class="sm:col-span-2">
                {{-- 投稿フォーム --}}
                @include('Aqours.index')
            </div>
        </div>
    @else
        <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
            <div class="hero-content text-center my-10">
                <div class="max-w-md mb-10">
                    
                    {{-- ユーザ登録ページへのリンク --}}
                    <a class="btn btn-primary btn-lg normal-case" href="{{ route('register') }}">アカウント登録はこちら!!!!</a>
                </div>
            </div>
        </div>
    @endif
@endsection