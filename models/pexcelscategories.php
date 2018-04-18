<?php

namespace Foostart\Pexcel\Models;

use Illuminate\Database\Eloquent\Model;

class PexcelsCategories extends Model {

    protected $table = 'pexcels_categories';
    public $timestamps = false;
    protected $fillable = [
        'pexcel_category_name'
    ];
    protected $primaryKey = 'pexcel_category_id';

    public function get_pexcels_categories($params = array()) {
        $eloquent = self::orderBy('pexcel_category_id');

        if (!empty($params['pexcel_category_name'])) {
            $eloquent->where('pexcel_category_name', 'like', '%'. $params['pexcel_category_name'].'%');
        }
        $pexcels_category = $eloquent->paginate(10);
        return $pexcels_category;
    }

    /**
     *
     * @param type $input
     * @param type $pexcel_id
     * @return type
     */
    public function update_pexcel_category($input, $pexcel_id = NULL) {

        if (empty($pexcel_id)) {
            $pexcel_id = $input['pexcel_category_id'];
        }

        $pexcel = self::find($pexcel_id);

        if (!empty($pexcel)) {

            $pexcel->pexcel_category_name = $input['pexcel_category_name'];

            $pexcel->save();

            return $pexcel;
        } else {
            return NULL;
        }
    }

    /**
     *
     * @param type $input
     * @return type
     */
    public function add_pexcel_category($input) {

        $pexcel = self::create([
                    'pexcel_category_name' => $input['pexcel_category_name'],
        ]);
        return $pexcel;
    }

    /**
     * Get list of pexcels categories
     * @param type $category_id
     * @return type
     */
     public function pluckSelect($category_id = NULL) {
        if ($category_id) {
            $categories = self::where('pexcel_category_id', '!=', $category_id)
                    ->orderBy('pexcel_category_name', 'ASC')
                ->pluck('pexcel_category_name', 'pexcel_category_id');
        } else {
            $categories = self::orderBy('pexcel_category_name', 'ASC')
                ->pluck('pexcel_category_name', 'pexcel_category_id');
        }
        return $categories;
    }

}
