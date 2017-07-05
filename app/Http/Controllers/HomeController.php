<?php

namespace App\Http\Controllers;

use LFComment;
use LFPackage\Comment\Repositories\CommentRepositoryInterface;

class HomeController extends Controller
{
    protected $commentRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function showTestPost($post_id)
    {

        return view('post',[
            'target_id' => $post_id
        ]);
    }
}
