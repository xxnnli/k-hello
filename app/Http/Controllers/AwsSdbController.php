<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Aws\SimpleDb\SimpleDbClient;

class AwsSdbController extends Controller {
    public function login() {
        return view('sdb_login');
    }

    public function list(Request $request) {
        if($request->isMethod('post')) {
            $request->session()->flush();
            $this->validate($request, [
                'name' => 'required|sdb_login',
                'psw' => 'required|sdb_login'
            ]);
            $name = $request->input('name');
            $pass = $request->input('psw');
            $request->session()->put('name', $name);
            $request->session()->put('pass', $pass);
        } else if(($name = $request->session()->get('name')) && ($pass = $request->session()->get('pass'))) {
            // do nothing
        } else {
            return redirect('sdb_login');
        }
        $client = SimpleDbClient::factory([
            'credentials' => [
                'key'    => env('aws_ki'),
                'secret' => env('aws_si')
            ],
            'region'  => 'us-east-1'
        ]);
        $domains = $client->getIterator('ListDomains')->toArray();
        $data = [];
        foreach($domains as $domain) {
            $iterator = $client->getIterator('Select', ['SelectExpression' => "select * from $domain"]);
            foreach ($iterator as $item) {
                $data[$domain][] = ['Name' => $item['Name'], 'Attributes' => $item['Attributes']];
            }
        }
        return view('sdb_list', ['data'=>$data]);
    }
}