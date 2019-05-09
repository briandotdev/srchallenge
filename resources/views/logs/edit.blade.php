@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Log Entry for {{ $log->date }}</div>

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

                    <form method="POST" action="{{ url('/logs/' . $log->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="exampleInputPassword1">Number of Steps</label>
                            <input type="number" min=0 max=100000 step="1" class="form-control" name="steps" value="{{ $log->steps }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Minutes of Workout</label>
                            <input type="number" min=0 max=3600 step="1" class="form-control" name="workout" value="{{ $log->workout }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Today's Weight</label>
                            <input type="number" min=0 max=400 step=".1" class="form-control" name="weight" value="{{ $log->weight }}">
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection