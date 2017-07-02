<?php
namespace LFPackage\Example\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

class ExampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = 'Lookfeel Package Development Example';
        return view('example::home');
        return view('example::welcome', compact('message'));
    }
}
