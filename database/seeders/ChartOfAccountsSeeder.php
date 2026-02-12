<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChartOfAccountsSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            // 1) Insert Categories
            $categories = [
                ['category_code' => 'PE',  'category_name' => 'Personal Expense',     'category_type' => 'Expense', 'is_active' => true],
                ['category_code' => 'OE',  'category_name' => 'Office Expense',       'category_type' => 'Expense', 'is_active' => true],
                ['category_code' => 'ME',  'category_name' => 'Marketing Expense',    'category_type' => 'Expense', 'is_active' => true],
                ['category_code' => 'FE',  'category_name' => 'Financial Expense',    'category_type' => 'Expense', 'is_active' => true],
                ['category_code' => 'OIE', 'category_name' => 'Other Income/Expense', 'category_type' => 'Other',   'is_active' => true],
            ];

            // Upsert for safe re-run
            DB::table('account_categories')->upsert(
                $categories,
                ['category_code'],
                ['category_name', 'category_type', 'is_active', 'updated_at']
            );

            // Fetch category ids by code
            $categoryIdByCode = DB::table('account_categories')
                ->select('id', 'category_code')
                ->get()
                ->pluck('id', 'category_code')
                ->toArray();

            // 2) Insert Accounts
            $accounts = [
                // Personal Expense (PE)
                ['account_code' => 'PE-001', 'account_name' => 'BPJS Kesehatan',              'category_id' => $categoryIdByCode['PE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'PE-002', 'account_name' => 'BPJS Tenaga Kerja',          'category_id' => $categoryIdByCode['PE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'PE-003', 'account_name' => 'Health Insurance',           'category_id' => $categoryIdByCode['PE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'PE-004', 'account_name' => 'Honorarium',                 'category_id' => $categoryIdByCode['PE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'PE-005', 'account_name' => 'HR Development',             'category_id' => $categoryIdByCode['PE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'PE-006', 'account_name' => 'Incentive and Bonus',        'category_id' => $categoryIdByCode['PE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'PE-007', 'account_name' => 'Meals Allowance',            'category_id' => $categoryIdByCode['PE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'PE-008', 'account_name' => 'Medical Allowance',          'category_id' => $categoryIdByCode['PE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'PE-009', 'account_name' => 'Overtime',                   'category_id' => $categoryIdByCode['PE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'PE-010', 'account_name' => 'Salary and THR',             'category_id' => $categoryIdByCode['PE'],  'normal_balance' => 'DEBIT',  'is_active' => true],

                // Office Expense (OE)
                ['account_code' => 'OE-001', 'account_name' => 'Building Management',        'category_id' => $categoryIdByCode['OE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'OE-002', 'account_name' => 'Car Insurance',              'category_id' => $categoryIdByCode['OE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'OE-003', 'account_name' => 'Cleaning Service',           'category_id' => $categoryIdByCode['OE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'OE-004', 'account_name' => 'Computer Supplies',          'category_id' => $categoryIdByCode['OE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'OE-005', 'account_name' => 'Groceries and Household Misc','category_id' => $categoryIdByCode['OE'], 'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'OE-006', 'account_name' => 'Internet and emails',        'category_id' => $categoryIdByCode['OE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'OE-007', 'account_name' => 'License',                    'category_id' => $categoryIdByCode['OE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'OE-008', 'account_name' => 'Maintenance',                'category_id' => $categoryIdByCode['OE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'OE-009', 'account_name' => 'Office Rent',                'category_id' => $categoryIdByCode['OE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'OE-010', 'account_name' => 'Photocopy',                  'category_id' => $categoryIdByCode['OE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'OE-011', 'account_name' => 'Post and Stamps',            'category_id' => $categoryIdByCode['OE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'OE-012', 'account_name' => 'Stationary',                 'category_id' => $categoryIdByCode['OE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'OE-013', 'account_name' => 'Subscription',               'category_id' => $categoryIdByCode['OE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'OE-014', 'account_name' => 'Telephone',                  'category_id' => $categoryIdByCode['OE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'OE-015', 'account_name' => 'Transportation',             'category_id' => $categoryIdByCode['OE'],  'normal_balance' => 'DEBIT',  'is_active' => true],

                // Marketing Expense (ME)
                ['account_code' => 'ME-001', 'account_name' => 'Donation',                   'category_id' => $categoryIdByCode['ME'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'ME-002', 'account_name' => 'Entertainment',              'category_id' => $categoryIdByCode['ME'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'ME-003', 'account_name' => 'Notarial Fee',               'category_id' => $categoryIdByCode['ME'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'ME-004', 'account_name' => 'Research,Training & Prod Dev','category_id' => $categoryIdByCode['ME'], 'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'ME-005', 'account_name' => 'Sales and Promotion',        'category_id' => $categoryIdByCode['ME'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'ME-006', 'account_name' => 'Sales Trip',                 'category_id' => $categoryIdByCode['ME'],  'normal_balance' => 'DEBIT',  'is_active' => true],

                // Financial Expense (FE)
                ['account_code' => 'FE-001', 'account_name' => 'Bank Charge',                'category_id' => $categoryIdByCode['FE'],  'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'FE-002', 'account_name' => 'Interest Loan',              'category_id' => $categoryIdByCode['FE'],  'normal_balance' => 'DEBIT',  'is_active' => true],

                // Other Income/Expense (OIE)
                ['account_code' => 'OIE-001','account_name' => 'Forex Gain (Loss)',          'category_id' => $categoryIdByCode['OIE'], 'normal_balance' => 'CREDIT', 'is_active' => true],
                ['account_code' => 'OIE-002','account_name' => 'Interest Income',            'category_id' => $categoryIdByCode['OIE'], 'normal_balance' => 'CREDIT', 'is_active' => true],
                ['account_code' => 'OIE-003','account_name' => 'Other Expense',              'category_id' => $categoryIdByCode['OIE'], 'normal_balance' => 'DEBIT',  'is_active' => true],
                ['account_code' => 'OIE-004','account_name' => 'Other Income',               'category_id' => $categoryIdByCode['OIE'], 'normal_balance' => 'CREDIT', 'is_active' => true],
            ];

            DB::table('accounts')->upsert(
                $accounts,
                ['account_code'],
                ['account_name', 'category_id', 'normal_balance', 'is_active', 'updated_at']
            );
        });
    }
}
