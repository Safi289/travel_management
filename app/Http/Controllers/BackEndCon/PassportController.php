<?php

namespace App\Http\Controllers\BackEndCon;

use App\CustomerPassport;
use App\Http\Controllers\Controller;
use App\PassportDocument;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Validator;

class PassportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $passports = CustomerPassport::all();
        return view('Admin.passport.index', compact('passports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('Admin.passport.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), array(
            'full_name' => 'required',
            'passport_no' => 'required',
            'date_of_birth' => 'required',
            'passport_type' => 'required',
            'issue_date' => 'required',
            'expiry_date' => 'required',
        ), array(
            'issue_location.required' => 'Address field is required.'
        ))->validate();

        $data = $request->except('document', 'document_title');
        $data['date_of_birth'] = Carbon::parse($data['date_of_birth'])->format('Y-m-d');
        $data['issue_date'] = Carbon::parse($data['issue_date'])->format('Y-m-d');
        $data['expiry_date'] = Carbon::parse($data['expiry_date'])->format('Y-m-d');

        $passport = CustomerPassport::create($data);

        $uploadDocument = $this->uploadDocuments($request, $passport);
        if ($uploadDocument['success'] == false) {
            Session::flash('error', 'Whoops! Failed to Upload Documents');
        }

        if ($passport) {
            Session::flash('success', 'Passport Created Successfully');
            return redirect()->route('passport-info.index');
        } else {
            Session::flash('error', 'Whoops! Failed to Create Passport');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $passport = CustomerPassport::FindOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $passport = CustomerPassport::with(['documents'])->findOrFail($id);
        return view('Admin.passport.form', compact('passport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(), array(
            'full_name' => 'required',
            'passport_no' => 'required',
            'date_of_birth' => 'required',
            'passport_type' => 'required',
            'issue_date' => 'required',
            'expiry_date' => 'required',
        ))->validate();

        $data = $request->except('document', 'document_title');
        $data['date_of_birth'] = Carbon::parse($data['date_of_birth'])->format('Y-m-d');
        $data['issue_date'] = Carbon::parse($data['issue_date'])->format('Y-m-d');
        $data['expiry_date'] = Carbon::parse($data['expiry_date'])->format('Y-m-d');

        $passport = CustomerPassport::FindOrFail($id);
        $updated = $passport->update($data);

        $uploadDocument = $this->uploadDocuments($request, $passport);
        if ($uploadDocument['success'] == false) {
            Session::flash('error', 'Whoops! Failed to Upload Documents');
        }

        if ($updated) {
            Session::flash('success', 'Passport Updated Successfully');
            return redirect()->route('passport-info.index');
        } else {
            Session::flash('error', 'Whoops! Failed to Update Passport');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $delete = CustomerPassport::find($id)->delete();
        if ($delete) {
            return response()->json(['success' => true, 'message' => 'Passport Deleted Successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! Passport Not Deleted'], 200);
        }
    }

    private function uploadDocuments(Request $request, $passport)
    {
        if (isset($request->document)) {
            foreach ($request->document as $key => $document){
                $attachDocument = new \App\Services\PassportDocument();
                $file_name = $attachDocument->uploadDocument($document);
                $attachDocumentData = [
                    'title' => $request->document_title[$key],
                    'document' => $file_name
                ];
                if (!$attachDocument->attachDocument($passport->id, $attachDocumentData)) {
                    return ['message' => 'Whoops! Failed to upload document', 'success' => false, 'type' => 'error', 'status' => 422];
                }
            }
            return ['message' => 'Document Uploaded Successfully', 'success' => true, 'type' => 'success', 'status' => 200];
        } else {
            return ['message' => 'Document Not Submitted', 'success' => true, 'type' => 'success', 'status' => 200];
        }
    }

    public function deleteDocument($id)
    {
        $document = PassportDocument::find($id);
        if (isset($document->document)) {
            Storage::disk('public')->delete('uploads/customers/passport-documents/' . $document->document);
        }
        $delete = $document->delete();
        if ($delete) {
            return response()->json(['success' => true, 'message' => 'Passport Document Deleted Successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! Passport Document Not Deleted'], 200);
        }
    }
}
