<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttachedDocument extends Model
{
    protected $guarded = ['id'];

    protected $appends = ['document_path'];

    public function getDocumentPathAttribute()
    {
        return public_path('uploads/customers/documents' . '/' . $this->document);
    }

    public function getDocumentDownloadUrlAttribute()
    {
        return asset('uploads/customers/documents' . '/' . $this->document);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
