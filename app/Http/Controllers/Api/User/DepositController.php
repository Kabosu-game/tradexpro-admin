<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Requests\Api\User\CurrencyDepositRateRequest;
use App\Http\Services\User2FAService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CurrencyDepositRequest;
use App\Http\Services\CurrencyDepositService;
use App\Http\Services\BankService;
use App\Http\Services\PaymentMethodService;
use App\Http\Services\WalletService;
use App\Http\Services\CurrencyService;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    public $service;
    private $bankService;
    private $paymentMethodService;
    private $walletService;
    private $currencyService;

    function __construct()
    {
        $this->service = new CurrencyDepositService();
        $this->bankService = new BankService();
        $this->paymentMethodService = new PaymentMethodService();
        $this->walletService = new WalletService();
        $this->currencyService = new CurrencyService();
    }
    /**
     * currencyDepositProcess
     *
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function currencyDepositProcess(CurrencyDepositRequest $request)
    {
        $currency_deposit_2fa_status = allsetting()['currency_deposit_2fa_status'] ?? 1;
        if ($currency_deposit_2fa_status == STATUS_ACTIVE && get_fiat_currency_method($request->payment_method_id) != PAYPAL) {
            $google2faService = new User2FAService();
            $valid = $google2faService->userGoogle2faValidation(Auth::user(),$request);
            if ($valid['success']) {
                $response = $this->service->sendCurrencyDepositRequest($request,Auth::user());
            } else {
                $response = responseData(false,$valid['message']);
            }
        } else {
            $response = $this->service->sendCurrencyDepositRequest($request,Auth::user());
        }

        return response()->json($response);
    }

    public function currencyDepositInfo(Request $request)
    {
        $data['banks'] = $this->bankService->getBanks();
        $data['payment_methods'] = $this->paymentMethodService->getCurrencyDepositePaymentMethods();
        $data['wallet_list'] =$this->walletService->getUserWalletList(Auth::id());
        $data['currency_list'] =$this->currencyService->getActiveCurrencyList();

        return response()->json(responseData(true,__('Bank and Payment Method List'),$data));
    }

    public function depositBankDetails($id)
    {
        $data = $this->bankService->getBank($id)['item'];

        return response()->json(responseData(true,__('Bank details'),$data));
    }

    // get currency deposit rate
    public function currencyDepositRate(CurrencyDepositRateRequest $request)
    {
        $response = $this->service->getCurrencyDepositRate($request,Auth::user());
        return response()->json($response);
    }

    public function currencyDepositHistory(Request $request)
    {
        $response = $this->service->getDepositHistory(Auth::id(),$request);
        return response()->json(responseData(true,__('Currency Deposit History'),$response));
    }
}
