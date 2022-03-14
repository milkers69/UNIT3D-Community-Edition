<?php

namespace Tests\Feature\Http\Controllers\Staff;

use App\Models\Privilege;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RolesTableSeeder;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Staff\InviteController
 */
class InviteControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function createStaffUser(): \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
    {
        $role = Role::factory()->create();
        $privileges = Privilege::all();
        foreach ($privileges as $privilege) {
            $role->privileges()->attach($privilege);
        }

        return User::factory()->create([
            'role_id' => $role->id,
        ]);
    }

    /** @test */
    public function index_returns_an_ok_response(): void
    {
        $this->seed(RolesTableSeeder::class);

        $user = $this->createStaffUser();

        $response = $this->actingAs($user)->get(route('staff.invites.index'));

        $response->assertOk();
        $response->assertViewIs('Staff.invite.index');
        $response->assertViewHas('invites');
        $response->assertViewHas('invitecount');
    }
}
