 @if($paginator->hasPages())
	 <div class="dataTable-bottom">
	<div class="dataTable-info">Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{$paginator->total()}} entries</div>
	<div class="dataTable-dropdown">
	   <label>
	   {{--
		  <select class="dataTable-selector">
			 <option value="10" selected="">10</option>
			 <option value="20">20</option>
			 <option value="30">30</option>
			 <option value="50">50</option>
			 <option value="100">100</option>
		  </select>
		  --}}
	   </label>
	</div>
	<nav class="dataTable-pagination">
	
	   <ul class="dataTable-pagination-list">
		  <li class="pager">
		 
		 {{-- Previous Page Link --}}
		   @if ($paginator->onFirstPage())

	       <a href="#" data-page="1">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180">
				   <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
				   <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
				</svg>
			 </a>
			
            @else
	
			 <a href="{{ $paginator->previousPageUrl() }}" data-page="1">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180">
				   <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
				   <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
				</svg>
			 </a>
			
            @endif

			 
		  </li>
		   {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
				<li class=""><a href="#" data-page="{{ $element }}">{{ $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
						<li class="active"><a href="#" data-page="{{ $page }}">{{ $page }}</a></li>
                        @else
						<li class=""><a href="{{ $url }}" data-page="{{ $page }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
			
		   {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
			  <li class="pager">
				 <a href="{{ $paginator->nextPageUrl() }}" data-page="3">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180">
					   <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
					   <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
					</svg>
				 </a>
			  </li>
            @else
			 <li class="pager">
				 <a href="#" data-page="3">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180">
					   <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
					   <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
					</svg>
				 </a>
			  </li>
		  
            @endif
			
		  
	   </ul>
	</nav>
 </div>
@endif	 