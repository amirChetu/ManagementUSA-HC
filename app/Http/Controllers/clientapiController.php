<?php

namespace App\Http\Controllers;

use App\ApiSetting;
use App\Http\Traits\CommonTrait;
use Illuminate\Http\Request;

/**
 * Class is used to test the Client Api functionality
 *
 * @category App\Http\Controllers;
 *
 * @return void
 */
class ClientApiController extends Controller {

    use CommonTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * This function is used to fetch the layout for API setting.
     *
     * @param Request
     *
     * @return \Illuminate\Http\Response
     */
    public function setting() {
        $data = ApiSetting::first();
        return view('api.setting', [
            'data' => $data
        ]);
    }

    /**
     * This function is used to save the API setting details in database.
     *
     * @param Request
     *
     * @return \Illuminate\Http\Response
     */
    public function saveSetting(Request $request) {
        $saved = $this->saveApiSetting($request);

        if ($saved) {
            // set the flash message for doctor creation success.
            \Session::flash('flash_message', config("constants.SAVED_DATA"));
            return redirect('/api/setting');
        } else {
            // set the flash message for doctor creation success.
            \Session::flash('error_message', config("constants.ERROR_OCCURED"));
            return redirect('/api/setting');
        }
    }

    /**
     * This function is used to save the api data in api_data table.
     *
     * @param Request
     *
     * @return \Illuminate\Http\Response
     */
    public function store() {
        $data = ApiSetting::first();
        if (count($data)) {
            $status = $this->saveApiData($data);
            if ($status) {
                \Session::flash('flash_message', config("constants.SAVED_DATA"));
                return redirect('/');
            } else {
                \Session::flash('error_message', config("constants.ERROR_OCCURED"));
                return redirect('/');
            }
        } else {
            \Session::flash('error_message',  config("constants.AUTH_VALID"));
            return redirect('/api/setting');
        }
    }

}
