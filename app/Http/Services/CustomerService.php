<?php

namespace App\Http\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Exception;

class CustomerService
{
    public function createCustomer(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['code'] = Customer::generateCode();
            $customer = Customer::create($data);
            return $customer->fresh(['projects']);
        });
    }

    public function getAllCustomers()
    {
        return Customer::with('projects')->get();
    }

    public function getCustomerById($id)
    {
        $customer = Customer::with('projects')->find($id);
        if (!$customer) {
            throw new Exception("Customer with ID {$id} not found");
        }
        return $customer;
    }

    public function updateCustomer($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $customer = Customer::find($id);
            if (!$customer) {
                throw new Exception("Customer with ID {$id} not found");
            }

            $customer->update($data);
            return $customer->fresh(['projects']);
        });
    }

    public function deleteCustomer($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            throw new Exception("Customer with ID {$id} not found");
        }
        $customer->delete();
    }
}
