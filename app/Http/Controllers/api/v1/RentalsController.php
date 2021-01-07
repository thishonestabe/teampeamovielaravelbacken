<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class RentalsController extends Controller
{
    public function create(Request $request) {
        $date = Carbon::now();
        $date->toDateString();
        $newDateTime = Carbon::now()->addDays(7);
        $newDateTime->toDateString();
        $rental = DB::table('rentals')->insert([
            'user_id' => $request->input('userId'),
            'movieId' => $request->input('movieId'),
            'title' => $request->input('title'),
            'rent_date' => $date,
            'return_date' => newDateTime


        ]);


       
        return response(['user' => Auth::user(), 'access_token' => $accessToken]);
       
    }
}
