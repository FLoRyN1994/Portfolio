<?php

namespace Tests\Feature;

use App\Models\ContactSubmission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_page_loads(): void
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('work together');
    }

    public function test_valid_submission_is_stored(): void
    {
        $response = $this->post('/contact', [
            'name'    => 'Jane Doe',
            'email'   => 'jane@example.com',
            'message' => 'I have a project for you.',
        ]);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contact_submissions', [
            'name'  => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);
    }

    public function test_invalid_submission_is_rejected(): void
    {
        $response = $this->post('/contact', [
            'name'    => '',
            'email'   => 'not-an-email',
            'message' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'message']);
        $this->assertDatabaseCount('contact_submissions', 0);
    }

    public function test_honeypot_fills_silently_succeed_without_storing(): void
    {
        $response = $this->post('/contact', [
            'name'    => 'Bot',
            'email'   => 'bot@example.com',
            'message' => 'Spam',
            'website' => 'http://spam.example.com',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseCount('contact_submissions', 0);
    }

    public function test_rate_limiting_blocks_excessive_requests(): void
    {
        for ($i = 0; $i < 7; $i++) {
            $response = $this->post('/contact', [
                'name'    => "User $i",
                'email'   => "user$i@example.com",
                'message' => 'Test message',
            ]);
        }

        $response->assertStatus(429);
    }
}
