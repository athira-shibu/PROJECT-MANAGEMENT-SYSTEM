<?php
declare(strict_types=1);

namespace App\Http\Requests\Task;

use App\Constants\Task\TaskTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class TaskUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'status' => ['string', 'nullable', Rule::in(TaskTypeEnum::values())],
            'remarks' => 'string|nullable'
        ];
    }
}
