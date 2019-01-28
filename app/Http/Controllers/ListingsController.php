<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\listing;

class ListingsController extends Controller
{
  public function __construct(){
    $this->middleware('auth',['except'=>['index','show']]);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listings = Listing::orderBy('created_at','desc')->get();
        return view('listings')->with('listings',$listings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createlisting');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'name' => 'required',
          'website' => 'required',
          'email' => 'email',
          'phone' => 'required',
          'address' => 'required',
          'bio' => 'required'

        ]);

        //Create Listings
        $listings = new Listing;
        $listings->name = $request->input('name');
        $listings->website = $request->input('website');
        $listings->email = $request->input('email');
        $listings->phone = $request->input('phone');
        $listings->address = $request->input('address');
        $listings->bio = $request->input('bio');
        $listings->user_id = auth()->user()->id;

        $listings->save();

        return redirect('/dashboard')->with('success','Listing Added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $listing = Listing::find($id);
        return view('showlisting')->with('listing',$listing);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $listing = Listing::find($id);
        return view('editlisting')->with('listing',$listing);
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
      $listings = Listing::find($id);
      $listings->name = $request->input('name');
      $listings->website = $request->input('website');
      $listings->email = $request->input('email');
      $listings->phone = $request->input('phone');
      $listings->address = $request->input('address');
      $listings->bio = $request->input('bio');
      $listings->user_id = auth()->user()->id;

      $listings->save();

      return redirect('/dashboard')->with('success','Listing Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $listings = Listing::find($id);
        $listings->delete();
        return redirect('/dashboard')->with('Deleted','Listing Deleted');

    }
}
