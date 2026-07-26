<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        foreach ($request->settings as $key => $value) {
            if ($request->hasFile("settings.{$key}")) {
                $file = $request->file("settings.{$key}");
                $path = $file->store('uploads/settings', 'public');
                Setting::set($key, $path);
            } else {
                Setting::set($key, $value);
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully!');
    }
}