<?php

namespace Tests\Feature;

use App\Mail\CandidacyMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CandidacyTest extends TestCase
{

    use RefreshDatabase;

    public function test_error_in_form_without_required_data(): void
    {
        $response = $this->post(route('candidacy.store'), []);

        $response->assertSessionHasErrors(['email', 'name', 'phone', 'desired_role', 'education_level', 'cv_file']);
    }

    public function test_file_name_upload_format() {
        Storage::fake('s3');

        $file = UploadedFile::fake()->create('curriculo.pdf', 1000, 'application/pdf');

        $data = [
            'name' => 'Gabriel Pereira',
            'email' => 'gabriel@email.com',
            'phone' => '99999999999',
            'desired_role' => 'Desenvolvedor',
            'education_level' => 'UNDERGRADUATE',
            'observations' => '123',
            'cv_file' => $file
        ];

        $this->post(route('candidacy.store'), $data);

        $expectedName = 'gabriel_pereira_' . now()->timestamp . '.pdf';

        Storage::disk('s3')->assertExists($expectedName);
    }

    public function test_error_in_file_size() {
        Storage::fake('s3');

        $file = UploadedFile::fake()->create('curriculo.pdf', 2048);

        $data = [
            'name' => 'Gabriel Pereira',
            'email' => 'gabriel@email.com',
            'phone' => '99999999999',
            'desired_role' => 'Desenvolvedor',
            'education_level' => 'UNDERGRADUATE',
            'observations' => '123',
            'cv_file' => $file
        ];

        $request = $this->post(route('candidacy.store'), $data);

        $request->assertSessionHasErrors(['cv_file']);
    }

    public function test_error_in_file_extension() {
        Storage::fake('s3');

        $file = UploadedFile::fake()->create('curriculo.pdf', 2048, 'text/csv');

        $data = [
            'name' => 'Gabriel Pereira',
            'email' => 'gabriel@email.com',
            'phone' => '99999999999',
            'desired_role' => 'Desenvolvedor',
            'education_level' => 'UNDERGRADUATE',
            'observations' => '123',
            'cv_file' => $file
        ];

        $request = $this->post(route('candidacy.store'), $data);

        $request->assertSessionHasErrors(['cv_file']);
    }

    public function test_insert_in_database() {
        $file = UploadedFile::fake()->create('cv.docx', 1000, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');

        $data = [
            'name' => 'Maria Cantina',
            'email' => 'Maria@email.com',
            'phone' => '99999999999',
            'desired_role' => 'Desenvolvedora',
            'education_level' => 'MASTER',
            'observations' => null,
            'cv_file' => $file
        ];

        $this->post(route('candidacy.store'), $data, ['REMOTE_ADDR' => '171.6.43.30']);


        $this->assertDatabaseHas('candidacy', [
            'name' => 'Maria Cantina',
            'desired_role' => 'Desenvolvedora',
            'phone' => '99999999999',
            'education_level' => 'MASTER',
            'sender_ip' => '171.6.43.30',
        ]);
    }

    public function test_is_email_candidacy_being_send() {
        Mail::fake();

        $file = UploadedFile::fake()->create('cv.pdf', 1000, 'application/pdf');

        $data = [
            'name' => 'Maria Cantina',
            'email' => 'Maria@email.com',
            'phone' => '99999999999',
            'desired_role' => 'Desenvolvedora',
            'education_level' => 'MASTER',
            'observations' => null,
            'cv_file' => $file
        ];

        $request = $this->post(route('candidacy.store'), $data );

        $request->assertSessionHasNoErrors();

        Mail::assertSent(CandidacyMail::class, function ($mail) use ($data) {
            return $mail->hasTo($data['email']);
        });
    }
}
