<?php

namespace Tests\Feature;

use App\Models\Feedback;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeedbackTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test: Homepage dapat diakses
     */
    public function test_homepage_can_be_accessed()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('welcome');
    }

    /**
     * Test: Homepage mengandung form feedback
     */
    public function test_homepage_contains_feedback_form()
    {
        $response = $this->get('/');
        $response->assertSeeText('Kotak Saran & Pengaduan');
        $response->assertSeeText('Nama Lengkap');
        $response->assertSeeText('Email');
        $response->assertSeeText('Kategori');
        $response->assertSeeText('Pesan');
    }

    /**
     * Test: Valid feedback dapat disimpan
     */
    public function test_valid_feedback_can_be_submitted()
    {
        $response = $this->postJson('/feedback', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'category' => 'Saran',
            'message' => 'Ini adalah saran yang bagus untuk dinas ketahanan pangan',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Terima kasih, saran Anda telah diterima.'
        ]);

        $this->assertDatabaseHas('feedbacks', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'category' => 'Saran',
        ]);
    }

    /**
     * Test: Nama wajib diisi
     */
    public function test_name_is_required()
    {
        $response = $this->postJson('/feedback', [
            'name' => '',
            'email' => 'john@example.com',
            'category' => 'Saran',
            'message' => 'Test message yang valid',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('name');
    }

    /**
     * Test: Email wajib diisi dan valid
     */
    public function test_email_is_required_and_valid()
    {
        $response = $this->postJson('/feedback', [
            'name' => 'John Doe',
            'email' => 'invalid-email',
            'category' => 'Saran',
            'message' => 'Test message yang valid',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }

    /**
     * Test: Kategori wajib dan harus valid
     */
    public function test_category_is_required_and_valid()
    {
        $response = $this->postJson('/feedback', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'category' => 'Invalid',
            'message' => 'Test message yang valid',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('category');
    }

    /**
     * Test: Pesan minimal 10 karakter
     */
    public function test_message_must_be_minimum_10_characters()
    {
        $response = $this->postJson('/feedback', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'category' => 'Saran',
            'message' => 'Short',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('message');
    }

    /**
     * Test: Semua kategori valid
     */
    public function test_all_valid_categories_are_accepted()
    {
        $categories = ['Saran', 'Kritik', 'Pengaduan', 'Pertanyaan'];

        foreach ($categories as $category) {
            $response = $this->postJson('/feedback', [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'category' => $category,
                'message' => 'Test message untuk kategori ' . $category,
            ]);

            $response->assertStatus(200);
            $this->assertDatabaseHas('feedbacks', ['category' => $category]);
        }
    }

    /**
     * Test: IP address tercatat
     */
    public function test_ip_address_is_recorded()
    {
        $response = $this->postJson('/feedback', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'category' => 'Saran',
            'message' => 'Test message dengan IP tracking',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('feedbacks', [
            'name' => 'John Doe',
            'ip_address' => '127.0.0.1'
        ]);
    }

    /**
     * Test: Feedback tersimpan dengan benar
     */
    public function test_feedback_is_stored_correctly()
    {
        $feedbackData = [
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'category' => 'Kritik',
            'message' => 'Ini adalah kritik konstruktif untuk meningkatkan layanan dinas',
        ];

        $response = $this->postJson('/feedback', $feedbackData);
        $response->assertStatus(200);

        $feedback = Feedback::first();
        $this->assertEquals('Jane Smith', $feedback->name);
        $this->assertEquals('jane@example.com', $feedback->email);
        $this->assertEquals('Kritik', $feedback->category);
        $this->assertStringContainsString('kritik', $feedback->message);
        $this->assertNotNull($feedback->created_at);
        $this->assertNotNull($feedback->updated_at);
    }

    /**
     * Test: Pesan panjang diterima (max 5000 chars)
     */
    public function test_long_message_is_accepted()
    {
        $longMessage = str_repeat('a', 5000);

        $response = $this->postJson('/feedback', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'category' => 'Saran',
            'message' => $longMessage,
        ]);

        $response->assertStatus(200);
    }

    /**
     * Test: Pesan terlalu panjang ditolak (max 5000 chars)
     */
    public function test_message_exceeding_5000_chars_is_rejected()
    {
        $tooLongMessage = str_repeat('a', 5001);

        $response = $this->postJson('/feedback', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'category' => 'Saran',
            'message' => $tooLongMessage,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('message');
    }

    /**
     * Test: Email maksimal 255 karakter
     */
    public function test_email_exceeding_255_chars_is_rejected()
    {
        $longEmail = str_repeat('a', 250) . '@example.com';

        $response = $this->postJson('/feedback', [
            'name' => 'John Doe',
            'email' => $longEmail,
            'category' => 'Saran',
            'message' => 'Test message yang valid',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }

    /**
     * Test: Multiple feedbacks dapat disimpan
     */
    public function test_multiple_feedbacks_can_be_submitted()
    {
        for ($i = 1; $i <= 5; $i++) {
            $response = $this->postJson('/feedback', [
                'name' => "User $i",
                'email' => "user$i@example.com",
                'category' => ['Saran', 'Kritik', 'Pengaduan', 'Pertanyaan'][$i % 4],
                'message' => "Feedback message number $i with minimum 10 characters",
            ]);

            $response->assertStatus(200);
        }

        $this->assertCount(5, Feedback::all());
    }

    /**
     * Test: Feedback dapat diambil dari database
     */
    public function test_feedback_can_be_retrieved_from_database()
    {
        $feedback = Feedback::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'category' => 'Saran',
            'message' => 'Test message for database retrieval',
            'ip_address' => '192.168.1.1',
        ]);

        $retrieved = Feedback::find($feedback->id);
        
        $this->assertEquals('Test User', $retrieved->name);
        $this->assertEquals('test@example.com', $retrieved->email);
        $this->assertEquals('Saran', $retrieved->category);
        $this->assertEquals('192.168.1.1', $retrieved->ip_address);
    }
}
