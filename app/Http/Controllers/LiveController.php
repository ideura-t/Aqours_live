<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aqours;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Song;
use Illuminate\Support\Facades\DB;

class LiveController extends Controller
{
    public function show($id)
    {
        $aqours = Aqours::findOrFail($id);
        $songTitles = $aqours->songs()->pluck('song_title');

        return view('live.show', compact('aqours', 'songTitles'));
    }
    public function live()
    {
        $aqours = Aqours::where('user_id', Auth::id())->get();

        return view('live.live', compact('aqours'));
    }
    public function index()
{
    $aqours = Aqours::with('songs')->where('user_id', Auth::id())->get();

    // 曲ごとの登録回数を取得するクエリを追加
    $songCounts = DB::table('aqours_song')
        ->select('song_id', DB::raw('COUNT(*) as count'))
        ->groupBy('song_id')
        ->pluck('count', 'song_id');
    $songs = Song::all(); // すべての曲名を取得
    return view('Aqours.index', compact('aqours', 'songCounts','songs'));
}
}