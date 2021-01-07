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
        $userId = Auth::id();
        $date = Carbon::now();
        $date->toDateString();
        $newDateTime = Carbon::now()->addDays(7);
        $newDateTime->toDateString();
        $rental = DB::table('rentals')->insert([
            'user_id' => $userId,
            'movieId' => $request->input('movieId'),
            'title' => $request->input('title'),
            'rent_date' => $date,
            'return_date' => newDateTime
        ]);


       
        return response(['rental' => $rental]);
       
    }
    public function return(Request $request) {
       
        $return = DB::table('rentals')->where('id', $request->input('id'))->delete();


       
        return response(['return' => 'Movie returned succesfully']);
       
    }

    public function getRentals(Request $request) {
        $userId = Auth::id();
        $rentals = DB::select('select * from rentals where user_id = ?', $userId);


       
        return response(['rentals' => $rentals]);
       
    }
}
