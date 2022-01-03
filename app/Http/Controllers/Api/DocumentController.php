<?php

namespace App\Http\Controllers\Api;

use App\Actions\Document\AddDocumentAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDocumentRequest;
use Symfony\Component\HttpFoundation\Response;

class DocumentController extends Controller
{
    public function create(CreateDocumentRequest $request, AddDocumentAction $addDocumentAction)
    {
        $data = $request->validationData();

        $addDocumentAction->execute($request->user(), $data, $request->file('file'));

        return response()->json(null, Response::HTTP_CREATED);
    }
}
