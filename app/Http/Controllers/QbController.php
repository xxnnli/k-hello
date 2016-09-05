<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class QbController extends Controller
{
    public function rt()
    {
        $auth_ulr = 'https://appcenter.intuit.com/Connect/Begin';
        $rt = '111111';
        return redirect($auth_ulr .'?oauth_token='.$rt);
    }
}