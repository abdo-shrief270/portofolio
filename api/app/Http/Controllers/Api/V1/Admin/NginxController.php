<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Traits\ApiResponseTrait;

class NginxController extends Controller
{
    use ApiResponseTrait;

    protected $nginxPath = '/etc/nginx/sites-available';

    /**
     * Display a listing of Nginx vhost configurations.
     */
    public function index()
    {
        if (!File::exists($this->nginxPath)) {
            return $this->errorResponse('Nginx path not found on this server.', 404);
        }

        $files = File::files($this->nginxPath);
        $configs = [];

        foreach ($files as $file) {
            $configs[] = [
                'name' => $file->getFilename(),
                'size' => $file->getSize(),
                'last_modified' => \Carbon\Carbon::createFromTimestamp($file->getMTime())->toDateTimeString(),
            ];
        }

        return $this->successResponse($configs, 'Nginx configurations retrieved successfully');
    }

    /**
     * Display a specific Nginx config file.
     */
    public function show($name)
    {
        $filePath = "{$this->nginxPath}/{$name}";

        if (!File::exists($filePath)) {
            return $this->errorResponse("Config file {$name} not found.", 404);
        }

        $content = File::get($filePath);

        return $this->successResponse([
            'name' => $name,
            'content' => $content
        ], 'Nginx configuration retrieved successfully');
    }
}
