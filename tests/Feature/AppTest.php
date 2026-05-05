<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Publicacion;
use App\Models\SolicitudIntercambio;


class AppTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

public function test_user_can_register()
{
    $this->post('/register', [
        'nombre' => 'Test User',
        'email' => 'test@example.com',
        'centro_id' => 1,
        'estado_id' => 1,
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
    ]);
}

public function test_user_can_login()
{
    $user = User::factory()->create([
        'password' => bcrypt('password123'),
    ]);

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'password123',
    ]);

    $this->assertAuthenticated();
}

public function test_user_can_update_profile()
{
    $user = User::factory()->create();

    $this->actingAs($user);

    $this->patch('/profile', [
        'nombre' => 'Nuevo Nombre',
        'email' => 'nuevo@email.com',
    ]);

    $this->assertDatabaseHas('users', [
        'nombre' => 'Nuevo Nombre',
    ]);
}

public function test_guest_cannot_access_profile()
{
    $response = $this->get('/profile');

    $response->assertRedirect('/login');
}

}
