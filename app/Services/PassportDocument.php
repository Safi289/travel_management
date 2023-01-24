<?php


namespace App\Services;


use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PassportDocument
{
    /**
     * Upload Document
     *
     * @param UploadedFile $file
     * @param string $UploadPath
     * @return \Symfony\Component\HttpFoundation\File\File|bool
     */
    public function uploadDocument(UploadedFile $file, string $UploadPath = 'uploads/customers/passport-documents')
    {
        $fileName = time() . ' - ' . $file->getClientOriginalName();
        $dir = public_path($UploadPath);
        if (!file_exists($dir) && !is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $uploaded = Storage::disk('public')->put("{$UploadPath}/{$fileName}", file_get_contents($file), 'public');
        return $uploaded ? $fileName : false;
    }

    public function attachDocument($customer_passport_id, $document_info)
    {
        $data = [
            'customer_passport_id' => $customer_passport_id,
            'title' => $document_info['title'],
            'document' => $document_info['document'],
            'status' => 1,
        ];
        $document = \App\PassportDocument::create($data);
        return $document ? $document : false;
    }
}
