@extends('layouts.app')

@section('content')

<div class="prose ml-4">
    <h3>ライブ編集</h3>
</div>

<div class="flex justify-center">
    <form method="POST" action="{{ route('Aqours.update', $live->id) }}" class="w-1/2">
        @csrf
        @method('PUT')

        <div class="form-control my-4">
            <label for="live_title" class="label">
                <span class="label-text">ライブ名</span>
            </label>
            <input type="text" name="live_title" class="input input-bordered w-full" value="{{ $live->live_title }}">
        </div>

        <div class="form-control my-4">
            <label for="venue" class="label">
                <span class="label-text">会場名</span>
            </label>
            <input type="text" name="venue" class="input input-bordered w-full" value="{{ $live->venue }}">
        </div>
        <div class="flex">
            <div class="flex items-center">
                <input type="radio" class="form-radio text-indigo-600 h-3 w-3" name="day" value="Day1" {{ $live->day == 'Day1' ? 'checked' : '' }}>
                <label for="day" class="ml-1 mr-2 text-sm text-gray-700">Day1</label>
            </div>

            <div class="flex items-center">
                <input type="radio" class="form-radio text-indigo-600 h-3 w-3" name="day" value="Day2" {{ $live->day == 'Day2' ? 'checked' : '' }}>
                <label for="day" class="ml-1 mr-2 text-sm text-gray-700">Day2</label>
            </div>

            <div class="flex items-center">
                <input type="radio" class="form-radio text-indigo-600 h-3 w-3" name="day" value="Day3" {{ $live->day == 'Day3' ? 'checked' : '' }}>
                <label for="day" class="ml-1 mr-2 text-sm text-gray-700">Day3</label>
            </div>
        </div>

        <div class="form-control my-4">
            <label for="dates" class="label">
                <span class="label-text">日付</span>
            </label>
            <input type="date" name="dates[]" multiple class="border border-gray-300 rounded-md px-4 py-2 mb-4" value="{{ $initialDates }}">
        </div>


        <label for="song_id" class="label">
            <span class="label-text">曲名</span>
        </label>
        <div class="form-control my-4 border border-gray-300 rounded-md p-4">
            <input type="text" id="searchSong" class="input input-bordered w-full mb-4" placeholder="曲名を検索">

            <div class="overflow-y-auto max-h-48">
                @php
                    $checkedSongs = [];
                    $uncheckedSongs = [];
                    foreach ($songs as $key => $value) {
                        if (in_array($key, $selectedSongs)) {
                            $checkedSongs[$key] = $value;
                        } else {
                            $uncheckedSongs[$key] = $value;
                        }
                    }
                @endphp

                @foreach ($checkedSongs as $key => $value)
                    <div class="flex items-center">
                        <input type="checkbox" name="song_id[]" value="{{ $key }}" class="form-checkbox song-checkbox text-indigo-600 h-5 w-5" checked>
                        <span class="ml-2 song-title">{{ $value }}</span>
                    </div>
                @endforeach

                @foreach ($uncheckedSongs as $key => $value)
                    <div class="flex items-center">
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
            <textarea name="memo" class="textarea input-bordered w-full h-24" rows="5">{{ $live->memo }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection
