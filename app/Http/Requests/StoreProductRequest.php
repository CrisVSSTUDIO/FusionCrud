<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check(); 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'required|max:255|unique:assets',
            'description' => 'required',
            'upload' => 'required|file|mimetypes:image/jpeg,image/png,image/gif,image/svg+xml,gltf,application/vnd.rar,image/webp,image/avif,application/pdf,model/gltf-binary,application/octet-stream,application/x-zip-compressed,text/csv,application/wavefront-obj',
            'category' => 'required',
        ];
    }
}
