@if(isset($movie->poster_filename) && $movie->poster_filename)
<div class="mb-3 row justify-content-center">
    <div class="col-sm-12 col-md-10 col-lg-8 col-xl-7">
        <img src="{{ asset('storage/posters/' . $movie->poster_filename) }}" class="img-thumbnail" alt="{{ $movie->title }}">
    </div>
</div>
@endif
