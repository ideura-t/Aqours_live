@extends('layouts.app')

@section('content')

<div class="prose ml-4">
    <h3>ライブ登録</h3>
</div>

<div class="flex justify-center">
    <form method="POST" action="{{ route('Aqours.store') }}" class="w-1/2">
        @csrf

        <div class="form-control my-4">
            <label for="live_title" class="label">
                <span class="label-text">ライブ名</span>
            </label>
            <input type="text" name="live_title" class="input input-bordered w-full">
        </div>

        <div class="form-control my-4">
            <label for="venue" class="label">
                <span class="label-text">会場名</span>
            </label>
            <input type="text" name="venue" class="input input-bordered w-full">
        </div>

       <div class="flex">
    <div class="flex items-center">
        <input type="radio" class="form-radio text-indigo-600 h-3 w-3" name="day" value="Day1" checked>
        <label for="day" class="ml-1 mr-2 text-sm text-gray-700">Day1</label>
    </div>

    <div class="flex items-center">
        <input type="radio" class="form-radio text-indigo-600 h-3 w-3" name="day" value="Day2">
        <label for="day" class="ml-1 mr-2 text-sm text-gray-700">Day2</label>
    </div>
    
    <div class="flex items-center">
        <input type="radio" class="form-radio text-indigo-600 h-3 w-3" name="day" value="Day3">
        <label for="day" class="ml-1 mr-2 text-sm text-gray-700">Day3</label>
    </div>
</div>






        <div class="form-control my-4">
            <label for="dates" class="label">
                <span class="label-text">日付</span>
            </label>
            <input type="date" name="dates[]" multiple class="border border-gray-300 rounded-md px-4 py-2 mb-4">
        </div>
        
        <label for="song_id" class="label">
    <span class="label-text">曲名</span>
</label>
<div class="form-control my-4 border border-gray-300 rounded-md p-4">
    <input type="text" id="searchSong" class="input input-bordered w-full mb-4" placeholder="曲名を検索">

    <div class="overflow-y-auto max-h-48">
        @foreach ($songs as $key => $value)
            <div class="flex items-center song-item">
                <input type="checkbox" name="song_id[]" value="{{ $key }}" class="form-checkbox song-checkbox text-indigo-600 h-5 w-5">
                <span class="ml-2 song-title">{{ $value }}</span>
            </div>
        @endforeach
    </div>
</div>

        <div class="form-control my-4">
            <label for="memo" class="label">
                <span class="label-text">メモ</span>
            </label>
            <textarea name="memo" class="textarea input-bordered w-full h-24" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">登録</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#searchSong').on('input', function() {
            var searchText = $(this).val().toLowerCase();
            
            $('.song-item').each(function() {
                var songTitle = $(this).find('.song-title').text().toLowerCase();
                
                if (songTitle.indexOf(searchText) !== -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>

@endsection