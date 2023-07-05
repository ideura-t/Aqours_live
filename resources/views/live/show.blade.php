@extends('layouts.app')

@section('content')

<p style="white-space: nowrap; font-size: 35px;">{{ $aqours->live_title }}</p>
<p style="white-space: nowrap; font-size: 25px;"><span style="font-size: 18px;">会場:</span> {{ $aqours->venue }}</p>
<p style="white-space: nowrap; font-size: 25px;"><span style="font-size: 18px;">日程:</span> {{ $aqours->date }}</p>
<p style="white-space: nowrap; font-size: 20px;">{{ $aqours->day }}</p>

<div class="flex">
    <div class="w-1/2">
        <div class="table-container" style="max-height: 65vh; overflow-y: auto;">
            @if (isset($aqours))
            <table class="table table-zebra my-4" style="table-layout: fixed; width: 100%;">
                <thead>
                    <tr>
                        <th>セットリスト</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($songTitles as $songTitle)
                    <tr>
                        <td style="font-size: 20px; white-space: nowrap;">{{ $songTitle }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>

    <div class="w-1/2">
        @if (!empty($aqours->memo))
        <div class="mt-4">
            <p>メモ</p>
            <textarea class="textarea input-bordered w-full h-24" rows="5" readonly>{{ $aqours->memo }}</textarea>
        </div>
        @endif

        <div class="mt-4 flex justify-start">
            <div>
                <a href="{{ route('Aqours.edit', $aqours->id) }}" class="btn btn-primary">編集</a>
            </div>
            <div class="ml-4">
                <form action="{{ route('Aqours.destroy', $aqours->id) }}" method="POST"
                    onsubmit="return confirm('削除しますか？');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error">削除</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
