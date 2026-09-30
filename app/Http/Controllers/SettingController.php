<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method', 'app_logo', 'hero_image']);

        // Update text settings
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value ?? '']);
        }

        // Handle File Uploads
        if ($request->hasFile('app_logo')) {
            $logo = $request->file('app_logo');
            $path = $logo->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'app_logo'], ['value' => $path]);
        }

        if ($request->hasFile('hero_image')) {
            $hero = $request->file('hero_image');
            $path = $hero->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'hero_image'], ['value' => $path]);
        }

        return back()->with('success', 'Pengaturan aplikasi berhasil disimpan.');
    }
}
