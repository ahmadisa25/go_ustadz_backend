<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Ustadz;
use App\Http\Processors\UstadzProcessor;
use App\Http\Requests\UstadzRequest;

class UstadzController extends Controller
{
 	public function __construct()
    {
        $this->middleware('auth:api');
    }	

    public function getNearestUstadz(UstadzRequest $request){
    	$ustadz = UstadzProcessor::getNearestUstadz($request->lat_alamat, $request->long_alamat, $request->topic);
    	return response()->json($ustadz, 200);
    }
}
