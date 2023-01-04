<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Cloudinary;
use Session;

class ImageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
        ]);
        $input = $request->all();
        $image = $request->file('image');

        $uploadedFileName = Cloudinary::upload(
            $request->file('image')->getRealPath(),
            ['folder' => 'solely/']
        )->getFileName();

        $uploadedFileName = $this->replace_extension($uploadedFileName, 'webp');

        $uploadedFileUrl =
            'https://res.cloudinary.com/dbe4m4swh/image/upload/c_scale,q_auto,w_400/v1672832472/solely/' .
            $uploadedFileName;

        $user = $request->user();
        $user->imageUrl = $uploadedFileUrl;
        $user->save();
        $user->refresh();
        $links = $user->links();

        return Redirect::route('dashboard')->with(
            ['status' => 'profile-updated'],
            compact(['user', 'links', 'uploadedFileUrl'])
        );
    }

    public function replace_extension($filename, $new_extension)
    {
        $info = pathinfo($filename);
        return $info['filename'] . '.' . $new_extension;
    }

    public function destroy($id)
    {
        //
        $imageDeleted = app('firebase.storage')
            ->getBucket()
            ->object('Images/defT5uT7SDu9K5RFtIdl.png')
            ->delete();
        Session::flash('message', 'Image Deleted');
        return back()->withInput();
    }
}
