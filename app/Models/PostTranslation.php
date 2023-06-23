<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostTranslation extends Model
{
    use HasFactory;
    protected $table = "post_translations";
    protected $guarded = false;
    public $timestamps = false;

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
