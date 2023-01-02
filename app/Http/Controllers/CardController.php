<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Link;

use App\Http\Requests\LinkUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use InterventionImage;

class CardController extends Controller
{
    public function show($handlename)
    {
        $user = User::where('handlename', '=', $handlename)->first();
        $links = $user->links()->get();
        return view('profile.show', compact(['user', 'links']));
    }

    public function edit(Request $request)
    {
        $user = $request->user();
        $links = $user->links()->get();
        return view('dashboard', compact(['user', 'links']));
    }

    public function getOgp($handlename)
    {
        $user = User::where('handlename', '=', $handlename)->first();

        //Baase Image
        $path = public_path('images/ogp.jpg');
        $img = InterventionImage::make($path);

        //Add Text to image
        $img->text($user->name, 220, 250, function ($font) {
            $font->file(public_path('fonts/NotoSansJP-Medium.otf'));
            $font->size(74);
            $font->color('#333333');
            $font->align('left');
            $font->valign('top');
        });
        $img->text(
            'Checkout solely.bio/u/' . $user->handlename . ' for full bio.',
            220,
            340,
            function ($font) {
                $font->file(public_path('fonts/NotoSansJP-Medium.otf'));
                $font->size(32);
                $font->color('#555555');
                $font->align('left');
                $font->valign('top');
            }
        );

        return $img->response();
    }

    // public function updateById($id, LinkUpdateRequest $request)
    // {
    //     $link = $request
    //         ->user()
    //         ->links()
    //         ->find($id);
    //     $link = $link->fill($request->validated());
    //     // $link = Link::find($id)->fill($request->validated());
    //     // $link->title = $request->title;
    //     // $link->url = $request->url;

    //     $link->save();

    //     return Redirect::route('dashboard');
    // }

    public function update(LinkUpdateRequest $request)
    {
        foreach ($request->links as $item) {
            Link::updateOrCreate(
                ['id' => $item['id']],
                ['title' => $item['title'], 'url' => $item['url']]
            );
        }

        return Redirect::route('dashboard');
    }
}
