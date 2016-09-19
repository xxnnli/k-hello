<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AwsSdbController extends Controller {
    public function login() {
        return view('sdb_login');
    }

    public function list(Request $request) {
        $name = $pass = NULL;
        if(($name = $request->input('name')) && ($pass = $request->input('psw'))) {
            if($name == env('sdb_name') && $pass == env('sdb_pass')) {
                $request->session()->put('name', $name);
                $request->session()->put('pass', $pass);
            } else {
                $request->session()->flush();
                return redirect('sdb_login');
            }
        } else if(($name = $request->session()->get('name')) && ($pass = $request->session()->get('pass'))) {
            // do nothing
        } else {
            return redirect('sdb_login');
        }
        $domains = ['xlitest1', 'url_path_dev'];
        return view('sdb_list', ['domains'=>$domains]);
    }
}