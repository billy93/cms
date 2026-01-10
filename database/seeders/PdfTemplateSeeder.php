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
        @page { size: A4; margin: 0; }
        .pdf-header {
            padding-top: 15mm;
            margin-bottom: 10mm;

            /* SAFE PADDING (the REAL margins) */
        }
        .pdf-header-wrapper {
            width: 210mm;  
            display: flex;
            justify-content: space-between;
            padding: 0 17mm 0 13mm;
        }
        .pdf-body { 
            padding-block: 15mm;
            margin: 0 auto;
            background: #525659; 
            display: flex; 
            justify-content: center; 
            padding: 20px; 
            min-height: 100vh; 
        }
        .pdf-body * {
            box-sizing: border-box; 
        }
        .pdf-page-wrapper { 
            width: 210mm;  
            margin: 0;
            padding: 0 17mm 20mm 13mm;
        }
        .pdf-page { 
            width: fit-content;
            font-family: Arial, "Calibri", sans-serif; 
            font-size: 10pt; 
            line-height: 1.5; 
            color: #333333; 
            background: white; 
            margin: 15mm auto 20mm;

            /* SAFE PADDING (the REAL margins) */
            border-radius: 8px;
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
        
        .pdf-header-right { display: flex; align-items: stretch; }
        .pdf-address-block { text-align: right; padding-right: 15px; display: flex; flex-direction: column; align-items: flex-end; }
        .pdf-building-icon { width: 24px; height: 24px; margin-bottom: 5px; fill: #4059C6; }
        .pdf-address-text { font-size: 9pt; color: #333333; line-height: 1.4; font-weight: 300; }
        .pdf-vertical-line { width: 4px; background-color: #4059C6; border-radius: 2px; }
        
        /* Invoice Title & Info */
        .title-table { width: 100%; margin-bottom: 30px; }
        .pdf-doc-title { font-size: 14pt; font-weight: 600; color: #4059C6; text-transform: uppercase; line-height: 1; letter-spacing: 1px; }
        .pdf-doc-number { font-size: 11pt; color: #666; margin-top: 5px; font-weight: 300; }
        
        .info-table { width: 100%; margin-bottom: 30px; border-collapse: separate; border-spacing: 0; }
        .pdf-info-label { font-size: 8pt; text-transform: uppercase; color: #888; margin-bottom: 3px; font-weight: 500; letter-spacing: 0.5px; }
        .pdf-info-value { font-size: 10pt; font-weight: 400; color: #333; margin-bottom: 10px; }
        .pdf-bill-to { background: #F4F4F4; padding: 15px; border-radius: 4px; }
        
        /* Table */
        .pdf-table { width: 100%; border-collapse: collapse; }
        .pdf-table thead { display: table-header-group; }
        .pdf-table tr { page-break-inside: avoid; }
        @media print {
            .pdf-table thead { display: table-header-group; }
            .pdf-table tfoot { display: table-footer-group; }
        }
        .pdf-table th { background: #4059C6; color: white; text-align: left; padding: 8px 10px; font-size: 10pt; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
        .pdf-table td { padding: 10px 10px; border-bottom: 1px solid #E6E6E6; font-size: 10pt; font-weight: 300; vertical-align: top; }
        .pdf-table tr { page-break-inside: avoid; }
        /* Last row of tbody (item list) gets blue border */
        .pdf-table tbody:not(.no-break) tr:last-child td { border-bottom: 2px solid #4059C6; }

        .pdf-text-right { text-align: right !important; }
        .pdf-text-center { text-align: center; }
        .pdf-text-left { text-align: left !important; }
        
        /* Utility Classes for Controller Usage */
        .boq-code-row { background-color: #f9f9f9; }
        .boq-code-text { font-weight: bold; color: #4059C6; }
        .boq-header { background-color: #f0f0f0; font-weight: bold; }
        .boq-subheader { background-color: #fafafa; }
        .indent-20 { padding-left: 20px; }
        .nowrap { white-space: nowrap; }
        .pr-80 { padding-right: 80px; }

        /* Totals */
        .pdf-totals-label { font-weight: 500; color: #333; font-size: 10pt; font-weight: medium !important; }
        .pdf-totals-value { text-align: right; font-weight: medium !important; color: #333; font-size: 10pt; }
        .pdf-grand-total { font-size: 14pt; color: #4059C6; border-bottom: none !important; font-weight: bold !important; padding-top: 15px !important; }
        
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
        <div class="pdf-header">
            <div class="pdf-header-wrapper">
                <div class="pdf-logo">
                    <img src="{{logo_path}}" alt="Logo" style="max-height: 50px; width: auto;">
                </div>
                <div class="pdf-header-right">
                    <div class="pdf-address-block">
                        <!-- Building Icon SVG -->
                        <svg class="pdf-building-icon" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/>
                            <path d="M7 7h2v2H7zm0 4h2v2H7zm0 4h2v2H7zm4-8h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm4-8h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2z"/>
                        </svg>
                        <div class="pdf-address-text">
                            123 Business Street<br>
                            City 12345<br>
                            Country
                        </div>
                    </div>
                    <div class="pdf-vertical-line"></div>
                </div>
            </div>
        </div>
        <div class="pdf-page-wrapper">
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
                        <th class="pdf-text-center" style="width: 30px;">NO</th>
                        <th>DESCRIPTION</th>
                        <th class="pdf-text-center" style="width: 60px;">QTY</th>
                        <th class="pdf-text-center" style="width: 60px;">FREQ</th>
                        <th class="pdf-text-right" style="width: 100px;">UNIT PRICE</th>
                        <th class="pdf-text-right" style="width: 100px;">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    {{invoice_items}}
                </tbody>
                <tfoot>
                    {{totals_rows}}
                </tfoot>
            </table>
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
                ['name' => 'totals_rows', 'label' => 'Totals Section Rows'],
                ['name' => 'notes', 'label' => 'Notes'],
                ['name' => 'invoice_items', 'label' => 'Invoice Items (Table Rows)'],
                ['name' => 'logo_path', 'label' => 'Logo Path'],
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
        .pdf-header {
            padding-top: 15mm;
            margin-bottom: 10mm;

            /* SAFE PADDING (the REAL margins) */
        }
        .pdf-header-wrapper {
            width: 210mm;  
            display: flex;
            justify-content: space-between;
            padding: 0 17mm 0 13mm;
        }
        .pdf-body { 
            padding-block: 15mm;
            margin: 0 auto;
            background: #525659; 
            display: flex; 
            justify-content: center; 
            padding: 20px; 
            min-height: 100vh; 
        }
        .pdf-body * {
            box-sizing: border-box; 
        }
        .pdf-page-wrapper { 
            width: 210mm;  
            margin: 0;
            padding: 0 17mm 20mm 13mm;
        }
        .pdf-page { 
            width: fit-content;
            font-family: Arial, "Calibri", sans-serif; 
            font-size: 10pt; 
            line-height: 1.5; 
            color: #333333; 
            background: white; 
            margin: 15mm auto 20mm;

            /* SAFE PADDING (the REAL margins) */
            border-radius: 8px;
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
        
        .pdf-header-right { display: flex; align-items: stretch; }
        .pdf-address-block { text-align: right; padding-right: 15px; display: flex; flex-direction: column; align-items: flex-end; }
        .pdf-building-icon { width: 24px; height: 24px; margin-bottom: 5px; fill: #4059C6; }
        .pdf-address-text { font-size: 9pt; color: #333333; line-height: 1.4; font-weight: 300; }
        .pdf-vertical-line { width: 4px; background-color: #4059C6; border-radius: 2px; }
        
        /* Cover Content (Proposal Specific) */
        .pdf-cover-content { text-align: center; margin-top: 60px; margin-bottom: 80px; }
        .pdf-proposal-label { font-size: 12pt; letter-spacing: 3px; color: #888; text-transform: uppercase; margin-bottom: 20px; font-weight: 300; }
        .pdf-project-title { font-size: 28pt; font-weight: 600; color: #4059C6; line-height: 1.2; margin-bottom: 10px; }
        .pdf-proposal-code { font-size: 12pt; color: #666; background: #F4F4F4; display: inline-block; padding: 5px 15px; border-radius: 20px; font-weight: 300; }
        
        /* Sections */
        .pdf-section { margin-bottom: 0px; }
        
        /* Table */
        .pdf-table { width: 100%; border-collapse: collapse; }
        .pdf-table thead { display: table-header-group; }
        .pdf-table tr { page-break-inside: avoid; }
        @media print {
            .pdf-table thead { display: table-header-group; }
            .pdf-table tfoot { display: table-footer-group; }
        }
        .pdf-table th { background: #4059C6; color: white; text-align: left; padding: 8px 10px; font-size: 8pt; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; white-space: nowrap; }
        .pdf-table td { padding: 10px 10px; border-bottom: 1px solid #E6E6E6; font-size: 8pt; font-weight: 300; vertical-align: top; }
        .pdf-table tr { page-break-inside: avoid; }
        /* Last row of tbody (item list) gets blue border */
        .pdf-table tbody:not(.no-break) tr:last-child td { border-bottom: 2px solid #4059C6; }
        
        /* Utility Classes */
        .pdf-text-right { text-align: right !important; }
        .pdf-text-center { text-align: center; }
        .pdf-text-left { text-align: left !important; }
        
        /* Utility Classes for Controller Usage */
        .boq-code-row { background-color: #f9f9f9; }
        .boq-code-text { font-weight: bold; color: #4059C6; }
        .boq-header { background-color: #f0f0f0; font-weight: bold; }
        .boq-subheader { background-color: #fafafa; }
        .indent-20 { padding-left: 20px; }
        .nowrap { white-space: nowrap; }
        .pr-80 { padding-right: 80px; }
        .no-break { page-break-inside: avoid; }
         
        /* Totals */
        .pdf-totals-label { font-weight: 500; color: #333; font-size: 10pt; font-weight: medium !important; }
        .pdf-totals-value { text-align: right; font-weight: medium !important; color: #333; font-size: 10pt; }
        .pdf-grand-total { font-size: 14pt; color: #4059C6; border-bottom: none !important; font-weight: bold !important; padding-top: 15px !important; }
       
        /* Footer */
        .pdf-footer-bottom { position: absolute; bottom: 15mm; left: 0; right: 0; text-align: center; font-size: 8pt; color: #999; font-weight: 300; }
    </style>
</head>
<body class="pdf-body">
    <div class="pdf-page">
        <!-- Header -->
        <div class="pdf-header">
            <div class="pdf-header-wrapper">
                <div class="pdf-logo">
                    <img src="{{logo_path}}" alt="Logo" style="max-height: 50px; width: auto;">
                </div>
                <div class="pdf-header-right">
                    <div class="pdf-address-block">
                        <!-- Building Icon SVG -->
                        <svg class="pdf-building-icon" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14z"/>
                            <path d="M7 7h2v2H7zm0 4h2v2H7zm0 4h2v2H7zm4-8h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2zm4-8h2v2h-2zm0 4h2v2h-2zm0 4h2v2h-2z"/>
                        </svg>
                        <div class="pdf-address-text">
                            123 Business Street<br>
                            City 12345<br>
                            Country
                        </div>
                    </div>
                    <div class="pdf-vertical-line"></div>
                </div>
            </div>
        </div>

        <div class="pdf-page-wrapper">
            <!-- Cover Page Content -->
            <div class="pdf-cover-content" style="text-align: center; margin-bottom: 30px;">
                <div class="pdf-proposal-label" style="font-size: 18pt; font-weight: bold; color: #333; margin-bottom: 5px;">BILL OF QUANTITY</div>
                <div class="pdf-project-title" style="font-size: 14pt; font-weight: 600; color: #333; margin-bottom: 5px;">{{project_name}}</div>
                <div class="pdf-proposal-code" style="font-size: 11pt; color: #666;">{{proposal_date}}</div>
            </div>
            
            <div style="margin-top: 60px;">
                <div class="pdf-section">
                    <!-- BOQ Items Table -->
                    <table class="pdf-table">
                        <thead>
                            <tr>
                                <th style="width: 5%; text-align: center;">No</th>
                                <th style="width: 100%;">Description</th>
                                <th class="pdf-text-center" style="width: 8%;">Title 1</th>
                                <th class="pdf-text-center" style="width: 8%;">Title 2</th>
                                <th class="pdf-text-center" style="width: 8%;">Title 3</th>
                                <th class="pdf-text-center" style="width: 8%;">Title 4</th>
                                <th class="pdf-text-right" style="width: 15%;">Unit Price</th>
                                <th class="pdf-text-right" style="width: 15%;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{proposal_items}}
                        </tbody>
                        <tbody class="no-break">
                            {{totals_rows}}
                        </tbody>
                    </table>
                </div>
            </div>
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
                ['name' => 'terms_and_conditions', 'label' => 'Terms & Conditions'],
                ['name' => 'proposal_items', 'label' => 'Proposal Items (Table Rows)'],
                ['name' => 'totals_rows', 'label' => 'Totals Section Rows'],
                ['name' => 'logo_path', 'label' => 'Logo Path'],
            ],
            'is_active' => true,
        ]); 
    }
}
