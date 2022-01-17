<?php

namespace App\Actions\Document;

use App\Models\Document;
use App\Models\ReliefType;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class GetDocumentsWithPaginatedAction
{
    public function execute(User $user = null, int $perPage = 25): LengthAwarePaginator
    {
        $documentTableName = (new Document)->getTable();
        $reliefTypeTableName = (new ReliefType)->getTable();

        return Document::query()
            ->select("$documentTableName.*")
            ->join("$reliefTypeTableName", "$reliefTypeTableName.id", '=', "$documentTableName.relief_type_id")
            ->when($user, function ($query) use ($user, $documentTableName) {
                return $query->where("$documentTableName.user_id", $user->id);
            })
            ->orderByDesc("$reliefTypeTableName.year")
            ->paginate($perPage);
    }
}
