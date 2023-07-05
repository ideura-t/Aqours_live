@extends('layouts.app')

@section('content')

<div class="prose ml-4">
    <a class="btn btn-accent" href="{{ route('live.live') }}">ライブ一覧</a>
    <a class="btn btn-primary" href="{{ route('Aqours.create') }}">ライブ登録</a>
    <h2>曲一覧</h2>
</div>

<div class="flex justify-between mt-4 mr-4 ml-4">
    <div>
        <input type="text" id="searchSong" class="input input-bordered w-64" placeholder="曲名を検索">
    </div>
    <div>
        <button class="btn btn-info" id="toggleZeroButton">0回を非表示</button>
    </div>
</div>

@if ($aqours->isNotEmpty())
    <div div style="height: 70vh; overflow-y: auto;">
        <table class="table table-zebra w-full my-4">
            <thead>
                <tr>
                    <th>曲名</th>
                    <th>見た回数</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($songs->sortByDesc(function ($song) use ($songCounts) {
                    return $songCounts[$song->id] ?? 0;
                }) as $song)
                    @php
                        $count = $songCounts[$song->id] ?? 0;
                    @endphp
                    <tr class="song-item @if ($count == 0) zero-count @endif">
                        <td>
                            <a class="hover:text-red-500" href="{{ route('Aqours.show', $song->id) }}">{{ $song->song_title }}</a>
                        </td>
                        <td>
                            {{ $count }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

{{-- メッセージ作成ページへのリンク --}}


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var showZero = true;
        var $toggleZeroButton = $('#toggleZeroButton');

        $toggleZeroButton.on('click', function() {
            showZero = !showZero;

            if (showZero) {
                $toggleZeroButton.text('0回を非表示');
                $('.zero-count').show();
            } else {
                $toggleZeroButton.text('すべて表示');
                $('.zero-count').hide();
            }
        });

        $('#searchSong').on('input', function() {
            var searchText = $(this).val().toLowerCase();
            
            $('.song-item').each(function() {
                var songTitle = $(this).find('a').text().toLowerCase();
                
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
