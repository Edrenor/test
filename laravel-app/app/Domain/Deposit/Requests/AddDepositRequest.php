<?php

namespace App\Domain\Deposit\Requests;

use App\Domain\Auth\Models\User;
use App\Domain\Deposit\Models\Deposit;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddDepositRequest extends FormRequest
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
        $userId    = Auth::user()->getAuthIdentifier();
        $balance  = User::find($userId)->wallet->balance;

        return [
            'deposit' => 'lte:' . $balance,
        ];
    }
}
