<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Traits\ApiResponseTrait;

class DnsController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of Hostinger DNS records for the portfolio domain.
     */
    public function index(Request $request)
    {
        $domain = env('HOSTINGER_DOMAIN');
        $token = env('HOSTINGER_API_TOKEN');

        if (!$domain || !$token) {
            return $this->errorResponse('Hostinger API token or domain not configured.', 500);
        }

        try {
            $response = Http::withToken($token)
                ->get("https://developers.hostinger.com/api/dns/v1/zones/{$domain}");

            if ($response->successful()) {
                return $this->successResponse($response->json(), 'DNS records retrieved successfully');
            }

            return $this->errorResponse('Failed to fetch DNS records from Hostinger API', $response->status(), $response->json());
        } catch (\Exception $e) {
            return $this->errorResponse('Error connecting to Hostinger API: ' . $e->getMessage(), 500);
        }
    }
}
