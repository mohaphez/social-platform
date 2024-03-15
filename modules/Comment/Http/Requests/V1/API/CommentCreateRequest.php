<?php

declare(strict_types=1);

namespace Modules\Comment\Http\Requests\V1\API;

use Modules\Base\Http\Requests\V1\API\BaseAPIRequest;
use Modules\Comment\Data\V1\CommentData;
use Spatie\LaravelData\WithData;

class CommentCreateRequest extends BaseAPIRequest
{
    use WithData;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'body' => ['required','max:2000']
        ];
    }

    protected function dataClass(): string
    {
        return CommentData::class;
    }
}
