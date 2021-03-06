<?php

namespace App\Http\Requests;

use App\Enum\ActivityTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Enum\Laravel\Rules\EnumRule;

class ActivityStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'group_id' => ['required', 'integer', 'exists:groups,id'],
            'activity_type' => ['required', new EnumRule(ActivityTypeEnum::class)],
            'kilometers' => ['required', 'numeric', 'between:-99999999.99,99999999.99'],
        ];
    }
}
