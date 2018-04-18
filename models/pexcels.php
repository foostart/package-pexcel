<?php

namespace Foostart\Pexcel\Models;

use Illuminate\Database\Eloquent\Model;

class Pexcels extends Model {

    protected $table = 'pexcels';
    public $timestamps = false;
    protected $fillable = [
        'pexcel_name',
        'category_id'
    ];
    protected $primaryKey = 'pexcel_id';

    /**
     *
     * @param type $params
     * @return type
     */
    public function get_pexcels($params = array()) {
        $eloquent = self::orderBy('pexcel_id');

        //pexcel_name
        if (!empty($params['pexcel_name'])) {
            $eloquent->where('pexcel_name', 'like', '%'. $params['pexcel_name'].'%');
        }

        $pexcels = $eloquent->paginate(10);//TODO: change number of item per page to configs

        return $pexcels;
    }



    /**
     *
     * @param type $input
     * @param type $pexcel_id
     * @return type
     */
    public function update_pexcel($input, $pexcel_id = NULL) {

        if (empty($pexcel_id)) {
            $pexcel_id = $input['pexcel_id'];
        }

        $pexcel = self::find($pexcel_id);

        if (!empty($pexcel)) {

            $pexcel->pexcel_name = $input['pexcel_name'];
            $pexcel->category_id = $input['category_id'];

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
    public function add_pexcel($input) {

        $pexcel = self::create([
                    'pexcel_name' => $input['pexcel_name'],
                    'category_id' => $input['category_id'],
        ]);
        return $pexcel;
    }
}
