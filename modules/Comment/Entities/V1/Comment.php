<?php

declare(strict_types=1);

namespace Modules\Comment\Entities\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Entities\V1\BaseModel;
use Modules\Comment\Database\Factories\V1\CommentFactory;
use Modules\Support\Enums\V1\LanguageList\LanguageList;
use Modules\Support\Enums\V1\Status\Status;
use Modules\User\Entities\V1\User;

class Comment extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected static function newFactory()
    {
        return CommentFactory::new();
    }

    protected $fillable = [
        'body',
        'user_id',
        'commentable_id',
        'commentable_type'
    ];

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
