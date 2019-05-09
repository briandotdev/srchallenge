@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">View My Activity Logs</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <a class="btn btn-success float-right" href="{{ url('/logs/create') }}" role="button">Add Activity Log</a>
                        </div>
                    </div>

                    <table class="table mt-3">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Steps</th>
                                <th scope="col">Minutes of Workout</th>
                                <th scope="col">Weight</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                                <tr>
                                    <th scope="row">{{ $log->date }}</th>
                                    <td>{{ $log->steps }}</td>
                                    <td>{{ $log->workout }}</td>
                                    <td>{{ $log->weight }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ url('/logs/' . $log->id . '/edit') }}" role="button">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ url('/logs/' . $log->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-primary">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection