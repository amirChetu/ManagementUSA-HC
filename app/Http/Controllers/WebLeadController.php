<?php

use DB;


/**
 * Class is used to test the weblead functionality
 *
 * @category App\Http\Controllers;
 *
 * @return void
 */
class WebLeadController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function listWebLeads() {

        $webLeads = DB :: table('web_leads')->get();
        return view('apptsetting.web_lead', [
            'web_leads' => $webLeads
        ]);
    }

}
