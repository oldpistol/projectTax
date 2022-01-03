<?php

namespace App\Actions\Document;

use App\Models\User;
use Illuminate\Http\UploadedFile;

class AddDocumentAction
{
    public function execute(User $user, array $data, UploadedFile $uploadedFile)
    {
        $path = $uploadedFile->store("$user->id");

        $document = $user->documents()->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'amount' => $data['amount'],
            'relief_type_id' => $data['relief_type_id'],
            'path' => $path
        ]);

        return $document;
    }
}
