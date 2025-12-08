<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;
use App\Models\PdfTemplate;
use App\Http\Requests\PdfTemplateRequest;
use App\Http\Services\PdfTemplateService;

class PdfTemplateController extends Controller
{
    protected $templateService;

    public function __construct(PdfTemplateService $templateService)
    {
        $this->templateService = $templateService;
    }

    /**
     * Display a listing of PDF templates
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $searchValue = $request->search;
            $search = strtolower(trim(is_array($searchValue) ? ($searchValue['value'] ?? '') : ($searchValue ?? '')));
            
            $templates = PdfTemplate::query();

            // Filter by type if provided
            if ($request->has('type') && $request->type !== '') {
                $templates->where('type', $request->type);
            }

            $result = DataTables::eloquent($templates)
                ->filter(function ($query) use ($search) {
                    if ($search !== '') {
                        $query->where(function ($q) use ($search) {
                            $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                                ->orWhereRaw('LOWER(type) LIKE ?', ["%{$search}%"])
                                ->orWhereRaw('LOWER(description) LIKE ?', ["%{$search}%"]);
                        });
                    }
                })
                ->addColumn('status_badge', function($template) {
                    if ($template->is_active) {
                        return '<span class="badge bg-success">Active</span>';
                    }
                    return '<span class="badge bg-secondary">Inactive</span>';
                })
                ->addColumn('type_badge', function($template) {
                    $color = $template->type === 'invoice' ? 'primary' : 'info';
                    return '<span class="badge bg-' . $color . '">' . ucfirst($template->type) . '</span>';
                })
                ->addColumn('variables_count', function($template) {
                    return $template->variables ? count($template->variables) : 0;
                })
                ->addColumn('actions', function($template) {
                    return '
                        <div class="dropdown table-action">
                            <a href="javascript:void(0)" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a 
                                    class="dropdown-item c_template_preview_btn" 
                                    href="javascript:void(0)" 
                                    data-id="' . $template->id . '"
                                    data-type="' . $template->type . '"
                                >
                                    <i class="ti ti-eye text-info"></i> Preview
                                </a>
                                <a 
                                    class="dropdown-item c_template_edit_btn" 
                                    href="javascript:void(0)" 
                                    data-url="' . route('pdf-templates.read', ['template_id' => $template->id]) . '"
                                >
                                    <i class="ti ti-edit text-blue"></i> Edit
                                </a>
                                <a 
                                    class="dropdown-item c_template_delete_btn" 
                                    href="javascript:void(0)" 
                                    data-url="' . route('pdf-templates.delete', ['template_id' => $template->id]) . '"
                                >
                                    <i class="ti ti-trash text-danger"></i> Delete
                                </a>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['status_badge', 'type_badge', 'actions'])
                ->make(true);
                
            return $result;
        }

        return view('pdf-templates');
    }

    /**
     * Create a new PDF template
     */
    public function create(PdfTemplateRequest $request): JsonResponse
    {
        try {
            $template = $this->templateService->createTemplate($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'PDF Template created successfully',
                'data' => $template
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to create PDF Template'
            ], 500);
        }
    }

    /**
     * Get all PDF templates
     */
    public function readAll(): JsonResponse
    {
        try {
            $templates = $this->templateService->getAllTemplates();
            return response()->json([
                'success' => true,
                'data' => $templates
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Internal Server Error'
            ], 500);
        }
    }

    /**
     * Get a single PDF template
     */
    public function read($template_id): JsonResponse
    {
        try {
            $template = $this->templateService->getTemplateById($template_id);
            return response()->json([
                'success' => true,
                'data' => $template
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Internal Server Error'
            ], 500);
        }
    }

    /**
     * Update a PDF template
     */
    public function update(PdfTemplateRequest $request, $template_id): JsonResponse
    {
        try {
            $template = $this->templateService->updateTemplate($template_id, $request->validated());
            return response()->json([
                'success' => true,
                'message' => 'PDF Template updated successfully',
                'data' => $template
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Internal Server Error'
            ], 500);
        }
    }

    /**
     * Delete a PDF template
     */
    public function delete($template_id): JsonResponse
    {
        try {
            $this->templateService->deleteTemplate($template_id);
            return response()->json([
                'success' => true,
                'message' => 'PDF Template deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Internal Server Error'
            ], 500);
        }
    }

    /**
     * Preview a PDF template with sample data
     */
    public function preview(Request $request): JsonResponse
    {
        try {
            $templateId = $request->input('template_id');
            $template = $this->templateService->getTemplateById($templateId);
            
            // Get sample data based on template type
            $sampleData = $this->templateService->getSampleData($template->type);
            
            // Render template with sample data
            $renderedHtml = $template->render($sampleData);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'html' => $renderedHtml,
                    'sample_data' => $sampleData
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to preview template'
            ], 500);
        }
    }
}
