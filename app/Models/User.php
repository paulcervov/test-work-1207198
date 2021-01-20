<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    const ID_ROLE_ADMINISTRATOR = 1;
    const ID_ROLE_EDITOR = 2;
    const ID_ROLE_AUTHOR = 3;

    const NAME_ROLE_ADMINISTRATOR = 'Administrator';
    const NAME_ROLE_EDITOR = 'Editor';
    const NAME_ROLE_AUTHOR = 'Author';

    const ROLES = [
        self::ID_ROLE_ADMINISTRATOR => self::NAME_ROLE_ADMINISTRATOR,
        self::ID_ROLE_EDITOR => self::NAME_ROLE_EDITOR,
        self::ID_ROLE_AUTHOR => self::NAME_ROLE_AUTHOR,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 5;

    /**
     * Get the posts for the user.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
