<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // //Show all listing
    // public function index() {
    //     return view('listings.index', [
    //         'listings' => Listing::all()
    //         ]
    //     );
    // }
     //Show all listing order
    // public function index() {
    //     return view('listings.index', [
    //         'listings' => Listing::latest()->get()
    //         ]
    //     );
    // }
      //Show all listing order filter by tag
    //   public function index() {
    //     return view('listings.index', [
    //         'listings' => Listing::latest()->filter(request(['tag']))->get()
            
    //     ]);
    // }
     //Show all listing order filter by tag and search
     public function index() {
        //return view('listings.index', [
          //  'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
            //for pagination we remove the get and replace with pagination as below

           // dd(Listing::latest()->filter(request(['tag', 'search']))->paginate(4));

            return view('listings.index', [
                  'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(4) //with simplePaginate instead of paginate we can paginate without numbers

            
        ]);
    }
    //Show single listing
    public function show(Listing  $listing) {
        return view('listings.show',[
            'listing' =>  $listing
            ]
        );  
    }
    //show creat form
    public function create() 
    {
        return view('listings.create');
    }

    //Store Listing Form
    public function store(Request $request) {
       // dd($request->file('logo'));

       $formFields = $request->validate([
        'title' => 'required',
        'company' => ['required', Rule::unique('listings', 'company')],
        'location' => 'required',
        'website' => 'required',
        'email' => ['required', 'email'],
        'tags' => 'required',
        'description' => 'required'
       ]);

       if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
       }

       Listing::create($formFields);

       return redirect('/')->with('message', 'Listing created successfully');
       //pass only one message when the page load
    }

}
