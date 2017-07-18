<?php
namespace LFPackage\TestVs\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

class TestVsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = 'Lookfeel Package Development TestVs';
        return view('testvs::home');
        return view('testvs::welcome', compact('message'));
    }
}
