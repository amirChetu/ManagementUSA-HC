<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Auth;
use App\User;
use App\TrimixDose;
use App\TrimixDosesFeedback;

/**
 * Class is used to handle all the action related to doses management
 *
 * @category App\Http\Controllers;
 *
 * @return void
 */
class DoseManagmentController extends Controller {

    protected $success = false;
    protected $patient_role = 6;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $patients = User::where('role', $this->patient_role)
                        ->join('patient_details', function ($join) {
                            $join->on('users.id', '=', 'patient_details.user_id')
                            ->where('patient_details.never_treat_status', '=', 0);
                        })->get(['users.id', 'first_name', 'last_name']);

        return view('doses.doseManagement', ['patients' => $patients]);
    }

    /**
     * This function is used to get  the trimix doses and patient details having Trimix package.
     *
     * @param Request
     *
     * @return \Illuminate\Http\Response
     */
    public function getPatientDetails(Request $request) {
        $patientData = User::with('patientDetail', 'paymentByPatientId', 'trimixDoses')->where('id', $request->patient_id)->first();
        return $patientData;
        exit();
    }

    /**
     * This function is used to save the trimix doses in trimix_doses tables.
     *
     * @param Request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // define validation rule
        $this->validate($request, [
            'doctor' => 'required',
            'amount1' => 'required',
            'medicationA1' => 'required',
            'amount2' => 'required',
            'medicationA2' => 'required',
            'amount3' => 'required',
            'medicationB1' => 'required',
            'amount4' => 'required',
            'medicationB2' => 'required'
        ]);
        // create TrimixDoses object
        $trimixData = new TrimixDose;
        $trimixData->patient_id = $request->patient_id;
        $trimixData->agent_id = Auth::user()->id;
        $trimixData->dose_type = $request->dose_type;
        $trimixData->quantity = (isset($request->quantity)) ? $request->quantity : 1;
        $trimixData->doctor = $request->doctor;
        $trimixData->amount1 = $request->amount1;
        $trimixData->medicationA1 = $request->medicationA1;
        $trimixData->amount2 = $request->amount2;
        $trimixData->medicationA2 = $request->medicationA2;
        $trimixData->amount3 = $request->amount3;
        $trimixData->medicationB1 = $request->medicationB1;
        $trimixData->amount4 = $request->amount4;
        $trimixData->medicationB2 = $request->medicationB2;
        $trimixData->antidote = (isset($request->antidote)) ? $request->antidote : '';
        $trimixData->dose_start_date = date('Y-m-d h:i:s');

        // save trimix doses data in table
        if ($trimixData->save()) {
            if ($request->dose_type != 1) {
                if ($request->dose_type == 2) {
                    $dose = $request->dose_type - 1;
                } else if ($request->dose_type == 'A') {
                    $dose = 2;
                } else {
                    $dose = chr(ord($request->dose_type) - 1);
                }
                DB::table('trimix_doses')
                        ->where('patient_id', '=', $request->patient_id)
                        ->where('dose_type', '=', $dose)
                        ->update(['dose_end_date' => date('Y-m-d h:i:s')]);
            }
            \Session::flash('flash_message', 'Doses saved successfully.');
            return redirect('/doses/doseManagement');
        } else {
            \Session::flash('flash_message', 'There are something went wrong Plz Try again.');
            return Redirect::back();
        }
    }

    /**
     * This function is used to save the patient feedback for trimix doses in trimix_dose_feedback tables.
     *
     * @param Request
     *
     * @return \Illuminate\Http\Response
     */
    public function storeFeedback(Request $request) {

        // define validation rule
        $this->validate($request, [
            'time' => 'required',
            'percent' => 'required',
            'pain' => 'required',
            'antidote' => 'required',
        ]);

        $trimixFeedback = new TrimixDosesFeedback;
        $trimixFeedback->agent_id = Auth::user()->id;
        $trimixFeedback->trimix_dose_id = 1;
        $trimixFeedback->time = $request->time;
        $trimixFeedback->percentage = $request->percent;
        $trimixFeedback->antidote = $request->antidote;
        $trimixFeedback->notes = $request->notes;
        // save user data in user table
        if ($trimixFeedback->save()) {
            // set the flash message.
            \Session::flash('flash_message', 'Feedback saved successfully.');
            return redirect('/doses/doseManagement');
        } else {
            \Session::flash('flash_message', 'There are something went wrong Plz Try again.');
            return Redirect::back();
        }
    }

}
