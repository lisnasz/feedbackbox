<?php

namespace Tests\Feature;

use App\Models\Feedback;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_valid_feedback_can_be_submitted(): void
    {
        $response = $this->postJson('/feedback', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'category' => 'Saran',
            'message' => 'This is a valid feedback message for testing',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('feedbacks', [
            'name' => 'John Doe',
        ]);
    }

    public function test_all_categories_are_accepted(): void
    {
        foreach (['Saran', 'Kritik', 'Pengaduan', 'Pertanyaan'] as $category) {
            $response = $this->postJson('/feedback', [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'category' => $category,
                'message' => 'Valid feedback message here',
            ]);

            $response->assertStatus(200);
        }
    }
}
