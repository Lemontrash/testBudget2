<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryActivity;
use App\CustomCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SummaryController extends Controller
{
    public function getSummaryForLastMonth(){
        $monthlyCosts = CategoryActivity::where(
            'created_at', '>=', Carbon::now()->subMonth()->toDateTimeString()
        )->where('userId', Auth::id())->get();
        $data = $this->countSummary($monthlyCosts);
        // dd($monthlyCosts);
        // dd($data);
        return response()->json($data);
    }

    public function getSummaryForLastYear(){
        $yearlyCosts  = CategoryActivity::where(
            'created_at', '>=', Carbon::now()->subYear()->toDateTimeString()
        )->where('userId', Auth::id())->get();
        $this->countSummary($yearlyCosts);
    }

    public function getSummaryForSetAmountOfDays(Request $request){
        $customCosts  = CategoryActivity::where(
            'created_at', '>=', Carbon::now()->subDays($request->get('days'))->toDateTimeString()
        )->where('userId', Auth::id())->get();
        $this->countSummary($customCosts);
        // dd($customCosts);
    }

    public function countSummary($costs){
        if ($costs->isEmpty()){
            return response()->json(['success' => false, 'message' => 'No summary available']);
        }
        $data = [];
        foreach ($costs as $cost) {
            $categoryName = Category::find($cost->category_id)->name;
            // $data[$categoryName][$cost->currency] = $cost->amount_of_money;
            if(isset($data[$categoryName])) {
              $data[$categoryName] += $cost->amount_of_money;
            }else {
              $data[$categoryName] = $cost->amount_of_money;
            }

        }
        // dd($data);
        return $data;


    }




}
