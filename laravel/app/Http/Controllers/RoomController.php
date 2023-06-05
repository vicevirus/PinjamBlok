<?php

namespace App\Http\Controllers;

use App\Models\Room;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();


        return view('room.index', compact('rooms'));
    }
    public function add()
    {
        return view('room.addroom');
    }
    public function storeRoom(Request $request)
    {
        $request->validate([
            'room_name' => 'required',
            'room_desc' => 'required',
        ]);



        Room::create($request->all());

        return redirect()->route('room.index')
            ->with('success', 'Room created successfully.');
    }
}
