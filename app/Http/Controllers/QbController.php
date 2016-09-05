<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OAuth;

class QbController extends Controller
{
    protected $oauth;

    public function __construct()
    {
        $this->oauth = new OAuth(env('qb_consumer_key'), env('qb_consumer_secret'), OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_URI);
        $this->oauth->enableDebug();
        $this->oauth->disableSSLChecks(); //To avoid the error: (Peer certificate cannot be authenticated with given CA certificates)
    }

    public function rt(Request $request)
    {
        $req_url = 'https://oauth.intuit.com/oauth/v1/get_request_token';
        $auth_url = 'https://appcenter.intuit.com/Connect/Begin';
        $rt = $this->oauth->getRequestToken($req_url, str_replace('/rt', '/at', $request->url()));
        $request->session()->put('secret', $rt['oauth_token_secret']);
        return redirect($auth_url .'?oauth_token='.$rt['oauth_token']);
    }

    public function at(Request $request)
    {
        $acc_url = 'https://oauth.intuit.com/oauth/v1/get_access_token';
        $secret = $request->session()->get('secret');
        $this->oauth->setToken($request->input('oauth_token'), $secret);
        $at = $this->oauth->getAccessToken($acc_url);
        $token = serialize($at);
        $realmId = $request->input('realmId');  // realmId is legacy for customerId;
        $dataSource = $request->input('dataSource');
        return view('qb_token_result', ['secret'=>$secret, 'token'=>$token, 'realmId'=>$realmId, 'dataSource'=>$dataSource]);
    }
}