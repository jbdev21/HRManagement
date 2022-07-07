<?php
namespace App\Traits;

use App\Models\Document;
use Illuminate\Http\Request;

trait HasDocumentTrait{
    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function addDocumentFromRequest(Request $request, $data)
    {
        $document = new Document();
        $document->name = $data['name'];
        $document->category_id = $data['category_id'];
        $document->path = $request->file('document_file')->store('documents', 'public');
        $this->documents()->save($document);
        return $document;
    }

}