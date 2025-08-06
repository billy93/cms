<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends ApiFormRequest
{
    public function validationData()
    {
        return array_merge($this->all(), [
            'id' => $this->route('invoice'),
        ]);
    }

    public function rules()
    {
        $action = $this->route()->getName();

        switch ($action) {
            case 'api.invoices.store':
            case 'invoices.store':
                return $this->createRules();
            case 'api.invoices.update':
            case 'invoices.update':
                return $this->updateRules();
            default:
                return [];
        }
    }

    protected function createRules()
    {
        return [
            'client_id' => 'sometimes|integer',
            'bill_to' => 'required|string|max:255',
            'ship_to' => 'required|string|max:255',
            'project_id' => 'sometimes|integer',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|string|max:10',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'payment_method' => 'sometimes|string|max:255',
            'status' => 'sometimes|string|max:50',
            'description' => 'required|string',
            'signature_name' => 'sometimes|string|max:255',
            'signature_image' => 'sometimes|string|max:255',
            'notes' => 'sometimes|string',
            'terms_and_conditions' => 'sometimes|string',
            'subtotal' => 'sometimes|numeric|min:0',
            'discount' => 'sometimes|numeric|min:0|max:100',
            'extra_discount' => 'sometimes|numeric|min:0|max:100',
            'tax' => 'sometimes|numeric|min:0',
            'total' => 'sometimes|numeric|min:0',
        ];
    }

    protected function updateRules()
    {
        return array_merge([
            'id' => 'required|exists:invoice,id',
        ], $this->createRules());
    }

    public function messages()
    {
        return [
            'id.required' => 'The invoice ID is required.',
            'id.exists' => 'The specified invoice does not exist.',

            'client_id.integer' => 'The client ID must be an integer.',

            'bill_to.required' => 'The "Bill to" is required.',
            'bill_to.string' => 'The "Bill to" must be a string.',
            'bill_to.max' => 'The "Bill to" may not be greater than :max characters.',

            'ship_to.required' => 'The "Ship to" is required.',
            'ship_to.string' => 'The "Ship to" must be a string.',
            'ship_to.max' => 'The "Ship to" may not be greater than :max characters.',
            
            'project_id.integer' => 'The project ID must be an integer.',

            'amount.required' => 'The amount is required.',
            'amount.numeric' => 'The amount must be a number.',
            'amount.min' => 'The amount must be at least :min.',

            'currency.required' => 'The currency is required.',
            'currency.string' => 'The currency must be a string.',
            'currency.max' => 'The currency may not be greater than :max characters.',

            'invoice_date.required' => 'The invoice date is required.',
            'invoice_date.date' => 'The invoice date must be a valid date.',
            
            'due_date.required' => 'The due date is required.',
            'due_date.after_or_equal' => 'The due date must be after or equal to the invoice date.',

            'payment_method.string' => 'The payment method must be a string.',
            'payment_method.max' => 'The payment method may not be greater than :max characters.',

            'status.string' => 'The status must be a string.',
            'status.max' => 'The status may not be greater than :max characters.',

            'description.required' => 'The description is required.',
            'description.string' => 'The description must be a string.',

            'signature_name.string' => 'The signature name must be a string.',
            'signature_name.max' => 'The signature name may not be greater than :max characters.',

            'signature_image.string' => 'The signature image must be a string.',
            'signature_image.max' => 'The signature image may not be greater than :max characters.',

            'notes.string' => 'The notes must be a string.',

            'terms_and_conditions.string' => 'The terms and conditions must be a string.',

            'subtotal.numeric' => 'The subtotal must be a number.',
            'subtotal.min' => 'The subtotal must be at least :min.',

            'discount.min' => 'The discount must be at least :min%.',
            'discount.max' => 'The discount may not be greater than :max%.',

            'extra_discount.min' => 'The extra discount must be at least :min%.',
            'extra_discount.max' => 'The extra discount may not be greater than :max%.',

            'tax.numeric' => 'The tax must be a number.',
            'tax.min' => 'The tax must be at least :min.',

            'total.numeric' => 'The total must be a number.',
            'total.min' => 'The total must be at least :min.',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
