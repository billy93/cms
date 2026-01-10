<div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="c_proposal_canvas" style="width: 998px !important;">
  <div class="offcanvas-header border-bottom">
    <h4 id="c_proposal_canvas_title">Create Proposal</h4>
    <button type="button" id="c_poposal_canvas_close_btn" class="btn-close custom-btn-close border p-1 me-0 d-flex align-items-center justify-content-center rounded-circle" data-bs-dismiss="offcanvas" aria-label="Close">
      <i class="ti ti-x"></i>
    </button>
  </div>
  <div class="offcanvas-body">
    <style>
      #c_proposal_canvas_form td { vertical-align: baseline; } 
      #proposal_canvas_boq_section tr > th, 
      #proposal_canvas_boq_section tr > td {
        padding: 12px 30px;
      } 
      #proposal_canvas_boq_section tr > th:first-child, 
      #proposal_canvas_boq_section tr > td:first-child {
        left: 0;
        padding: 12px;
      } 
      #proposal_canvas_boq_section tr > td:first-child {
        position: sticky;
        z-index: 1;
        background-color: #fff; 
      } 
      #proposal_canvas_boq_section th:nth-child(2), 
      #proposal_canvas_boq_section td:nth-child(2) {
        padding-left: 0;
      }
      #proposal_canvas_boq_section td { vertical-align: baseline; } 
      #proposal_canvas_boq_section #selected_proposal_canvas_boq {
        display: flex;  
        flex-wrap: wrap;
        list-style: none;
        gap: 6px; 
      }
      #proposal_canvas_boq_section .selected-tag {
        padding: 2px 6px;
        border-radius: 5px;
        background: #aaa;
        color: #fff;
        font-size: 12px;
      }
      #proposal_canvas_boq_section .no-selected-tag {
        text-align: center;
        flex-grow: 1;
        padding: 2px 6px;
        color: #6f6f6f;
        font-size: 12px;
      }
    </style>
    <form id="c_proposal_canvas_form" method="POST"></form>
  </div>
</div> 