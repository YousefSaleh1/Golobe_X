<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\RoomRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Room;

class RoomController extends Controller
{
    use ApiResponseTrait;

    //show all rooms
    public function index()
    {
        $rooms = RoomResource::collection(Room::get());
        return $this->customeRespone($rooms, ' ', 200);
    }
    //Add room
    public function store(RoomRequest $request)
    {
        $room = $request->validated();
        $room = Room::create([
            'guestNumber'  => $room['guestNumber'],
            'available' => $room['available'],
            'fromDay' => $room['fromDay'],
            'toDay' => $room['toDay'],
            'price' => $room['price'],
            'hotel_id' => $room['hotel_id'],
        ]);
        $room->save();
        return $this->customeRespone($room, 'ok', 200);
    }
    //update
    public function update(RoomRequest $request, $id)
    {
        $room = $request->validated();
        $room = Room::findOrFail($id);
        if ($room) {
            $room->update($request->all());
            return $this->customeRespone(new RoomResource($room), 'the room update successfuly', 201);
        }
        return $this->customeRespone(null, 'the room not found', 400);
    }
    //show room by id
    public function show($id)
    {
        $room = Room::find($id);
        if ($room) {
            return $this->customeRespone(new RoomResource($room), 'ok', 200);
        }
        return $this->customeRespone(null, 'the room not found', 404);
    }
    //delete room
    public function SoftDelete($id)
    {
        $room = Room::find($id);
        if ($room) {
            $room->delete($id);
            return $this->customeRespone(null, 'the room deleted', 200);
        }
        return $this->customeRespone(null, 'the room not found', 404);
    }
    //show onlyTashed
    public function NotDeleteForEver()
    {
        $rooms = Room::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
        return $this->customeRespone($rooms, 'ok', 201);
    }
    //delete for ever
    public function forceDeleted($id)
    {
        $room = Room::onlyTrashed()->find($id);
        if ($room) {
            $room->forceDelete();
            return $this->customeRespone(null, 'room deleted successfully', 201);
        }
        return $this->customeRespone(null, 'room not  found', 404);
    }
}
