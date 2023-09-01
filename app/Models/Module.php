<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;

class Module extends Model
{
    use HasFactory;
    use AsSource;
    use Chartable;

    protected $table = 'modules';
    protected $fillable =
        [
          'title',
          'description'
        ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
