<?php
namespace LFPackage\TestRep\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

class TestRepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = 'Lookfeel Package Development TestRep';
        return view('testrep::home');
        return view('testrep::welcome', compact('message'));
    }
}
