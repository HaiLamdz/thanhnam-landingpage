<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $settings = SiteSetting::all()->keyBy('key');

        $sections = [
            'Hero'         => ['hero_headline', 'hero_description', 'hero_bg_image'],
            'About Teaser' => ['about_image', 'about_text', 'about_stat_label', 'about_stat_value'],
            'CTA Banner'   => ['cta_heading', 'cta_description'],
            'Contact Info' => ['contact_address', 'contact_email', 'contact_phone'],
            'Footer'       => ['footer_description', 'social_linkedin', 'social_facebook', 'social_youtube'],
            'About Page'   => ['about_page_content'],
            'General'      => ['company_name', 'company_logo', 'meta_description_default'],
        ];

        return view('admin.settings.index', compact('settings', 'sections'));
    }

    public function update(Request $request)
    {
        $imageFields = ['hero_bg_image', 'about_image', 'company_logo'];

        $rules = [];
        foreach ($imageFields as $field) {
            $rules[$field] = 'nullable|image|mimes:jpeg,png,webp|max:2048';
        }

        $request->validate($rules);

        $data = $request->except(array_merge(['_token', '_method'], $imageFields));

        foreach ($data as $key => $value) {
            SiteSetting::where('key', $key)->update(['value' => $value]);
        }

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $existing = SiteSetting::where('key', $field)->value('value');
                if ($existing) {
                    $this->imageService->delete($existing);
                }
                $path = $this->imageService->store($request->file($field), 'settings');
                SiteSetting::where('key', $field)->update(['value' => $path]);
            }
        }

        Cache::forget('site_settings');

        return redirect()->route('admin.settings.index')->with('success', 'Cài đặt đã được lưu thành công.');
    }
}
