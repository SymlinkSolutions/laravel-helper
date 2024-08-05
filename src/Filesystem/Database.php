<?php

namespace Symlink\LaravelHelper\Filesystem;

use Illuminate\Support\Facades\Storage;
use League\Flysystem\Config;
use League\Flysystem\FileAttributes;
use League\Flysystem\FilesystemAdapter;

class Database implements FilesystemAdapter{
    //---------------------------------------------------------------------------
    public function move(string $source, string $destination, Config $config): void {
    }
    //---------------------------------------------------------------------------
    public function listContents(string $path, bool $deep): iterable {
        return [];
    }
    //---------------------------------------------------------------------------
    public function fileSize(string $path): FileAttributes {
        $attr = new FileAttributes("");
        return $attr;
    }
    //---------------------------------------------------------------------------
    public function lastModified(string $path): FileAttributes {
        $attr = new FileAttributes("");
        return $attr;
    }
    //---------------------------------------------------------------------------
    public function mimeType(string $path): FileAttributes {
        $attr = new FileAttributes("");
        return $attr;
    }
    //---------------------------------------------------------------------------
    public function visibility(string $path): FileAttributes {
        $attr = new FileAttributes("");
        return $attr;
    }
    //---------------------------------------------------------------------------
    public function setVisibility(string $path, string $visibility): void {
        
    }
    //---------------------------------------------------------------------------
    public function createDirectory(string $path, Config $config): void {
        
    }
    //---------------------------------------------------------------------------
    public function deleteDirectory(string $path): void {
        
    }
    //---------------------------------------------------------------------------
    public function delete(string $path): void {
        
    }
    //---------------------------------------------------------------------------
    public function readStream(string $path) {
        
    }
    //---------------------------------------------------------------------------
    public function read(string $path): string {
        return "";
    }
    //---------------------------------------------------------------------------
    public function writeStream(string $path, $contents, Config $config): void {
        
    }
    //---------------------------------------------------------------------------
    public function copy(string $source, string $destination, Config $config): void {
        
    }
    //---------------------------------------------------------------------------
    public function write(string $path, string $contents, Config $config): void{
        
    }
    //---------------------------------------------------------------------------
    public function directoryExists(string $path): bool {
        return false;
    }
    //---------------------------------------------------------------------------
    public function fileExists(string $path):bool {
        return false;
    }
    //---------------------------------------------------------------------------
}