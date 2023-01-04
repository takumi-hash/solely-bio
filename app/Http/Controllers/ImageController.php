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
        $user = $request->user();
        $links = $user->llinks();

        $request->validate([
            'image' => 'required',
        ]);
        $input = $request->all();
        $image = $request->file('image'); //image file from frontend

        $uploadedFileUrl = Cloudinary::upload(
            $request->file('image')->getRealPath()
        )->getSecurePath();

        return view('dashboard', compact(['user', 'links', 'uploadedFileUrl']));
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
