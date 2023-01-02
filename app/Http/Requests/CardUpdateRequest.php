<?php

namespace App\Http\Requests;

use App\Models\Link;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CardUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    // TODO: Implement validation
    public function rules()
    {
        return [
            'name' => ['string', 'max:255'],
            'title' => ['string', 'max:255'],
            'url' => ['active_url'],
        ];
    }
}
