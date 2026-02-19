<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

class TerminalController extends Controller
{
    /**
     * Execute a terminal command.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function execute(Request $request)
    {
        $request->validate([
            'command' => 'required|string',
        ]);

        $command = $request->input('command');

        // Whitelist allowed base commands for security
        $allowedCommands = [
            'php artisan',
            'composer', // Careful with this
            'git status',
            'git log',
            'about',
            'help',
            'system:stats',
        ];

        // Basic security check: ensure command starts with one of the allowed prefixes
        $isAllowed = false;
        foreach ($allowedCommands as $allowed) {
            if (str_starts_with($command, $allowed)) {
                $isAllowed = true;
                break;
            }
        }

        if (!$isAllowed) {
            return response()->json([
                'output' => "Command not allowed: $command\nType 'help' for a list of available commands.",
            ], 403);
        }

        // Handle specific custom commands
        if ($command === 'help') {
            return response()->json([
                'output' => "Available commands:
- php artisan [command] (e.g., optimize:clear, route:list)
- git status
- git log
- system:stats (Show server stats)
- clear (Clear terminal output)
- about (About this terminal)",
            ]);
        }

        if ($command === 'about') {
            return response()->json([
                'output' => "Portfolio Admin Terminal v1.0\nRunning on Laravel " . app()->version(),
            ]);
        }
        
        if ($command === 'system:stats') {
             $memoryUsage = round(memory_get_usage(true) / 1024 / 1024, 2);
             $phpVersion = phpversion();
             $uptime = @file_get_contents('/proc/uptime') ? explode(' ', file_get_contents('/proc/uptime'))[0] : 'N/A';
             
             return response()->json([
                'output' => "System Stats:\nPHP Version: $phpVersion\nMemory Usage: {$memoryUsage} MB\nUptime: $uptime seconds",
            ]);
        }

        // Execute actual shell commands
        // Note: 'php artisan' commands can be run via Artisan::call() for better control/security than shell_exec
        if (str_starts_with($command, 'php artisan')) {
            $artisanCommand = trim(substr($command, 11));
            
            // Prevent dangerous artisan commands if needed (e.g. migrate:fresh)
            $blacklisted = ['migrate:fresh', 'db:wipe', 'tinker', 'down'];
            foreach ($blacklisted as $bad) {
                if (str_contains($artisanCommand, $bad)) {
                     return response()->json([
                        'output' => "Command blocked for security reasons: $command",
                    ], 403);
                }
            }

            try {
                ob_start();
                Artisan::call($artisanCommand);
                $noise = ob_get_clean();
                $output = Artisan::output();
                
                if ($noise) {
                    $output .= "\n--- System Noise ---\n" . $noise;
                }
                
                return $this->forceCleanResponse(['output' => $output]);
            } catch (\Exception $e) {
                if (ob_get_level() > 0) ob_get_clean();
                return $this->forceCleanResponse(['output' => "Error: " . $e->getMessage()]);
            }
        }

        try {
            $process = Process::fromShellCommandline($command, base_path());
            $process->run();

            // Return 200 even on exit code != 0 so the terminal shows the error message instead of a generic fetch error
            if (!$process->isSuccessful()) {
                 return $this->forceCleanResponse(['output' => $process->getErrorOutput() ?: $process->getOutput()]);
            }

            return $this->forceCleanResponse(['output' => $process->getOutput()]);
        } catch (\Exception $e) {
            return $this->forceCleanResponse(['output' => "Execution Exception: " . $e->getMessage()]);
        }
    }

    /**
     * Force a clean JSON response, bypassing framework shutdown noise.
     */
    private function forceCleanResponse($data, $status = 200)
    {
        // Clear all buffers
        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        // Set headers for CORS and JSON
        if (!headers_sent()) {
            http_response_code($status);
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
            header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
            header('Content-Type: application/json');
        }

        echo json_encode($data);
        exit;
    }
}
