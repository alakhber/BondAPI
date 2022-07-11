<?php

namespace App\Http\Requests;

use App\Models\Bond;
use Illuminate\Foundation\Http\FormRequest;

class PurchaseOrderStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'bond_id' => request()->id,
        ]);
    }

    public function rules()
    {
        return [
            'bond_id' => ['required', 'integer', 'exists:bonds,id'],
            'order_date' => ['required', 'date_format:Y-m-d', 'after_or_equal:' . Bond::find($this->bond_id)->emission_date, 'before_or_equal:' . Bond::find($this->bond_id)->turnover_end_date],
            'bond_received' => ['required', 'integer']
        ];
    }
}
