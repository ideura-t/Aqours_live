 @extends('layouts.app')

@section('content')

    <div class="prose ml-4">
   
        
        <a class="btn btn-accent" href="{{ route('Aqours.index') }}">曲一覧</a>
            <a class="btn btn-primary" href="{{ route('Aqours.create') }}">ライブ登録</a>
 <h2>ライブ一覧</h2>
</div>

    @if (isset($aqours))
        <div div style="max-height: 70vh; overflow-y: auto;">
        <table class="table table-zebra w-full my-4">
            <thead>
                <tr>
                    <th>ライブ名</th>
                    <th>　</th>
                    <th>日程</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($aqours->sortByDesc('date') as $live)
                    <tr>
                        <td><a class="hover:text-red-500" href="{{ route('live.show', $live->id) }}">{{ $live->live_title }}</a></td>
                        <td>{{ $live->day }}</td>
                        <td>{{ $live->date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    @endif
    {{-- メッセージ作成ページへのリンク --}}                                               

    @endsection