<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function registration_page_contains_livewire_component()
    {
        $this->get('/register')->assertSeeLivewire('auth.register');
    }

    /** @test */
    function can_register()
    {
        Livewire::test('auth.register')
            ->set('name', 'fabio')
            ->set('email', 'fabio@example.com')
            ->set('password', 'password')
            ->set('passwordConfirmation', 'password')
            ->call('register')
            ->assertRedirect('/');

        $this->assertTrue(User::whereEmail('fabio@example.com')->exists());
        $this->assertEquals('fabio@example.com', auth()->user()->email);
    }

    /** @test */
    function email_is_require()
    {
        Livewire::test('auth.register')
            ->set('name', 'fabio')
            ->set('email', '')
            ->set('password', 'password')
            ->set('passwordConfirmation', 'password')
            ->call('register')
            ->assertHasErrors(['email' => 'required']);
    }

    /** @test */
    function email_is_valid_email()
    {
        Livewire::test('auth.register')
            ->set('name', 'fabio')
            ->set('email', 'fabio')
            ->set('password', 'password')
            ->set('passwordConfirmation', 'password')
            ->call('register')
            ->assertHasErrors(['email' => 'email']);
    }

    /** @test */
    function email_hasnt_been_taken_already()
    {
        User::create([
            'name' => 'fabio',
            'email' => 'fabio@example.com',
            'password' => Hash::make('password'),
        ]);

        Livewire::test('auth.register')
            ->set('name', 'fabio')
            ->set('email', 'fabio@example.com')
            ->set('password', 'password')
            ->set('passwordConfirmation', 'password')
            ->call('register')
            ->assertHasErrors(['email' => 'unique']);
    }

    /** @test */
    function see_email_hasnt_already_been_taken_validation_message_as_user_types()
    {
        User::create([
            'name' => 'fabio',
            'email' => 'fabioa@example.com',
            'password' => Hash::make('password'),
        ]);

        Livewire::test('auth.register')
            ->set('email', 'fabio@example.com')
            ->assertHasNoErrors()
            ->set('email', 'fabioa@example.com')
            ->assertHasErrors(['email' => 'unique']);
    }

    /** @test */
    function password_is_required()
    {
        Livewire::test('auth.register')
            ->set('name', 'fabio')
            ->set('email', 'fabio@example.com')
            ->set('password', '')
            ->set('passwordConfirmation', 'password')
            ->call('register')
            ->assertHasErrors(['password' => 'required']);
    }

    /** @test */
    function password_is_minimum_of_six_characters()
    {
        Livewire::test('auth.register')
            ->set('name', 'fabio')
            ->set('email', 'fabio@example.com')
            ->set('password', 'fab')
            ->set('passwordConfirmation', 'password')
            ->call('register')
            ->assertHasErrors(['password' => 'min']);
    }

    /** @test */
    function password_matches_password_confirmation()
    {
        Livewire::test('auth.register')
            ->set('name', 'fabio')
            ->set('email', 'fabio@example.com')
            ->set('password', 'password')
            ->set('passwordConfirmation', 'non-password')
            ->call('register')
            ->assertHasErrors(['password' => 'same']);
    }
}
