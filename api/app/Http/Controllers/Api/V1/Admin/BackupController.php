<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function create()
    {
        $filename = 'backup-' . now()->format('Y-m-d-His') . '.sql';
        
        // Use config name for path if using spatie
        $appName = config('backup.backup.name');
        $path = $appName . '/' . $filename;

        try {
            // Try spatie/laravel-backup if installed
            if (class_exists(\Spatie\Backup\BackupServiceProvider::class)) {
                $exitCode = Artisan::call('backup:run', ['--only-db' => true]);
                
                if ($exitCode !== 0) {
                    return response()->json([
                        'message' => 'Backup failed. Check server logs.',
                    ], 500);
                }

                return response()->json([
                    'message' => 'Backup created successfully via Spatie Backup.',
                ]);
            }

            // Fallback: mysqldump logic (simplified for brevity, keeping existing structure if possible)
            // Fallback: mysqldump logic
            $path = 'backups/' . $filename; 
            
             $dbHost     = config('database.connections.mysql.host');
            $dbPort     = config('database.connections.mysql.port');
            $dbName     = config('database.connections.mysql.database');
            $dbUser     = config('database.connections.mysql.username');
            $dbPassword = config('database.connections.mysql.password');

            $command = sprintf(
                'mysqldump --host=%s --port=%s --user=%s --password=%s %s',
                escapeshellarg($dbHost),
                escapeshellarg($dbPort),
                escapeshellarg($dbUser),
                escapeshellarg($dbPassword),
                escapeshellarg($dbName)
            );

            $output = [];
            exec($command, $output, $exitCode);

            if ($exitCode !== 0) {
                return response()->json([
                    'message' => 'Backup failed. mysqldump returned exit code ' . $exitCode,
                ], 500);
            }

            Storage::put($path, implode("\n", $output));

            return response()->json([
                'message'  => 'Backup created successfully.',
                'filename' => $filename,
                'path'     => $path,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Backup failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function list()
    {
        $backups = collect();
        
        // Determine directory based on what's available
        $spatieDir = config('backup.backup.name');
        $fallbackDir = 'backups'; // For the manual fallback

        $directories = array_filter([$spatieDir, $fallbackDir]);
        
        foreach ($directories as $dir) {
            if (Storage::exists($dir)) {
                $files = Storage::files($dir);
                foreach ($files as $file) {
                    $backups->push([
                        'name'       => basename($file),
                        'path'       => $file,
                        'size'       => Storage::size($file),
                        'size_human' => $this->humanFileSize(Storage::size($file)),
                        'created_at' => date('Y-m-d H:i:s', Storage::lastModified($file)),
                    ]);
                }
            }
        }

        // Sort by newest first
        $sorted = $backups->sortByDesc('created_at')->values();

        return response()->json([
            'data' => $sorted,
        ]);
    }

    public function download(string $name)
    {
        // Try to find the file in either directory
        $spatieDir = config('backup.backup.name');
        $fallbackDir = 'backups';
        
        $paths = [
            $spatieDir . '/' . $name,
            $fallbackDir . '/' . $name,
        ];

        foreach ($paths as $path) {
            if (Storage::exists($path)) {
                 return Storage::download($path, $name);
            }
        }

        return response()->json([
            'message' => 'Backup file not found.',
        ], 404);
    }

    private function humanFileSize(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $factor = floor((strlen((string) $bytes) - 1) / 3);
        return sprintf("%.1f %s", $bytes / pow(1024, $factor), $units[$factor] ?? 'TB');
    }
}
