<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index()
    {
        $title = 'mr anderson welcome back we missed you';
        return view('pages.index')->with('title',$title);
    }
    public function about()
    {
        $title = 'about page';
        return view('pages.about')->with('title',$title);;
    }
    public function service()
    {
        $data = array(
            'title' => 'Services',
            'services' => ['Web Design','Programming','SEO']
        );
        return view('pages.service')->with($data);
    }
}
