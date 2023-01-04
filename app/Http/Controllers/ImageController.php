<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $image = $request->file('image'); //image file from frontend

        $uploadedFileUrl = Cloudinary::upload(
            $request->file('image')->getRealPath()
        )->getSecurePath();

        $user = $request->user();
        $links = $user->links();

        return view(
            'dashboard',
            compact(['user', 'links', 'uploadedFileUrl'])
        )->with('status', 'photo-updated');
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
