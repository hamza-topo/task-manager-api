<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    protected $baseUrl = 'api/projects';
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_should_forbid_an_unauthenticated_user_to_create_project()
    {
        $response = $this->json('POST', $this->baseUrl.'/create', [
            'name' => 'Our First Project',
        ]);
        $response->assertForbidden();
    }


}
