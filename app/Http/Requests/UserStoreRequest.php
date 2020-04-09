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
        //cek kalau usernya admin, maka harus auth check dulu
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
         switch($this->method()) {
            case 'POST':
            return [
                'nama' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W\_])[A-Za-z\d\W\_]/',
                'telepon' => 'required|digits_between:10,11|unique:users,telepon',
                //'pendidikan_terakhir' => 'required|in:pesantren,sd,smp,sma,s1,s2,s3', 
                //'nama_institusi_pendidikan_terakhir' => 'required',
                'pekerjaan' => 'required',
                //'domisili' => 'required',
                'status' => 'required|in:lajang,duda,menikah,janda',
                'tanggal_lahir' => 'required|date',
                'nomor_ktp' => 'required|digits:16|unique:users,nomor_ktp',
                'alasan_bergabung' => 'required',
                'profile_picture' => 'required|url',
                'jenis_kelamin' => 'required|in:P,W',
                'latitude_alamat' => 'required|numeric',  
                'longitude_alamat' => 'required|numeric'
             ];
             break;
            case ($this->method() =='PATCH' || $this->method() == 'PUT') :
                return [
                    'email' => 'email|unique:users,email',
                    'password' => 'min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W\_])[A-Za-z\d\W\_]/',
                    'telepon' => 'digits_between:10,11|unique:users,telepon',
                    'pendidikan_terakhir' => 'in:pesantren,sd,smp,sma,s1,s2,s3', 
                    'status' => 'in:lajang,duda,menikah,janda',
                    'tanggal_lahir' => 'date',
                    'nomor_ktp' => 'digits:16|unique:users,nomor_ktp',
                    'profile_picture' => 'url',
                    'jenis_kelamin' => 'in:P,W'
                ];
                break;

        }
    }
}
