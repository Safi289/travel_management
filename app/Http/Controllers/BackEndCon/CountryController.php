<?php

namespace App\Http\Controllers\BackEndCon;

use App\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function addCountry()
    {
        return view('Admin.country.add-country');
    }

    public function saveCountry(Request $request)
    {



        $country = new Country();
        $country->country_name = $request->country_name;
        $country->country_desc = $request->country_desc;
        $country->status = $request->status;
        $country->save();
        return redirect('/add-country')->with('message','Country added successfully');
    }

    public function viewCountry()
    {
        $countries = Country::all();
        return view('Admin.country.view-country',[
            'countries'=>$countries
        ]);
    }

    public function publishedCountry($id)
    {
       $country = Country::find($id);
       $country->status = 0;
       $country->save();

       return redirect('/view-country');
    }

    public function unpublishedCountry($id)
    {
        $country = Country::find($id);
        $country->status = 1;
        $country->save();

        return redirect('/view-country');
    }




    public function editCountry($id)
    {
        $countries = Country::find($id);
        $countries->get();

        return view('Admin.country.edit-country',['countries'=>$countries]);
    }











    public function updateCountry(Request $request)
    {
        $country = Country::find($request->country_id);
        $country->country_name = $request->country_name;
        $country->country_desc = $request->country_desc;
        $country->save();
       

        return redirect('/view-country')->with('message','Country updated successfully');
    }

    public function deleteCountry($id)
    {
        $country = Country::find($id);
        $country->delete();

        return redirect('/view-country')->with('message','Country deleted successfully');
    }


   





}
