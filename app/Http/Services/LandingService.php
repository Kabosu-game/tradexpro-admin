<?php

namespace App\Http\Services;


use App\Http\Repositories\AdminSettingRepository;
use App\Model\AdminSetting;
use App\Model\Announcement;
use App\Model\CoinPair;
use App\Model\CustomPage;
use App\Model\LandingBanner;
use App\Model\LandingFeature;
use App\Model\SocialMedia;


class LandingService
{
    public $logger;
    public function __construct()
    {
        $this->logger = new Logger();
    }

    /*
     * save or update landing feature
     *
     */
    public function saveLandingFeature($request)
    {
        $response = ['success' => false, 'message' => __('Something went wrong')];
        try {
            $data = [
                'feature_title'=> $request->feature_title,
                'description'=> $request->description,
                'status'=> $request->status
            ];
            $old_img = '';
            if (!empty($request->edit_id)) {
                $item = LandingFeature::where(['id'=>$request->edit_id])->first();
                if(isset($item) && (!empty($item->feature_icon))) {
                    $old_img = $item->feature_icon;
                }
            }
            if (!empty($request->feature_icon)) {
                $icon = uploadFile($request->feature_icon,IMG_PATH,$old_img);
                if ($icon != false) {
                    $data['feature_icon'] = $icon;
                }
            }
            if(!empty($request->edit_id)) {
                LandingFeature::where(['id'=>$request->edit_id])->update($data);
                $response = ['success' => true, 'message' => __('Landing feature updated successfully!')];
            } else {
                LandingFeature::create($data);
                $response = ['success' => true, 'message' => __('Landing feature created successfully!')];
            }
        } catch (\Exception $e) {
            $this->logger->log('saveLandingFeature', $e->getMessage());
            $response = ['success' => false, 'message' => __('Something went wrong')];
        }
        return $response;
    }

    /*
     *
     * create or update social media
     */
    public function saveLandingSocialMedia($request)
    {
        $response = ['success' => false, 'message' => __('Something went wrong')];
        try {
            $data = [
                'media_title'=> $request->media_title,
                'media_link'=> $request->media_link,
                'status'=> $request->status
            ];
            $old_img = '';
            if (!empty($request->edit_id)) {
                $item = SocialMedia::where(['id'=>$request->edit_id])->first();
                if(isset($item) && (!empty($item->media_icon))) {
                    $old_img = $item->media_icon;
                }
            }
            if (!empty($request->media_icon)) {
                $icon = uploadFile($request->media_icon,IMG_PATH,$old_img);
                if ($icon != false) {
                    $data['media_icon'] = $icon;
                }
            }
            if(!empty($request->edit_id)) {
                SocialMedia::where(['id'=>$request->edit_id])->update($data);
                $response = ['success' => true, 'message' => __('Social media updated successfully!')];
            } else {
                SocialMedia::create($data);
                $response = ['success' => true, 'message' => __('Social media created successfully!')];
            }
        } catch (\Exception $e) {
            $this->logger->log('saveLandingSocialMedia', $e->getMessage());
            $response = ['success' => false, 'message' => __('Something went wrong')];
        }
        return $response;
    }

    public function customPageSlugCheck($post_data){
        $text_array = explode(' ', $post_data['title']);
        $slug = '';
        foreach ($text_array as $i => $split_text) {
            if(!empty($slug)){
                $slug = $slug .'-'. strtolower(trim($split_text));
            }else{
                $slug = strtolower(trim($split_text));
            }
        }
        if(isset($post_data['id'])){
            $res = CustomPage::where('id','<>',$post_data['id'])->where('key', 'like', '%'.$slug.'%')->get()->count();
        }else{
            $res = CustomPage::where('key', 'like', '%'.$slug.'%')->get()->count();
        }
        if($res){
            $response['slug'] = $slug.'-'.$res;
        }else{
            $response['slug'] = $slug;
        }
        return response()->json($response);
    }

    public function checkKeyCustom($key,$id = null){
        if(isset($id)){
            $res = CustomPage::where('id','<>',$id)->where('key', 'like', '%'.$key.'%')->get()->count();
        }else{
            $res = CustomPage::where('key', 'like', '%'.$key.'%')->get()->count();
        }
        if($res){
            return false;
        }else{
            return true;
        }
    }

    //
    public function adminLandingApiLinkSave($request)
    {
        try {
            AdminSetting::updateOrCreate(['slug' => 'apple_store_link'],['value' => $request['apple_store_link']]);
            AdminSetting::updateOrCreate(['slug' => 'android_store_link'],['value' => $request['android_store_link']]);
            AdminSetting::updateOrCreate(['slug' => 'google_store_link'],['value' => $request['google_store_link']]);
            AdminSetting::updateOrCreate(['slug' => 'macos_store_link'],['value' => $request['macos_store_link']]);
            AdminSetting::updateOrCreate(['slug' => 'windows_store_link'],['value' => $request['windows_store_link']]);
            AdminSetting::updateOrCreate(['slug' => 'linux_store_link'],['value' => $request['linux_store_link']]);
            AdminSetting::updateOrCreate(['slug' => 'api_link'],['value' => $request['api_link']]);

            $response = responseData(true,__('Settings updated successfully'));
        } catch (\Exception $e) {
            storeException('adminLandingApiLinkSave', $e->getMessage());
            $response = responseData(false,__('Something went wrong'));
        }
        return $response;
    }
    //
    public function adminLandingPairAssetSave($request)
    {
        try {
            AdminSetting::updateOrCreate(['slug' => 'pair_assets_list'],['value' => $request['pair_assets_list']]);
            AdminSetting::updateOrCreate(['slug' => 'pair_assets_base_coin'],['value' => $request['pair_assets_base_coin']]);
            $response = responseData(true,__('Settings updated successfully'));
        } catch (\Exception $e) {
            storeException('adminLandingPairAssetSave', $e->getMessage());
            $response = responseData(false,__('Something went wrong'));
        }
        return $response;
    }

    // user coller list
    public function userEndColorList()
    {
        $settings = allsetting();
        $response = [];
        $data['--primary-color'] = $settings['user_primary_color'] ?? "" ;
        $data['--text-primary-color'] = $settings['user_text_primary_color'] ?? "" ;
        $data['--text-primary-color-2'] = $settings['user_text_primary_color_2'] ?? "" ;
        $data['--text-primary-color-3'] = $settings['user_text_primary_color_3'] ?? "" ;
        $data['--text-primary-color-4'] = $settings['user_text_primary_color_4'] ?? "" ;
        $data['--border-color'] = $settings['user_border_color'] ?? "" ;
        $data['--border-color-1'] = $settings['user_border_color_1'] ?? "" ;
        $data['--border-color-2'] = $settings['user_border_color_2'] ?? "" ;
        $data['--hover-color'] = $settings['user_hover_color'] ?? "" ;
        $data['--font-color'] = $settings['user_font_color'] ?? "" ;
        $data['--bColor'] = $settings['user_bColor'] ?? "" ;
        $data['--title-color'] = $settings['user_title_color'] ?? "" ;
        $data['--white'] = $settings['user_white'] ?? "" ;
        $data['--black'] = $settings['user_black'] ?? "" ;
        $data['--color-pallet-1'] = $settings['user_color_pallet_1'] ?? "" ;
        $data['--background-color'] = $settings['user_background_color'] ?? "" ;
        $data['--background-color-trade'] = $settings['user_background_color_trade'] ?? "" ;
        $data['--main-background-color'] = $settings['user_main_background_color'] ?? "" ;
        $data['--card-background-color'] = $settings['user_card_background_color'] ?? "" ;
        $data['--table-background-color'] = $settings['user_table_background_color'] ?? "" ;
        $data['--footer-background-color'] = $settings['user_footer_background_color'] ?? "" ;
        $data['--background-color-hover'] = $settings['user_background_color_hover'] ?? "" ;

        foreach ($data as $key => $val) {
            $response[]=[
                'name' => $key,
                'value' => $val,
            ];
        }
        return $response;
    }

}
