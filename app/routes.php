// app/routes.php

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

$app->post('/cropper', function(Request $request){

  $str =  str_random(7);

  $crop =  value(function() use ($request, $str) {

              // Laravelの場合は public_path()ヘルパー関数、Facadeが使えます
              $image = Image::make('../public/img/art.jpg')
                      ->crop(
                             $request->get('width'),
                             $request->get('height'),
                             $request->get('x'),
                             $request->get('y')
                           )
                      ->resize(256,256) // 256 * 256にリサイズ
                      // 画像の保存
                      ->save('../public/img/'. $str . '.jpg')
                      ->resize(128,128) //サムネイル用にリサイズ
                      ->save('../public/img/'. $str . '_t' . '.jpg');

                      // 必要があれば元のファイルも消す
                      /* Lumenの場合は bootstrap/app.phpに以下のコードを追加
                      * class_alias('Illuminate\Support\Facades\File', 'File');
                      */
                      // \File::delete('Your image File);

                      return $image ?: false;

              });

  return $crop ? ['response' =>  true, 'img' => $str . '.jpg']
               : ['response' => false];

});