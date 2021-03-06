<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\City;
use App\User;
use App\Receipt;
use App\Download;
use App\Photo;
use App\Coupon;

use App\Mail\FormSubmited;

use Validator;
use Image;
use Session;
use Socialite;

class PublicController extends Controller
{
    public function index(){

        // return redirect('download');

    	$provinsi = City::groupBy('provinsi')->get();

    	return view('main')
    		->with('provinsi', $provinsi);
    }

    public function terms()
    {
        return view('terms');
    }

    // for ajax
    public function getCity(Request $request)
    {

    	$provinsi = City::find($request->input('id'));
    	$cities = City::where('provinsi', $provinsi->provinsi)->orderBy('kota', 'ASC')->get();
    	
    	return response()->json($cities);
    }

    public function submit(Request $request)
    {

        $rule = [
            'name'              => 'required|max:100',
            'email'             => 'required|email|max:100',
            'phone'             => 'required|digits_between:5,13',
            'id_card'           => 'required|numeric',
            'address'           => 'required|max:255',
            'store_name'        => 'required|max:100',
            'contact_accept.0'         => 'required_without_all:contact_accept.1, required_without_all:contact_accept.2',
            'contact_accept.1'         => 'required_without_all:contact_accept.0, required_without_all:contact_accept.2',
            'contact_accept.2'         => 'required_without_all:contact_accept.0, required_without_all:contact_accept.1',
            'nominal'           => 'required|numeric|regex:/^[0-9]+$/',
            'region'            => 'required',
            'city'              => 'required_with:region',
            'location'          => 'max:100',
            // 'images.0'          => 'required|mimes:jpg,jpeg,gif,png|max:5000',
            // 'images.1'          => 'mimes:jpg,jpeg,gif,png|max:5000',
            // 'images.2'          => 'mimes:jpg,jpeg,gif,png|max:5000',
            // 'images.3'          => 'mimes:jpg,jpeg,gif,png|max:5000',
            'term'              => 'required',
            'mendaftar'         => 'required',
        ];

        $message = [
          'name.required'   => 'Nama wajib di isi',
          'nama.max'        => 'Nama maksimal 100 karakter',
          'email.required'     => 'Email wajib di isi',
          'email.email'     => 'Format email salah',
          'email.unique'    => 'Email sudah digunakan',
          'email.max'       => 'Email maksimal 100 karakter',
          'phone.required'    => 'Nomor handphone wajib di isi',
          'phone.unique'        => 'Nomor handphone sudah digunakan',
          'phone.numeric'       => 'Nomor handphone harus berupa angka',
          'phone.digits_between'    => 'Periksa kembali nomor handphone Anda',
          'id_card.required'        => 'Nomor identitas wajib di isi',
          'id_card.numeric'         => 'Periksa kembali nomor identitas Anda',
          'address.required'        => 'Alamat wajib di isi',
          'address.max'             => 'Alamat maksimal 200 karakter',
          'store_name.required'     => 'Nama toko wajib di isi',
          'store_name.max'          => 'Nama toko maksimal 100 karakter',
          'contact_accept.*.required_without_all' => 'Pilih salah satu media diatas',
          'nominal.required'        => 'Nominal wajib di isi',
          'nominal.numeric'         => 'Nominal harus berupa angka',
          'nominal.regex'           => 'Nominal tanpa menggunakan titik',
          'region.required'         => 'Pilih provinsi',
          'city.required'           => 'Pilih kota',
          'location.max'            => 'Lokasi maksimal 100 karakter',
          // 'images.*.required'          => 'Upload foto',
          // 'images.*.mimes'             => 'Format foto harus jpg,jpeg,gif atau png',
          // 'images.*.max'               => 'Mohon maaf file anda tidak dapat di unggah karena maksimum file yang dapat di unggah sebesar 5 MB.',
          'term.required'           => 'Centang untuk menyetujui syarat dan ketentuan kami',
          'mendaftar.required'      => 'Centang untuk menyetujui syarat dan ketentuan kami',
        ];

        $valid = Validator::make($request->all(), $rule, $message);

    	if ($valid->fails()) {

    		return redirect()->back()
    			->withErrors($valid)
    			->withInput();

    	} else {


    		if (Session::has('image1') || Session::has('image2') || Session::has('image3') || Session::has('image4')) {
                
                if ($request->input('location') != null) {

                    $region = City::find($request->input('region'));
                    $kota = City::where('kota', 'like', '%'. $request->input('location') . '%')->first();

                    if ($kota == null) {

                        $city = new City;
                        $city->provinsi = $region->provinsi;
                        $city->kota = $request->input('location');
                        $city->save();

                        $city_id = $city->id;

                    } else {

                        $city_id = $kota->id;

                    }
                    
                } else {

                    $city_id = $request->input('city');

                }

                // print_r($request->input('contact_accept'));

                $contact_accept = array();
                $contact_accept = $request->input('contact_accept');

                $receipt = new Receipt;
                $receipt->city_id = $city_id;
                $receipt->name = $request->input('name');
                $receipt->email = $request->input('email');
                $receipt->phone = $request->input('phone');
                $receipt->id_card = $request->input('id_card');
                $receipt->address = $request->input('address');
                $receipt->store_name = $request->input('store_name');
                ( $receipt->contact_accept != '' ? $receipt->contact_accept = implode(',', $contact_accept) : $receipt->contact_accept = 'email' );
                $receipt->nominal = $request->input('nominal');
                // $receipt->unique_code = $city_id . substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), -7);

                if ($receipt->save()) {

                    $coupon_num = floor($receipt->nominal / 750000);
                        
                    for ($i=1; $i <= $coupon_num; $i++) { 
                        $coupon = new Coupon;
                        $coupon->receipt_id = $receipt->id;
                        $coupon->coupon_code = $receipt->city_id . substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), -7);
                        $coupon->save();
                    }

                    if (Session::has('image1')) {
                        $photo = new Photo;
                        $photo->receipt_id = $receipt->id;
                        $photo->image_url = Session::get('image1');
                        $photo->save();
                    }

                    if (Session::has('image2')) {
                        $photo = new Photo;
                        $photo->receipt_id = $receipt->id;
                        $photo->image_url = Session::get('image2');
                        $photo->save();
                    }

                    if (Session::has('image3')) {
                        $photo = new Photo;
                        $photo->receipt_id = $receipt->id;
                        $photo->image_url = Session::get('image3');
                        $photo->save();
                    }

                    if (Session::has('image4')) {
                        $photo = new Photo;
                        $photo->receipt_id = $receipt->id;
                        $photo->image_url = Session::get('image4');
                        $photo->save();
                    }

                    // if ($request->hasFile('images')) {
                    //  foreach ($request->images as $photo) {

                       //      $file = $photo;
                       //      $filename = snake_case($request->input('name')) . '_' . time();

                       //      $destinationPath = public_path('uploads/' . $filename . '.' . $file->getClientOriginalExtension());
                       //      $img = Image::make($photo);
                       //      $img->resize(800, null, function ($constraint) {
                       //          $constraint->aspectRatio();
                       //      });
                       //      $img->save($destinationPath);
                       //      $img_url = url('/uploads'. '/'. $filename . '.' . $file->getClientOriginalExtension());

                       //      $photo = new Photo;
                       //      $photo->receipt_id = $receipt->id;
                       //      $photo->image_url = $img_url;
                       //      $photo->save();

                       //  }
                    // }

                    $user = Receipt::findOrFail($receipt->id);
                    Mail::to($receipt->email)->queue(new FormSubmited($user));

                    Session::flush();

                    return redirect()->back()
                        ->with('message', 'Successfully submited');
                } else {
                    return redirect()->back()
                    ->with('error', 'Please try again');
                }

            } else {

                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Upload foto struk');

            }

    	}
    }

    /*
    * Upload image
    */
    public function upload(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'image' => 'mimes:jpg,jpeg,gif,png|image|max:5000'
        ]);

        if ($validator->fails()) {

          return response()->json('error', 201);

        } else {

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = rand(1111111111, 9999999999) . '_' . time();

                $destinationPath = public_path('uploads/' . $filename . '.' . $file->getClientOriginalExtension());
                $img = Image::make($file);
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($destinationPath);
                $img_url = url('/uploads'. '/'. $filename . '.' . $file->getClientOriginalExtension());

                $id = $request->input('id');
                $image = Session::put('image'. $id, $img_url);

                return response($img_url, 200)->header('Content-Type', 'text/plain');

                // $photo = new Photo;
                // $photo->receipt_id = $receipt->id;
                // $photo->image_url = $img_url;
                // $photo->save();
            } else {
                return response()->json('error', 201);
            }

        }
    }


    /*
     * Download Page
     *
     */
    public function download()
    {

    	return view('download');
    }

    public function downloadSuccess()
    {

        return view('download-success');
    }

    public function startDownload(Request $request)
    {
    	$valid = Validator::make($request->all(), [
    		'name'			=> 'required|max:100',
    		'email'			=> 'required|max:100|email',
    	]);

    	if ($valid->fails()) {
    		
    		return redirect()->back()
    			->withErrors($valid)
    			->withInput();

    	} else {

    		$download = new Download;
    		$download->name = $request->input('name');
    		$download->email = $request->input('email');
            $download->subscribe = ( $request->input('subscribe') == 0 ? false : true );

    		if ($download->save()) {

    			Session::flash('download_url_activated', url('/download'));
    			
    			return redirect('download-success')
    				->with('message', 'Successfully saved');

    		} else {

    			return redirect()
    				->back()
    				->with('error', 'Please try again');

    		}

    	}
    }


    public function startDownloadNow(Request $request)
    {
        return response()->download(public_path('files/booklet.pdf'));
    }


    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        //return Socialite::driver('facebook')->redirect();
        return Socialite::driver('facebook')->fields([
            'name', 'email'
        ])->scopes([
            'email'
        ])->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {

        $user = Socialite::driver('facebook')->fields([
            'name', 'email'
        ])->user();

        $email = $user['email'];
        $name = $user['name'];

        $download = new Download;
        $download->name = $name;
        $download->email = $email;

        if ($download->save()) {

            Session::flash('download_url_activated', url('/download'));

            return redirect('download-success')
                ->with('message', 'Successfully saved');

        } else {

            return redirect()
                ->back()
                ->with('error', 'Please try again');

        }

        
    }

}
