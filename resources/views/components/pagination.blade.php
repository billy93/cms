<div class="row align-items-center">
  <div class="col-md-6">
    <div class="datatable-length custom">
      <div class="dataTables_length">
        <label>Show 
          <select name="companieslist_length" aria-controls="companieslist" class="form-select form-select-sm">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select> 
          entries
        </label>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="datatable-paginate custom">
      <div class="dataTables_paginate paging_simple_numbers">
        <ul class="pagination">
          <li class="page-item previous {{ $curPage == 1 ? 'disabled' : '' }}">
            <a href="{{ ($curPage - 1 > 0) ? request()->fullUrlWithQuery(['page' => $curPage - 1]) : 'javascript:void(0)' }}" class="page-link">
              <i class="fa fa-angle-left"></i> Prev 
            </a>
          </li>
          @for($i = 1; $i <= $totalPage; $i++)
            <li class="paginate_button page-item {{ $i == $curPage ? 'active' : '' }}{{ $i == 1 && $i != $totalPage ? ' pagination-start' : '' }}{{ $i == $totalPage && $i != 1 ? ' pagination-end' : '' }}">
               <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}" data-page="{{ $i }}" class="page-link">{{ $i }}</a>
            </li>
          @endfor
          <li class="page-item next {{ $curPage == $totalPage ? 'disabled' : '' }}">
            <a href="{{ ($curPage + 1 <= $totalPage) ? request()->fullUrlWithQuery(['page' => $curPage + 1]) : 'javascript:void(0)' }}" class="page-link">
              Next <i class="fa fa-angle-right"></i> 
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>