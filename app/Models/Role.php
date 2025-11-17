<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public static function generateSlug(string $name, string $table, string $column = 'slug'): string
    {
        // slug dasar lowercase
        $slug = Str::slug(strtolower($name));
        $originalSlug = $slug;

        // ambil semua slug mirip dari DB
        $allSimilar = DB::table($table)
            ->where($column, 'like', $originalSlug . '%')
            ->pluck($column)
            ->toArray();

        // kalau slug belum ada, langsung return
        if (!in_array($slug, $allSimilar)) {
            return $slug;
        }

        // cari angka suffix terbesar
        $max = 0;
        foreach ($allSimilar as $s) {
            if (preg_match('/^' . preg_quote($originalSlug, '/') . '-(\d+)$/', $s, $matches)) {
                $num = (int)$matches[1];
                if ($num > $max) {
                    $max = $num;
                }
            }
        }

        // return slug dengan increment +1
        return $originalSlug . '-' . ($max + 1);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }
    
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'role_menu', 'role_id', 'menu_id')
                    ->withTimestamps();
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
