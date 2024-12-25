<?php

namespace App\Http\Controllers;

use App\Http\Services\CoinPairService;
use App\Http\Services\ERC20TokenApi;
use App\Http\Services\MarketTradeService;
use App\Http\Services\PublicService;
use App\Jobs\MarketBotOrderJob;
use App\Model\Buy;
use App\Model\Coin;
use App\Model\Sell;
use App\Model\Transaction;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    //
    public function index(Request $request)
    {

//        if (env('APP_ENV') == 'local' || env('APP_ENV') == 'dev') {
            $service = new MarketTradeService();
//            $admin = User::where(['role' => USER_ROLE_ADMIN])->first();
//            $request->merge(['user_id' => $admin->id]);
//        $a = $service->makeMarketOrder($request);
//        dd($a);
//        dispatch(new MarketBotOrderJob($request->all()))->onQueue('market-bot');
//            Artisan::call('buy:order',['buy']);
//            Artisan::call('buy:order',['sell']);
//            return 'market bot started successfully';
//            storeException('storeException ',date('Y-m-d H:i:s'));
//            storeBotException('storeBotException ',date('Y-m-d H:i:s'));
//            if(env('BOT_LOG_PRINT_ENABLE') == 1) {
//                return 'BOT_LOG_PRINT_ENABLE = '.env('BOT_LOG_PRINT_ENABLE');
//            } else {
//                return 'BOT_LOG_PRINT_ENABLE disable = '.env('BOT_LOG_PRINT_ENABLE');
//            }
//            $sellData = '[["16585.4","0.088398"],["16586.6","0.130225"],["16587.9","0.296395"],["16589.1","0.374901"],["16590.4","1.172301"],["16591.6","0.683742"],["16592.8","0.577437"],["16594.1","0.509304"],["16595.3","0.652373"],["16596.6","0.569748"],["16597.8","0.179336"],["16599.1","0.931635"],["16600.3","0.412556"],["16601.2","0.1339"],["16601.3","2.84851"],["16601.4","2.09186"],["16601.5","0.35193"],["16601.6","0.817606"],["16601.9","0.45088"],["16602","1.33502"],["16602.1","1.14396"],["16602.3","0.117"],["16602.4","0.2"],["16602.5","0.54251"],["16602.6","0.69315"],["16602.7","0.07584"],["16602.8","0.97602"],["16603","0.60068"],["16603.2","0.2"],["16603.4","13.02032"],["16603.5","0.39671"],["16603.6","0.33298"],["16603.7","0.07846"],["16603.8","1.99527"],["16603.9","0.3679"],["16604","3.79954"],["16604.1","1.272147"],["16604.2","1.8"],["16604.3","0.5238"],["16604.4","0.28944"],["16604.5","0.25354"],["16604.6","0.43646"],["16604.8","0.83542"],["16604.9","0.05335"],["16605","2.711"],["16605.1","0.24096"],["16605.2","0.23529"],["16605.3","4.439184"],["16605.4","0.26006"],["16605.5","0.15644"],["16605.6","0.02836"],["16605.7","0.0233"],["16605.9","0.43967"],["16606","0.54703"],["16606.1","0.11447"],["16606.2","0.67515"],["16606.3","0.07849"],["16606.4","1.33784"],["16606.5","2.31317"],["16606.6","1.464413"],["16606.8","0.30878"],["16606.9","0.28093"],["16607.1","0.21885"],["16607.3","0.24123"],["16607.4","0.01753"],["16607.5","1.86919"],["16607.6","1.4633"],["16607.8","1.538763"],["16607.9","0.25736"],["16608","2.15986"],["16608.1","2.78445"],["16608.2","0.01851"],["16608.3","0.53438"],["16608.4","0.17825"],["16608.5","0.02204"],["16608.6","1.93482"],["16608.7","0.09574"],["16608.9","0.31016"],["16609","1.971742"],["16609.1","0.17742"],["16609.2","3.87315"],["16609.5","0.63989"],["16609.6","0.01861"],["16609.8","0.14968"],["16609.9","1.68994"],["16610","5.13554"],["16610.1","0.16395"],["16610.2","0.05368"],["16610.3","1.053984"],["16610.4","10.92479"],["16610.5","0.13474"],["16610.6","0.14596"],["16610.7","0.07544"],["16610.8","0.23799"],["16610.9","0.31711"],["16611","0.23479"],["16611.1","0.60663"],["16611.2","0.22473"],["16611.3","0.421"],["16611.4","0.2893"]]';
//            $data = json_decode($sellData);
//            if (isset($data[0])) {
//                foreach ($data as $item) {
//                    dd($item[0]);
//                }
//            }
            try {

//                $parService = new CoinPairService();
//                $coinPairs = $parService->getAllCoinPairsData()['data'];
//                $delOffset = 20;
//
//                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
//                $buyIds = [];
//                $a = Buy::where(['is_bot' => STATUS_ACTIVE,'status' => 1])->take(1000)->skip($delOffset)
//                    ->withTrashed()
//                    ->get();
//                $b = Buy::where(['is_bot' => 1,'status' => 1])
//                    ->withTrashed()
//                    ->get();
//
//                $buys = Buy::latest()->where(['is_bot' => STATUS_ACTIVE,'status' => 1])
//                    ->take(1000)->skip($delOffset)
//                    ->withTrashed()
//                    ->toSql();
//                if (isset($buys[0])) {
//                    foreach ($buys as $buy) {
//                        $buyIds[] = $buy->id;
//                    }
//                }
//                Buy::whereIn('id',$buyIds)->forcedelete();
//                dd($buys);
//                dd($b->count(),$a->count(),$buys->count(),$buyIds);
//                $startDate = Carbon::now()->subMinutes(10)->startOfMinute();
//                $endDate = Carbon::now();
////                dd($startDate->unix(),intval($startDate->unix() / 300),intval($startDate->unix() / 300) * 300,Carbon::parse(intval($startDate->unix() / 300) * 300));
//               $count = 0;
//                while ($startDate <= $endDate) {
//                    storeException('while', 'called');
//                    $intervalDate = Carbon::parse(intval($startDate->unix() / 300) * 300);
//                    if ($startDate->equalTo($intervalDate)) {
//                        storeException('$intervalDate', 'matched');
//                        dd('ok');
//                        }
//                    $count++;
//                    }
//                $this->testTokenBotTrading($request);
                $this->deleteBotData($request);
//                $this->checkErc20ContractAddress();
            } catch (\Exception $e) {
                dd($e->getMessage());
            }

//
//        }
    }

    // check erc20 token
    public function checkErc20ContractAddress()
    {
        $coin = Coin::join('coin_settings', 'coin_settings.coin_id', '=', 'coins.id')
            ->where(['coins.coin_type' => 'PX'])
            ->first();
        $api = new ERC20TokenApi($coin);
        $requestData = array(
//            "address" => '0x281480653F77506b070E1738EE8CbEaFeaB10145',
            "contract_address" => '0x2e3Ca81aa6C8816E929b1fBce8c02AD7558542e7',
        );
        $data = $api->checkContractDetails($requestData);
        dd($data);
    }

    public function deleteBotData($request) {

        // delete active old order
        $buys = Buy::where(['is_bot' => STATUS_ACTIVE,'status' => 1])->withTrashed()->get();
        $lastOneHourBuy = Buy::where(['is_bot' => STATUS_ACTIVE,'status' => 0])
            ->where('created_at', '>', \Carbon\Carbon::now()->subMinutes(45))
            ->withTrashed()
            ->count();
        if ($lastOneHourBuy == 0) {
            $lastOneHourBuy = 50;
        }
        $buyIdsActive = [];
        $buysActive = Buy::latest()->where(['is_bot' => STATUS_ACTIVE,'status' => 0])
            ->take(10000)
            ->skip($lastOneHourBuy)
            ->withTrashed()
            ->get();
        if (isset($buysActive[0])) {
            foreach ($buysActive as $buy1) {
                $buyIdsActive[] = $buy1->id;
            }
        }
//        Buy::whereIn('id',$buyIdsActive)->forcedelete();

        $sells = Sell::where(['is_bot' => STATUS_ACTIVE,'status' => 0])
            ->withTrashed()
            ->get();
        $lastOneHourSell = Sell::where(['is_bot' => STATUS_ACTIVE,'status' => 0])
            ->where('created_at', '>', \Carbon\Carbon::now()->subMinutes(45))
            ->withTrashed()
            ->count();
        if ($lastOneHourSell == 0) {
            $lastOneHourSell = 50;
        }
        $sellIdsActive = [];
        $sellsActive = Sell::latest()->where(['is_bot' => STATUS_ACTIVE,'status' => 0])
            ->take(10000)
            ->skip($lastOneHourSell)
            ->withTrashed()
            ->get();

        if (isset($sellsActive[0])) {
            foreach ($sellsActive as $sell1) {
                $sellIdsActive[] = $sell1->id;
            }
        }
        dd($buys->count(),$lastOneHourBuy,$buysActive->count(),$sells->count(),$lastOneHourSell,$sellsActive->count());
//        Sell::whereIn('id',$sellIdsActive)->forcedelete();
    }

    public function testTokenBotTrading(Request $request)
    {
        $publicService = new PublicService();
        $marketService = new MarketTradeService();

        dd($marketService->getPrice(0.045,'big'),$marketService->getPrice(0.045,'small'));
        $parService = new CoinPairService();
        $coinPairs = $parService->getAllCoinPairsData()['data'];
//        dd($coinPairs);
        if (isset($coinPairs[0])) {
            foreach ($coinPairs as $pair) {
                if($pair['is_token'] == 1) {
                    $request->merge([
                        'base_coin_id' => $pair['parent_coin_id'],
                        'trade_coin_id' => $pair['child_coin_id'],
                        'order_type' => 'buy_sell',
                        'dashboard_type' => 'dashboard',
                        'per_page' => 10
                    ]);
                    $orderBook = $publicService->getOrderdata($request);
                    $aa = $this->makeBuySellData($orderBook['sells'],$orderBook['buys'],$pair);
                    $requestData['user_id'] = 1;
                    $requestData['pair_id'] = $pair['id'];
                    $requestData['coin_pair_coin'] = $pair['coin_pair_coin'];
                    $sellData = $aa['sells'];
                    $buyData = $aa['buys'];
                    storeException('$sellData', $sellData);
                    storeException('$buyData', $buyData);
                    $this->createBuyOrder($requestData,$pair,$buyData);
                    $this->createSellOrder($requestData,$pair,$sellData);
                }
            }
        } else {
            dd('pair not found');
        }

    }
// buy order create
    public function createBuyOrder($requestData,$pair,$sellData)
    {
        $request = new Request($requestData);
        $service = new MarketTradeService();
        $request->merge(['bot_order_type' => 'buy']);
        $service->makeMarketOrder($request,$pair,$sellData);
    }

    // sell order create
    public function createSellOrder($requestData,$pair,$buyData)
    {
        $request = new Request($requestData);
        $service = new MarketTradeService();
        $request->merge(['bot_order_type' => 'sell']);
        $service->makeMarketOrder($request,$pair,$buyData);
    }
    public function makeBuySellData($ask,$bids,$pair)
    {
        if (isset($ask[0])) {
            $sellData = $ask;
        } else {
            $sellData = [];
            if ($pair['last_price'] == $pair['initial_price']) {
                $sellData[]=[
                    'price' => $pair['last_price'],
                    'amount' => $this->getAmount($pair['last_price'])
                ];
            } else {
                $sellData[]=[
                    'price' => $this->getPrice($pair['last_price'],'big'),
                    'amount' => $this->getAmount($pair['last_price'])
                ];
            }
        }
        if (isset($bids[0])) {
            $buyData = $bids;
        } else {
            $buyData = [];
            $buyData[]=[
                'price' => $this->getPrice($pair['last_price'],'small'),
                'amount' => $this->getAmount($pair['last_price'])
            ];
        }
        $data = [
            'buys' => $buyData,
            'sells' => $sellData
        ];
        return $data;
    }

    public function getPrice($lastPrice,$type)
    {
        $div = pow(10, 8);
        $settingTolerance = 0.1;
        $tolerancePrice = bcdiv(bcmul($lastPrice, $settingTolerance), "100");
        if ($type == 'big') {
            $tolerance = bcadd($lastPrice, $tolerancePrice);
            $price = custom_number_format(rand($lastPrice * $div, $tolerance * $div) / $div);

        } else {
            $tolerance = bcsub($lastPrice, $tolerancePrice);
            $price = custom_number_format(rand($tolerance * $div, $lastPrice * $div) / $div);
        }
        return $price;
    }
    public function getAmount($price)
    {
        $div = pow(10, 8);
        if ($price >= 1) {
            $amount = custom_number_format(rand(0.0000001 * $div, 0.00001 * $div) / $div);
        } else {
            $amount = custom_number_format(rand(0.001 * $div, 0.1 * $div) / $div);
        }
        return $amount;
    }
}
