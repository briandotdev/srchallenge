@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="alert alert-primary" role="alert">
                        Check out the <a href="https://www.strava.com/clubs/514355">United Tech Ops team on Strava</a> for even more fitness based challenges!  And don't forget to join us for the <a href="https://www.strava.com/clubs/514355/group_events/506012">JP Morgan Corporate Challenge</a>.
                    </div>

                    Welcome to United Tech Ops Summer (Health) Readiness!

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mt-4" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Most Steps Last 7 Days</h5>

                                    <p class="card-text">Participants with the most cumulative steps over the past 7 days.</p>
                                </div>

                                <ul class="list-group list-group-flush">
                                    @php
                                        $count = 1;
                                    @endphp

                                    @foreach ($topSteps as $topStep)
                                        <li class="list-group-item">{{ $count++.'. ' . $topStep['name'] }}<span class="float-right">{{ $topStep['steps'] }} steps</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mt-4" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Most Workout Last 7 Days</h5>

                                    <p class="card-text">Participants with the most cumulative workout minutes over the past 7 days.</p>
                                </div>

                                <ul class="list-group list-group-flush">
                                    @php
                                        $count = 1;
                                    @endphp

                                    @foreach ($topWorkouts as $topWorkout)
                                        <li class="list-group-item">{{ $count++.'. ' . $topWorkout['name'] }}<span class="float-right">{{ $topWorkout['minutes'] }} min</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mt-4" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Top Weight Loss Last 7 Days</h5>

                                    <p class="card-text">Participants with the most cumulative weight lost over the past 7 days.</p>
                                </div>

                                <ul class="list-group list-group-flush">
                                    @php
                                        $count = 1;
                                    @endphp

                                    @foreach ($topWeightLost as $topWeightLoss)
                                        <li class="list-group-item">{{ $count++.'. ' . $topWeightLoss['name'] }}<span class="float-right">{{ round($topWeightLoss['loss'], 2) }} lbs</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
