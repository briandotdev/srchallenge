<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLog;
use App\Http\Requests\UpdateLog;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = Log::where('user_id', auth()->user()->id)->orderBy('date', 'desc')->get();

        return view('logs.index')->with('logs', $logs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('logs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLog $request)
    {
        Log::create([
            'user_id' => auth()->user()->id,
            'date' => Carbon::parse($request->date, 'America/Chicago'),
            'steps' => $request->steps,
            'workout' => $request->workout,
            'weight' => $request->weight,
        ]);

        session()->flash('status', 'Your summer readiness log has been added!');
        return redirect('/logs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $log = Log::where('id', $id)->first();

        return view('logs.edit')->with('log', $log);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLog $request, $id)
    {
        $log = Log::where('id', $id)->update([
            'steps' => $request->steps,
            'workout' => $request->workout,
            'weight' => $request->weight,
        ]);

        session()->flash('status', 'Activity log updated!');
        return redirect('/logs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $log = Log::where('id', $id)->first();

        if (is_null($log)) {
            return redirect('/logs');
        }

        if ($log->user_id == auth()->user()->id) {
            $log->delete();

            session()->flash('status', 'Activity log deleted!');
            return redirect('/logs');
        }

        return redirect('/logs');
    }
}
