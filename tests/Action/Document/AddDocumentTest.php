<?php

namespace Tests\Action\Document;

use App\Actions\Document\AddDocumentAction;
use App\Models\Document;
use App\Models\ReliefType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AddDocumentTest extends TestCase
{
    use RefreshDatabase;

    public function test_execute()
    {
        $user = User::factory()->create();
        $reliefType = ReliefType::factory()->create();

        Storage::fake(env('FILESYSTEM_DRIVER'));

        $data = [
            'name' => 'Test Name',
            'description' => 'Test Description',
            'amount' => 100,
            'relief_type_id' => $reliefType->id
        ];

        $document = (new AddDocumentAction)->execute(
            $user,
            $data,
            UploadedFile::fake()->image('photo1.jpg')
        );

        $this->assertDatabaseHas((new Document)->getTable(), [
            'name' => $data['name'],
            'description' => $data['description'],
            'amount' => $data['amount'],
            'relief_type_id' => $reliefType->id,
            'user_id' => $user->id,
            'filename' => $document->filename
        ]);

        Storage::disk(env('FILESYSTEM_DRIVER'))->assertExists("$user->id/$document->filename");
    }
}
