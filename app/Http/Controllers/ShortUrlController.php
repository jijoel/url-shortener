<?php

namespace App\Http\Controllers;

use App\ShortUrl;
use Illuminate\Http\Request;

class ShortUrlController extends Controller
{

    public function index($short = null)
    {
        if (! $short)
            return view('app');

        $found = ShortUrl::find($short);
        if (! $found)
            return view('app');

        return redirect($found->long);
    }


    // this is an api call that will return
    // a ShortUrl object
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        $long = $request->input('url');
        $found = ShortUrl::where('long', $long)->first();
        if ($found)
            return $found;

        $link = new ShortUrl();
        $link->long = $long;
        $link->short = $this->getShortLink();
        $link->save();

        return $link;
    }

    // In a bigger project, this would go into its
    // own class. This is small enough that I think
    // it's fine to leave in the controller
    private function getShortLink()
    {
        return uniqid();
    }

}
