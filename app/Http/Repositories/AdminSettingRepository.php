<?php

namespace App\Http\Repositories;


use App\Http\Services\MarketTradeService;
use App\Model\AdminSetting;
use App\Model\CoinPair;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AdminSettingRepository
{
    public function updateOrCreate($slug, $value)
    {
        return AdminSetting::updateOrCreate(['slug' => $slug], ['slug' => $slug, 'value' => $value]);
    }
    public function updateOrCreateTrade($slug, $value)
    {
        return AdminSetting::updateOrCreate(['slug' => $slug], $value);
    }


    public function ApiCredentialsUpdateOrCreate($coinId, $apiService, $withdrawalFeeMethod, $withdrawalFeePercent, $withdrawalFeeFixed)
    {
        return CoinSetting::updateOrCreate(['coin_id' => $coinId], ['coin_id' => $coinId, 'api_service' => $apiService, 'withdrawal_fee_method' => $withdrawalFeeMethod, 'withdrawal_fee_percent' => $withdrawalFeePercent, 'withdrawal_fee_fixed' => $withdrawalFeeFixed]);
    }

    public function updateOrCreateCoinPair($request, $edit_id=null)
    {
        $data = [
            'parent_coin_id' => $request->parent_coin_id,
            'child_coin_id' => $request->child_coin_id,
            'is_token' => $request->is_token
        ];
        if ($request->is_token == STATUS_ACTIVE) {
            $data['bot_trading'] = STATUS_PENDING;
        }
        if (isset($edit_id)) {
            $coinPair = CoinPair::where('id', decrypt($edit_id))->first();
            if (isset($coinPair)) {
                if($request->price) {
                    $data['price'] = $request->price;
                }
                return $coinPair->update($data);
            }
            return false;
        } else {
            $pair = get_coin_type($request->child_coin_id).get_coin_type($request->parent_coin_id);
            $callApi = getPriceFromApi($pair);
            if ($callApi['success'] == true) {
                $data['bot_possible'] = STATUS_ACTIVE;
                $data['price'] = $callApi['data']['price'];
                $data['initial_price'] = $callApi['data']['price'];
                $create = CoinPair::create($data);
                return $create;
            } else {
                if(isset($request->price) && $request->price > 0) {
                    $data['price'] = $request->price;
                    $data['initial_price'] = $request->price;
                    $create = CoinPair::create($data);
                    return $create;
                } else {
                    return false;
                }
            }

        }
    }

    // buy order create
    public function createBuyOrder($requestData,$pair,$sellData)
    {
        storeBotException('createBuyOrder called', date('Y-m-d H:i:s'));
        $request = new Request($requestData);
        $service = new MarketTradeService();
        $request->merge(['bot_order_type' => 'buy']);
        $service->makeMarketOrder($request,$pair,$sellData);
    }

    // sell order create
    public function createSellOrder($requestData,$pair,$buyData)
    {
        storeBotException('createSellOrder called', date('Y-m-d H:i:s'));
        $request = new Request($requestData);
        $service = new MarketTradeService();
        $request->merge(['bot_order_type' => 'sell']);
        $service->makeMarketOrder($request,$pair,$buyData);
    }
    public function saveMaintenanceModeData($data)
    {
        try{
            if(isset($data))
            {
                foreach ($data as $key => $val) {
                    $this->updateOrCreate($key, $val);
                }

                $response = ['success' => true, 'message' => 'Maintenance Mode Updated successfully!'];
            }else{
                $response = ['success' => false, 'message' => 'No Data Updated, Insert data First'];
            }
        } catch (\Exception $e) {
            storeException('saveMaintenanceModeData', $e->getMessage());
            $response = ['success' => false, 'data' => [], 'message' => 'something went wrong'];
        }
        return $response;
    }
}
