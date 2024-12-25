<?php


namespace App\Http\Services;


use App\Model\Coin;
use App\Model\DepositeTransaction;

class DepositService
{

    public function __construct()
    {
    }

    // check deposit by transaction
    public function checkDepositByHash($network,$coinType,$hash,$type)
    {
        try {
            $coin = Coin::join('coin_settings','coin_settings.coin_id', '=', 'coins.id')
                ->where(['coins.coin_type' => $coinType])
                ->first();
            if ($coin) {
                if ($network == $coin->network) {
                    if ($coin->network == BITGO_API) {
                        $response = $this->checkBitgoTransaction($coin, $hash, $type);
                    } else {
                        $response = responseData(false,__('This feature is currently under construction'));
                    }
                } else {
                    $response = responseData(false,__('Your selected network is invalid for this coin'));
                }
            } else {
                $response = responseData(false,__('Coin not found'));
            }
        } catch (\Exception $e) {
            storeException('checkDepositByHash',$e->getMessage());
            $response = responseData(false,$e->getMessage());
        }
        return $response;
    }

    // check bitgo transaction hash
    public function checkBitgoTransaction($coin, $hash, $type)
    {
        try {
            $service = new WalletService();
            if (empty($coin->bitgo_wallet_id)) {
                $response = responseData(false,__('Bitgo wallet id is empty, please add it first'));
            } else {
                $checkHash = DepositeTransaction::where(['transaction_id' => $hash])->first();
                if (isset($checkHash)) {
                    $response = responseData(false,__('bitgoWalletCoinDeposit hash already in db'));
                } else {
                    $getTransaction = $service->getTransaction($coin->coin_type, $coin->bitgo_wallet_id, $hash);
                    if ($getTransaction['success'] == true) {
                        $bitgoService = new BitgoWalletService();
                        $transactionData = $getTransaction['data'];
                        if ($transactionData['type'] == 'receive' && $transactionData['state'] == 'confirmed') {
                            $coinVal = $bitgoService->getDepositDivisibilityValues($transactionData['coin']);
                            $amount = bcdiv($transactionData['value'],$coinVal,8);

                            $data = [
                                'coin_type' => $transactionData['coin'],
                                'txId' => $transactionData['txid'],
                                'confirmations' => $transactionData['confirmations'],
                                'amount' => $amount
                            ];

                            if (isset($transactionData['entries'][0])) {
                                foreach ($transactionData['entries'] as $entry) {
                                    if (isset($entry['wallet']) && ($entry['wallet'] == $transactionData['wallet'])) {
                                        $data['address'] = $entry['address'];
                                        storeException('entry address', $data['address']);
                                    }
                                }
                            }
                            if(isset($data['address'])) {
                                if ($type == CHECK_DEPOSIT) {
                                    $response = ['success' => true,'message' => __('Transaction found'), 'data' => $data];
                                } else {
                                    $response = $service->checkAddressAndDeposit($data);
                                }
                            } else {
                                $response = ['success' => false,'message' => __('No address found')];
                            }
                        } else {
                            $response = ['success' => false,'message' => __('The transaction type is not receive')];
                        }
                    } else {
                        $response = responseData(false,$getTransaction['message']);
                    }
                }
            }
        } catch (\Exception $e) {
            storeException('checkBitgoTransaction',$e->getMessage());
            $response = responseData(false,$e->getMessage());
        }
        return $response;
    }

}
