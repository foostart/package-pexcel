<?php

namespace Foostart\Pexcel\Controllers\Admin;

use Illuminate\Http\Request;
use Foostart\Pexcel\Controllers\Admin\Controller;
use URL;
use Route,
    Redirect;
use Foostart\Pexcel\Models\Pexcels;
use Foostart\Pexcel\Models\PexcelsCategories;
/**
 * Validators
 */
use Foostart\Pexcel\Validators\PexcelAdminValidator;

class PexcelAdminController extends Controller {

    public $data_view = array();
    private $obj_pexcel = NULL;
    private $obj_pexcel_categories = NULL;
    private $obj_validator = NULL;

    public function __construct() {
        $this->obj_pexcel = new Pexcels();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

        $params = $request->all();

        $list_pexcel = $this->obj_pexcel->get_pexcels($params);

        $this->data_view = array_merge($this->data_view, array(
            'pexcels' => $list_pexcel,
            'request' => $request,
            'params' => $params
        ));
        return view('pexcel::pexcel.admin.pexcel_list', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $pexcel = NULL;
        $pexcel_id = (int) $request->get('id');


        if (!empty($pexcel_id) && (is_int($pexcel_id))) {
            $pexcel = $this->obj_pexcel->find($pexcel_id);
        }

        $this->obj_pexcel_categories = new PexcelsCategories();

        $this->data_view = array_merge($this->data_view, array(
            'pexcel' => $pexcel,
            'request' => $request,
            'categories' => $this->obj_pexcel_categories->pluckSelect()
        ));
        return view('pexcel::pexcel.admin.pexcel_edit', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function post(Request $request) {

        $this->obj_validator = new PexcelAdminValidator();

        $input = $request->all();

        $pexcel_id = (int) $request->get('id');
        $pexcel = NULL;

        $data = array();

        if ($this->obj_validator->validate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($pexcel_id) && is_int($pexcel_id)) {

                $pexcel = $this->obj_pexcel->find($pexcel_id);
            }
        } else {
            if (!empty($pexcel_id) && is_int($pexcel_id)) {

                $pexcel = $this->obj_pexcel->find($pexcel_id);

                if (!empty($pexcel)) {

                    $input['pexcel_id'] = $pexcel_id;
                    $pexcel = $this->obj_pexcel->update_pexcel($input);

                    //Message
                    $this->addFlashMessage('message', trans('pexcel::pexcel_admin.message_update_successfully'));
                    return Redirect::route("admin_pexcel.edit", ["id" => $pexcel->pexcel_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pexcel::pexcel_admin.message_update_unsuccessfully'));
                }
            } else {

                $pexcel = $this->obj_pexcel->add_pexcel($input);

                if (!empty($pexcel)) {

                    //Message
                    $this->addFlashMessage('message', trans('pexcel::pexcel_admin.message_add_successfully'));
                    return Redirect::route("admin_pexcel.edit", ["id" => $pexcel->pexcel_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pexcel::pexcel_admin.message_add_unsuccessfully'));
                }
            }
        }

        $this->data_view = array_merge($this->data_view, array(
            'pexcel' => $pexcel,
            'request' => $request,
                ), $data);

        return view('pexcel::pexcel.admin.pexcel_edit', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $pexcel = NULL;
        $pexcel_id = $request->get('id');

        if (!empty($pexcel_id)) {
            $pexcel = $this->obj_pexcel->find($pexcel_id);

            if (!empty($pexcel)) {
                //Message
                $this->addFlashMessage('message', trans('pexcel::pexcel_admin.message_delete_successfully'));

                $pexcel->delete();
            }
        } else {

        }

        $this->data_view = array_merge($this->data_view, array(
            'pexcel' => $pexcel,
        ));

        return Redirect::route("admin_pexcel");
    }

}
