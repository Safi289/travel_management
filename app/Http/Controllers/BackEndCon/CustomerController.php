<?php

namespace App\Http\Controllers\BackEndCon;

use App\Customer;
use App\CustomerPassport;
use App\District;
use App\Group;
use App\Http\Controllers\Controller;
use App\MahramRelation;
use App\ServiceType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Validator;
use Barryvdh\DomPDF\Facade as PDF;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $customers = Customer::all();
        // return $customers; exit();
        return view('Admin.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $groups = Group::select('id', 'group_name')->get();
        $districts = District::orderBy('name')->get();
        $registered_customers = Customer::all();
        $service_types = ServiceType::all();
        $mahram_relationships = MahramRelation::all();
        return view('Admin.customer.form', compact('districts', 'groups', 'registered_customers', 'service_types', 'mahram_relationships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $toValidate = array(
            'given_name' => 'required',
            'sur_name' => 'required',
            'date_of_birth' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|max:11',
            'photo' => 'required|mimes:jpeg,jpg,png|max:500',
        );
        $toValidate['nrb_residence_country'] = ($request->resident_type == 'NRB') ? 'required' : 'nullable';
        $validator = Validator::make($request->all(), $toValidate);
        $data = $request->all();
        $data['date_of_birth'] = Carbon::parse($data['date_of_birth'])->format('Y-m-d');
        $data['email'] = strtolower($data['email']);
        $data['given_name'] = strtoupper($data['given_name']);
        $data['sur_name'] = strtoupper($data['sur_name']);
        if ($request->ajax()) {
            return response()->json($this->ajaxStore($data, $validator, $request), 200);
        } else { // if request is not a AJAX request
            $validator->validate();
            if ($request->hasFile('photo')) {
                $upload = $this->uploadFile($request->photo, 'uploads/customers/images');
                if ($upload) {
                    $data['photo'] = $upload;
                } else {
                    Session::flash('error', 'Whoops! Failed to upload photo');
                    return redirect()->back()->withInput();
                }
            }
            $customer = Customer::create($data);
            if ($customer) {
                Session::flash('success', 'Customer Created Successfully');
                return redirect()->route('groups.index');
            } else {
                Session::flash('error', 'Whoops! Failed to Create Customer');
                return redirect()->back()->withInput();
            }
        }
    }

    /**
     * @param $validator
     * @param $request
     * @return array|bool
     */
    private function ajaxStore($data, $validator, Request $request) {
        if ($validator->fails()) {
            return ['errors' => $validator->errors(), 'success' => false, 'type' => 'error', 'status' => 422];
        }
        if ($request->hasFile('photo')) {
            $upload = $this->uploadFile($request->photo, 'uploads/customers/images');
            if ($upload) {
                $data['photo'] = $upload;
            } else {
                return ['message' => 'Whoops! Failed to upload photo', 'success' => false, 'type' => 'error', 'status' => 422];
            }
        }

        if (isset($request->passport_no)) {
            if ($passport = $this->createPassport($request)) {
                if ($passport['success'] == false) {
                    return $passport;
                } else {
                    $data['passport_id'] = $passport['data'];
                }
            }
        }
        $remove_passport_data = array(
            'passport_no', 'passport_type', 'issue_date', 'expiry_date', 'issue_location'
        );
        array_push($remove_passport_data, 'document', 'document_title');
        foreach ($remove_passport_data as $key) {
            unset($data[$key]);
        }
        $customer = Customer::create($data);
        $updated_customer = $customer->update(['serial_no' => $customer->id + 1000, 'tracking_no' => 'SN' . getSixDigitNumber($customer->id)]);
        if ($updated_customer) {
            $uploadDocument = $this->uploadDocuments($request, $customer);
            if ($uploadDocument['success'] == false) {
                return ['data' => $customer, 'message' => 'Customer Created Successfully But failed to upload documents', 'success' => true, 'type' => 'success', 'status' => 200];
            }
            return ['data' => $customer, 'message' => 'Customer Created Successfully', 'success' => true, 'type' => 'success', 'status' => 200];
        } else {
            return ['message' => 'Whoops! Failed to create Customer.', 'success' => false, 'type' => 'error', 'status' => 400];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $customer = Customer::with('group', 'passport', 'maharam', 'dependent', 'documents', 'hajj.payments')->FindOrFail($id);
        $customer_address = Customer::where('customers.id', '=', $id)
                                ->join('upazilas', 'upazilas.id', '=', 'customers.current_police_station')
                                ->first();
        $customer_district = Customer::where('customers.id', '=', $id)
                                ->join('districts', 'districts.id', '=', 'customers.current_district')
                                ->first();
        $permanent_upazila = Customer::where('customers.id', '=', $id)
                                ->join('upazilas', 'upazilas.id', '=', 'customers.permanent_police_station')
                                ->first();
        $permanent_district = Customer::where('customers.id', '=', $id)
                                ->join('districts', 'districts.id', '=', 'customers.permanent_district')
                                ->first();

        // return $customer_address; exit();
        return view('Admin.customer.show', compact('customer', 'customer_address', 'customer_district', 'permanent_upazila', 'permanent_district'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $customer = Customer::with('documents')->findOrFail($id);
        $groups = Group::select('id', 'group_name')->get();
        $districts = District::orderBy('name')->get();
        $registered_customers = Customer::where('id', '<>', $id)->get();
        $passports = CustomerPassport::all();
        $service_types = ServiceType::all();
        $mahram_relationships = MahramRelation::all();
        return view('Admin.customer.form', compact('customer', 'districts', 'groups', 'registered_customers', 'passports', 'service_types', 'mahram_relationships'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), array(
            'given_name' => 'required',
            'sur_name' => 'required',
            'date_of_birth' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'photo' => 'mimes:jpeg,jpg,png|max:500',
        ));

        $data = $request->all();
        $data['date_of_birth'] = Carbon::parse($data['date_of_birth'])->format('Y-m-d');
        $data['email'] = strtolower($data['email']);
        if ($request->ajax()) {
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'success' => false, 'type' => 'error', 'status' => 422], 200);
            }

            $remove_data = array();
            array_push($remove_data, 'document', 'document_title');
            foreach ($remove_data as $key) {
                unset($data[$key]);
            }
            $customer = Customer::find($id);
            if ($request->hasFile('photo')) {
                $upload = $this->uploadFile($request->photo, 'uploads/customers/images');
                if ($upload) {
                    File::delete('uploads/customers/images/' . $customer->photo);
                    $data['photo'] = $upload;
                } else {
                    return response()->json(['message' => 'Whoops! Failed to upload photo', 'success' => false, 'type' => 'error', 'status' => 422], 200);
                }
            }
            if (isset($request->document)) {
                foreach ($request->document as $key => $document){
                    $attachDocument = new \App\Services\AttachedDocument();
                    $file_name = $attachDocument->uploadDocument($document);
                    $attachDocumentData = [
                        'title' => $request->document_title[$key],
                        'document' => $file_name
                    ];
                    if (!$attachDocument->attachDocument($customer->id, $attachDocumentData)) {
                        return response()->json(['message' => 'Whoops! Failed to upload document', 'success' => false, 'type' => 'error', 'status' => 422], 200);
                    }
                }
            }
            $updated = false;
            if ($customer) {
                $updated = $customer->update($data);
            }
            if ($updated) {
                return response()->json(['data' => $customer, 'message' => 'Customer updated Successfully', 'success' => true, 'type' => 'success', 'status' => 200], 200);
            } else {
                return response()->json(['message' => 'Whoops! Failed to update Customer.', 'success' => false, 'type' => 'error', 'status' => 400], 200);
            }
        } else { // if request is not a AJAX request
            $validator->validate();
            $customer = Customer::findOrFail($id);
            if ($request->hasFile('photo')) {
                $upload = $this->uploadFile($request->photo, 'uploads/customers/images');
                if ($upload) {
                    File::delete('uploads/customers/images/' . $customer->photo);
                    $data['photo'] = $upload;
                } else {
                    Session::flash('error', 'Whoops! Failed to upload photo');
                    return redirect()->back()->withInput();
                }
            }
            $updated = false;
            if ($customer) {
                $updated = $customer->update($data);
            }
            if ($updated) {
                Session::flash('success', 'Customer updated Successfully');
                return redirect()->route('groups.index');
            } else {
                Session::flash('error', 'Whoops! Failed to update Customer');
                return redirect()->back()->withInput();
            }
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
        $customer = Customer::find($id);
        if ($customer->delete()) {
            File::delete('uploads/customers/images/' . $customer->photo);
            return response()->json(['success' => true, 'message' => 'Customer Deleted Successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! Customer Not Deleted'], 200);
        }
    }

    /**
     * Upload File Universal Function
     *
     * @param UploadedFile $file
     * @param string $UploadPath
     * @return \Symfony\Component\HttpFoundation\File\File|bool
     */
    private function uploadFile(UploadedFile $file, string $UploadPath = 'uploads')
    {
        $fileName = time() . ' - ' . $file->getClientOriginalName();
        $uploaded = $file->move(public_path($UploadPath), $fileName);
        if ($uploaded) {
            list($width, $height, $type, $attr) = getimagesize(public_path($UploadPath).'/'.$fileName);
            if ($attr != 'width="300" height="400"') {
                $image = Image::make(public_path($UploadPath).'/'.$fileName)->resize(300, 400)->save();
            }
            return $fileName;
        } else {
            return false;
        }
    }

    private function uploadDocuments(Request $request, $customer)
    {
        if (isset($request->document)) {
            foreach ($request->document as $key => $document){
                $attachDocument = new \App\Services\AttachedDocument();
                $file_name = $attachDocument->uploadDocument($document);
                $attachDocumentData = [
                    'title' => $request->document_title[$key],
                    'document' => $file_name
                ];
                if (!$attachDocument->attachDocument($customer->id, $attachDocumentData)) {
                    return ['message' => 'Whoops! Failed to upload document', 'success' => false, 'type' => 'error', 'status' => 422];
                }
            }
            return ['message' => 'Document Uploaded Successfully', 'success' => true, 'type' => 'success', 'status' => 200];
        } else {
            return ['message' => 'Document Not Submitted', 'success' => true, 'type' => 'success', 'status' => 200];
        }
    }

    /**
     * Create Passport
     *
     * @param Request $request
     * @return array|bool
     */
    private function createPassport(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'passport_no' => 'required|min:9',
            'date_of_birth' => 'required',
            'passport_type' => 'required',
            'issue_date' => 'required',
            'expiry_date' => 'required',
        ));
        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors(), 'type' => 'validation-error', 'status' => 422];
        }
        $data = array(
            'full_name' => $request->given_name . ' ' . $request->sur_name,
            'passport_no' => $request->passport_no,
            'date_of_birth' => Carbon::parse($request->date_of_birth)->format('Y-m-d'),
            'passport_type' => $request->passport_type,
            'issue_date' => Carbon::parse($request->issue_date)->format('Y-m-d'),
            'expiry_date' => Carbon::parse($request->expiry_date)->format('Y-m-d'),
            'issue_location' => $request->issue_location,
        );

        $passport = CustomerPassport::create($data);
        if ($passport) {
            return ['success' => true, 'data' => $passport->id, 'status' => 200];
        } else {
            return ['success' => false, 'errors' => 'Error in creating passport!', 'type' => 'create-error', 'status' => 422];
        }
    }

    public function customerInfoPDF($id)
    {
        $contxt = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ]);
        $customer = Customer::with('group', 'passport', 'maharam', 'dependent')->FindOrFail($id);
//        return view('Admin.customer.customer-info-pdf', compact('customer'));
        $pdf = PDF::loadView('Admin.customer.customer-info-pdf', compact('customer'))
            ->setOptions([
                'defaultPaperSize' => 'A4',
                'isRemoteEnabled' => true,
                'isJavascriptEnabled' => true,
                'isPhpEnabled' => true,
                'isHtml5ParserEnabled' => true,
                'fullBase' => true,
            ]);
        return $pdf->stream();
//        return $pdf->download('invoice.pdf');
    }
}
