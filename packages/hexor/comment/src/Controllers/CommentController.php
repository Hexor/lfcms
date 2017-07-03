<?php
namespace LFPackage\Comment\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = 'Lookfeel Package Development Example';
        return $message;
//        return view('example::welcome', compact('message'));
    }
}
