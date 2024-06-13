<div class="form-group">
    <label for="movie_id">Movie</label>
    <select name="movie_id" id="movie_id" class="form-control">
        @foreach($movies as $movie)
            <option value="{{ $movie->id }}" {{ $screening->movie_id == $movie->id ? 'selected' : '' }}>{{ $movie->title }}</option>
        @endforeach
    </select>
    @error('movie_id')
    <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="theater_id">Theater</label>
    <select name="theater_id" id="theater_id" class="form-control">
        @foreach($theaters as $theater)
            <option value="{{ $theater->id }}" {{ $screening->theater_id == $theater->id ? 'selected' : '' }}>{{ $theater->name }}</option>
        @endforeach
    </select>
    @error('theater_id')
    <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="date">Date</label>
    <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $screening->date) }}">
    @error('date')
    <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="start_time">Start Time</label>
    <input type="time" name="start_time" id="start_time" class="form-control" value="{{ old('start_time', $screening->start_time) }}">
    @error('start_time')
    <div class="small text-danger">{{ $message }}</div>
    @enderror
</div>
