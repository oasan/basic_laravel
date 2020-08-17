<?php

namespace App\Http\Requests;

use App\Models\Slug;
use Illuminate\Foundation\Http\FormRequest;

class PostUpdate extends FormRequest
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
            'name' => 'required',
            'slug' => 'required|unique:slugs,slug,' . $this->post->slug->id
        ];
    }

    protected function prepareForValidation() {
        $this->merge([
            'slug' => Slug::str_slug($this->slug)
        ]);
    }
}
