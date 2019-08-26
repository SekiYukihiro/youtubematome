<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    public function storeIcon(Request $request)
    {
            $this->validate($request,[
                    'photo' => 'required|file|image|max:50000|mimes:jpeg,png,jpg,gif',
            ]);


            $params = $this->validate($request,[
                        'photo' => 'required|file|image|mimes:jpeg,png,jpg,gif',
            ]);

            $file=$params['photo'];
            $image=\Image::make(file_get_contents($file->getRealPath()));
            $image
                ->resize(200,200)
                ->save(storage_path().'/app/public/icon_images/'. \Auth::id() . '-200-200'.'.jpg');


            $user=\Auth::user();
            $user->icon_image_url = ('public/icon_images/'.\Auth::id() . '-200-200'.'.jpg');

            $user->save();


            return view('setting.channel',[
               'user'=>$user,
            ]);
    }

    public function storeTop(Request $request)
    {
            $this->validate($request,[
                    'photo' => 'required|file|image|max:50000|mimes:jpeg,png,jpg,gif',
            ]);


            $params1 = $this->validate($request,[
                        'photo' => 'required|file|image|mimes:jpeg,png,jpg,gif',
            ]);

            $file1=$params1['photo'];

            $image1=\Image::make(file_get_contents($file1->getRealPath()));
            $image1
                ->resize(1000,200)
                ->save(storage_path().'/app/public/top_images/'. \Auth::id() . '-1000-200'.'.jpg');

            $image2=\Image::make(file_get_contents($file1->getRealPath()));
            $image2
                ->save(storage_path().'/app/public/top_images/'. \Auth::id() .'.jpg');


            $user=\Auth::user();
            $user->top_image_url = ('public/top_images/'.\Auth::id() .'.jpg');

            $user->save();


            return view('setting.channel',[
               'user'=>$user,
            ]);
    }

    // use Intervention\Image\ImageManagerStatic as Image;

    public function topTrim(Request $request)
    {

        $this->validate($request,[
                'top_trim' => 'required|integer|between:0,100',
        ]);

        $user=\Auth::user();
        $user->top_trim = $request->top_trim;
        $user->save();

        $num="";

        return view('setting.channel',[
               'user'=>$user,
               'num'=>$num,
        ]);
    }

    public function topTrimming(Request $request)
    {

        $crop =  value(function() use ($request) {

              // Laravelの場合は public_path()ヘルパー関数、Facadeが使えます
              $image = \Image::make(storage_path().'/app/public/top_images/'. \Auth::id() .'.jpg');
              $image
                      ->crop(
                             $request->get('width'),
                             $request->get('height'),
                             $request->get('x'),
                             $request->get('y')
                           )
                      ->resize(1000,200) // 256 * 256にリサイズ
                      // 画像の保存
                      ->save(storage_path().'/app/public/top_images/'. \Auth::id() . '-1000-200'.'.jpg');

                      // 必要があれば元のファイルも消す
                      /* Lumenの場合は bootstrap/app.phpに以下のコードを追加
                      * class_alias('Illuminate\Support\Facades\File', 'File');
                      */
                      // \File::delete('Your image File);

                      return $image ?: false;

              });

            return $crop ? ['response' =>  true, 'img' => $str . '.jpg']
                        : ['response' => false];

            $user=\Auth::user();

            return view('setting.channel',[
                'user'=>$user,
            ]);
    }


}
