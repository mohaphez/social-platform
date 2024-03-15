<?php

declare(strict_types=1);

namespace Modules\Post\Http\Requests\V1\API;

use Illuminate\Validation\Rule;
use Modules\Base\Http\Requests\V1\API\BaseAPIRequest;
use Modules\Post\Data\V1\PostData;
use Modules\Support\Enums\V1\LanguageList\LanguageList;
use Modules\Support\Enums\V1\Status\Status;
use Spatie\LaravelData\WithData;

class PostUpsertRequest extends BaseAPIRequest
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
            'title'        => ['required', 'string', 'max:255', 'min:3'],
            'slug'         => ['sometimes', 'string', 'max:255', 'min:8'],
            'published_at' => ['sometimes', 'string'],
            'language'     => ['required', Rule::enum(LanguageList::class)],
            'status'       => ['required', Rule::enum(Status::class)],
            'content'      => ['required','max:2000']
        ];
    }

    protected function dataClass(): string
    {
        return PostData::class;
    }
}
