<?php

namespace App\Http\Controllers\BackEndCon;

use App\Bank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankController extends Controller
{
    

   public function viewBank()
    {
        $banks = Bank::all();
        return view('Admin.bank.view-bank',[
            'banks'=>$banks
        ]);
    }





    public function addBank()
    {
        return view('Admin.bank.add-bank');
    }

    public function saveBank(Request $request)
    {



        $bank = new Bank();
        $bank->bank_name = $request->bank_name;
        $bank->branch = $request->branch;
        $bank->description = $request->description;
        $bank->bank_status = $request->bank_status;
        $bank->save();
        return redirect('/add-bank')->with('message','Bank added successfully');
    }

    



   public function updateBank(Request $request)
    {
        $bank = Bank::find($request->b_id);
        $bank->bank_name = $request->bank_name;
        $bank->branch = $request->branch;
        $bank->description = $request->description;
        $bank->bank_status = $request->bank_st;
        $bank->save();
       

        return redirect('/view-bank')->with('message','Bank updated successfully');
    }




    // public function publishedbank($id)
    // {
    //    $bank = Bank::find($id);
    //    $bank->bank_status = 'No';
    //    $bank->save();

    //    return redirect('/view-bank');
    // }

    // public function unpublishedBank($id)
    // {
    //     $bank = Bank::find($id);
    //     $bank->bank_status = 'Yes';
    //     $bank->save();

    //     return redirect('/view-bank');
    // }





    public function deleteBank($id)
    {
        $bank = Bank::find($id);
        $bank->delete();

        return redirect('/view-bank')->with('message','Bank information deleted successfully');
    }


   





}
