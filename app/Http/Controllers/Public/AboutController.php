<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ActivityArea;
use App\Models\ActivityImage;
use App\Models\Equipment;
use App\Models\Service;

class AboutController extends Controller
{
    public function index()
    {
        $content = setting('about_page_content');
        $activityAreas = ActivityArea::published()->orderBy('sort_order')->get();
        $equipments = Equipment::published()->orderBy('sort_order')->get();
        $activityImages = ActivityImage::published()->orderBy('sort_order')->get();
        $services = Service::published()->ordered()->get();

        return view('public.about', compact('content', 'activityAreas', 'equipments', 'activityImages', 'services'));
    }
}
