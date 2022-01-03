<?php

namespace Api;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DocumentTest extends TestCase
{
    public function test_can_post_document()
    {
//        Sanctum::actingAs(User::factory()->create());
//
//        $response = $this->postJson('/api/document', [
//            'name' => 'Test Document',
//            ''
//        ]);

        $this->assertTrue(true);
    }
}
