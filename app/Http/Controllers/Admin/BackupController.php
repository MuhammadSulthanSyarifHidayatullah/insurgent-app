<?php
// app/Http/Controllers/Admin/BackupController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BackupController extends Controller
{
    public function index(Request $request)
    {
        $backupFile = $request->session()->get('backup_file');
        return view('admin.backup.index', compact('backupFile'));
    }

    public function backup(Request $request)
    {
        $backupFile = 'backup-' . now()->format('Y-m-d-H-i-s') . '.sql';
        $backupPath = public_path('backup/' . $backupFile);
        $command = sprintf(
            'mysqldump --user=%s --password=%s --host=%s %s > %s',
            env('DB_USERNAME'),
            env('DB_PASSWORD'),
            env('DB_HOST'),
            env('DB_DATABASE'),
            $backupPath // Lokasi penyimpanan file backup
        );

        $result = null;
        $output = null;
        exec($command . ' 2>&1', $output, $result);

        // Log output and result for debugging
        Log::info('Backup command output: ' . implode("\n", $output));
        Log::info('Backup command result: ' . $result);

        if ($result === 0) {
            $request->session()->put('backup_file', $backupFile);
            return redirect()->route('admin.backup.index')->with('success', 'Database backup created successfully.');
        } else {
            return redirect()->route('admin.backup.index')->with('error', 'Failed to create database backup.');
        }
    }

    public function download(Request $request)
    {
        $backupFile = $request->session()->get('backup_file');
        $backupPath = public_path('backup/' . $backupFile);
        if ($backupFile && file_exists($backupPath)) {
            return response()->download($backupPath);
        } else {
            return redirect()->route('admin.backup.index')->with('error', 'No backup file available for download.');
        }
    }
}