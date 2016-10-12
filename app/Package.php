<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This class is used to handle all the data related to packages tables
 *
 * @category App\Http\Controllers;
 *
 * @return null
 */
class Package extends Model
{
    use SoftDeletes;
	
    protected $fillable = [
        'product_id',
        'category_id',
        'product_count',
        'product_price',
        'category_type'
    ];

    /**
    * This function is used to get all the details of category by category_id.
    *
    * @parms $id;
    *
    * @return $data
    */
    public static function getCategoryDetailsById($id){
        $category_info = [];
        $products = [];
        $pck_type = '';
        $total_price = 0;	

        $category_details = Package::where('packages.category_id', $id)
            ->leftJoin('products', 'packages.product_id', '=', 'products.id')
            ->leftJoin('category_types', 'packages.category_type', '=', 'category_types.id')
            ->select('packages.product_count as p_count', 'packages.product_price as spl_price', 'products.*', 'category_types.name as package_type', 'products.count as inventory_count'
            )
            ->orderBy('package_type', 'DESC')
            ->get();

        foreach ($category_details as $cat) {
            if ($pck_type != $cat->package_type) {
                $pck_type = $cat->package_type;
                $category_info[$pck_type] = [];
                $category_info[$pck_type]['total_price'] = 0;
                $category_info[$pck_type]['ori_price'] = 0;
            }

            $category_info[$pck_type]['total_price'] += $cat->spl_price;
            $category_info[$pck_type]['ori_price'] += $cat->price * $cat->p_count;
            if (!isset($products[$cat->name])) {
                $products[$cat->name] = [];

                $products[$cat->name]['Bronze'] = [];
                $products[$cat->name]['Silver'] = [];
                $products[$cat->name]['Gold'] = [];
            }

            $products[$cat->name]['price'] = $cat->price;
            $products[$cat->name]['unit_of_measurement'] = $cat->unit_of_measurement;
            $products[$cat->name]['inventory_count'] = $cat->inventory_count;
            $products[$cat->name][$cat->package_type]['count'] = $cat->p_count;
            $products[$cat->name][$cat->package_type]['spl_price'] = $cat->spl_price;
            if($cat->count <= $cat->p_count){
                $category_info[$pck_type]['available'] = false;
            } else{
                $category_info[$pck_type]['available'] = true;					
            }
        }

        $data = [
            'category_info' => $category_info,
            'products' => $products
        ];

        return $data;
    }
    
    /**
    * This function create linking between categories table and packages table.
    *
    * @parms void;
    *
    * @return null
    */
    public function categories() {  
        return $this->belongsTo('App\Category', 'category_id');
    }
    
    /**
    * This function create linking between products table and packages table.
    *
    * @parms void;
    *
    * @return null
    */
    public function Product() {
        return $this->belongsTo('App\Product', 'product_id');
    }	
    
    /**
    * This function create linking between orders table and packages table.
    *
    * @parms void;
    *
    * @return null
    */
    public function order() {
        return $this->belongsTo('App\Order', 'package_id');
    }	
}
