<?php


namespace App\Interfaces;


use Symfony\Component\HttpFoundation\File\UploadedFile;

interface IUploadable
{
    public function getFile(): ?UploadedFile;
    public function setFilename(string $filename);
    public function getFilename(): ?string;
    public function getUploadDirectory(): string;
}