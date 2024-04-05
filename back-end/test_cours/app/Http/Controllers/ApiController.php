<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function login(Request $request){
        try {
			$http = new \GuzzleHttp\Client;

			$response = $http->post('http://localhost/oauth/token', [
				'form_params' => [
					'grant_type' => 'password',
					'client_id' => '2',
					'client_secret' => 'qs0kxzQNgIowO05CtN4KkCxEOb4ngTKqDwBrvCoP',
					'username' => $request->email,
					'password' => $request->password,
					'scope' => '*',
				],
			]);
			return  $response->getBody();
		} catch (\GuzzleHttp\Exception\BadResponseException $e) {
            return response()->json('Something went wrong on the server.', $e->getCode());
		}
    }



}
