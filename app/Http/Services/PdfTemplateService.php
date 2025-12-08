<?php

namespace App\Http\Services;

use App\Models\PdfTemplate;
use Illuminate\Support\Facades\DB;
use Exception;

class PdfTemplateService
{
    /**
     * Create a new PDF template
     */
    public function createTemplate(array $data)
    {
        return DB::transaction(function () use ($data) {
            $template = PdfTemplate::create($data);
            return $template->fresh();
        });
    }

    /**
     * Get all PDF templates
     */
    public function getAllTemplates()
    {
        return PdfTemplate::orderBy('created_at', 'desc')->get();
    }

    /**
     * Get PDF template by ID
     */
    public function getTemplateById($id)
    {
        $template = PdfTemplate::find($id);
        if (!$template) {
            throw new Exception("PDF Template with ID {$id} not found");
        }
        return $template;
    }

    /**
     * Get templates filtered by type
     */
    public function getTemplatesByType(string $type)
    {
        return PdfTemplate::ofType($type)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Get only active templates
     */
    public function getActiveTemplates()
    {
        return PdfTemplate::active()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Update PDF template
     */
    public function updateTemplate($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $template = PdfTemplate::find($id);
            if (!$template) {
                throw new Exception("PDF Template with ID {$id} not found");
            }

            $template->update($data);
            return $template->fresh();
        });
    }

    /**
     * Delete PDF template
     */
    public function deleteTemplate($id)
    {
        $template = PdfTemplate::find($id);
        if (!$template) {
            throw new Exception("PDF Template with ID {$id} not found");
        }

        $template->delete();
    }

    /**
     * Render template with provided data
     * Replaces {{variable_name}} with actual values
     */
    public function renderTemplate($templateId, array $data): string
    {
        $template = $this->getTemplateById($templateId);
        return $template->render($data);
    }

    /**
     * Get sample data for preview based on template type
     */
    public function getSampleData(string $type): array
    {
        if ($type === 'invoice') {
            return [
                'customer_name' => 'PT. Sample Company',
                'invoice_code' => 'INV-2025-001',
                'invoice_date' => date('d F Y'),
                'due_date' => date('d F Y', strtotime('+30 days')),
                'total_amount' => 'Rp 10.000.000',
                'bill_to' => 'Jl. Sample Street No. 123, Jakarta',
                'ship_to' => 'Jl. Sample Street No. 123, Jakarta',
                'payment_method' => 'Bank Transfer',
                'notes' => 'Thank you for your business',
            ];
        } elseif ($type === 'proposal') {
            return [
                'customer_name' => 'PT. Sample Company',
                'proposal_code' => 'PROP-2025-001',
                'project_name' => 'Sample Project',
                'proposal_date' => date('d F Y'),
                'total_amount' => 'Rp 50.000.000',
                'description' => 'This is a sample proposal description',
                'terms_and_conditions' => 'Standard terms and conditions apply',
            ];
        }

        return [];
    }
}
