<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AllAudiencesController extends Controller
{
    public function all() {
        return DB::select('select * from audiences', [1]);
    }

    public function redisTest(){
        return json_decode(Redis::get('allAudiences') )    ;
    }
}
