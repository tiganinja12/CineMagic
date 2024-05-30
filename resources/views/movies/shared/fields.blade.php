<div class="form-group">
    <label for="inputTitle">Title</label>
    <input type="text" class="form-control" name="title" id="inputTitle" value="{{ old('title', $movie->title ?? '') }}" />
    @error('title')
    <div class="small text-danger"> {{$message}} </div>
    @enderror
</div>
<div class="form-group">
    <label for="inputSynopsis">Synopsis</label>
    <input type="text" class="form-control" name="synopsis" id="inputSynopsis" value="{{ old('synopsis', $movie->synopsis ?? '') }}" />
    @error('synopsis')
    <div class="small text-danger"> {{$message}} </div>
    @enderror
</div>
<div class="form-group">
    <label for="inputYear">Year</label>
    <input type="text" class="form-control" name="year" id="inputYear" value="{{ old('year', $movie->year ?? '') }}" />
    @error('year')
    <div class="small text-danger"> {{$message}} </div>
    @enderror
</div>
<div class="form-group">
    <label for="inputGenre">Genre</label>
    <select class="form-control" name="genre_code" id="inputGenre">
        @foreach ($genres as $genre)
            <option value="{{ $genre->code }}" {{ old('genre_code', $movie->genre_code ?? '') == $genre->code ? 'selected' : '' }}>{{ $genre->name }}</option>
        @endforeach
    </select>
    @error('genre_code')
    <div class="small text-danger"> {{$message}} </div>
    @enderror
</div>
<div class="form-group">
    <label for="inputPoster">Poster</label>
    <input type="file" class="form-control" name="poster" id="inputPoster" />
    @error('poster')
    <div class="small text-danger"> {{$message}} </div>
    @enderror
</div>
