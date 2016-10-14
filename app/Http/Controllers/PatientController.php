<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Patient;
use App\User;
use App\State;
use DB;
use Exception;

/**
 * Class is used to handle all the action related to Patient
 *
 * @category App\Http\Controllers;
 *
 * @return void
 */
class PatientController extends Controller {

    protected $role = 6;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addPatient() {
        $states = State::get();

        $stateArray = array();

        foreach ($states as $state) {
            $stateArray[$state->id] = $state->name;
        }

        return view('patient.addPatient', ['states' => $stateArray]);
    }

    /**
     * This function is used to fetch all patient.
     *
     * @param void
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null) {
        if ($id == null) {
            $patients = User::with(
                            'patientDetail', 'PatientDetail.patientStateName', 'PatientDetail.patientLocationName'
                    )
                    ->where('role', $this->role)
                    ->orderBy('id', 'DESC')
                    ->get();

            return view('patient.patients', ['patients' => $patients]);
        } else {
            $patient = Patient::find($id);
            return view('patient.patient', ['patient' => $patient]);
        }
    }

    /**
     * This function is used to save the patient information in users table and patient details table.
     *
     * @param form data
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request) {
        try {
            $this->validate($request, [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'phone' => 'required',
                'zipCode' => 'required|min:6|max:15'
            ]);

            if (!class_exists('App\User')) {
                throw new Exception('Class User not exist');
            }

            $userData = new User;
            $userData->first_name = $request->first_name;
            $userData->middle_name = $request->middle_name;
            $userData->last_name = $request->last_name;
            $userData->email = $request->email;
            $userData->role = $this->role;

            if ($userData->save()) {
                $userId = $userData->id;
                $saveResult = $this->savePatientDetail($request, $userId);
                if ($saveResult != 0) {
                    \Session::flash('flash_message', config("constants.SAVED_DATA"));
                    return redirect('/patient');
                } else {
                    return redirect('/patient/addPatient');
                }
            } else {
                return redirect('/patient/addPatient');
            }
        } catch (Exception $e) {
            \Log::error($e);
            \App::abort(404, $e->getMessage());
        }
    }

    /**
     * This function is used to save the patient when an appointment is created or edited.
     *
     * @param form data
     *
     * @return \Illuminate\Http\Response
     */
    public function saveAppointmentPatient(Request $request) {
        try {
            $this->validate($request, [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'phone' => 'required',
            ]);

            if (!class_exists('App\User')) {
                throw new Exception('Class User not found');
            }
            $userData = new User;
            $userData->first_name = $request->first_name;
            $userData->last_name = $request->last_name;
            $userData->email = $request->email;
            $userData->role = $this->role;

            if ($userData->save()) {
                $userId = $userData->id;
                $saveResult = $this->savePatientDetail($request, $userId);
                if ($saveResult != 0) {
                    return $userId;
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        } catch (Exception $e) {
            \Log::error($e);
            \App::abort(404, $e->getMessage());
        }
    }

    /**
     * This function is used to fetch the layout of edit form.
     *
     * @param Patient Id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null) {
        try {
            if (!($patient = User::with('patientDetail')->find(base64_decode($id)))) {
                throw new Exception('Page not found');
            }

            $states = State::get();

            $stateArray = array();

            foreach ($states as $state) {
                $stateArray[$state->id] = $state->name;
            }

            return view('patient.editPatient', [
                'patient' => $patient,
                'states' => $stateArray
            ]);
        } catch (Exception $e) {
            \Log::error($e);
            \App::abort(404, $e->getMessage());
        }
    }

    /**
     * This function is used to delete the patient data from user table and patient details table.
     *
     * @param void
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id = null) {
        try {
            $user = User::find(base64_decode($id));
            if (!$user || $user->role != config("constants.PATIENT_ROLE_ID")) {
                throw new Exception(config("constants.PAGE_NOT_FOUND"));
            }
            User::destroy(base64_decode($id));
            \Session::flash('flash_message', config("constants.DELETED_DATA"));
            return Redirect::back();
        } catch (Exception $e) {
            \Log::error($e);
            \App::abort(404, $e->getMessage());
        }
    }

    /**
     * This function is used to update the patient details.
     *
     * @param Request data
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePatient($id = null, Request $request) {
        try {
            if (!($userData = User::find($id))) {
                throw new Exception('Page not found');
            }

            $this->validate($request, [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'phone' => 'required',
                'zipCode' => 'required|min:6|max:15',
                'payment_bill' => 'mimes:jpg,png,jpeg,doc,docx,pdf,csv,xls',
                'driving_license' => 'mimes:jpg,png,jpeg'
            ]);

            $userInput['first_name'] = $request->first_name;
            $userInput['middle_name'] = $request->middle_name;
            $userInput['last_name'] = $request->last_name;
            $userInput['email'] = $request->email;

            $patientData = Patient::where('user_id', $id)->get();

            $documentFile = $request->file('payment_bill');
            $oldDocumentPath = public_path('uploads/patient_documents/' . $patientData[0]->payment_bill);

            $drivingLicense = $request->file('driving_license');
            $oldLicensePath = public_path('uploads/patient_documents/' . $patientData[0]->driving_license);

            if ($request->dob) {
                $patientInput['dob'] = date('Y-m-d', strtotime($request->dob));
            }
            // SAVE DATA IN PATIENTDETAIL TABLE
            $patientInput['gender'] = $request->gender;
            $patientInput['phone'] = $request->phone;
            $patientInput['address1'] = $request->address1;
            $patientInput['address2'] = $request->address2;
            $patientInput['city'] = $request->city;
            $patientInput['state'] = $request->state;
            $patientInput['zipCode'] = $request->zipCode;
            $patientInput['employer'] = $request->employer;
            $patientInput['occupation'] = $request->occupation;

            $patientInput['marital_status'] = $request->marital_status;
            $patientInput['mobile'] = $request->mobile;
            $patientInput['call_time'] = $request->call_time;
            $patientInput['driving_license'] = $request->driving_license;
            $patientInput['work'] = $request->work;
            $patientInput['height'] = $request->height;
            $patientInput['weight'] = $request->weight;
            $patientInput['primary_physician'] = $request->primary_physician;
            $patientInput['physician_phone'] = $request->physician_phone;

            $patientInput['never_treat_status'] = ($request->never_treat_status == 'on') ? 1 : 0;


            if (isset($documentFile)) {
                $extension = $documentFile->getClientOriginalExtension();

                $filename = mt_rand(0, 99999999) . '.' . $extension;
                $uploads = 'uploads\patient_documents';

                if ($documentFile->move($uploads, $filename)) {
                    $patientInput['payment_bill'] = $filename;
                    if (!empty($patientData[0]->payment_bill)) {
                        unlink($oldDocumentPath);
                    }
                }
            }

            if (isset($drivingLicense)) {
                $extension = $drivingLicense->getClientOriginalExtension();

                $filename = mt_rand(0, 99999999) . '.' . $extension;
                $uploads = 'uploads\patient_documents';

                if ($drivingLicense->move($uploads, $filename)) {
                    $patientInput['driving_license'] = $filename;
                    if (!empty($patientData[0]->driving_license)) {
                        unlink($oldLicensePath);
                    }
                }
            }

            if ($userData->fill($userInput)->save() && $patientData[0]->fill($patientInput)->save()) {
                \Session::flash('flash_message', config("constants.UPDATED_DATA"));

                return redirect('/patient');
            } else {
                return redirect('/patient/editPatient');
            }
        } catch (Exception $e) {
            \Log::error($e);
            \App::abort(404, $e->getMessage());
        }
    }

    /**
     * This function is used to save the patient details in patient details table.
     *
     * @param request and user_id
     *
     * @return \Illuminate\Http\Response
     */
    public function savePatientDetail($request, $userId) {
        $patient = new Patient;
        $patient->user_id = $userId;
        $patient->phone = $request->phone;
        $patient->gender = $request->gender;
        if ($request->dob) {
            $patient->dob = date('Y-m-d', strtotime($request->dob));
        }
        $patient->address1 = $request->address1;
        $patient->address2 = $request->address2;
        $patient->city = $request->city;
        $patient->state = $request->state;
        $patient->zipCode = $request->zipCode;
        $patient->employer = $request->employer;
        $patient->occupation = $request->occupation;

        $patient->marital_status = $request->marital_status;
        $patient->mobile = $request->mobile;
        $patient->call_time = $request->call_time;
        $patient->driving_license = $request->driving_license;
        $patient->work = $request->work;
        $patient->height = $request->height;
        $patient->weight = $request->weight;
        $patient->primary_physician = $request->primary_physician;
        $patient->physician_phone = $request->physician_phone;

        $drivingLicense = $request->file('driving_license');
        $oldLicensePath = public_path('uploads/patient_documents/' . $patientData[0]->driving_license);

        if (isset($drivingLicense)) {
            $extension = $drivingLicense->getClientOriginalExtension();

            $filename = mt_rand(0, 99999999) . '.' . $extension;
            $uploads = 'uploads\patient_documents';

            if ($drivingLicense->move($uploads, $filename)) {
                $patient->driving_license = $filename;
                if (!empty($patientData[0]->driving_license)) {
                    unlink($oldLicensePath);
                }
            }
        }

        if ($patient->save()) {
            return $patient->id;
        } else {
            return 0;
        }
    }

    /**
     * This function is used to view the patient details.
     *
     * @param patient_id
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id = null) {
        try {
            if (!($patient = User::with(
                            'patientDetail', 'PatientDetail.patientStateName', 'roleName'
                    )
                    ->find(base64_decode($id)))) {
                throw new Exception(config("constants.PAGE_NOT_FOUND"));
            }
            $id = base64_decode($id);
            $packageData = showCart($id);
            $catList = $packageData['category_list'];
            $cartDetailList = $packageData['category_detail_list'];
            $originalPrice = $packageData['original_package_price'];
            $discountPrice = $packageData['discouonted_package_price'];
            $packageDiscount = $packageData['package_discount'];
            $disease_id = DB::table('appointment_reasons')->where('patient_id', $id)->orderBy('updated_at', 'DESC')->pluck('reason_id');
            $diseases = DB::table('reason_codes')->where('type', 1)->pluck('reason', 'id');
            $adamsQ = DB::table('adams_questionaires')->where('patient_id', $id)->first();
            $medicalHistories = DB::table('medical_histories')->where('patient_id', $id)->first();
            $erectileD = DB::table('erectile_dysfunctions')->where('patient_id', $id)->first();
            $weightL = DB::table('weight_loss')->where('patient_id', $id)->first();
            $priapus = DB::table('priapus')->where('patient_id', $id)->first();
            $testosterone = DB::table('high_testosterones')->where('patient_id', $id)->first();
            $vitamins = DB::table('vitamins')->where('patient_id', $id)->first();
            $cosmetics = DB::table('cosmetics')->where('patient_id', $id)->first();
            $labReports = DB::table('lab_reports')->where('patient_id', $id)->get();

            return view('patient.view_patient', [
                'patient' => $patient,
                'catList' => $catList,
                'cartDetailList' => $cartDetailList,
                'originalPrice' => $originalPrice,
                'discountPrice' => $discountPrice,
                'packageDiscount' => $packageDiscount,
                'disease_id' => $disease_id,
                'diseases' => $diseases,
                'adamsQuestionaires' => $adamsQ,
                'medicalHistories' => $medicalHistories,
                'erectileD' => $erectileD,
                'weightL' => $weightL,
                'priapus' => $priapus,
                'testosterone' => $testosterone,
                'cosmetics' => $cosmetics,
                'vitamins' => $vitamins,
                'labReports' => $labReports
            ]);
        } catch (Exception $e) {
            \Log::error($e);
            \App::abort(404, $e->getMessage());
        }
    }

}
