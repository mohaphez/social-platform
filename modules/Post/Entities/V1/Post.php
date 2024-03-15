<?php

declare(strict_types=1);

namespace Modules\Post\Entities\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Entities\V1\BaseModel;
use Modules\Comment\Entities\V1\Concerns\HasComment;
use Modules\Post\Database\Factories\V1\PostFactory;
use Modules\Support\Enums\V1\LanguageList\LanguageList;
use Modules\Support\Enums\V1\Status\Status;
use Modules\User\Entities\V1\User;

class Post extends BaseModel
{
    use HasComment;
    use HasFactory;
    use SoftDeletes;

    protected static function newFactory()
    {
        return PostFactory::new();
    }

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function ($model): void {
            $model->user_id = $model->user_id ?? auth()->id();
        });
    }

    protected $fillable = [
        'slug',
        'language',
        'user_id',
        'title',
        'cover_url',
        'content',
        'description',
        'cache_ttl',
        'status',
        'published_at',
    ];

    protected $casts = [
        'status'       => Status::class,
        'language'     => LanguageList::class,
        'published_at' => 'datetime'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
