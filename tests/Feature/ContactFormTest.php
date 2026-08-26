<?php

namespace Tests\Feature;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_valid_submission_is_stored(): void
    {
        $response = $this->post($this->publicUrl('/contact'), [
            'fullname' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'Hello, I would like to get in touch.',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('messages', [
            'fullname' => 'John Doe',
            'email' => 'john@example.com',
        ]);
    }

    public function test_invalid_submission_fails_validation(): void
    {
        $response = $this->post($this->publicUrl('/contact'), [
            'fullname' => '',
            'email' => 'not-an-email',
            'message' => '',
        ]);

        $response->assertSessionHasErrors(['fullname', 'email', 'message']);
        $this->assertSame(0, Message::count());
    }

    public function test_honeypot_field_rejects_submission_silently(): void
    {
        $response = $this->post($this->publicUrl('/contact'), [
            'fullname' => 'Bot User',
            'email' => 'bot@example.com',
            'message' => 'I am a bot.',
            'website' => 'https://spam.example.com',
        ]);

        $response->assertSessionHasErrors(['website']);
        $this->assertSame(0, Message::count());
    }
}
