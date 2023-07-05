<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Aqours;
use App\Models\User;
use App\Models\Song;
use Illuminate\Support\Facades\DB;

class AqoursController extends Controller
{
        public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
    
            $aqours = Aqours::with('songs')->where('user_id', $user->id)->get();
    
            // 曲ごとの登録回数を取得するクエリを追加
            $songCounts = DB::table('aqours_song')
                ->select('song_id', DB::raw('COUNT(*) as count'))
                ->where('user_id', $user->id)
                ->groupBy('song_id')
                ->pluck('count', 'song_id');
    
            $songs = Song::all(); // すべての曲名を取得
    
            return view('dashboard', compact('aqours', 'songCounts', 'songs'));
        } else {
             return redirect()->route('Aqours.index');

            }
}




    public function create()
    {
        $aqours = new Aqours;
        $songs = Song::pluck('song_title', 'id'); // 曲名のリストを取得
    
        return view('Aqours.create', compact('aqours', 'songs'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'live_title' => 'required',
        'venue' => 'required',
        'day' => 'required',
        'dates' => 'required|array',
        'song_id' => 'required|array',
        'song_id.*' => 'required',
        ]);

        $aqours = new Aqours();
        $aqours->user_id = $request->user()->id;
        $aqours->live_title = $validatedData['live_title'];
        $aqours->venue = $validatedData['venue'];
        $aqours->day = $validatedData['day'];
        $aqours->date = implode(',', $validatedData['dates']);
        $aqours->memo = $request->input('memo');
        $aqours->save();

        $user = $request->user();
        $selectedSongs = $validatedData['song_id'];
        
        foreach ($selectedSongs as $songId)
        {
            $aqours->songs()->attach($songId, ['user_id' => $user->id]);
        }



        return redirect('/');
    }

    public function show($id)
    {
        $song = Song::findOrFail($id);
        $liveTitles = $song->aqours()->select('live_title', 'day','aqours_id')->get(); // ライブ名と日付を取得
        return view('Aqours.show', compact('liveTitles', 'song'));
    }

    public function edit($id)
    {
        $songs = Song::pluck('song_title', 'id');
        $live = Aqours::where('user_id', Auth::id())->findOrFail($id);
    
        // データベースから選択された曲のIDを取得
        $selectedSongs = $live->songs->pluck('id')->toArray();
    
        // 日付の取得と整形
        $dates = explode(',', $live->date);
        $formattedDates = [];
        foreach ($dates as $date) {
            $formattedDates[] = \Carbon\Carbon::parse($date)->format('Y-m-d');
    }
    $initialDates = implode(',', $formattedDates);

    return view('Aqours.edit', compact('live', 'songs', 'selectedSongs', 'initialDates'));
}


    public function update(Request $request, $id)
    {
        $live = Aqours::findOrFail($id);
    
        // ライブの情報を更新
        $live->live_title = $request->input('live_title');
        $live->venue = $request->input('venue');
        $live->day = $request->input('day');
        $live->date = implode(',', $request->input('dates'));
        $live->memo = $request->input('memo');
        $live->save();
    
        // 曲の関連付けを更新
        $songIds = $request->input('song_id');
        $live->songs()->sync($songIds);
    
        return redirect()->route('live.show', $live->id);
    }

    public function destroy($id)
    {
        $aqours = Aqours::where('user_id', Auth::id())->findOrFail($id);
        $aqours->delete();
        return redirect('/');
    }
}
