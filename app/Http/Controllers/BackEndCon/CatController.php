<?php

namespace App\Http\Controllers\BackEndCon;

use App\Expense;
use App\ExpenseCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CatController extends Controller
{
    

   public function viewCat()
    {
        $cats = ExpenseCategory::all();
        // dd($cats);
        return view('Admin.expense-categories.view-excat',[
            'cats'=>$cats
        ]);
    }





    public function addCat()
    {
        return view('Admin.expense-categories.add-excat');
    }

    public function saveCat(Request $request)
    {



        $cat = new ExpenseCategory();
        $cat->title = $request->title;
        $cat->description = $request->description;
        $cat->status = $request->status;
        $cat->save();
        return redirect('/add-expense-category')->with('message','Expense Category added successfully');
    }

    



   public function updateCat(Request $request)
    {
        $cat = ExpenseCategory::find($request->id);
        $cat->title = $request->title;
        $cat->description = $request->description;
        $cat->status = $request->st;
        $cat->save();
       

        return redirect('/view-expense-category')->with('message','Expense Category updated successfully');
    }




    // public function publishedCat($id)
    // {
    //    $cat = ExpenseCategory::find($id);
    //    $cat->status = 0;
    //    $cat->save();

    //    return redirect('/view-cat');
    // }

    // public function unpublishedCat($id)
    // {
    //     $cat = ExpenseCategory::find($id);
    //     $cat->status = 1;
    //     $cat->save();

    //     return redirect('/view-cat');
    // }





    public function deleteCat($id)
    {
        $cat = ExpenseCategory::find($id);
        $cat->delete();

        return redirect('/view-expense-category')->with('message','Bank information deleted successfully');
    }


   





}
