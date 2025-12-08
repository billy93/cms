<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PdfTemplate;

class PdfTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete existing templates first
        PdfTemplate::truncate();

        // Default Invoice Template
        PdfTemplate::create([
            'name' => 'Default Invoice',
            'type' => 'invoice',
            'description' => 'Standard invoice template with ATI branding',
            'html_content' => '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{invoice_code}}</title>
    <style>
    <style>
        @page { size: A4; margin: 0; }
        .pdf-body { 
            margin: 0; 
            background: #525659; 
            display: flex; 
            justify-content: center; 
            padding: 20px; 
            min-height: 100vh; 
        }
        .pdf-page { 
            font-family: "Helvetica Neue", Helvetica, Arial, "Calibri", sans-serif; 
            font-size: 10pt; 
            line-height: 1.5; 
            color: #333333; 
            background: white; 
            width: 210mm; 
            min-height: 297mm; 
            padding: 20mm; 
            margin: 0 auto; 
            box-sizing: border-box; 
            box-shadow: 0 0 4px rgba(0,0,0,0.3); 
        }
        
        /* Layout Helpers */
        .w-100 { width: 100%; }
        .w-50 { width: 50%; }
        .valign-top { vertical-align: top; }
        .text-right { text-align: right; }
        
        /* Header */
        .header-table { width: 100%; margin-bottom: 40px; }
        .pdf-logo img { height: 50px; width: auto; }
        
        .pdf-address-block { text-align: right; }
        .pdf-address-text { font-size: 9pt; color: #333333; line-height: 1.4; font-weight: 300; }
        
        /* Invoice Title & Info */
        .title-table { width: 100%; margin-bottom: 30px; }
        .pdf-doc-title { font-size: 24pt; font-weight: 600; color: #4059C6; text-transform: uppercase; line-height: 1; letter-spacing: 1px; }
        .pdf-doc-number { font-size: 11pt; color: #666; margin-top: 5px; font-weight: 300; }
        
        .info-table { width: 100%; margin-bottom: 30px; border-collapse: separate; border-spacing: 0; }
        .pdf-info-label { font-size: 8pt; text-transform: uppercase; color: #888; margin-bottom: 3px; font-weight: 500; letter-spacing: 0.5px; }
        .pdf-info-value { font-size: 10pt; font-weight: 400; color: #333; margin-bottom: 10px; }
        .pdf-bill-to { background: #F4F4F4; padding: 15px; border-radius: 4px; }
        
        /* Table */
        .pdf-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .pdf-table th { background: #4059C6; color: white; text-align: left; padding: 12px 15px; font-size: 9pt; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; }
        .pdf-table td { padding: 12px 15px; border-bottom: 1px solid #E6E6E6; font-size: 10pt; font-weight: 300; }
        .pdf-table tr:last-child td { border-bottom: 2px solid #4059C6; }
        .pdf-text-right { text-align: right; }
        .pdf-text-center { text-align: center; }
        
        /* Totals */
        .totals-table-container { width: 100%; }
        .pdf-totals-table { width: 300px; border-collapse: collapse; margin-left: auto; }
        .pdf-totals-table td { padding: 8px 0; border-bottom: 1px solid #eee; }
        .pdf-totals-label { font-weight: 500; color: #666; font-size: 10pt; }
        .pdf-totals-value { text-align: right; font-weight: 500; color: #333; font-size: 10pt; }
        .pdf-grand-total { font-size: 14pt; color: #4059C6; border-bottom: none !important; padding-top: 15px !important; font-weight: 600; }
        
        /* Footer & Notes */
        .pdf-notes { margin-top: 40px; padding-top: 20px; border-top: 1px solid #E6E6E6; }
        .pdf-notes-title { font-size: 9pt; font-weight: 600; color: #4059C6; margin-bottom: 5px; }
        .pdf-notes-text { font-size: 9pt; color: #666; font-weight: 300; }
        
        .pdf-footer-bottom { position: absolute; bottom: 15mm; left: 0; right: 0; text-align: center; font-size: 8pt; color: #999; font-weight: 300; }
    </style>
</head>
<body class="pdf-body">
    <div class="pdf-page">
        <!-- Header -->
        <table class="header-table">
            <tr>
                <td class="valign-top">
                    <div class="pdf-logo">
                        <img src="{{logo_path}}" alt="ATI Logo">
                    </div>
                </td>
                <td class="valign-top text-right">
                    <div class="pdf-address-block">
                        <div class="pdf-address-text">
                            Batu Tulis Raya 13C<br>
                            Jakarta 10120<br>
                            Indonesia
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Title Section -->
        <table class="title-table">
            <tr>
                <td class="valign-top">
                    <div class="pdf-doc-title">INVOICE</div>
                    <div class="pdf-doc-number">#{{invoice_code}}</div>
                </td>
                <td class="valign-top text-right">
                    <div class="pdf-info-label">Date</div>
                    <div class="pdf-info-value">{{invoice_date}}</div>
                </td>
            </tr>
        </table>

        <!-- Info Grid -->
        <table class="info-table">
            <tr>
                <td class="valign-top w-50" style="padding-right: 20px;">
                    <div class="pdf-bill-to">
                        <div class="pdf-info-label">Bill To:</div>
                        <div class="pdf-info-value" style="font-size: 11pt; font-weight: 600;">{{customer_name}}</div>
                        <div class="pdf-info-value" style="font-weight: 300; font-size: 9pt;">{{bill_to}}</div>
                    </div>
                </td>
                <td class="valign-top w-50" style="padding-left: 20px;">
                    <div class="pdf-info-label">Due Date</div>
                    <div class="pdf-info-value">{{due_date}}</div>
                    
                    <div class="pdf-info-label" style="margin-top: 15px;">Payment Method</div>
                    <div class="pdf-info-value">{{payment_method}}</div>
                </td>
            </tr>
        </table>

        <!-- Items Table -->
        <table class="pdf-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="pdf-text-center" style="width: 80px;">Qty</th>
                    <th class="pdf-text-right" style="width: 120px;">Price</th>
                    <th class="pdf-text-right" style="width: 120px;">Total</th>
                </tr>
            </thead>
            <tbody>
                {{invoice_items}}
            </tbody>
        </table>

        <!-- Totals -->
        <div class="totals-table-container">
            <table class="pdf-totals-table">
                <tr>
                    <td class="pdf-totals-label">Subtotal</td>
                    <td class="pdf-totals-value">{{subtotal}}</td>
                </tr>
                <tr>
                    <td class="pdf-totals-label">Tax</td>
                    <td class="pdf-totals-value">{{tax_amount}}</td>
                </tr>
                <tr>
                    <td class="pdf-totals-label pdf-grand-total">Total</td>
                    <td class="pdf-totals-value pdf-grand-total">{{total_amount}}</td>
                </tr>
            </table>
        </div>

        <!-- Notes -->
        <div class="pdf-notes">
            <div class="pdf-notes-title">Notes / Payment Instructions</div>
            <div class="pdf-notes-text">{{notes}}</div>
        </div>
        
        <div class="pdf-footer-bottom">
            www.ati.co.id
        </div>
    </div>
</body>
</html>',
            'variables' => [
                ['name' => 'invoice_code', 'label' => 'Invoice Code'],
                ['name' => 'invoice_date', 'label' => 'Invoice Date'],
                ['name' => 'customer_name', 'label' => 'Customer Name'],
                ['name' => 'bill_to', 'label' => 'Billing Address'],
                ['name' => 'due_date', 'label' => 'Due Date'],
                ['name' => 'payment_method', 'label' => 'Payment Method'],
                ['name' => 'subtotal', 'label' => 'Subtotal'],
                ['name' => 'tax_amount', 'label' => 'Tax Amount'],
                ['name' => 'total_amount', 'label' => 'Total Amount'],
                ['name' => 'notes', 'label' => 'Notes'],
                ['name' => 'invoice_items', 'label' => 'Invoice Items (Table Rows)'],
            ],
            'is_active' => true,
        ]);

        // Default Proposal Template
        PdfTemplate::create([
            'name' => 'Default Proposal',
            'type' => 'proposal',
            'description' => 'Standard proposal template with ATI branding',
            'html_content' => '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal - {{proposal_code}}</title>
    <style>
        @page { size: A4; margin: 0; }
        .pdf-body { 
            margin: 0; 
            background: #525659; 
            display: flex; 
            justify-content: center; 
            padding: 20px; 
            min-height: 100vh; 
        }
        .pdf-page { 
            font-family: "Helvetica Neue", Helvetica, Arial, "Calibri", sans-serif; 
            font-size: 10pt; 
            line-height: 1.6; 
            color: #333333; 
            background: white; 
            width: 210mm; 
            min-height: 296mm; 
            padding: 20mm; 
            margin: 0 auto; 
            box-sizing: border-box; 
            box-shadow: 0 0 4px rgba(0,0,0,0.3); 
            overflow: hidden;
        }
        .pdf-page * { box-sizing: border-box; }
        
        /* Header */
        .pdf-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 50px; padding-bottom: 10px; }
        .pdf-logo img { height: 50px; width: auto; }
        
        .pdf-header-right { display: flex; align-items: stretch; }
        .pdf-address-block { text-align: right; padding-right: 15px; display: flex; flex-direction: column; align-items: flex-end; }
        .pdf-building-icon { width: 24px; height: 24px; margin-bottom: 5px; fill: #4059C6; }
        .pdf-address-text { font-size: 9pt; color: #333333; line-height: 1.4; font-weight: 300; }
        .pdf-vertical-line { width: 4px; background-color: #4059C6; border-radius: 2px; }
        
        /* Cover Content */
        .pdf-cover-content { text-align: center; margin-top: 60px; margin-bottom: 80px; }
        .pdf-proposal-label { font-size: 12pt; letter-spacing: 3px; color: #888; text-transform: uppercase; margin-bottom: 20px; font-weight: 300; }
        .pdf-project-title { font-size: 28pt; font-weight: 600; color: #4059C6; line-height: 1.2; margin-bottom: 10px; }
        .pdf-proposal-code { font-size: 12pt; color: #666; background: #F4F4F4; display: inline-block; padding: 5px 15px; border-radius: 20px; font-weight: 300; }
        
        /* Prepared For/By */
        .pdf-people-grid { display: flex; justify-content: space-between; margin-top: 60px; padding: 0 40px; }
        .pdf-person-col { text-align: center; }
        .pdf-person-label { font-size: 9pt; text-transform: uppercase; color: #888; margin-bottom: 10px; letter-spacing: 1px; font-weight: 500; }
        .pdf-person-name { font-size: 12pt; font-weight: 600; color: #333; margin-bottom: 5px; }
        .pdf-person-detail { font-size: 10pt; color: #666; font-weight: 300; }
        
        /* Sections */
        .pdf-section { margin-bottom: 40px; page-break-inside: avoid; }
        .pdf-section-title { font-size: 14pt; font-weight: 600; color: #4059C6; border-bottom: 2px solid #E6E6E6; padding-bottom: 10px; margin-bottom: 20px; }
        .pdf-section-content { color: #333; text-align: justify; font-weight: 300; }
        
        /* Pricing */
        .pdf-pricing-box { background: #F9F9F9; border-left: 4px solid #4059C6; padding: 20px; margin-top: 20px; }
        .pdf-total-label { font-size: 10pt; text-transform: uppercase; color: #666; font-weight: 500; }
        .pdf-total-amount { font-size: 24pt; font-weight: 600; color: #4059C6; margin-top: 5px; }
        
        /* Footer */
        .pdf-footer-bottom { position: absolute; bottom: 15mm; left: 0; right: 0; text-align: center; font-size: 8pt; color: #999; font-weight: 300; }
    </style>
</head>
<body class="pdf-body">
    <div class="pdf-page">
        <!-- Header -->
        <div class="pdf-header">
            <div class="pdf-logo">
                <img src="/build/img/ati-logo.png" alt="ATI Logo">
            </div>
            <div class="pdf-header-right">
                <div class="pdf-address-block">
                    <!-- Building Icon SVG -->
                    <svg class="pdf-building-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/>
                        <path d="M7 7h2v2H7zm0 4h2v2H7zm0 4h2v2H7zm4-8h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm4-8h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2z"/>
                    </svg>
                    <div class="pdf-address-text">
                        Batu Tulis Raya 13C<br>
                        Jakarta 10120<br>
                        Indonesia
                    </div>
                </div>
                <div class="pdf-vertical-line"></div>
            </div>
        </div>

        <!-- Cover Page Content -->
        <div class="pdf-cover-content">
            <div class="pdf-proposal-label">PROPOSAL FOR</div>
            <div class="pdf-project-title">{{project_name}}</div>
            <div class="pdf-proposal-code">{{proposal_code}}</div>
        </div>

        <div class="pdf-people-grid">
            <div class="pdf-person-col">
                <div class="pdf-person-label">Prepared For</div>
                <div class="pdf-person-name">{{customer_name}}</div>
                <div class="pdf-person-detail">{{proposal_date}}</div>
            </div>
            <div class="pdf-person-col">
                <div class="pdf-person-label">Valid Until</div>
                <div class="pdf-person-name">{{valid_until}}</div>
                <div class="pdf-person-detail">Sales Code: {{sales_code}}</div>
            </div>
        </div>
        
        <div style="margin-top: 60px;">
            <div class="pdf-section">
                <div class="pdf-section-title">Executive Summary</div>
                <div class="pdf-section-content">
                    <p>{{description}}</p>
                </div>
            </div>
            
            <div class="pdf-section">
                <div class="pdf-section-title">Scope of Work</div>
                <div class="pdf-section-content">
                    <p>{{scope_of_work}}</p>
                </div>
            </div>
            
            <div class="pdf-section">
                <div class="pdf-section-title">Investment</div>
                <div class="pdf-pricing-box">
                    <div class="pdf-total-label">Total Project Investment</div>
                    <div class="pdf-total-amount">{{total_amount}}</div>
                </div>
            </div>
            
            <div class="pdf-section">
                <div class="pdf-section-title">Terms & Conditions</div>
                <div class="pdf-section-content">
                    <p>{{terms_and_conditions}}</p>
                </div>
            </div>
        </div>

        <div class="pdf-footer-bottom">
            www.ati.co.id
        </div>
    </div>
</body>
</html>',
            'variables' => [
                ['name' => 'proposal_code', 'label' => 'Proposal Code'],
                ['name' => 'project_name', 'label' => 'Project Name'],
                ['name' => 'customer_name', 'label' => 'Customer Name'],
                ['name' => 'proposal_date', 'label' => 'Proposal Date'],
                ['name' => 'valid_until', 'label' => 'Valid Until Date'],
                ['name' => 'sales_code', 'label' => 'Sales Code'],
                ['name' => 'description', 'label' => 'Description'],
                ['name' => 'scope_of_work', 'label' => 'Scope of Work'],
                ['name' => 'terms_and_conditions', 'label' => 'Terms & Conditions'],
                ['name' => 'total_amount', 'label' => 'Total Amount'],
            ],
            'is_active' => true,
        ]); 
    }
}
