<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Setting;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $settings = [];

        $dbsettings = Setting::get();

        foreach ($dbsettings as $dbsetting) {
            $settings[$dbsetting['name']] = $dbsetting['content'];
        }

        return view('admin.settings.index', ['settings' => $settings]);
    }

    public function save(Request $request)
    {
        $datas = $request->only(['title', 'subtitle', 'email', 'bgcolor', 'textcolor']);

        $validator = $this->validator($datas);

        if ($validator->fails()) {
            return redirect()->route('settings')->withErrors($validator);
        }

        foreach ($datas as $item => $value) {
            Setting::where('name', $item)->update(['content' => $value]);
        }

        return redirect()->route('settings')->with('warning', 'Informações alterada com sucesso!');
    }

    public function validator($datas)
    {
        return Validator::make($datas, [
            'title' => 'string|max:100',
            'subtitle' => 'string|max:100',
            'email' => 'string|email',
            'bgcolor' => 'string|regex:/#[A-Z0-9]{6}/i',
            'textcolor' => 'string|regex:/#[A-Z0-9]{6}/i'
        ]);
    }
}
