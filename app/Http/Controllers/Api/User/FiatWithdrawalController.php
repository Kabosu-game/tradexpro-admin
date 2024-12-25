<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\FiatWithdrawalRequest;
use App\Http\Services\FiatWithdrawalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FiatWithdrawalController extends Controller
{
    private $service;
    function __construct()
    {
        $this->service = new FiatWithdrawalService();
    }
    // fiat withdrawal data
    public function fiatWithdrawal()
    {
        $response = $this->service->getFiatWithdrawalData(Auth::id());

        return response()->json($response);
    }

    // fiat withdrawal rate
    public function getFiatWithdrawalRate(FiatWithdrawalRequest $request)
    {
        $response = $this->service->getFiatWithdrawalRateData($request,Auth::id());

        return response()->json($response);
    }
    // fiat withdrawal process
    public function fiatWithdrawalProcess(FiatWithdrawalRequest $request)
    {
        $response = $this->service->fiatWithdrawalProcess($request,Auth::id());

        return response()->json($response);
    }
    // fiat withdrawal list
    public function fiatWithdrawHistory(Request $request){
        try{
            $response = $this->service->getWithdrawalHistory(Auth::id(), $request->per_page);
            return response()->json($response);
        }catch (\Exception $e){
            return response()->json(['success' => false,'message' => __('Something went wrong')]);
        }
    }
}
