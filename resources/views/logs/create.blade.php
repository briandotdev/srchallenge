@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a New Log Entry</div>

                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="row mt-2">
                            <div class="col-md-8 offset-md-2">
                                <div class="alert alert-danger">
                                    <ul>
                                        <p><strong>Something's Gone Wrong!</strong></p>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/logs') }}">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">Log Date</label>
                            <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="date" value="{{ old('date') }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Number of Steps</label>
                            <input type="number" min=0 max=100000 step="1" class="form-control" name="steps" value="{{ old('steps') }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Minutes of Workout</label>
                            <input type="number" min=0 max=3600 step="1" class="form-control" name="workout" value="{{ old('workout') }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Today's Weight</label>
                            <input type="number" min=0 max=400 step=".1" class="form-control" name="weight" value="{{ old('weight') }}">
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection