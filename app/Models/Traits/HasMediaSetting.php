<?php

namespace App\Models\Traits;

use App\Traits\Loggable;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait HasMediaSetting
{
    use Loggable;

    private ?string $mediaCollection = null;

    public function handleFileUpload($model, UploadedFile $file, $filename, $deleteExistingFile = true, ?string $mediaCollection = ''): void
    {
        $this->mediaCollection = $mediaCollection ?: $model::MEDIA_COLLECTION;

        try {
            $this->validateFile($file, $model::ALLOWED_EXTENSIONS);

            // Generate nama file yang unik
            $fileName = $this->generateFileName($filename, $file);

            // Hapus file lama jika ada
            if ($deleteExistingFile) {
                $this->deleteExistingFile($model);
            }

            // Upload file baru
            $model->addMedia($file)
                ->usingFileName($fileName)
                // ->withResponsiveImages()
                // ->withCustomProperties([
                //     'title' => $title,
                //     'uploaded_at' => now()
                // ])
                ->toMediaCollection($this->mediaCollection);

        } catch (Exception $e) {
            $this->logError(class_basename($model), 'File upload failed', [
                'error' => $e->getMessage(),
                'model_id' => $this->model_id ?? null
            ]);

            throw new Exception('Gagal mengunggah file: ' . $e->getMessage());
        }
    }

    public function validateFile(UploadedFile $file, array $allowedExtensions, int $maxFileSize = 2048): void
    {
        if (!in_array($file->getClientOriginalExtension(), $allowedExtensions)) {
            throw new Exception('Format file tidak didukung. Format yang diizinkan: ' . implode(', ', $allowedExtensions));
        }

        if ($file->getSize() > ($maxFileSize * 1024)) {
            throw new Exception('Ukuran file terlalu besar. Maksimal ' . $maxFileSize . 'KB');
        }
    }

    private function generateFileName(string $title, UploadedFile $file): string
    {
        $baseFileName = Str::slug($title);
        $extension = $file->getClientOriginalExtension();
        $timestamp = now()->timestamp;

        return "{$baseFileName}-{$timestamp}.{$extension}";
    }

    private function deleteExistingFile($model, ?string $mediaCollection = null): void
    {
        $this->mediaCollection = $mediaCollection ?: $model::MEDIA_COLLECTION;

        if ($model->hasMedia($this->mediaCollection)) {
            $model->clearMediaCollection($this->mediaCollection);
        }
    }
}
