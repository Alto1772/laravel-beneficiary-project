<form action="{{ url()->current() }}" method="GET" class="w-100">
    <div class="input-group searchbar-group">
        <input type="text" id="searchBar" class="form-control" placeholder="Search Data..." aria-label="Search"
            name="q" value="{{ $searchTerm ?? '' }}">
        <button class="btn btn-outline-secondary btn-sm" type="submit"><i class="bx bx-search bx-md"></i></button>
    </div>
</form>
