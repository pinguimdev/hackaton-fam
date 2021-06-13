<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return response()->json($events, 200);
    }

    public function getEventsInfo()
    {
        $events = Event::with('users')->get();
        $info = [];
        foreach ($events as $key => $value) {
            $info[$value->season]['total'] = $value->users->count();
            $info[$value->season]['users'] = $value->users;
        }

        foreach ($events as $key => $value) {
            $info[$value->season]['reincidentes'] = $value->users->count();
            if (array_key_exists(($value->season-1), $info)) {
                $info[$value->season]['reincidentes'] = 0;

                $anterior = $info[$value->season-1]['users'];
                $atual    = $info[$value->season]['users'];
                foreach ($anterior as $ant) {
                    foreach ($atual as $at) {
                        if ($at->id == $ant->id) {
                            $info[$value->season]['reincidentes']++;
                        }
                    }
                }
            }
        }

        return response()->json($info, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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


}
