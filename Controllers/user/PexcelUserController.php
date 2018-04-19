<?php

namespace Foostart\Pexcel\Controlers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use URL,
    Route,
    Redirect;
use Foostart\Pexcel\Models\Pexcels;

class PexcelUserController extends Controller
{
    public $data = array();
    public function __construct() {

    }

    public function index(Request $request)
    {

        $obj_pexcel = new Pexcels();
        $pexcels = $obj_pexcel->get_pexcels();
        $this->data = array(
            'request' => $request,
            'pexcels' => $pexcels
        );
        return view('pexcel::pexcel.index', $this->data);
    }

}