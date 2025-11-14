<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Chirp extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'message',
        'image',
    ];

    // /**
    //  * The attributes that should be hidden for serialization.
    //  *
    //  * @var list<string>
    //  */
    // protected $hidden = [
    //     'user_id',
    // ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    protected $appends = ['time_diff'];

    public function getTimeDiffAttribute()
    {
        $minutes = Carbon::parse($this->created_at)->diffInMinutes(now());
        if ($minutes > 1440) {
            return round($minutes / 1440, 0).'d';
        } elseif ($minutes > 60) {
            return round($minutes / 60, 0).'h';
        }

        return round($minutes, 0).'m';
    }
}
