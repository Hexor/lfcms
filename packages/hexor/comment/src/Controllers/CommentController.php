<?php
namespace LFPackage\Comment\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use LFPackage\Comment\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($target_id, Request $request)
    {
        $targetTypeID = $request->get('target_type_id');

        $comments = Comment::where('target_id', $target_id);

        if (!is_null($targetTypeID)) {
           $comments = $comments->where('target_type_id', $targetTypeID);
        }

        $comments = $comments->get();

        return response()->json([
            'status' => 1,
            'msg' => "",
            'data' => $comments
        ], 200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $target_id)
    {
        $comment = new Comment;
        $comment->content = $request->input('content');
        $comment->user_id = 1;
        $comment->user_name = $request->input('name')?$request->input('name'):"nobody";


        $comment->target_id = $target_id;
        $comment->save();

        $redirectTo = $request->input(['redirect_url'])?$request->input(['redirect_url']):$request->getBaseUrl();
        return redirect($redirectTo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
