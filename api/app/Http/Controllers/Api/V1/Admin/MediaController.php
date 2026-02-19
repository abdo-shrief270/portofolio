<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file'   => 'required|file|mimes:jpg,jpeg,png,gif,svg,webp|max:10240',
            'folder' => 'nullable|string|max:100',
        ]);

        $file   = $request->file('file');
        $folder = $request->get('folder', 'uploads');

        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path     = $file->storeAs($folder, $filename, 'public');

        return response()->json([
            'path'     => $path,
            'url'      => Storage::disk('public')->url($path),
            'filename' => $filename,
            'original_name' => $file->getClientOriginalName(),
            'size'     => $file->getSize(),
            'mime'     => $file->getMimeType(),
        ], 201);
    }

    public function destroy(string $path)
    {
        // Decode the path (it may be URL-encoded)
        $decodedPath = urldecode($path);

        if (!Storage::disk('public')->exists($decodedPath)) {
            return response()->json([
                'message' => 'File not found.',
            ], 404);
        }

        Storage::disk('public')->delete($decodedPath);

        return response()->json([
            'message' => 'File deleted successfully.',
        ]);
    }
}
