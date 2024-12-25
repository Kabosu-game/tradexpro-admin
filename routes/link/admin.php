<?php

Route::group(['prefix'=>'admin','namespace'=>'admin','middleware'=> ['auth','admin','default_lang']],function () {

    // Logs
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('adminLogs');


    Route::get('dashboard', 'DashboardController@adminDashboard')->name('adminDashboard');
    Route::get('earning-report', 'DashboardController@adminEarningReport')->name('adminEarningReport');

    // user management
    Route::get('profile', 'DashboardController@adminProfile')->name('adminProfile');
    Route::get('users', 'UserController@adminUsers')->name('adminUsers');
    Route::get('user-profile', 'UserController@adminUserProfile')->name('adminUserProfile');
    Route::get('user-add', 'UserController@UserAddEdit')->name('admin.UserAddEdit');
    Route::get('user-edit', 'UserController@UserEdit')->name('admin.UserEdit');
    Route::get('user-delete-{id}', 'UserController@adminUserDelete')->name('admin.user.delete');
    Route::get('user-suspend-{id}', 'UserController@adminUserSuspend')->name('admin.user.suspend');
    Route::get('user-active-{id}', 'UserController@adminUserActive')->name('admin.user.active');
    Route::get('user-remove-gauth-set-{id}', 'UserController@adminUserRemoveGauth')->name('admin.user.remove.gauth');
    Route::get('user-email-verify-{id}', 'UserController@adminUserEmailVerified')->name('admin.user.email.verify');
    Route::get('user-phone-verify-{id}', 'UserController@adminUserPhoneVerified')->name('admin.user.phone.verify');
    Route::get('deleted-users', 'UserController@adminDeletedUser')->name('adminDeletedUser');

    Route::group(['middleware'=>'check_demo'], function() {
        Route::post('user-profile-update', 'DashboardController@UserProfileUpdate')->name('UserProfileUpdate');
        Route::post('upload-profile-image', 'DashboardController@uploadProfileImage')->name('uploadProfileImage');

    });

    // ID Varification
    Route::get('verification-details-{id}', 'UserController@VerificationDetails')->name('adminUserDetails');
    Route::get('pending-id-verified-user', 'UserController@adminUserIdVerificationPending')->name('adminUserIdVerificationPending');
    Route::get('verification-active-{id}-{type}', 'UserController@adminUserVerificationActive')->name('adminUserVerificationActive');
    Route::get('verification-reject', 'UserController@varificationReject')->name('varificationReject');

    // coin
    Route::get('total-user-coin', 'CoinController@adminUserCoinList')->name('adminUserCoinList');
    Route::get('coin-list', 'CoinController@adminCoinList')->name('adminCoinList');
    Route::get('add-new-coin', 'CoinController@adminAddCoin')->name('adminAddCoin');
    Route::get('coin-edit/{id}', 'CoinController@adminCoinEdit')->name('adminCoinEdit');
    Route::get('coin-settings/{id}', 'CoinController@adminCoinSettings')->name('adminCoinSettings');

    Route::group(['middleware'=>'check_demo'], function() {
        Route::get('coin-delete/{id}', 'CoinController@adminCoinDelete')->name('adminCoinDelete');
        Route::get('change-coin-rate', 'CoinController@adminCoinRate')->name('adminCoinRate');
        Route::get('adjust-bitgo-wallet/{id}', 'CoinController@adminAdjustBitgoWallet')->name('adminAdjustBitgoWallet');
        Route::post('save-new-coin', 'CoinController@adminSaveCoin')->name('adminSaveCoin');
        Route::post('save-coin-settings', 'CoinController@adminSaveCoinSetting')->name('adminSaveCoinSetting');
        Route::post('coin-save-process', 'CoinController@adminCoinSaveProcess')->name('adminCoinSaveProcess');
        Route::post('change-coin-status', 'CoinController@adminCoinStatus')->name('adminCoinStatus');
    });

    // Wallet management
    Route::get('my-wallet-list', 'WalletController@myWalletList')->name('myWalletList');
    Route::get('wallet-list', 'WalletController@adminWalletList')->name('adminWalletList');
    Route::get('send-coin-list', 'WalletController@adminWalletSendList')->name('adminWalletSendList');
    Route::get('swap-coin-history', 'WalletController@adminSwapCoinHistory')->name('adminSwapCoinHistory');
    Route::get('send-wallet-balance', 'WalletController@adminSendWallet')->name('adminSendWallet');

    Route::group(['middleware'=>'check_demo'], function() {
        Route::post('admin-send-balance-process', 'WalletController@adminSendBalanceProcess')->name('adminSendBalanceProcess');
    });

    // deposit withdrawal
    Route::get('transaction-history', 'TransactionController@adminTransactionHistory')->name('adminTransactionHistory');
    Route::get('withdrawal-history', 'TransactionController@adminWithdrawalHistory')->name('adminWithdrawalHistory');
    Route::get('pending-withdrawal', 'TransactionController@adminPendingWithdrawal')->name('adminPendingWithdrawal');
    Route::get('rejected-withdrawal', 'TransactionController@adminRejectedWithdrawal')->name('adminRejectedWithdrawal');
    Route::get('active-withdrawal', 'TransactionController@adminActiveWithdrawal')->name('adminActiveWithdrawal');
    Route::get('reject-pending-withdrawal-{id}', 'TransactionController@adminRejectPendingWithdrawal')->name('adminRejectPendingWithdrawal');
    Route::get('pending-deposit', 'TransactionController@adminPendingDeposit')->name('adminPendingDeposit');
    Route::get('accept-pending-deposit-{id}', 'TransactionController@adminPendingDepositAcceptProcess')->name('adminPendingDepositAcceptProcess');

    Route::group(['middleware'=>'check_demo'], function() {
        Route::get('accept-pending-withdrawal-{id}', 'TransactionController@adminAcceptPendingWithdrawal')->name('adminAcceptPendingWithdrawal');
        Route::get('pending-withdrawal-accept-process', 'TransactionController@adminPendingWithdrawalAcceptProcess')->name('adminPendingWithdrawalAcceptProcess');
    });
    // pending deposit report and action
    Route::get('gas-send-history', 'DepositController@adminGasSendHistory')->name('adminGasSendHistory');
    Route::get('token-receive-history', 'DepositController@adminTokenReceiveHistory')->name('adminTokenReceiveHistory');
    Route::get('pending-token-deposit-history', 'DepositController@adminPendingDepositHistory')->name('adminPendingDepositHistory');
    Route::get('pending-token-deposit-accept-{id}', 'DepositController@adminPendingDepositAccept')->name('adminPendingDepositAccept');
    Route::get('pending-token-deposit-reject-{id}', 'DepositController@adminPendingDepositReject')->name('adminPendingDepositReject');
    Route::get('check-deposit','DepositController@adminCheckDeposit')->name('adminCheckDeposit');
    Route::get('submit-check-deposit', 'DepositController@submitCheckDeposit')->name('submitCheckDeposit');

    //FAQ
    Route::get('faq-list', 'SettingsController@adminFaqList')->name('adminFaqList');
    Route::get('faq-add', 'SettingsController@adminFaqAdd')->name('adminFaqAdd');
    Route::get('faq-type-add', 'SettingsController@adminFaqTypeAdd')->name('adminFaqTypeAdd');
    Route::get('faq-edit-{id}', 'SettingsController@adminFaqEdit')->name('adminFaqEdit');
    Route::get('faq-delete-{id}', 'SettingsController@adminFaqDelete')->name('adminFaqDelete');
    Route::get('faq-type-edit-{id}', 'SettingsController@adminFaqTypeEdit')->name('adminFaqTypeEdit');
    Route::get('faq-type-delete-{id}', 'SettingsController@adminFaqTypeDelete')->name('adminFaqTypeDelete');

    Route::group(['middleware'=>'check_demo'], function() {
        Route::post('faq-type-save', 'SettingsController@adminFaqTypeSave')->name('adminFaqTypeSave');
        Route::post('faq-save', 'SettingsController@adminFaqSave')->name('adminFaqSave');
    });
    // admin setting

    Route::get('general-settings', 'SettingsController@adminSettings')->name('adminSettings');
    Route::get('api-settings', 'SettingsController@adminCoinApiSettings')->name('adminCoinApiSettings');
    Route::post('order-settings', 'SettingsController@adminOrderSettings')->name('adminOrderSettings');
    Route::get('admin-feature-settings', 'SettingsController@adminFeatureSettings')->name('adminFeatureSettings');
    Route::get('admin-chat-settings', 'SettingsController@adminChatSettings')->name('adminChatSettings');

    Route::group(['middleware'=>'check_demo'], function() {
        Route::post('admin-save-common-setting', 'SettingsController@adminSettingsSaveCommon')->name('adminSettingsSaveCommon');

        Route::post('common-settings', 'SettingsController@adminCommonSettings')->name('adminCommonSettings');
        Route::post('save-payment-settings', 'SettingsController@adminSavePaymentSettings')->name('adminSavePaymentSettings');
        Route::post('save-bitgo-settings', 'SettingsController@adminSaveBitgoSettings')->name('adminSaveBitgoSettings');
        Route::post('email-save-settings', 'SettingsController@adminSaveEmailSettings')->name('adminSaveEmailSettings');
        Route::post('sms-save-settings', 'SettingsController@adminSaveSmsSettings')->name('adminSaveSmsSettings');
        Route::post('cron-save-settings', 'SettingsController@adminSaveCronSettings')->name('adminSaveCronSettings');
        Route::post('fiat-widthdraw-save-settings', 'SettingsController@adminSaveFiatWithdrawalSettings')->name('adminSaveFiatWithdrawalSettings');
        Route::post('referral-fees-settings', 'SettingsController@adminReferralFeesSettings')->name('adminReferralFeesSettings');
        Route::post('withdrawal-settings', 'SettingsController@adminWithdrawalSettings')->name('adminWithdrawalSettings');
        Route::post('recaptcha-settings', 'SettingsController@adminCapchaSettings')->name('adminCapchaSettings');
        Route::post('node-settings', 'SettingsController@adminNodeSettings')->name('adminNodeSettings');
        Route::post('admin-other-api-settings', 'SettingsController@adminSaveOtherApiSettings')->name('adminSaveOtherApiSettings');
        Route::post('admin-stripe-api-settings', 'SettingsController@adminSaveStripeApiSettings')->name('adminSaveStripeApiSettings');
        Route::post('admin-erc20-api-settings', 'SettingsController@adminSaveERC20ApiSettings')->name('adminSaveERC20ApiSettings');
        Route::post('admin-cookie-settings-save', 'SettingsController@adminCookieSettingsSave')->name('adminCookieSettingsSave');

    });
   // notification
    Route::get('send-email', 'DashboardController@sendEmail')->name('sendEmail');
    Route::get('clear-email', 'DashboardController@clearEmailRecord')->name('clearEmailRecord');
    Route::get('send-notification', 'DashboardController@sendNotification')->name('sendNotification');
    Route::post('send-notification-process', 'DashboardController@sendNotificationProcess')->name('sendNotificationProcess');

    Route::group(['middleware'=>'check_demo'], function() {
        Route::post('send-email-process', 'DashboardController@sendEmailProcess')->name('sendEmailProcess');
    });

    // custom page
    Route::get('custom-page-slug-check', 'LandingController@customPageSlugCheck')->name('customPageSlugCheck');
    Route::get('custom-page-list', 'LandingController@adminCustomPageList')->name('adminCustomPageList');
    Route::get('custom-page-add', 'LandingController@adminCustomPageAdd')->name('adminCustomPageAdd');
    Route::get('custom-page-edit/{id}', 'LandingController@adminCustomPageEdit')->name('adminCustomPageEdit');
    Route::get('custom-page-order', 'LandingController@customPageOrder')->name('customPageOrder');

    Route::group(['middleware'=>'check_demo'], function() {
        Route::get('custom-page-delete/{id}', 'LandingController@adminCustomPageDelete')->name('adminCustomPageDelete');
        Route::post('custom-page-save', 'LandingController@adminCustomPageSave')->name('adminCustomPageSave');
    });

    // landing setting
    Route::get('landing-page-setting', 'LandingController@adminLandingSetting')->name('adminLandingSetting');
    Route::post('landing-api-link-setting-save', 'LandingController@adminLandingApiLinkSave')->name('adminLandingApiLinkSave');
    Route::post('landing-pair-asset-setting-save', 'LandingController@adminLandingPairAssetSave')->name('adminLandingPairAssetSave');

    Route::group(['middleware'=>'check_demo'], function() {
        Route::post('landing-page-setting-save', 'LandingController@adminLandingSettingSave')->name('adminLandingSettingSave');
    });

    Route::get('admin-config', 'ConfigController@adminConfiguration')->name('adminConfiguration');
    Route::get('run-admin-command/{type}', 'ConfigController@adminRunCommand')->name('adminRunCommand');

    // trade
    Route::get('trade/coin-pairs', 'TradeSettingController@coinPairs')->name('coinPairs');
    Route::get('trade/coin-pairs-chart-update/{id}', 'TradeSettingController@coinPairsChartUpdate')->name('coinPairsChartUpdate');
    Route::post('trade/change-coin-pair-bot-status', 'TradeSettingController@changeCoinPairBotStatus')->name('changeCoinPairBotStatus');
    Route::get('trade/trade-fees-settings', 'TradeSettingController@tradeFeesSettings')->name('tradeFeesSettings');
    Route::post('trade/save-trade-fees-settings', 'TradeSettingController@tradeFeesSettingSave')->name('tradeFeesSettingSave');
    Route::post('trade/remove-trade-limit', 'TradeSettingController@removeTradeLimit')->name('removeTradeLimit');

    Route::group(['middleware'=>'check_demo'], function() {
        Route::get('trade/coin-pairs-delete/{id}', 'TradeSettingController@coinPairsDelete')->name('coinPairsDelete');
        Route::post('trade/save-coin-pair', 'TradeSettingController@saveCoinPairSettings')->name('saveCoinPairSettings');
        Route::post('trade/change-coin-pair-status', 'TradeSettingController@changeCoinPairStatus')->name('changeCoinPairStatus');
    });

    // trade reports
    Route::get('all-buy-orders-history', 'ReportController@adminAllOrdersHistoryBuy')->name('adminAllOrdersHistoryBuy');
    Route::get('all-sell-orders-history', 'ReportController@adminAllOrdersHistorySell')->name('adminAllOrdersHistorySell');
    Route::get('all-stop-limit-orders-history', 'ReportController@adminAllOrdersHistoryStopLimit')->name('adminAllOrdersHistoryStopLimit');
    Route::get('all-transaction-history', 'ReportController@adminAllTransactionHistory')->name('adminAllTransactionHistory');

    // landing banner
    Route::get('landing-banner-list', 'BannerController@adminBannerList')->name('adminBannerList');
    Route::get('landing-banner-add', 'BannerController@adminBannerAdd')->name('adminBannerAdd');
    Route::get('landing-banner-edit-{id}', 'BannerController@adminBannerEdit')->name('adminBannerEdit');

    Route::group(['middleware'=>'check_demo'], function() {
        Route::post('landing-banner-save', 'BannerController@adminBannerSave')->name('adminBannerSave');
        Route::get('landing-banner-delete-{id}', 'BannerController@adminBannerDelete')->name('adminBannerDelete');
    });


    // landing announcement
    Route::get('landing-announcement-list', 'AnnouncementController@adminAnnouncementList')->name('adminAnnouncementList');
    Route::get('landing-announcement-add', 'AnnouncementController@adminAnnouncementAdd')->name('adminAnnouncementAdd');
    Route::get('landing-announcement-edit-{id}', 'AnnouncementController@adminAnnouncementEdit')->name('adminAnnouncementEdit');

    Route::group(['middleware'=>'check_demo'], function() {
        Route::post('landing-announcement-save', 'AnnouncementController@adminAnnouncementSave')->name('adminAnnouncementSave');
        Route::get('landing-announcement-delete-{id}', 'AnnouncementController@adminAnnouncementDelete')->name('adminAnnouncementDelete');
    });



    // landing feature
    Route::get('landing-feature-list', 'LandingController@adminFeatureList')->name('adminFeatureList');
    Route::get('landing-feature-add', 'LandingController@adminFeatureAdd')->name('adminFeatureAdd');
    Route::get('landing-feature-edit-{id}', 'LandingController@adminFeatureEdit')->name('adminFeatureEdit');

    Route::group(['middleware'=>'check_demo'], function() {
        Route::post('landing-feature-save', 'LandingController@adminFeatureSave')->name('adminFeatureSave');
        Route::get('landing-feature-delete-{id}', 'LandingController@adminFeatureDelete')->name('adminFeatureDelete');
    });



    // landing social media
    Route::get('landing-social-media-list', 'LandingController@adminSocialMediaList')->name('adminSocialMediaList');
    Route::get('landing-social-media-add', 'LandingController@adminSocialMediaAdd')->name('adminSocialMediaAdd');
    Route::get('landing-social-media-edit-{id}', 'LandingController@adminSocialMediaEdit')->name('adminSocialMediaEdit');
    Route::group(['middleware'=>'check_demo'], function() {
        Route::post('landing-social-media-save', 'LandingController@adminSocialMediaSave')->name('adminSocialMediaSave');
        Route::get('landing-social-media-delete-{id}', 'LandingController@adminSocialMediaDelete')->name('adminSocialMediaDelete');
    });
    // currency list
    Route::get('currency-list', 'CurrencyController@adminCurrencyList')->name('adminCurrencyList');
    Route::get('currency-add', 'CurrencyController@adminCurrencyAdd')->name('adminCurrencyAdd');
    Route::get('currency-edit-{id}', 'CurrencyController@adminCurrencyEdit')->name('adminCurrencyEdit');
    Route::get('fiat-currency-list', 'CurrencyController@adminFiatCurrencyList')->name('adminFiatCurrencyList');

    Route::group(['middleware'=>'check_demo'], function() {
        Route::get('currency-rate-change', 'CurrencyController@adminCurrencyRate')->name('adminCurrencyRate');
        Route::post('currency-save-process', 'CurrencyController@adminCurrencyAddEdit')->name('adminCurrencyStore');
        Route::post('currency-status-change', 'CurrencyController@adminCurrencyStatus')->name('adminCurrencyStatus');
        Route::post('currency-all', 'CurrencyController@adminAllCurrency')->name('adminAllCurrency');
        Route::get('fiat-currency-delete-{id}', 'CurrencyController@adminFiatCurrencyDelete')->name('adminFiatCurrencyDelete');
        Route::post('fiat-currency-save-process', 'CurrencyController@adminFiatCurrencySaveProcess')->name('adminFiatCurrencySaveProcess');
        Route::post('withdrawal-currency-status-change', 'CurrencyController@adminWithdrawalCurrencyStatus')->name('adminWithdrawalCurrencyStatus');

    });

    // landing social media
    Route::get('lang-list', 'AdminLangController@adminLanguageList')->name('adminLanguageList');
    Route::get('lang-add', 'AdminLangController@adminLanguageAdd')->name('adminLanguageAdd');
    Route::post('lang-save', 'AdminLangController@adminLanguageSave')->name('adminLanguageSave');
    Route::get('lang-edit-{id}', 'AdminLangController@adminLanguageEdit')->name('adminLanguageEdit');
    Route::get('lang-delete-{id}', 'AdminLangController@adminLanguageDelete')->name('adminLanguageDelete');
    Route::post('lang-status-change', 'AdminLangController@adminLangStatus')->name('adminLangStatus');

    //Bank settings
    Route::get('bank-list', 'BankController@bankList')->name('bankList');
    Route::get('bank-add', 'BankController@bankAdd')->name('bankAdd');
    Route::get('bank-edit-{id}', 'BankController@bankEdit')->name('bankEdit');

    Route::group(['middleware'=>'check_demo'], function() {
        Route::post('bank-save', 'BankController@bankStore')->name('bankStore');
        Route::post('bank-status-change', 'BankController@bankStatusChange')->name('bankStatusChange');
        Route::get('bank-delete-{id}', 'BankController@bankDelete')->name('bankDelete');
    });

    //currency deposit Payment payment method
    Route::get('currency-payment-method','PaymentMethodController@currencyPaymentMethod')->name('currencyPaymentMethod');
    Route::get('currency-payment-method-add','PaymentMethodController@currencyPaymentMethodAdd')->name('currencyPaymentMethodAdd');
    Route::get('currency-payment-method-edit-{id}','PaymentMethodController@currencyPaymentMethodEdit')->name('currencyPaymentMethodEdit');
    Route::group(['middleware'=>'check_demo'], function() {
        Route::post('currency-payment-method-store','PaymentMethodController@currencyPaymentMethodStore')->name('currencyPaymentMethodStore');
        Route::post('currency-payment-method-status','PaymentMethodController@currencyPaymentMethodStatus')->name('currencyPaymentMethodStatus');
        Route::get('currency-payment-method-delete-{id}','PaymentMethodController@currencyPaymentMethodDelete')->name('currencyPaymentMethodDelete');
    });

    // currency deposit
    Route::get('currency-deposit-list','CurrencyDepositController@currencyDepositList')->name('currencyDepositList');
    Route::get('currency-deposit-pending-list','CurrencyDepositController@currencyDepositPendingList')->name('currencyDepositPendingList');
    Route::get('currency-deposit-accept-list','CurrencyDepositController@currencyDepositAcceptList')->name('currencyDepositAcceptList');
    Route::get('currency-deposit-reject-list','CurrencyDepositController@currencyDepositRejectList')->name('currencyDepositRejectList');
    Route::get('currency-deposit-accept-{id}','CurrencyDepositController@currencyDepositAccept')->name('currencyDepositAccept');
    Route::post('currency-deposit-reject','CurrencyDepositController@currencyDepositReject')->name('currencyDepositReject');

    // Fiat Withdraw
    Route::get('fiat-withdraw-list','FiatWithdrawController@fiatWithdrawList')->name('fiatWithdrawList');
    Route::post('fiat-withdraw-accept','FiatWithdrawController@fiatWithdrawAccept')->name('fiatWithdrawAccept');
    Route::post('fiat-withdraw-reject','FiatWithdrawController@fiatWithdrawReject')->name('fiatWithdrawReject');
    Route::get('fiat-withdraw-pending-list','FiatWithdrawController@fiatWithdrawPendingList')->name('fiatWithdrawPendingList');
    Route::get('fiat-withdraw-reject-list','FiatWithdrawController@fiatWithdrawRejectList')->name('fiatWithdrawRejectList');
    Route::get('fiat-withdraw-active-list','FiatWithdrawController@fiatWithdrawActiveList')->name('fiatWithdrawActiveList');


    //country
    Route::get('country-list','CountryController@countryList')->name('countryList');
    Route::post('country-status-change','CountryController@countryStatusChange')->name('countryStatusChange');

    //kyc settings
    Route::get('kyc-list','KycController@kycList')->name('kycList');
    Route::post('kyc-status-change','KycController@kycStatusChange')->name('kycStatusChange');
    Route::get('kyc-update-image-{id}','KycController@kycUpdateImage')->name('kycUpdateImage');

    Route::group(['middleware'=>'check_demo'], function() {
        Route::post('send_test_mail','SettingsController@testMail')->name('testmailsend');
        Route::post('kyc-withdrawal-setting','KycController@kycWithdrawalSetting')->name('kycWithdrawalSetting');
        Route::post('kyc-trade-setting','KycController@kycTradeSetting')->name('kycTradeSetting');
        Route::post('kyc-store-image','KycController@kycStoreImage')->name('kycStoreImage');
    });

    //Google analytics
    Route::get('google-analytics-add','AnalyticsController@googleAnalyticsAdd')->name('googleAnalyticsAdd');
    Route::post('google-analytics-id-store','AnalyticsController@googleAnalyticsIDStore')->name('googleAnalyticsIDStore');

    // Network Fees
    Route::get('network-fees','CoinPaymentNetworkFee@list')->name('networkFees');
    Route::get('network-fees-update','CoinPaymentNetworkFee@createOrUpdate')->name('networkFeesUpdate');

    //SEO manager
    Route::get('seo-manager-add','SeoManagerController@seoManagerAdd')->name('seoManagerAdd');
    Route::group(['middleware'=>'check_demo'], function() {
        Route::post('seo-manager-update','SeoManagerController@seoManagerUpdate')->name('seoManagerUpdate');
    });

    //Two Factor At Profile
    Route::post("google-two-factor-enable","DashboardController@g2fa_enable")->name("SaveTwoFactorAdmin");
    Route::post('update-two-factor',"DashboardController@updateTwoFactor")->name("UpdateTwoFactor");

    // Two Factor Setting
    Route::get("two-factor-settings","TwoFactorController@index")->name("twoFactor");
    Route::post("two-factor-settings","TwoFactorController@saveTwoFactorList")->name("SaveTwoFactor");
    Route::post("two-factor-data","TwoFactorController@saveTwoFactorData")->name("SaveTwoFactorData");

    //Bitgo Webhook
    Route::post('bitgo-webhook-save', 'CoinController@webhookSave')->name('webhookSave');

    //theme settings
    Route::get('theme-settings','ThemeSettingsController@addEditThemeSettings')->name('addEditThemeSettings');
    Route::get('reset-theme-color-settings', 'ThemeSettingsController@resetThemeColorSettings')->name('resetThemeColorSettings');
    Route::group(['middleware'=>'check_demo'], function() {
        Route::post('theme-settings-store','ThemeSettingsController@addEditThemeSettingsStore')->name('addEditThemeSettingsStore');
    });

    //progress status
    Route::get('progress-status-list', 'ProgressStatusController@progressStatusList')->name('progressStatusList');
    Route::get('progress-status-add', 'ProgressStatusController@progressStatusAdd')->name('progressStatusAdd');
    Route::get('progress-status-edit/{id}', 'ProgressStatusController@progressStatusEdit')->name('progressStatusEdit');
    Route::get('progress-status-settings', 'ProgressStatusController@progressStatusSettings')->name('progressStatusSettings');
    Route::post('progress-status-settings-update', 'ProgressStatusController@progressStatusSettingsUpdate')->name('progressStatusSettingsUpdate');

    Route::group(['middleware'=>'check_demo'], function() {
        Route::get('progress-status-delete/{id}', 'ProgressStatusController@progressStatusDelete')->name('progressStatusDelete');
        Route::post('progress-status-save', 'ProgressStatusController@progressStatusSave')->name('progressStatusSave');
    });

    Route::get('dynamic-menu-settings','DynamicMenuController@dynamicMenuSettings')->name('dynamicMenuSettings');

});

Route::group(['middleware'=> ['auth', 'lang']], function () {
    Route::get('/send-sms-for-verification', 'user\ProfileController@sendSMS')->name('sendSMS');
    Route::get('test', 'TestController@index')->name('test');
    Route::group(['middleware'=>'check_demo'], function() {
        Route::post('/user-profile-update', 'user\ProfileController@userProfileUpdate')->name('userProfileUpdate');
        Route::post('/upload-profile-image', 'user\ProfileController@uploadProfileImage')->name('uploadProfileImage');
        Route::post('change-password-save', 'user\ProfileController@changePasswordSave')->name('changePasswordSave');
        Route::post('/phone-verify', 'user\ProfileController@phoneVerify')->name('phoneVerify');
    });
});
