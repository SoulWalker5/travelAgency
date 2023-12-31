<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, HasUuids;

    public const ADMIN = 'admin';
    public const EDITOR = 'editor';

    public static array $roles = [
        self::ADMIN,
        self::EDITOR,
    ];

    protected $fillable = ['name'];
}
