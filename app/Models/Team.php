<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Team extends Model
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'name',
        'coach',
        'phone',
        'logo',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($team) {
            if ($team->logo) {
                Storage::disk('public')->delete($team->logo);
            }
        });
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }
}
