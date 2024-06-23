<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;


class Magang extends Model
{
    use HasFactory, Notifiable, HasRoles;
    protected $table = "magang";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public function getId()
    {
        return $this->user_id;
    }
    protected $fillable = [
        'nama',
        'universitas',
        'npm',
        'jurusan',
        'status',
        'mulai_magang',
        'selesai_magang',
        'user_id',
        'sertifikat'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
}
