<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Download;
use App\Receipt;
use App\Photo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_download = Download::count();
        $unique_download = Download::distinct('email')->count('email');

        $total_submission = Receipt::count();
        $unique_submission = Receipt::where('nominal', '>=', 750000)->count();
        return view('admin.home.view')
            ->with('total_submission', $total_submission)
            ->with('unique_submission', $unique_submission)
            ->with('total_download', $total_download)
            ->with('unique_download', $unique_download);
    }

    /*
    * Submissions List
    */
    public function submissions()
    {
        $submissions = Receipt::paginate(50);
        return view('admin.submission.view')
            ->with('submissions', $submissions);
    }

    /*
    * Images View
    */
    public function submissionImages($id)
    {
        $images = Photo::where('receipt_id', $id)->get();
        return view('admin.submission.images')
            ->with('images', $images);
    }
}
