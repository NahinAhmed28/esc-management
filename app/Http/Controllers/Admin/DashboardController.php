<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use FontLib\EOT\File;
use Illuminate\Http\Request;
use App\Models\Lang as ModelsLang;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Foreach_;

class DashboardController extends Controller
{
    const VIEW_PATH = 'admin.dashboard.';

    public function __construct()
    {
    }

    public function index()
    {
      // return $authUser = Auth::guard('admin')->user()->load(['userType']);
      // return Admin::DEFAULT_ROLE[2];
      // return Admin::DEFAULT_ROLE_LIST[5];
      //return Config::get('languages')['bn']['display'];

      // foreach (Admin::DEFAULT_ROLE as $key => $value) {
      //   echo 'key - '. $key . ' value - '. $value;
      // }
      // exit;

      $data = [];
      return view(self::VIEW_PATH . 'index', compact('data'));
    }


    

}
