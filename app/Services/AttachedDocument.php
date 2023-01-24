<?php


namespace App\Services;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class AttachedDocument
{
    /**
     * Upload Document
     *
     * @param UploadedFile $file
     * @param string $UploadPath
     * @return \Symfony\Component\HttpFoundation\File\File|bool
     */
    public function uploadDocument(UploadedFile $file, string $UploadPath = 'uploads/customers/documents')
    {
        $fileName = time() . ' - ' . $file->getClientOriginalName();
        $uploaded = $file->move(public_path($UploadPath), $fileName);
        return $uploaded ? $fileName : false;
    }

    public function attachDocument($customer_id, $document_info)
    {
        $data = [
            'customer_id' => $customer_id,
            'title' => $document_info['title'],
            'document' => $document_info['document'],
            'status' => 1,
        ];
        $document = \App\AttachedDocument::create($data);
        return $document ? $document : false;
    }
}
