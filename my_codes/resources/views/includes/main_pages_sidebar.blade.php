<div class="col-lg-4">
    <!-- Search widget-->
    <div class="card mb-4">
        <div class="card-header">جستجو</div>
        <div class="card-body">
            <form action="{{ route('search') }}" method="GET">
                <input type="text" name="searched" class="form-control" placeholder="جستجو..." @if(isset($_GET['searched']) && !empty($_GET['searched'])) value="{{ $_GET['searched'] }}" @endif aria-label="جستجو..." aria-describedby="button-search" /><br>
                <input type="submit" value="برو" class="btn btn-primary" id="button-search">
            </form>
        </div>
    </div>
    <!-- Categories widget-->
    <div class="card mb-4">
        <div class="card-header">دسته بندی ها</div>
        <div class="card-body">
            <div class="row">
                <ul class="list-unstyled mb-0">
                    @foreach($categories as $category)
                        <li><a href="{{ route('category.books', ['category' => $category->id]) }}" style="text-decoration: none;">{{ $category->category_name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
