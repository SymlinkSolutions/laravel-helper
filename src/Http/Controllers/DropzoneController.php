<?php

namespace Symlink\LaravelHelper\Http\Controllers;

use Symlink\LaravelHelper\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DropzoneController extends Controller {

    public function upload(Request $request) {
        $path = session('dropzone.path');

        if (!$path) {
            return response()->json(['error' => 'Session path not found.'], 500);
        }

        // Check if it's a chunked upload
        $chunkIndex = $request->input('dzchunkindex');
        $totalChunks = $request->input('dztotalchunkcount');
        $filename = $request->file('file')->getClientOriginalName();

        if ($chunkIndex !== null && $totalChunks !== null) {
            // Create the temporary directory if it doesn't exist
            $tempDirectory = $path . "temp/" . $filename . "/" . $chunkIndex;
            Storage::disk('public')->makeDirectory($tempDirectory);

            // Move the chunk to the temporary directory
            $request->file('file')->storeAs($tempDirectory, $filename, "public");

            if ($chunkIndex == $totalChunks - 1) {
                $outputFilePath = Storage::disk('public')->path($path.$filename);
                touch($outputFilePath);
                for ($i = 0; $i < $totalChunks; $i++) {
                    $filePart = Storage::disk('public')->path($path . "/" . $filename . "/" . $i . "/" . $filename);
                    $chunkContent = file_get_contents($filePart);
                    file_put_contents($outputFilePath, $chunkContent, FILE_APPEND);
                    unlink($filePart); // Delete the temporary chunk file
                }
                return response()->json(['success' => true, 'file' => $outputFilePath], 200);
            }
            return response()->json(['success' => true, 'chunkIndex' => $chunkIndex], 206);
        } else {
            // It's a non-chunked upload, handle as usual
            $file = $request->file('file')->storeAs($path, $filename, "public");
            return response()->json(['success' => $file], 200);
        }
    }

    public function remove(Request $request) {
        $path = session('dropzone.path');
        $filename = $request->filename;
        $file = Storage::disk('public')->delete($path . "/" . $filename);
        Log::info($file);
        $dir = Storage::disk('public')->deleteDirectory($path . "/" . $filename);
        return response()->json(['success' => true], 200);
    }

}
