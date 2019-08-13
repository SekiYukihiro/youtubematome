<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    public function storeIcon(Request $request)
    {
            $this->validate($request,[
                    'photo' => 'required|file|image|mimes:jpeg,png,jpg,gif',
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
            // $user->icon_image_url = $request->photo->storeAs('public/icon_images/',\Auth::id() . '-200-200'.'.jpg');
            $user->icon_image_url = ('public/icon_images/'.\Auth::id() . '-200-200'.'.jpg');

            $user->save();


            return view('setting.channel',[
               'user'=>$user,
            ]);
    }
}
