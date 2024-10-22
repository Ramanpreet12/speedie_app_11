<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RestaurantRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'speciality' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'delivery_radius' => 'required|numeric|min:0',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'phone' => 'required|string|max:20',
            'secondary_phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:restaurants,email',
            'website' => 'nullable|url',
            'owner_name' => 'required|string|max:255',
            'owner_contact_number' => 'required|string|max:20',
            'owner_email' => 'required|email|unique:restaurants,owner_email',
            'opening_time' => 'required|string',
            'closing_time' => 'required|string',
            'days_of_operation' => 'required|string',
            'restraunt_images' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'featured_img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tax_gst_number' => 'nullable|string|max:50',
            'business_license' => 'nullable|string|max:50',
        ];
    }

    public function messages()
    {
        return [
            'logo.required' => 'Restaurant logo is required',
            'logo.image' => 'Logo must be an image file',
            'logo.mimes' => 'Logo must be a jpeg, png, or jpg file',
            'restraunt_images.required' => 'Restaurant images are required',
            'restraunt_images.image' => 'Restaurant images must be image files',
            'featured_img.required' => 'Featured image is required',
            'featured_img.image' => 'Featured image must be an image file',
            'delivery_radius.numeric' => 'Delivery radius must be a number',
            'latitude.between' => 'Latitude must be between -90 and 90',
            'longitude.between' => 'Longitude must be between -180 and 180',
            'email.unique' => 'This email is already registered with another restaurant',
            'owner_email.unique' => 'This owner email is already registered with another restaurant',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            throw new HttpResponseException(response()->json([
                'status' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422));
        }

        parent::failedValidation($validator);
    }
}