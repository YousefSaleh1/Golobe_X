<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotelRequest;
use Illuminate\Http\Request;
use App\Http\Resources\{HotelResource,DetailsResource,ShowResource};
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadPhotoTrait;
use App\Models\{Hotel,Room,Review};
use Illuminate\Support\Facades\Log;


class HotelController extends Controller
{
use ApiResponseTrait;
use UploadPhotoTrait;

public function index()
{
    $hotels = ShowResource::collection(Hotel::get());
    return $this->customeRespone($hotels,' ',200);
}
public function search(Request $request)
    {
        try {
            $request->validate([
                'city' => 'string',
                'fromDay' => 'date',
                'toDay' => 'date',
                'guestNumber' => 'integer',
            ]);

            $query = Hotel::query();

            if ($request->has('city')) {
                $query->where('city', 'like', '%' . $request->city . '%');
            }

            if ($request->has('fromDay') ) {
                $query->whereHas('rooms', function ($query) use ($request) {
                    $query->whereDate('fromDay', $request->fromDay);
                });
            }
            if($request->has('toDay'))
            {
                $query->whereHas('rooms', function ($query) use ($request) {
                  $query ->whereDate('toDay', $request->toDay);});
            }

            if ($request->has('guestNumber')) {
                $query->whereHas('rooms', function ($query) use ($request) {
                    $query->where('guestNumber', $request->guestNumber);
                });
            }

            $hotels = $query->get();

            if ($hotels->isEmpty()) {
                return $this->customResponse(null, 'No results found', 404);
            }

            $results = $this->formatHotelResults($hotels);

            return $this->customResponse($results, 'Results found', 200);

        } catch (\Exception $e) {
            // Log the entire exception
            Log::error('Error executing search: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return $this->customResponse(null, 'An error occurred while searching', 500);
        }
    }

    private function formatHotelResults($hotels)
    {
        return $hotels->map(function ($hotel) {
            $review = Review::where('hotel_id', $hotel->id)->avg('rate');
            return [
                "name" => $hotel->name,
                "address" => $hotel->address,
                "rate" => $hotel->rate,
                "amenities" => $hotel->amenities,
                "priceForNight" => $hotel->priceForNight,
                "averageRating" => $review ? round($review, 2) : 0,
            ];
        })->toArray();
    }

    private function customResponse($data, $message, $statusCode)
    {
        return response()->json(['data' => $data, 'message' => $message], $statusCode);
    }
public function ViewDetails(string $id)
{
    $hotel= Hotel::find($id);
    $review=Review::where('hotel_id',$hotel->id)->avg('rate');
    $Rooms=Room::where('hotel_id',$id)->where('available',false)->get();
    $reviewsAll=Review::where('hotel_id',$id)->get();
    return $this->customeRespone([$hotel,$review,$Rooms,$reviewsAll],' ',200);
}
////Add hotel
public function store(HotelRequest $request)
{
    $hotel = $request->validated();
    $destination = 'hotels';
    $imagePath = $this->UploadPhoto($request, $destination,'image');
    $hotel = Hotel::create([
        'name'  => $hotel['name'],
        'rate' => $hotel['rate'],
        'priceForNight' =>$hotel['priceForNight'],
        'city' => $hotel['city'],
        'address' => $hotel['address'],
        'freebies'=>json_encode($request->freebies),
        'amenities'=>json_encode($request->amenities),
        'overview'=>$hotel['overview'],
        'image'=> $imagePath
    ]);
    $hotel->save();
    return $this->customeRespone(new HotelResource($hotel),'ok',200);
}
//update for hotel
public function update(HotelRequest $request, $id)
{
    $hotel = Hotel::findOrFail($id);

    // Update fields not related to file uploads
    $hotel->update($request->except('image'));

    // Upload and update the image field
    $destination = 'hotels';
    $imagePath = $this->UploadPhoto($request, $destination, 'image');
    $hotel->image = $imagePath;
    $hotel->save();

    return $this->customeRespone(new HotelResource($hotel), 'The hotel was updated successfully', 201);
}


//show hotel by id
public function show($id)
{
    $hotel =Hotel::find($id);
    if($hotel) {
        return $this->customeRespone(new HotelResource($hotel),'ok',200);
    }
    return $this->customeRespone(null,'the hotel not found',404);
}
//delete hotel
public function SoftDelete($id)
{
    $hotel = Hotel::find($id);
    if($hotel)
    {
        $hotel->delete($id);
        return $this->customeRespone(null,'the hotel deleted',200);
    }
    return $this->customeRespone(null,'the hotel not found',404);
}
//show onlyTashed
public function NotDeleteForEver()
{
    $hotels = Hotel::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
    return $this->customeRespone($hotels,'ok',201);
}
//delete for ever
public function forceDeleted($id)
{
$hotel = Hotel::onlyTrashed()->find($id);
if($hotel){
    $hotel->forceDelete();
    return $this->customeRespone(null,'hotel deleted successfully',201);
}
return $this->customeRespone(null,'hotel not  found',404);
}
}
