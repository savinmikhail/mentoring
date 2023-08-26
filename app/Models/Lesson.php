<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class Lesson extends Model
{
    use HasFactory;
    use AsSource;
    use Chartable;

    protected $fillable =
        [
            'title',
            'text',
            'image',
            'code',
            'module_id',
        ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
