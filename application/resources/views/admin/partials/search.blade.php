<div class="dataTable-search">

<form action="{{ route(Request::route()->getName(),request()->all()) }}" method="GET" role="search">

<input class="dataTable-input" placeholder="Search...." type="search" name="q">

</form>

</div>