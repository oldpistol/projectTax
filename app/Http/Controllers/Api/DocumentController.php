<?php

namespace App\Http\Controllers\Api;

use App\Actions\Document\AddDocumentAction;
use App\Actions\Document\GetDocumentsWithPaginatedAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateDocumentRequest;
use App\Http\Resources\DocumentResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocumentController extends Controller
{
    public function index(Request $request, GetDocumentsWithPaginatedAction $getDocumentsWithPaginatedAction)
    {
        $documents = $getDocumentsWithPaginatedAction->execute($request->user());

        return DocumentResource::collection($documents);
    }

    public function store(CreateDocumentRequest $request, AddDocumentAction $addDocumentAction)
    {
        $data = $request->validationData();

        $addDocumentAction->execute($request->user(), $data, $request->file('file'));

        return response()->json(null, Response::HTTP_CREATED);
    }
}
