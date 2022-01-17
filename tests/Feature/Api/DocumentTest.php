<?php

namespace Tests\Feature\Api;

use App\Models\Document;
use App\Models\ReliefType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DocumentTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_store_document()
    {
        $user = User::factory()->create();
        $reliefType = ReliefType::factory()->create();

        Sanctum::actingAs($user);

        $creatingDocument = Document::factory()->make();

        $response = $this->postJson(route('api.documents.store'), [
            'name' => $creatingDocument->name,
            'description' => $creatingDocument->description,
            'amount' => $creatingDocument->amount,
            'file' => UploadedFile::fake()->image('test.jpg'),
            'relief_type_id' => $reliefType->id
        ]);

        $response->assertCreated();
    }

    public function test_get_own_documents()
    {
        $users = User::factory()
            ->count(3)
            ->hasDocuments(50)
            ->create();

        $authUser = $users->first();

        Sanctum::actingAs($authUser);

        $response = $this->getJson(route('api.documents.index'));

        $response->assertOk();
    }
}
