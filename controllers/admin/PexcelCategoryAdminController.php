<?php namespace Foostart\Pexcel\Controllers\Admin;

use Illuminate\Http\Request;
use Foostart\Pexcel\Controllers\Admin\Controller;
use URL;
use Route,
    Redirect;
use Foostart\Pexcel\Models\PexcelsCategories;
/**
 * Validators
 */
use Foostart\Pexcel\Validators\PexcelCategoryAdminValidator;

class PexcelCategoryAdminController extends Controller {

    public $data_view = array();

    private $obj_pexcel_category = NULL;
    private $obj_validator = NULL;

    public function __construct() {
        $this->obj_pexcel_category = new PexcelsCategories();
    }

    /**
     *
     * @return type
     */
    public function index(Request $request) {

         $params =  $request->all();

        $list_pexcel_category = $this->obj_pexcel_category->get_pexcels_categories($params);

        $this->data_view = array_merge($this->data_view, array(
            'pexcels_categories' => $list_pexcel_category,
            'request' => $request,
            'params' => $params
        ));
        return view('pexcel::pexcel_category.admin.pexcel_category_list', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function edit(Request $request) {

        $pexcel = NULL;
        $pexcel_id = (int) $request->get('id');


        if (!empty($pexcel_id) && (is_int($pexcel_id))) {
            $pexcel = $this->obj_pexcel_category->find($pexcel_id);

        }

        $this->data_view = array_merge($this->data_view, array(
            'pexcel' => $pexcel,
            'request' => $request
        ));
        return view('pexcel::pexcel_category.admin.pexcel_category_edit', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function post(Request $request) {

        $this->obj_validator = new PexcelCategoryAdminValidator();

        $input = $request->all();

        $pexcel_id = (int) $request->get('id');

        $pexcel = NULL;

        $data = array();

        if (!$this->obj_validator->validate($input)) {

            $data['errors'] = $this->obj_validator->getErrors();

            if (!empty($pexcel_id) && is_int($pexcel_id)) {

                $pexcel = $this->obj_pexcel_category->find($pexcel_id);
            }

        } else {
            if (!empty($pexcel_id) && is_int($pexcel_id)) {

                $pexcel = $this->obj_pexcel_category->find($pexcel_id);

                if (!empty($pexcel)) {

                    $input['pexcel_category_id'] = $pexcel_id;
                    $pexcel = $this->obj_pexcel_category->update_pexcel_category($input);

                    //Message
                    $this->addFlashMessage('message', trans('pexcel::pexcel_admin.message_update_successfully'));
                    return Redirect::route("admin_pexcel_category.edit", ["id" => $pexcel->pexcel_id]);
                } else {

                    //Message
                    $this->addFlashMessage('message', trans('pexcel::pexcel_admin.message_update_unsuccessfully'));
                }
            } else {

                $pexcel = $this->obj_pexcel_category->add_pexcel_category($input);

                if (!empty($pexcel)) {

                    //Message
                    $this->addFlashMessage('message', trans('pexcel::pexcel_admin.message_add_successfully'));
                    return Redirect::route("admin_pexcel_category.edit", ["id" => $pexcel->pexcel_id]);
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

        return view('pexcel::pexcel_category.admin.pexcel_category_edit', $this->data_view);
    }

    /**
     *
     * @return type
     */
    public function delete(Request $request) {

        $pexcel = NULL;
        $pexcel_id = $request->get('id');

        if (!empty($pexcel_id)) {
            $pexcel = $this->obj_pexcel_category->find($pexcel_id);

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

        return Redirect::route("admin_pexcel_category");
    }

}