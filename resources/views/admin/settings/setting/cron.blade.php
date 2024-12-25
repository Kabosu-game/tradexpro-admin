<div class="header-bar">
    <div class="table-title">
        <h3>{{__('Cron Setup')}}</h3>
    </div>
</div>
<div class="profile-info-form">
    <form action="{{route('adminSaveCronSettings')}}" method="post"
          enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-6 col-12  mt-20">
                <div class="form-group">
                    <label for="#">{{__('Coin Rate Update ( Cron )')}}</label>
                    @if(env('APP_MODE') == 'demo')
                        <select class="selectpicker" data-width="100%">
                            <option @if(isset($settings['cron_coin_rate_status']) && $settings['cron_coin_rate_status'] == STATUS_ACTIVE ) selected @endif value="{{ STATUS_ACTIVE }}">{{ __('ON') }}</option>
                            <option @if(isset($settings['cron_coin_rate_status']) && $settings['cron_coin_rate_status'] == STATUS_DEACTIVE ) selected @endif value="{{ STATUS_DEACTIVE }}">{{ __('OFF') }}</option>
                        </select>
                    @else
                        <select name="cron_coin_rate_status" class="selectpicker" data-width="100%">
                            <option @if(isset($settings['cron_coin_rate_status']) && $settings['cron_coin_rate_status'] == STATUS_ACTIVE ) selected @endif value="{{ STATUS_ACTIVE }}">{{ __('ON') }}</option>
                            <option @if(isset($settings['cron_coin_rate_status']) && $settings['cron_coin_rate_status'] == STATUS_DEACTIVE ) selected @endif value="{{ STATUS_DEACTIVE }}">{{ __('OFF') }}</option>
                        </select>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-12  mt-20">
                <div class="form-group">
                    <label for="#">{{__('Coin Rate Update ( Minutes )')}}</label>
                    @if(env('APP_MODE') == 'demo')
                        <input class="form-control" value="{{'disablefordemo'}}">
                    @else
                    <input class="form-control" type="text" name="cron_coin_rate"
                           placeholder=""
                           value="{{$settings['cron_coin_rate'] ?? 10}}">
                    @endif
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-6 col-12  mt-20">
                <div class="form-group">
                    <label for="#">{{__('ERC20/BEP20 Deposit ( Cron )')}}</label>
                    @if(env('APP_MODE') == 'demo')
                        <select class="selectpicker" data-width="100%">
                            <option @if(isset($settings['cron_token_deposit_status']) && $settings['cron_token_deposit_status'] == STATUS_ACTIVE ) selected @endif value="{{ STATUS_ACTIVE }}">{{ __('ON') }}</option>
                            <option @if(isset($settings['cron_token_deposit_status']) && $settings['cron_token_deposit_status'] == STATUS_DEACTIVE ) selected @endif value="{{ STATUS_DEACTIVE }}">{{ __('OFF') }}</option>
                        </select>
                    @else
                    <select name="cron_token_deposit_status" class="selectpicker" data-width="100%">
                        <option @if(isset($settings['cron_token_deposit_status']) && $settings['cron_token_deposit_status'] == STATUS_ACTIVE ) selected @endif value="{{ STATUS_ACTIVE }}">{{ __('ON') }}</option>
                        <option @if(isset($settings['cron_token_deposit_status']) && $settings['cron_token_deposit_status'] == STATUS_DEACTIVE ) selected @endif value="{{ STATUS_DEACTIVE }}">{{ __('OFF') }}</option>
                    </select>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-12  mt-20">
                <div class="form-group">
                    <label for="#">{{__('ERC20/BEP20 Deposit ( Minutes )')}}</label>
                    @if(env('APP_MODE') == 'demo')
                        <input class="form-control" value="{{'disablefordemo'}}">
                    @else
                    <input class="form-control" type="text" name="cron_token_deposit"
                           placeholder="{{__('Auth Token')}}"
                           value="{{$settings['cron_token_deposit'] ?? 10}}">
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-12 mt-20">
                <button type="submit" class="button-primary theme-btn">{{__('Update')}}</button>
            </div>
        </div>
    </form>
</div>
