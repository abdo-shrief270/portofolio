<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiteSettingResource;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function public()
    {
        $settings = SiteSetting::whereIn('group', ['general', 'seo', 'social'])->get();
        return SiteSettingResource::collection($settings);
    }
}
