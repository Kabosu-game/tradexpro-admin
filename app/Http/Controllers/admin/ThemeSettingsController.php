<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\AdminSettingService;

class ThemeSettingsController extends Controller
{
    private $adminSettingService;
    public function __construct()
    {
        $this->adminSettingService = new AdminSettingService();
    }
    public function addEditThemeSettings()
    {
        $data['title'] = __('Theme Color for User Panel');
        $data['settings'] = allsetting();
        return view('admin.theme-settings.addEdit',$data);
    }

    public function addEditThemeSettingsStore(Request $request)
    {
        try{
            $response = $this->adminSettingService->saveThemeColorSettings($request);
        } catch(\Exception $e) {
            storeException('addEditThemeSettingsStore', $e->getMessage());
            return redirect()->back()->with(['dismiss' => $e->getMessage()]);
        }
        return back()->with(['success' => $response['message']]);
    }

    public function resetThemeColorSettings()
    {
        try{
            $response = $this->adminSettingService->resetThemeColorSettings();
        } catch(\Exception $e) {
            storeException('addEditThemeSettingsStore', $e->getMessage());
            return redirect()->back()->with(['dismiss' => $e->getMessage()]);
        }
        return back()->with(['success' => $response['message']]);
    }
}
