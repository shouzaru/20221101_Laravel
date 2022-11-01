<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Photo;
use App\Models\Player;
use Illuminate\Support\Facades\Storage;  //画像ファイル削除機能のため追加
use Image; // intervention/imageライブラリの読み込み
use Carbon\Carbon;  //日付を扱うCarbonライブラリ
use Illuminate\Support\Str;
use Validator;


class PhotoUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $files,$file,$exifdata,$dateTimeOriginal,$img,$constraint,$ext,$fileName,$pathFileName,$save_path,$photo,$request;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($request)
    {
        $files = $request->file('photo');
        $this->files = $files;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
            if ( !empty($this->files) ){
            foreach($this->files as $file){
                //画像ファイルのexifデータ取得、撮影日取得             
                $exifdata=exif_read_data($file, 0, true);
                $dateTimeOriginal = isset($exifdata["EXIF"]['DateTimeOriginal']) ? $exifdata["EXIF"]['DateTimeOriginal'] : "";
                if(empty($dateTimeOriginal)){
                    $dateTimeOriginal = "2000-01-01 00:00:00";
                }

                $img = Image::make($file); //intervention/imageライブラリを使用する準備
                $img->orientate();         // スマホアップ画像に対応
                $img->resize(
                    2048,  //LINEアルバムの設定に合わせて横2048pixlに設定
                    null,
                    function ($constraint) {
                        $constraint->aspectRatio(); // 縦横比を保持したままにする
                        $constraint->upsize(); // 小さい画像は大きくしない
                    }
                );
                
                $ext = $file->guessExtension(); // ファイルの拡張子取得
                $fileName = $dateTimeOriginal.'.'.$ext; //ファイル名を生成。撮影日をファイル名にする。
                $pathFileName = "app/public/uploads/" . $fileName; //保存先のパス名
                $save_path = storage_path($pathFileName); //保存先
                
                // ファイル名（撮影日時）が重複したら末尾にランダムな三文字を加える
                while(file_exists($save_path)){  //すでにファイル名があったら
                    $randomstr = Str::random(3); //ランダムな三文字を生成
                    $fileName = $dateTimeOriginal . '_' . $randomstr .'.'.$ext; //末尾に加える
                    $pathFileName = "app/public/uploads/" . $fileName;  //$pathFileNameに再代入
                    $save_path = storage_path($pathFileName); //保存先
                }

                $img->save($save_path); //保存。これはintervention/imageライブラリの書き方。画像圧縮してるからこれ。

                // 画像のファイル名をDBに保存。Photoモデルで指定したphotosテーブルに保存。
                    $photo = Photo::create([
                        "path" => $fileName,
                        "date" => $dateTimeOriginal,
                    ]);

                    $photo->players()->attach(request()->players); //追加 photoとplayerのリレーション
            }}

    }
}
