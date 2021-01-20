<?php declare(strict_types=1);

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'alpha_dash', 'max:255', 'unique:posts'],
            'text' => ['required', 'string', 'max:16000'],
            'categories' => ['array'],
            'categories.*' => ['exists:categories,id'],
        ];
    }
}
