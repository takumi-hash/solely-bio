<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Link;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $demoUser = new User();
        $demoUser->name = 'Jane Appleseed';
        $demoUser->intro = 'Seize the day.';
        $demoUser->imageUrl = asset('images/placeholder.webp');

        $linksFirst = new Link();
        $linksFirst->title = 'GitHub';
        $linksFirst->url = 'https://github.com';

        $linksSecond = new Link();
        $linksSecond->title = 'LinkedIn';
        $linksSecond->url = 'https://linkedin.com';

        $linksThird = new Link();
        $linksThird->title = 'Podcast';
        $linksThird->url = 'https://anchor.fm';

        $links = [$linksFirst, $linksSecond, $linksThird];

        return view('welcome', compact(['demoUser', 'links']));
    }
}
