<?php declare(strict_types=1);

namespace Tests\Feature\Home;

use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testIndex()
    {
        $this->get(route('home.users.index'))
            ->assertRedirect(route('login'));

        $author = User::factory()->create(['role_id' => User::ID_ROLE_AUTHOR]);
        $this->actingAs($author)
            ->get(route('home.users.index'))
            ->assertForbidden();

        $editor = User::factory()->create(['role_id' => User::ID_ROLE_EDITOR]);
        $this->actingAs($editor)
            ->get(route('home.users.index'))
            ->assertForbidden();

        $admin = User::factory()->create(['role_id' => User::ID_ROLE_ADMINISTRATOR]);
        $this->actingAs($admin)
            ->get(route('home.users.index'))
            ->assertOk()
            ->assertViewIs('home.users.index')
            ->assertViewHas('users');
    }

    /**
     * @return void
     */
    public function testCreate()
    {
        $this->get(route('home.users.create'))
            ->assertRedirect(route('login'));

        $author = User::factory()->create(['role_id' => User::ID_ROLE_AUTHOR]);
        $this->actingAs($author)
            ->get(route('home.users.create'))
            ->assertForbidden();

        $editor = User::factory()->create(['role_id' => User::ID_ROLE_EDITOR]);
        $this->actingAs($editor)
            ->get(route('home.users.create'))
            ->assertForbidden();

        $admin = User::factory()->create(['role_id' => User::ID_ROLE_ADMINISTRATOR]);
        $this->actingAs($admin)
            ->get(route('home.users.create'))
            ->assertOk()
            ->assertViewIs('home.users.create');
    }

    /**
     * @return void
     */
    public function testStore()
    {
        $createdUser = User::factory()->make();
        $formData = $createdUser->only([
            'name', 'email', 'password', 'role_id'
        ]);
        $url = route('home.users.store');

        $this->post($url, $formData)
            ->assertRedirect(route('login'));

        $author = User::factory()->create(['role_id' => User::ID_ROLE_AUTHOR]);
        $this->actingAs($author)
            ->post($url, $formData)
            ->assertForbidden();

        $editor = User::factory()->create(['role_id' => User::ID_ROLE_EDITOR]);
        $this->actingAs($editor)
            ->post($url, $formData)
            ->assertForbidden();

        $admin = User::factory()->create(['role_id' => User::ID_ROLE_ADMINISTRATOR]);
        $this->actingAs($admin)
            ->post($url, $formData)
            ->assertRedirect(route('home.users.index'))
            ->assertSessionHas('status', __('messages.users.created'));

        $this->assertDatabaseHas($createdUser->getTable(), Arr::except($formData, 'password'));
    }

    /**
     * @return void
     */
    public function testEdit()
    {
        $createdUser = User::factory()->create();
        $url = route('home.users.edit', $createdUser);

        $this->get($url)->assertRedirect(route('login'));

        $author = User::factory()->create(['role_id' => User::ID_ROLE_AUTHOR]);
        $this->actingAs($author)
            ->get($url)
            ->assertForbidden();

        $editor = User::factory()->create(['role_id' => User::ID_ROLE_EDITOR]);
        $this->actingAs($editor)
            ->get($url)
            ->assertForbidden();

        $admin = User::factory()->create(['role_id' => User::ID_ROLE_ADMINISTRATOR]);
        $this->actingAs($admin)
            ->get($url)
            ->assertOk()
            ->assertViewIs('home.users.edit')
            ->assertViewHas('user');
    }

    /**
     * @return void
     */
    public function testUpdate()
    {
        $createdUser = User::factory()->create();
        $formData = User::factory()->make()->only([
            'name', 'email', 'password', 'role_id'
        ]);
        $url = route('home.users.update', $createdUser);

        $this->patch($url, $formData)->assertRedirect(route('login'));

        $author = User::factory()->create(['role_id' => User::ID_ROLE_AUTHOR]);
        $this->actingAs($author)
            ->patch($url, $formData)
            ->assertForbidden();

        $editor = User::factory()->create(['role_id' => User::ID_ROLE_EDITOR]);
        $this->actingAs($editor)
            ->patch($url, $formData)
            ->assertForbidden();

        $admin = User::factory()->create(['role_id' => User::ID_ROLE_ADMINISTRATOR]);
        $this->actingAs($admin)
            ->patch($url, $formData)
            ->assertRedirect(route('home.users.index'))
            ->assertSessionHas('status', __('messages.users.updated'));

        $this->assertDatabaseHas($createdUser->getTable(), Arr::except($formData, 'password'));
    }

    /**
     * @return void
     */
    public function testDestroy()
    {
        $createdUser = User::factory()->create();
        $url = route('home.users.destroy', $createdUser);

        $this->delete($url)
            ->assertRedirect(route('login'));

        $author = User::factory()->create(['role_id' => User::ID_ROLE_AUTHOR]);
        $this->actingAs($author)
            ->delete($url)
            ->assertForbidden();

        $editor = User::factory()->create(['role_id' => User::ID_ROLE_EDITOR]);
        $this->actingAs($editor)
            ->delete($url)
            ->assertForbidden();

        $admin = User::factory()->create(['role_id' => User::ID_ROLE_ADMINISTRATOR]);
        $this->actingAs($admin)
            ->delete($url)
            ->assertRedirect(route('home.users.index'))
            ->assertSessionHas('status', __('messages.users.deleted'));

        $this->assertSoftDeleted($createdUser->getTable(), ['id' => $createdUser->id]);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function testRestore()
    {
        $createdUser = User::factory()->create();
        $createdUser->delete();
        $this->assertSoftDeleted($createdUser->getTable(), ['id' => $createdUser->id]);

        $url = route('home.users.restore', $createdUser);
        $this->patch($url)
            ->assertRedirect(route('login'));

        $author = User::factory()->create(['role_id' => User::ID_ROLE_AUTHOR]);
        $this->actingAs($author)
            ->patch($url)
            ->assertForbidden();

        $editor = User::factory()->create(['role_id' => User::ID_ROLE_EDITOR]);
        $this->actingAs($editor)
            ->patch($url)
            ->assertForbidden();

        $admin = User::factory()->create(['role_id' => User::ID_ROLE_ADMINISTRATOR]);
        $this->actingAs($admin)
            ->patch($url)
            ->assertRedirect(route('home.users.index'))
            ->assertSessionHas('status', __('messages.users.restored'));

        $this->assertDatabaseHas($createdUser->getTable(), [
            'id' => $createdUser->id,
            'deleted_at' => null
        ]);
    }
}
