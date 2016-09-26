<?php

namespace CARTEIRA_IFBA\Http\Controllers\Admin\suap;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $this->authorize('permission_server');



    }

    public function store(){

    }

    public function view(){

    }
}
