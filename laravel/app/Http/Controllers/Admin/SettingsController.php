<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use View;
use App\Models\Settings;
use App\Http\Controllers\Admin\CacheController;

class SettingsController extends AdminController
{
    public function __construct()
    {
        $this->checkPermissions('settings');
        View::share('section_name', 'Настройки');
        View::share('page_name', '');
    }

    public function index()
    {
        View::share('page_name', 'Общие настройки');

        $settings_structure = Settings::$settings_structure;

        return view('admin.settings.settings', compact('settings_structure'));
    }

    public function save(Request $request)
    {
        $settings_data = $request->get('settings');

        if (!is_array($settings_data)) {
            flash()->error('Нет данных для сохранения');

            return redirect()->back();
        }

        foreach ($settings_data as $key => $value) {
            $s = Settings::firstOrCreate(['key' => $key]);
            $s->value = $value;
            $s->save();
        }

        flash()->success('Настройки успешно сохранены');

        CacheController::clear_cache();

        return redirect()->back();
    }
}
