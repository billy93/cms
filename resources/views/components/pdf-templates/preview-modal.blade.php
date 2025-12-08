<div class="modal fade" id="c_template_preview_modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Preview PDF Template</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-info mb-3">
          <i class="ti ti-info-circle me-2"></i>
          This is a preview with sample data. The actual PDF will use real data from your system.
        </div>
        
        <div class="row mb-3">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-light">
                <h6 class="mb-0">Sample Data Used</h6>
              </div>
              <div class="card-body">
                <div id="c_template_preview_sample_data" class="font-monospace small">
                  <!-- Sample data will be displayed here -->
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Rendered HTML Preview</h6>
                <button type="button" class="btn btn-sm btn-outline-primary" id="c_template_preview_copy_btn">
                  <i class="ti ti-copy me-1"></i>Copy HTML
                </button>
              </div>
              <div class="card-body">
                <div id="c_template_preview_content" class="border rounded p-3" style="min-height: 600px; max-height: 600px; overflow-y: auto;">
                  <!-- Rendered HTML will be displayed here -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
