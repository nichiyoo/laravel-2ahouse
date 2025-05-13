<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return Auth::user()->landlord !== null;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'name' => ['required', 'string', 'max:255'],
      'address' => ['required', 'string', 'max:255'],
      'city' => ['required', 'string', 'max:100'],
      'region' => ['required', 'string', 'max:100'],
      'zipcode' => ['required', 'string', 'max:20'],
      'description' => ['required', 'string'],
      'latitude' => ['required', 'numeric'],
      'longitude' => ['required', 'numeric'],
      'image' => ['nullable', 'image', 'max:2048'],
    ];
  }
}
