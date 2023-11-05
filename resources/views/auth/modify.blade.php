@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">Modify Event</div>
            <div class="card-body">
                <form action="{{ route('events.patch', ['id' => $event->id]) }}" method="post">
                        @csrf
                        @method('PATCH')
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                        <div class="col-md-6">
                          <input type="text" maxlength=64 class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{$event->name }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="type" class="col-md-4 col-form-label text-md-end text-start">Event type</label>
                        <div class="col-md-6">
                          <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ $event->type }}">
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" >{{$type->name}}</option>
                            @endforeach

                          </select>
                            @if ($errors->has('type'))
                                <span class="text-danger">{{ $errors->first('type') }}</span>
                            @endif
                        </div>
                    </div>



                    <div class="mb-3 row">
                        <label for="description" class="col-md-4 col-form-label text-md-end text-start">Description</label>
                        <div class="col-md-6">
                          <textarea rows="10" cols="30" class="form-control @error('description') is-invalid @enderror" id="description" name="description" >{{ $event->description }} </textarea>
                            @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif

                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="esd" class="col-md-4 col-form-label text-md-end text-start">Event start date</label>
                        <div class="col-md-6">
                          <input type="date"  class="form-control @error('esd') is-invalid @enderror" id="esd" name="esd" value="{{ $event->start_date }}">
                            @if ($errors->has('esd'))
                                <span class="text-danger">{{ $errors->first('esd') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="eed" class="col-md-4 col-form-label text-md-end text-start">Event end date</label>
                        <div class="col-md-6">
                          <input type="date"  class="form-control @error('eed') is-invalid @enderror" id="eed" name="eed" value="{{ $event->end_date }}">
                            @if ($errors->has('eed'))
                                <span class="text-danger">{{ $errors->first('eed') }}</span>
                            @endif
                        </div>
                    </div>

                    
                        


                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Modify">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection