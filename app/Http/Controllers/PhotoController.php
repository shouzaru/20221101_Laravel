<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Player;
use Illuminate\Support\Str;
use Validator;
use Auth;
use Illuminate\Support\Facades\Storage;  //画像ファイル削除機能のため追加
use Image; // intervention/imageライブラリの読み込み
use Carbon\Carbon;  //日付を扱うCarbonライブラリ

use App\Jobs\PhotoUpload;


class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();
        $players = Player::all();
        return view('photo.index', compact('players', 'photos'));
    }

    public static function nenchou()
    {
        $photos = Photo::all();
        $players = Player::all();  //追加
        //  データベースから各学年ののデータを取り出す
        $nenchou = new Carbon('2018-04-01');
        $ichinen = new Carbon('2020-04-01');
        $ninen = new Carbon('2021-04-01');
        $sannen = new Carbon('2022-04-01');
        $yonen = new Carbon('2023-04-01');
        $gonen = new Carbon('2024-04-01');
        $rokunen = new Carbon('2025-04-01');
        $photo_nenchou=Photo::whereBetween('date', [$nenchou, $ichinen])->get();
        return view('photo.nenchou', compact('players', 'photos', 'photo_nenchou'));  //修正
    }

    public static function ichinen()
    {
        $photos = Photo::all();
        $players = Player::all();  //追加
        //  データベースから各学年ののデータを取り出す
        $nenchou = new Carbon('2018-04-01');
        $ichinen = new Carbon('2020-04-01');
        $ninen = new Carbon('2021-04-01');
        $sannen = new Carbon('2022-04-01');
        $yonen = new Carbon('2023-04-01');
        $gonen = new Carbon('2024-04-01');
        $rokunen = new Carbon('2025-04-01');
        $photo_ichinen=Photo::whereBetween('date', [$ichinen, $ninen])->get();
        return view('photo.ichinen', compact('players', 'photos', 'photo_ichinen'));  //修正
    }

    public static function ninen()
    {
        $photos = Photo::all();
        $players = Player::all();  //追加
        //  データベースから各学年ののデータを取り出す
        $nenchou = new Carbon('2019-04-01');
        $ichinen = new Carbon('2020-04-01');
        $ninen = new Carbon('2021-04-01');
        $sannen = new Carbon('2022-04-01');
        $yonen = new Carbon('2023-04-01');
        $gonen = new Carbon('2024-04-01');
        $rokunen = new Carbon('2025-04-01');
        $photo_ninen=Photo::whereBetween('date', [$ninen, $sannen])->get();
        return view('photo.ninen', compact('players', 'photos', 'photo_ninen'));  //修正
    }

    public static function sannen()
    {
        $photos = Photo::all();
        $players = Player::all();  //追加
        //  データベースから各学年ののデータを取り出す
        $nenchou = new Carbon('2019-04-01');
        $ichinen = new Carbon('2020-04-01');
        $ninen = new Carbon('2021-04-01');
        $sannen = new Carbon('2022-04-01');
        $yonen = new Carbon('2023-04-01');
        $gonen = new Carbon('2024-04-01');
        $rokunen = new Carbon('2025-04-01');
        $photo_sannen=Photo::whereBetween('date', [$sannen, $yonen])->get();
        return view('photo.sannen', compact('players', 'photos', 'photo_sannen'));  //修正
    }

    public static function yonen()
    {
        $photos = Photo::all();
        $players = Player::all();  //追加
        //  データベースから各学年ののデータを取り出す
        $nenchou = new Carbon('2019-04-01');
        $ichinen = new Carbon('2020-04-01');
        $ninen = new Carbon('2021-04-01');
        $sannen = new Carbon('2022-04-01');
        $yonen = new Carbon('2023-04-01');
        $gonen = new Carbon('2024-04-01');
        $rokunen = new Carbon('2025-04-01');
        $photo_yonen=Photo::whereBetween('date', [$yonen, $gonen])->get();
        return view('photo.yonen', compact('players', 'photos', 'photo_yonen'));  //修正
    }

    public static function gonen()
    {
        $photos = Photo::all();
        $players = Player::all();  //追加
        //  データベースから各学年ののデータを取り出す
        $nenchou = new Carbon('2019-04-01');
        $ichinen = new Carbon('2020-04-01');
        $ninen = new Carbon('2021-04-01');
        $sannen = new Carbon('2022-04-01');
        $yonen = new Carbon('2023-04-01');
        $gonen = new Carbon('2024-04-01');
        $rokunen = new Carbon('2025-04-01');
        $photo_gonen=Photo::whereBetween('date', [$gonen, $rokunen])->get();
        return view('photo.gonen', compact('players', 'photos', 'photo_gonen'));  //修正
    }

    public static function rokunen()
    {
        $photos = Photo::all();
        $players = Player::all();  //追加
        //  データベースから各学年ののデータを取り出す
        $nenchou = new Carbon('2019-04-01');
        $ichinen = new Carbon('2020-04-01');
        $ninen = new Carbon('2021-04-01');
        $sannen = new Carbon('2022-04-01');
        $yonen = new Carbon('2023-04-01');
        $gonen = new Carbon('2024-04-01');
        $rokunen = new Carbon('2025-04-01');
        $rokunenowari = new Carbon('2026-04-01');
        $photo_rokunen=Photo::whereBetween('date', [$rokunen, $rokunenowari])->get();
        return view('photo.rokunen', compact('players', 'photos', 'photo_rokunen'));  //修正
    }

    public static function taggingAll()
    {
        $photos = Photo::all();
        $players = Player::all();  //追加
        return view('photo.taggingAll', compact('players', 'photos'));  //修正
    }

    public static function taggingNone()
    {
        $photos = Photo::all();
        $players = Player::all();  
        return view('photo.taggingNone', compact('players', 'photos')); 
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $players = Player::all();
        $photos = Photo::all();  //追加
        return view('photo.create', compact('players', 'photos'));  //修正
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $photo = Photo::create($request->all());
        $photo->players()->attach(request()->players);
        return redirect()->route('photo.index')->with('success', '新規登録完了しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = Photo::find($id);
        $players = $photo->players->pluck('id')->toArray();
        $playerList = Player::all();
        return view('photo.edit', compact('photo', 'players', 'playerList'));
        // return view('photo.edit', compact('photo', 'photos', 'players', 'playerList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $photo = Photo::find($id);
        $photo->players()->sync(request()->players);
        return back()->with('success', '編集完了しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::find($id);
        $path = $photo->path;  // アップロード済みの写真のパスを取得
        
        // ファイルが登録されていれば削除
        if ($path !== '') {
            Storage::disk('public')->delete('uploads/' . $path);
        }

        $photo->delete();
        $photo->players()->detach();
        return redirect()->route('photo.index')->with('success', '削除完了しました');
    }


    // 画像ダウンロード処理
    public function download($id){
        $photo = Photo::find($id);
        $path = $photo->path;  // アップロード済みの写真のパスを取得
        $date = $photo->date;  //撮影日の情報
        return Storage::disk('public')->download('uploads/' . $path , $date . '.jpg' ); //downloadメソッドの第二引数はダウンロードしたファイルにつけるファイル名
    }


    // 画像アップロード処理
    public function upload(Request $request){
        PhotoUpload::dispatch($request);     //ジョブPhotoUploadに渡す
        
            // if ( !empty($files) ){
            // foreach($files as $file){
            //     //画像ファイルのexifデータ取得、撮影日取得             
            //     $exifdata=exif_read_data($file, 0, true);
            //     $dateTimeOriginal = isset($exifdata["EXIF"]['DateTimeOriginal']) ? $exifdata["EXIF"]['DateTimeOriginal'] : "";
            //     if(empty($dateTimeOriginal)){
            //         $dateTimeOriginal = "2000-01-01 00:00:00";
            //     }

            //     $img = Image::make($file); //intervention/imageライブラリを使用する準備
            //     $img->orientate();         // スマホアップ画像に対応
            //     $img->resize(
            //         2048,  //LINEアルバムの設定に合わせて横2048pixlに設定
            //         null,
            //         function ($constraint) {
            //             $constraint->aspectRatio(); // 縦横比を保持したままにする
            //             $constraint->upsize(); // 小さい画像は大きくしない
            //         }
            //     );
                
            //     $ext = $file->guessExtension(); // ファイルの拡張子取得
            //     $fileName = $dateTimeOriginal.'.'.$ext; //ファイル名を生成。撮影日をファイル名にする。
            //     $pathFileName = "app/public/uploads/" . $fileName; //保存先のパス名
            //     $save_path = storage_path($pathFileName); //保存先
                
            //     // ファイル名（撮影日時）が重複したら末尾にランダムな三文字を加える
            //     while(file_exists($save_path)){  //すでにファイル名があったら
            //         $randomstr = Str::random(3); //ランダムな三文字を生成
            //         $fileName = $dateTimeOriginal . '_' . $randomstr .'.'.$ext; //末尾に加える
            //         $pathFileName = "app/public/uploads/" . $fileName;  //$pathFileNameに再代入
            //         $save_path = storage_path($pathFileName); //保存先
            //     }

            //     $img->save($save_path); //保存。これはintervention/imageライブラリの書き方。画像圧縮してるからこれ。

            //     // 画像のファイル名をDBに保存。Photoモデルで指定したphotosテーブルに保存。
            //         $photo = Photo::create([
            //             "path" => $fileName,
            //             "date" => $dateTimeOriginal,
            //         ]);

            //         $photo->players()->attach(request()->players); //追加 photoとplayerのリレーション
            // }}
            return redirect('photo');
        }
}
