<div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="c_proposal_append_boq_canvas" style="width: 998px !important;">
  <div class="offcanvas-header border-bottom">
    <h4>Add Existing BOQ</h4>
    <button type="button" id="c_proposal_append_boq_canvas_close_btn" class="btn-close custom-btn-close border p-1 me-0 d-flex align-items-center justify-content-center rounded-circle" data-bs-dismiss="offcanvas" aria-label="Close">
      <i class="ti ti-x"></i>
    </button>
  </div>
  <div class="offcanvas-body">
    <style>
      #c_proposal_append_boq_canvas tr > th, 
      #c_proposal_append_boq_canvas tr > td {
        padding: 12px 30px;
      } 
      #c_proposal_append_boq_canvas tr > th:first-child, 
      #c_proposal_append_boq_canvas tr > td:first-child {
        left: 0;
        padding: 12px;
      } 
      #c_proposal_append_boq_canvas tr > td:first-child {
        position: sticky;
        z-index: 1;
        background-color: #fff; 
      } 
      #c_proposal_append_boq_canvas th:nth-child(2), 
      #c_proposal_append_boq_canvas td:nth-child(2) {
        padding-left: 0;
      }
      #c_proposal_append_boq_canvas tbody tr td {
        vertical-align: baseline;
      }
      #c_proposal_append_boq_canvas thead tr th {
        text-align: center !important;
      }
      #c_proposal_append_boq_canvas .td-break {
        text-align: left !important;
        word-break: auto-phrase;
        white-space: unset !important;
      }
      .desc-col {
        max-width: 300px
      }
      #c_proposal_append_boq_canvas #selected_proposal_append_boq {
        display: flex;  
        flex-wrap: wrap;
        list-style: none;
        gap: 6px; 
        margin-bottom: 24px;
      }
      #c_proposal_append_boq_canvas .selected-tag {
        padding: 4px 6px;  
        border-radius: 3px;
        background: #e41f07;
        color: #fff;
      }
      #c_proposal_append_boq_canvas .no-selected-tag {
        text-align: center;
        flex-grow: 1;
        padding: 4px 6px;  
        color: #6f6f6f;
      }
    </style>
    <form id="c_proposal_append_boq_canvas_form" method="POST"></form>
  </div>
</div>