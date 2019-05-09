<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $end = now('America/Chicago');
        $start = $end->copy()->subDays(7);

        $logs = Log::whereBetween('date', [$start, $end])->get();

        $topSteps = [];

        foreach ($logs as $log) {
            if (!array_key_exists($log->user_id, $topSteps)) {
                $topSteps[$log->user_id] = [
                    'name' => $log->user->name,
                    'steps' => 0,
                ];
            }

            if (array_key_exists($log->user_id, $topSteps)) {
                $topSteps[$log->user_id]['steps'] = $topSteps[$log->user_id]['steps'] + $log->steps;
            }
        }

        usort($topSteps, function ($item1, $item2) {
            return $item2['steps'] <=> $item1['steps'];
        });

        $topWorkouts = [];

        foreach ($logs as $log) {
            if (!array_key_exists($log->user_id, $topWorkouts)) {
                $topWorkouts[$log->user_id] = [
                    'name' => $log->user->name,
                    'minutes' => 0,
                ];
            }

            if (array_key_exists($log->user_id, $topWorkouts)) {
                $topWorkouts[$log->user_id]['minutes'] = $topWorkouts[$log->user_id]['minutes'] + $log->workout;
            }
        }

        usort($topWorkouts, function ($item1, $item2) {
            return $item2['minutes'] <=> $item1['minutes'];
        });

        $topWeightLost = [];

        foreach ($logs as $log) {
            if (!array_key_exists($log->user_id, $topWeightLost)) {
                $topWeightLost[$log->user_id] = [
                    'name' => $log->user->name,
                    'data' => [],
                ];
            }

            if (array_key_exists($log->user_id, $topWeightLost)) {
                if (!is_null($log->weight)) {
                    $topWeightLost[$log->user_id]['data'][] = [
                        'date' => Carbon::parse($log->date)->timestamp,
                        'weight' => $log->weight,
                    ];
                }
            }
        }

        foreach ($topWeightLost as &$topWeightLoss) {
            usort($topWeightLoss['data'], function ($item1, $item2) {
                return $item2['date'] <=> $item1['date'];
            });
        }

        foreach ($topWeightLost as &$topWeightLoss) {
            $topWeightLoss['loss'] = end($topWeightLoss['data'])['weight'] - reset($topWeightLoss['data'])['weight'];
        }

        usort($topWeightLost, function ($item1, $item2) {
            return $item2['loss'] <=> $item1['loss'];
        });
        
        return view('home')->with('topSteps', $topSteps)->with('topWorkouts', $topWorkouts)->with('topWeightLost', $topWeightLost);
    }
}
