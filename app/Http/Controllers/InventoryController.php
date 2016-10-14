<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App;
use DB;
use App\Inventory;

/**
 * Class is used to handle all the action related to Inventory Management
 *
 * @category App\Http\Controllers;
 *
 * @return void
 */
class InventoryController extends Controller {

    protected $success = false;

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
        $inventory = DB::table('stocks')
                ->join('products', 'products.sku', '=', 'stocks.sku')
                ->select('stocks.*', 'products.name')
                ->get();

        return view('inventory.inventory_details', ['inventories' => $inventory]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('inventory.inventory_imports');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $data = Input::all();
            $messages = [
                'mimes' => config("constants.EXCEL_VALID")
            ];

            $validator = Validator::make($data, [
                        'inventory_file' => 'required|mimes:xls,xlsx|between:0,1024' // file size must be from 0 kb to 1 mb
                            ], $messages);

            if ($validator->fails()) {
                return Redirect::to('/inventory/create')->withInput()->withErrors($validator->errors());
            }
            \Excel::load($data['inventory_file']->getPathname(), function($reader) {
                // Getting all results
                $inventoryList = $reader->select(array('sku', 'unit_of_measurement', 'quantity'))->get()->toArray();

                $list = [];
                $inventory = [];

                // check if any column is missing in any row if found then the row is rejected
                foreach ($inventoryList as $i => $n) {
                    if (!isset($n['sku']) || !isset($n['unit_of_measurement']) || !isset($n['quantity']) || empty($n['sku']) || empty($n['unit_of_measurement']) || empty($n['quantity'])) {
                        unset($inventoryList[$i]);
                    } else {
                        $pro = ['sku' => $n['sku'], 'unit_of_measurement' => $n['unit_of_measurement'], 'quantity' => $n['quantity']];

                        $inventory[] = $pro;
                        $proUpdated = App\Inventory::firstOrNew(array('sku' => $n['sku']));
                        $proUpdated->fill($pro)->save();
                    }
                }

                if (!empty($inventory)) {
                    $this->success = true;
                }
            });
            if ($this->success) {
                \Session::flash('success_message', config("constants.IMPORTED_DATA"));
            } else {
                \Session::flash('error_message', config("constants.INVENTORY_VALID"));
            }
            return redirect()->back();
        } catch (Exception $e) {
            \Log::error($e);
            \App::abort(404, $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        try {
            if (!($inventory = Inventory::find(base64_decode($id)))) {
                throw new Exception(config("constants.PAGE_NOT_FOUND"));
            }
            return view('inventory.edit', ['inventory' => $inventory]);
        } catch (Exception $e) {
            \Log::error($e);
            \App::abort(404, $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        try {
            if (!($user = Inventory::find($request->id))) {
                throw new Exception(config("constants.PAGE_NOT_FOUND"));
            }

            // validation rule
            $this->validate($request, [
                'quantity' => 'required|numeric'
            ]);

            // update the user status by user id
            $update = DB::table('stocks')
                    ->where('id', $request->id)
                    ->update(['quantity' => $request->quantity]);
            if ($update) {
                \Session::flash('flash_message', config("constants.UPDATED_DATA"));

                return redirect('/inventory/index');
            } else {
                \Session::flash('flash_message', config("constants.ERROR_OCCURED"));
                return Redirect::back();
            }
        } catch (Exception $e) {
            \Log::error($e);
            \App::abort(404, $e->getMessage());
        }
    }

    /**
     * Displays the details of patient inventory.
     *
     * @param  int  $id
     * @return\Illuminate\Http\Response
     */
    public function patientInventory() {

        $dropDowns = DB::table('dose_dropdown')
                        ->join('dropdown_details', function ($join) {
                            $join->on('dose_dropdown.id', '=', 'dropdown_details.dropdown_id');
                        })->groupBy('dropdown_details.dropdown_id')->where('dose_dropdown.category_id', '=', 2)->get();

        return view('inventory.patientInventory');
    }

}
