@extends('layouts.app')

@section('content')

<div class="prose ml-4">
    <h1>{{$song->song_title}}</h1>
</div>

<div class="mt-4">
    <table class="table table-zebra w-full">
        <thead>
            <tr>
                <th>ライブ名</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($liveTitles as $liveTitle)
            <tr>
                <td><a class="hover:text-red-500" href="{{ route('live.show', $liveTitle->aqours_id) }}">{{ $liveTitle->live_title }}</a></td>
                <td>{{ $liveTitle->day }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection