<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OrderStoreRequest extends FormRequest
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
         switch($this->method()) {
            case 'POST':
            return [
                'client_id' => 'required|exists:users,id',
                'server_id' => 'required|exists:ustadzs,id',
                'paket_id' => 'required|exists:pakets,id',
                'topic_id' => 'required|exists:topics,id',
             ];
             break;

        }
    }
}
