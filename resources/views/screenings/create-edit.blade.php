<div class="form-group">
    <label for="inputData">Data</label>
    <input type="text" class="form-control" name="date" id="inputData" value="{{old('date', $screening->date)}}" >
    @error('date')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputHoraInicio">Hora Inicio</label>
    <input type="text" class="form-control" name="start_time" id="inputhoraInicio" value="{{old('start_time', $screening->start_time)}}" >
    @error('start_time')
        <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
