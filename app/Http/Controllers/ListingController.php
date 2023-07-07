<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Categories;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class ListingController extends Controller
{
    //Get and return all Listings/Jobs
    public function index(Request $request) {

        return view('listings.index', [
            "listings" => Listing::latest()->filter(request(['cat', 'search']))->paginate(6),
        ]);
    }

    public function getcategories(Categories $category){
        return view('listings.index', [
            "listings" => $category->listing,
        ]); 
    }


    // Get and show a single Listing/Job

    public function show(Listing $listing) {
        return view('listings.show', [
            "listing" => $listing,
        ]);
    }


    // get and show the listing creat form

    public function create() {

        return view('listings.create',[
            "categories" => Categories::latest()->get(),
        ]);
    }

    public function store(Request $request) {
        
        $listingFields = $request->validate([
            'title' => ['required'],
            'content'=>"required",
            'company'=>"required",
            'location'=>"required",
            'website'=>"required",
            'email'=>["required", "email"],
            'categories'=>"required",
            'expires'=>"required",
        ]);

        if($request->hasFile('logo')) {
            $listingFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $listingFields['user_id'] = auth()->user()->id;

        
        $listing = Listing::create($listingFields);
        $listing->categories()->attach($request->categories);
        return redirect('/')->with("Message", "Listing Created Successfully");
    }

    public function edit(Listing $listing) {
        return view('listings.edit',[
            "categories" => Categories::latest()->get(),
            "listing" => $listing,
        ]);
    }
   
    public function update(Request $request, Listing $listing) {
        // Make sure the owner is updating the listing
        if(auth()->id() !== $listing->user_id) {
            abort(403, 'You are not allowed to update this listing');
        }

        $listingFields = $request->validate([
            'title' => ['required'],
            'content'=>"required",
            'company'=>"required",
            'location'=>"required",
            'website'=>"required",
            'email'=>["required", "email"],
            'categories'=>"required",
            'expires'=>"required",
        ]);

        if($request->hasFile('logo')) {
            $listingFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($listingFields);
        $listing->categories()->attach($request->categories);
        return redirect('/')->with("Message", "Listing Updated Successfully");
    }

    // Delete the listing
    public function destroy(Listing $listing) {
        // Make sure the owner is updating the listing
        if(auth()->id() !== $listing->user_id) {
            abort(403, 'You are not allowed to update this listing');
        }
        $listing->delete();
        return redirect('/')->with("Message", 'Listing Deleted Successfully');
    }

    public function manage() {
        return view("listings.manage", [
            // "listings" => auth()->user()->listings()->get()
            "listings" => Listing::latest()->where("user_id", auth()->id())->paginate(6),
        ]);
    }
}
