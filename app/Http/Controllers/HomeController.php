<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Download;
use App\Receipt;
use App\Photo;
use App\Coupon;

use DB;
use Excel;
use Validator;
use Mail;
use Image;

use App\Mail\SendCode;

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
     */
    public function index()
    {
        $total_download = Download::count();
        $unique_download = Download::distinct('email')->count('email');

        $total_submission = Receipt::count();
        $unique_submission = Receipt::distinct('email')->count('email');
        return view('admin.home.view')
            ->with('total_submission', $total_submission)
            ->with('unique_submission', $unique_submission)
            ->with('total_download', $total_download)
            ->with('unique_download', $unique_download);
    }

    /*
    * Submissions List
    */
    public function submissions(Request $request)
    {
        if ($request->has('key')) {
            $submissions = Receipt::join('city', 'city.id', '=', 'receipt.city_id')
                ->select('receipt.*', 'city.kota')
                ->where('receipt.name', 'LIKE', '%' . $request->input('key') . '%')
                ->orWhere('receipt.email', 'LIKE', '%' . $request->input('key') . '%')
                ->paginate(50);
        } else {
            $submissions = Receipt::join('city', 'city.id', '=', 'receipt.city_id')
                ->select('receipt.*', 'city.kota')
                ->paginate(50);
        }
        
        return view('admin.submission.view')
            ->with('submissions', $submissions);
    }

    /*
    * Edit Submission Data
    */
    public function submissionEdit($id)
    {
        $data = Receipt::find($id);
        $images = Photo::where('receipt_id', $id)->get();
        return view('admin.submission.edit')
            ->with('images', $images)
            ->with('data', $data);
    }

    public function addImage(Request $request)
    {

        $valid = Validator::make($request->all(), [
            'images'    => 'required|image|mimes:jpg,jpeg,gif,png|max:5000'
        ]);

        if ($valid->fails()) {
            
            return redirect()->back()
                ->withErrors($valid)
                ->withInput();

        } else {

            $receipt = Receipt::find($request->input('id'));

            if ($request->hasFile('images')) {
                $file = $request->file('images');
                $filename = snake_case($request->input('name')) . '_' . time();

                $destinationPath = public_path('uploads/' . $filename . '.' . $file->getClientOriginalExtension());
                $img = Image::make($file);
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($destinationPath);
                $img_url = url('/uploads'. '/'. $filename . '.' . $file->getClientOriginalExtension());

                $photo = new Photo;
                $photo->receipt_id = $receipt->id;
                $photo->image_url = $img_url;
                
                if ($photo->save()) {
                    return redirect()->back()
                        ->with('success', 'Image has been added');
                }
            }
        }
    }

    /*
    * Add new unique code
    */
    public function addCode(Request $request)
    {
        $id = $request->input('id');
        $receipt = Receipt::find($id);
        $coupon = new Coupon;
        $coupon->receipt_id = $id;
        $coupon->coupon_code = $receipt->city_id . substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), -7);
        $coupon->save();

        return redirect()->back()
            ->with('success', 'Code has been added');
    }

    /*
    * Send code by email
    */
    public function sendCode(Request $request)
    {
        $user = Receipt::findOrFail($request->input('id'));
        $coupon = $request->input('code');
        Mail::to($user->email)->queue(new SendCode($coupon));

        return redirect()->back()
            ->with('success', 'Email with code has been sent');
    }

    /*
    * Update data submission
    */
    public function submissionUpdate(Request $request)
    {
        $valid = Validator::make($request->all(), [
                    'name'      => 'required|max:100',
                    'phone'     => 'required|numeric',
                    'id_card'   => 'required|numeric',
                    'address'   => 'required|max:255',
                    'store_name'=> 'required|max:100',
                    'nominal'   => 'required|numeric',
                ]);
        
        if ($valid->fails()) {
            return redirect()->back()
                ->withErrors($valid)
                ->withInput();
        } else {

            $receipt = Receipt::find($request->input('id'));
            $receipt->name = $request->input('name');
            $receipt->phone = $request->input('phone');
            $receipt->id_card = $request->input('id_card');
            $receipt->address = $request->input('address');
            $receipt->store_name = $request->input('store_name');
            $receipt->nominal = $request->input('nominal');

            if ($receipt->save()) {
                return redirect()->back()
                    ->with('success', 'Receipt has been updated');
            } else {
                return redirect()->back()
                    ->with('error', 'Please try again');
            }

        }
    }

    /*
    * Images & Data View
    */
    public function submissionImages($id)
    {
        $data = Receipt::find($id);
        $coupons = Coupon::where('receipt_id', $id)->get();
        $images = Photo::where('receipt_id', $id)->get();
        return view('admin.submission.images')
            ->with('coupons', $coupons)
            ->with('data', $data)
            ->with('images', $images);
    }

    /*
    * View downloads data
    */
    public function downloads()
    {
        $downloads = Download::paginate(50);
        return view('admin.downloads.view')
            ->with('downloads', $downloads);
    }

    /*
    * Downloads export data
    */
    public function downloadExport(Request $request)
    {
        $users = Download::select(DB::raw('id, name, email, created_at'))->get();

       // Initialize the array which will be passed into the Excel
        // generator.
        $dataArray = []; 

        // Define the Excel spreadsheet headers
        $dataArray[] = ['id', 'nama', 'email', 'downloaded_at'];

        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($users as $user) {
            $dataArray[] = $user->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('data-'. time(), function($excel) use ($dataArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('data' . microtime());
            $excel->setDescription('data file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($dataArray) {
                $sheet->fromArray($dataArray, null, 'A1', false, false);
            });

        })->download('csv');
    }


    /*
    * Export submissions
    */
    public function submissionExport(Request $request)
    {
        $users = Receipt::select(DB::raw('receipt.id, receipt.name, receipt.email, receipt.phone, receipt.id_card, receipt.address, receipt.store_name, receipt.contact_accept, receipt.nominal, receipt.created_at'))
          ->get();

       // Initialize the array which will be passed into the Excel
        // generator.
        $dataArray = []; 

        // Define the Excel spreadsheet headers
        $dataArray[] = ['id', 'nama', 'email', 'phone', 'id_card', 'address', 'store_name', 'contact_accept', 'nominal', 'submit_at'];

        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($users as $user) {
            $dataArray[] = $user->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('data-'. time(), function($excel) use ($dataArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('data' . microtime());
            $excel->setDescription('data file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($dataArray) {
                $sheet->fromArray($dataArray, null, 'A1', false, false);
            });

        })->download('xls');
    }

    /*
    * Export Unique Code
    */
    public function submissionExportCode(Request $request)
    {
        $users = Receipt::join('coupons', 'coupons.receipt_id', '=', 'receipt.id')
            ->select(DB::raw('coupons.coupon_code, receipt.id, receipt.name, receipt.email, receipt.phone, receipt.id_card, receipt.nominal, receipt.created_at'))
            ->get();

       // Initialize the array which will be passed into the Excel
        // generator.
        $dataArray = []; 

        // Define the Excel spreadsheet headers
        $dataArray[] = ['unique_code', 'id', 'nama', 'email', 'phone', 'id_card', 'nominal', 'submit_at'];

        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($users as $user) {
            $dataArray[] = $user->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('data-'. time(), function($excel) use ($dataArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('data' . microtime());
            $excel->setDescription('data file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($dataArray) {
                $sheet->fromArray($dataArray, null, 'A1', false, false);
            });

        })->download('xls');
    }
}
