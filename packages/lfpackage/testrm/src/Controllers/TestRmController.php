<?php
namespace LFPackage\TestRm\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

class TestRmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = 'Lookfeel Package Development TestRm';
        return view('testrm::home');
        return view('testrm::welcome', compact('message'));
    }
}
