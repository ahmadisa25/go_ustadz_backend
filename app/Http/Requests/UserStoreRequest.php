<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
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
            'email' => 'required|email',
            'password' => 'required|min:8|regex:^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W\_])[A-Za-z\d\W\_]$',
            'telepon' => 'required|numeric|max:11|',
            'pendidikan_terakhir' => 'required|in:pesantren, sd, smp, sma, s1, s2, s3', 
            'pekerjaan' => 'required',
            'domisili' => 'required',
            'status' => 'required|in: lajang, duda, menikah, janda',
            'tanggal_lahir' => 'required|date',
            'nomor_ktp' => 'required|unique:nomor_ktp',
            'alasan_bergabung' => 'required',
            'profile_picture' => 'required|url',
            'jenis_kelamin' => 'required|in: P, W'
        ];
    }
}
