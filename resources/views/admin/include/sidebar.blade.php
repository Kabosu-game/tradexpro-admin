<div class="sidebar">
    <!-- logo -->
    <div class="logo">
        <a href="{{route('adminDashboard')}}">
            <img src="{{show_image(Auth::user()->id,'logo')}}" class="img-fluid" alt="">
        </a>
    </div><!-- /logo -->

    <!-- sidebar menu -->
    <div class="sidebar-menu">
        <nav>
            <ul id="metismenu">
                <li class="@if(isset($menu) && $menu == 'dashboard') active-page @endif">
                    <a href="{{route('adminDashboard')}}">
                        <span class="icon"><img src="{{asset('assets/admin/images/sidebar-icons/dashboard.svg')}}" class="img-fluid" alt=""></span>
                        <span class="name">{{__('Dashboard')}}</span>
                    </a>
                </li>
                <li class="@if(isset($menu) && $menu == 'users') active-page @endif">
                    <a href="#" aria-expanded="true">
                        <span class="icon"><img src="{{asset('assets/admin/images/sidebar-icons/user.svg')}}" class="img-fluid" alt=""></span>
                        <span class="name">{{__('User Management')}}</span>
                    </a>
                    <ul class="@if(isset($menu) && $menu == 'users')  mm-show  @endif">
                        <li class="@if(isset($sub_menu) && $sub_menu == 'user') submenu-active @endif">
                            <a href="{{route('adminUsers')}}">{{__('User')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'pending_id') submenu-active @endif">
                            <a href="{{route('adminUserIdVerificationPending')}}">{{__('Kyc Verification')}}</a>
                        </li>
                    </ul>
                </li>
                <li class="@if(isset($menu) && $menu == 'coin') active-page @endif">
                    <a href="#">
                        <span class="icon"><img src="{{asset('assets/admin/images/sidebar-icons/coin.svg')}}" class="img-fluid" alt=""></span>
                        <span class="name">{{__('Coin ')}}</span>
                    </a>
                    <ul class="@if(isset($menu) && $menu == 'coin')  mm-show  @endif">
                        <li class="@if(isset($sub_menu) && $sub_menu == 'coin_list') submenu-active @endif">
                            <a href="{{route('adminCoinList')}}">{{__('Coin List')}}</a>
                        </li>
                        <ul class="@if(isset($menu) && $menu == 'coin')  mm-show  @endif">
                            <li class="@if(isset($sub_menu) && $sub_menu == 'coin_pair') submenu-active @endif">
                                <a href="{{route('coinPairs')}}">{{__('Coin Pairs')}}</a>
                            </li>
                        </ul>
                    </ul>
                </li>
                <li class="@if(isset($menu) && $menu == 'wallet') active-page @endif">
                    <a href="#" aria-expanded="true">
                        <span class="icon"><img src="{{asset('assets/admin/images/sidebar-icons/wallet.svg')}}" class="img-fluid" alt=""></span>
                        <span class="name">{{__('User Wallet')}}</span>
                    </a>
                    <ul class="@if(isset($menu) && $menu == 'wallet')  mm-show  @endif">
                        <li class="@if(isset($sub_menu) && $sub_menu == 'personal') submenu-active @endif">
                            <a href="{{route('adminWalletList')}}">{{__('Wallet List')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'send_wallet') submenu-active @endif">
                            <a href="{{route('adminSendWallet')}}">{{__('Send Wallet Coin')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'send_coin_list') submenu-active @endif">
                            <a href="{{route('adminWalletSendList')}}">{{__('Send Coin History')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'swap_coin_history') submenu-active @endif">
                            <a href="{{route('adminSwapCoinHistory')}}">{{__('Swap Coin History')}}</a>
                        </li>
                    </ul>
                </li>
                <li class="@if(isset($menu) && $menu == 'transaction') active-page @endif">
                    <a href="#" aria-expanded="true">
                        <span class="icon"><img src="{{asset('assets/admin/images/sidebar-icons/Transaction-1.svg')}}" class="img-fluid" alt=""></span>
                        <span class="name">{{__('Deposit/Withdrawal')}}</span>
                    </a>
                    <ul class="@if(isset($menu) && $menu == 'transaction')  mm-show  @endif">
                        <li class="@if(isset($sub_menu) && $sub_menu == 'transaction_all') submenu-active @endif">
                            <a href="{{route('adminTransactionHistory')}}">{{__('All Transaction')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'transaction_withdrawal') submenu-active @endif">
                            <a href="{{route('adminPendingWithdrawal')}}">{{__('Pending Withdrawal')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'transaction_deposit') submenu-active @endif">
                            <a href="{{route('adminPendingDeposit')}}">{{__('Pending Deposit')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'check_deposit') submenu-active @endif">
                            <a href="{{route('adminCheckDeposit')}}">{{__('Check Deposit')}}</a>
                        </li>
                    </ul>
                </li>

                <li class="@if(isset($menu) && $menu == 'profile') active-page @endif">
                    <a href="{{ route('adminProfile') }}">
                        <span class="icon"><img src="{{asset('assets/admin/images/sidebar-icons/profile.svg')}}" class="img-fluid" alt=""></span>
                        <span class="name">{{__('Profile')}}</span>
                    </a>
                </li>
                <li class="@if(isset($menu) && $menu == 'trade') active-page @endif">
                    <a href="#" aria-expanded="true">
                        <span class="icon"><img src="{{asset('assets/admin/images/sidebar-icons/trade-report.svg')}}" class="img-fluid" alt=""></span>
                        <span class="name">{{__('Trade Reports')}}</span>
                    </a>
                    <ul class="@if(isset($menu) && $menu == 'trade')  mm-show  @endif">
                        <li class="@if(isset($sub_menu) && $sub_menu == 'buy_order') submenu-active @endif">
                            <a href="{{route('adminAllOrdersHistoryBuy')}}">{{__('Buy Order History')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'sell_order') submenu-active @endif">
                            <a href="{{route('adminAllOrdersHistorySell')}}">{{__('Sell Order History')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'stop_limit') submenu-active @endif">
                            <a href="{{route('adminAllOrdersHistoryStopLimit')}}">{{__('Stop Limit Order History')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'transaction') submenu-active @endif">
                            <a href="{{route('adminAllTransactionHistory')}}">{{__('Transaction History')}}</a>
                        </li>
                    </ul>
                </li>

                <li class="@if(isset($menu) && $menu == 'currency_deposit') active-page @endif">
                    <a href="#" aria-expanded="true">
                        <span class="icon"><img src="{{asset('assets/admin/images/sidebar-icons/coin.svg')}}" class="img-fluid" alt=""></span>
                        <span class="name">{{__('Fiat Deposit')}}</span>
                    </a>
                    <ul class="@if(isset($menu) && $menu == 'currency_deposit')  mm-show  @endif">
                        <li class="@if(isset($sub_menu) && $sub_menu == 'pending_deposite_list') submenu-active @endif">
                            <a href="{{route('currencyDepositList')}}">{{__('Pending Request')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'bank_list') submenu-active @endif">
                            <a href="{{route('bankList')}}">{{__('Bank List')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'payment_method_list') submenu-active @endif">
                            <a href="{{route('currencyPaymentMethod')}}">{{__('Payment Method')}}</a>
                        </li>
                    </ul>
                </li>
                <li class="@if(isset($menu) && $menu == 'fiat_withdraw') active-page @endif">
                    <a href="#" aria-expanded="true">
                        <span class="icon"><img src="{{asset('assets/admin/images/sidebar-icons/coin.svg')}}" class="img-fluid" alt=""></span>
                        <span class="name">{{__('Fiat Withdraw')}}</span>
                    </a>
                    <ul class="@if(isset($menu) && $menu == 'fiat_withdraw')  mm-show  @endif">
                        <li class="@if(isset($sub_menu) && $sub_menu == 'fiat_withdraw_list') submenu-active @endif">
                            <a href="{{route('fiatWithdrawList')}}">{{__('Pending Request')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'currency_list') submenu-active @endif">
                            <a href="{{route('adminFiatCurrencyList')}}">{{__('Withdrawal Currency')}}</a>
                        </li>
                    </ul>
                </li>
                <li class="@if(isset($menu) && $menu == 'deposit') active-page @endif">
                    <a href="#" aria-expanded="true">
                        <span class="icon"><img src="{{asset('assets/admin/images/sidebar-icons/deposit.svg')}}" class="img-fluid" alt=""></span>
                        <span class="name">{{__('Admin Token')}}</span>
                    </a>
                    <ul class="@if(isset($menu) && $menu == 'deposit')  mm-show  @endif">
                        <li class="@if(isset($sub_menu) && $sub_menu == 'pending') submenu-active @endif">
                            <a href="{{route('adminPendingDepositHistory')}}">{{__('Pending Token Report')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'gas') submenu-active @endif">
                            <a href="{{route('adminGasSendHistory')}}">{{__('Gas Sent Report')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'token') submenu-active @endif">
                            <a href="{{route('adminTokenReceiveHistory')}}">{{__('Token Received Report')}}</a>
                        </li>
                    </ul>
                </li>
                <li class="@if(isset($menu) && $menu == 'setting') active-page @endif">
                    <a href="#" aria-expanded="true">
                        <span class="icon"><img src="{{asset('assets/admin/images/sidebar-icons/settings.svg')}}" class="img-fluid" alt=""></span>
                        <span class="name">{{__('Settings')}}</span>
                    </a>
                    <ul class="@if(isset($menu) && $menu == 'setting')  mm-show  @endif">
                        <li class="@if(isset($sub_menu) && $sub_menu == 'general') submenu-active @endif">
                            <a href="{{route('adminSettings')}}">{{__('General')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'feature_settings') submenu-active @endif">
                            <a href="{{route('adminFeatureSettings')}}">{{__('Features')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'dynamic_menu_settings') submenu-active @endif">
                            <a href="{{route('dynamicMenuSettings')}}">{{__('Menu Settings')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'theme_color') submenu-active @endif">
                            <a href="{{route('addEditThemeSettings')}}">{{__('Theme Color')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'api_settings') submenu-active @endif">
                            <a href="{{route('adminCoinApiSettings')}}">{{__('Api')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'kyc_settings') submenu-active @endif">
                            <a href="{{route('kycList')}}">{{__('KYC Settings')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'google_analytics') submenu-active @endif">
                            <a href="{{ route('googleAnalyticsAdd') }}">{{__('Google Analytics')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'lang_list') submenu-active @endif">
                            <a href="{{route('adminLanguageList')}}">{{__('Language List')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'country_list') submenu-active @endif">
                            <a href="{{route('countryList')}}">{{__('Country List')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'two_factor') submenu-active @endif">
                            <a href="{{route('twoFactor')}}">{{__('Two Factor Settings')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'currency_list') submenu-active @endif">
                            <a href="{{route('adminCurrencyList')}}">{{__('Fiat Currency')}}</a>
                        </li>

                        <li class="@if(isset($sub_menu) && $sub_menu == 'trade_fees_settings') submenu-active @endif">
                            <a href="{{route('tradeFeesSettings')}}">{{__('Trade Fees')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'seo_manager') submenu-active @endif">
                            <a href="{{route('seoManagerAdd')}}">{{__('SEO Manager')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'config') submenu-active @endif">
                            <a href="{{ route('adminConfiguration') }}">{{__('Configuration')}}</a>
                        </li>
                    </ul>
                </li>
                <li class="@if(isset($menu) && $menu == 'landing_setting') active-page @endif">
                    <a href="#" aria-expanded="true">
                        <span class="icon"><img src="{{asset('assets/admin/images/sidebar-icons/landing-settings.svg')}}" class="img-fluid" alt=""></span>
                        <span class="name">{{__('Landing Settings')}}</span>
                    </a>
                    <ul class="@if(isset($menu) && $menu == 'landing_setting')  mm-show  @endif">
                        <li class="@if(isset($sub_menu) && $sub_menu == 'landing') submenu-active @endif">
                            <a href="{{ route('adminLandingSetting') }}">{{__('Landing Page')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'custom_pages') submenu-active @endif">
                            <a href="{{ route('adminCustomPageList') }}">{{__('Custom Pages')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'banner') submenu-active @endif">
                            <a href="{{ route('adminBannerList') }}">{{__('Banner')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'feature') submenu-active @endif">
                            <a href="{{ route('adminFeatureList') }}">{{__('Feature')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'media') submenu-active @endif">
                            <a href="{{ route('adminSocialMediaList') }}">{{__('Social Media')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'announcement') submenu-active @endif">
                            <a href="{{ route('adminAnnouncementList') }}">{{__('Announcement')}}</a>
                        </li>
                    </ul>
                </li>
                <li class="@if(isset($menu) && $menu == 'notification') active-page @endif">
                    <a href="#" aria-expanded="true">
                        <span class="icon"><img src="{{asset('assets/admin/images/sidebar-icons/Notification.svg')}}" class="img-fluid" alt=""></span>
                        <span class="name">{{__('Notification')}}</span>
                    </a>
                    <ul class="@if(isset($menu) && $menu == 'notification')  mm-show  @endif">
                        <li class="@if(isset($sub_menu) && $sub_menu == 'notify') submenu-active @endif">
                            <a href="{{route('sendNotification')}}">{{__('Notification')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'email') submenu-active @endif">
                            <a href="{{route('sendEmail')}}">{{__('Bulk Email')}}</a>
                        </li>
                    </ul>
                </li>
                <li class="@if(isset($menu) && $menu == 'faq') active-page @endif">
                    <a href="{{ route('adminFaqList') }}">
                        <span class="icon"><img src="{{asset('assets/admin/images/sidebar-icons/FAQ.svg')}}" class="img-fluid" alt=""></span>
                        <span class="name">{{__('FAQs')}}</span>
                    </a>
                </li>
                <li class="@if(isset($menu) && $menu == 'progress-status') active-page @endif">
                    <a href="#" aria-expanded="true">
                        <span class="icon"><img src="{{asset('assets/admin/images/sidebar-icons/progress-status.svg')}}" class="img-fluid" alt=""></span>
                        <span class="name">{{__('Progress Status')}}</span>
                    </a>
                    <ul class="@if(isset($menu) && $menu == 'progress-status')  mm-show  @endif">
                        <li class="@if(isset($sub_menu) && $sub_menu == 'progress-status-list') submenu-active @endif">
                            <a href="{{ route('progressStatusList') }}">{{__('Progress Status List')}}</a>
                        </li>
                        <li class="@if(isset($sub_menu) && $sub_menu == 'progress-status-settings') submenu-active @endif">
                            <a href="{{ route('progressStatusSettings') }}">{{__('Progress Status Settings')}}</a>
                        </li>
                    </ul>

                </li>
                <li class="@if(isset($menu) && $menu == 'log') active-page @endif">
                    <a href="{{ route('adminLogs') }}" target="_blank">
                        <span class="icon"><img src="{{asset('assets/admin/images/sidebar-icons/logs.svg')}}" class="img-fluid" alt=""></span>
                        <span class="name">{{__('Logs')}}</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div><!-- /sidebar menu -->

</div>
