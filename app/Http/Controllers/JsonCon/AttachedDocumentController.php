<?php

namespace App\Http\Controllers\JsonCon;

use App\AttachedDocument;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AttachedDocumentController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param $document_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($document_id)
    {
        $document = AttachedDocument::find($document_id);
        if ($document->delete()) {
            File::delete('uploads/customers/documents/' . $document->document);
            return response()->json(['success' => true, 'message' => 'Document Deleted Successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Whoops! Customer Not Deleted'], 200);
        }
    }
}
