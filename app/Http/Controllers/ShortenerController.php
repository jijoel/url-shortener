<?php

namespace App\Http\Controllers;

use App\Shortener;
use Illuminate\Http\Request;

class ShortenerController extends Controller
{

    public function index($short = null)
    {
        if (! $short)
            return view('welcome');

        $found = Shortener::find($short);
        if (! $found)
            return view('welcome');

        return redirect($found->long);
    }


    // this is an api call that will return
    // a Shortener object
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        $long = $request->input('url');
        $found = Shortener::where('long', $long)->first();
        if ($found)
            return $found;

        $link = new Shortener();
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
