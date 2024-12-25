<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Services\BitgoWalletService;
use App\Http\Services\DepositService;
use App\Http\Services\WalletService;
use App\Jobs\PendingDepositAcceptJob;
use App\Jobs\PendingDepositRejectJob;
use App\Model\AdminReceiveTokenTransactionHistory;
use App\Model\DepositeTransaction;
use App\Model\EstimateGasFeesTransactionHistory;
use App\Model\Coin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\DepositRequest;

class DepositController extends Controller
{
    // gas send history
    public function adminGasSendHistory(Request $request)
    {
        $data['title'] = __('Admin Estimate Gas Sent History');
        if ($request->ajax()) {
            $items = EstimateGasFeesTransactionHistory::join('deposite_transactions', 'deposite_transactions.id', '=','estimate_gas_fees_transaction_histories.deposit_id')
                ->select('estimate_gas_fees_transaction_histories.*','deposite_transactions.coin_type as token');

            return datatables()->of($items)
                ->addColumn('created_at', function ($item) {
                    return $item->created_at;
                })
                ->addColumn('status', function ($item) {
                    return deposit_status($item->status);
                })
                ->make(true);
        }

        return view('admin.transaction.deposit.gas_sent_history', $data);
    }

    // token receive history
    public function adminTokenReceiveHistory(Request $request)
    {
        $data['title'] = __('Admin Token Receive History');
        if ($request->ajax()) {
            $items = AdminReceiveTokenTransactionHistory::join('deposite_transactions', 'deposite_transactions.id', '=','admin_receive_token_transaction_histories.deposit_id')
                ->select('admin_receive_token_transaction_histories.*','deposite_transactions.coin_type');

            return datatables()->of($items)
                ->addColumn('created_at', function ($item) {
                    return $item->created_at;
                })
                ->addColumn('status', function ($item) {
                    return deposit_status($item->status);
                })
                ->make(true);
        }

        return view('admin.transaction.deposit.token_receive_history', $data);
    }

    // token pending deposit history
    public function adminPendingDepositHistory(Request $request)
    {
        $data['title'] = __('Pending Token Deposit History');

        if ($request->ajax()) {
//            $time = time() - 1500;
//            $date = date('Y-m-d H:i:s',$time);
            $items = DepositeTransaction::join('coins','coins.coin_type', '=', 'deposite_transactions.coin_type')
                ->where(['deposite_transactions.address_type' => ADDRESS_TYPE_EXTERNAL])
                ->where('deposite_transactions.is_admin_receive', STATUS_PENDING)
                ->select('deposite_transactions.*')
                ->whereIn('coins.network',[ERC20_TOKEN,BEP20_TOKEN])
                ->get();

            return datatables()->of($items)
                ->addColumn('created_at', function ($item) {
                    return $item->created_at;
                })
                ->addColumn('status', function ($item) {
                    return '<span class="badge badge-warning">'.deposit_status($item->status).'</span>';
                })
                ->addColumn('actions', function ($wdrl) {
                    $action = '<ul>';
                    $action .= accept_html('adminPendingDepositAccept',encrypt($wdrl->id));
                    $action .= '<ul>';

                    return $action;
                })
                ->rawColumns(['actions','status'])
                ->make(true);
        }

        return view('admin.transaction.deposit.token_pending_deposit_history', $data);
    }

    // pending deposit reject process
    public function adminPendingDepositReject($id)
    {
        if (isset($id)) {
            try {
                $wdrl_id = decrypt($id);
            } catch (\Exception $e) {
                return redirect()->back();
            }
            $transaction = DepositeTransaction::where(['id' => $wdrl_id, 'status' => STATUS_PENDING, 'address_type' => ADDRESS_TYPE_EXTERNAL])->first();

            if (!empty($transaction)) {
                dispatch(new PendingDepositRejectJob($transaction,Auth::id()))->onQueue('deposit');
                return redirect()->back()->with('success', __('Pending deposit reject process goes to queue. Please wait sometimes'));
            } else {
                return redirect()->back()->with('dismiss', __('Pending deposit not found'));
            }
        }
    }

    // pending deposit accept process
    public function adminPendingDepositAccept($id)
    {
        if (isset($id)) {
            try {
                $wdrl_id = decrypt($id);
            } catch (\Exception $e) {
                return redirect()->back();
            }
            $transactions = DepositeTransaction::join('coins','coins.coin_type', '=', 'deposite_transactions.coin_type')
                ->where(['deposite_transactions.address_type' => ADDRESS_TYPE_EXTERNAL])
                ->where('deposite_transactions.is_admin_receive', STATUS_PENDING)
                ->where('deposite_transactions.id', $wdrl_id)
                ->select('deposite_transactions.*')
                ->whereIn('coins.network',[ERC20_TOKEN,BEP20_TOKEN])
                ->first();
            if (!empty($transactions)) {
                dispatch(new PendingDepositAcceptJob($transactions,Auth::id()))->onQueue('deposit');
                return redirect()->back()->with('success', __('Pending deposit accept process goes to queue. Please wait sometimes'));
            } else {
                return redirect()->back()->with('dismiss', __('Pending deposit not found'));
            }
        }
    }

    public function adminCheckDeposit()
    {
        $data['title'] = __('Check Deposit');
        $data['coin_list'] = Coin::where(['status' => STATUS_ACTIVE])->get();
        return view('admin.transaction.deposit.check-deposit', $data);
    }

    public function submitCheckDeposit(DepositRequest $request)
    {
        try{
            $service = new DepositService();
            $response = $service->checkDepositByHash($request->network,$request->coin_type,$request->transaction_id,$request->type);
            if ($response['success'] == true) {
                if ($request->type == CHECK_DEPOSIT) {
                    $data = $response['data'];
                    $data['network'] = $request->network;
                    $data['coin_type'] = $request->coin_type;
                    $data['transaction_id'] = $request->transaction_id;
                    $data['type'] = $request->type;
                    $data['title'] = __('Transaction Details');
                    $data['coin_list'] = Coin::where(['status' => STATUS_ACTIVE])->get();

                    return view('admin.transaction.deposit.check-deposit', $data);
                }
            } else {
                return redirect()->back()->with('dismiss', $response['message']);
            }
        }catch (\Exception $e) {
            storeException("submitCheckDeposit",$e->getMessage());
            return redirect()->back()->with('dismiss', $e->getMessage());
        }
    }
}
