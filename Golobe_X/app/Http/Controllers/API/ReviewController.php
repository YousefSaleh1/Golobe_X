<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\ReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use ApiResponseTrait;
    //show all reviews
    public function index()
    {
        $reviews = ReviewResource::collection(Review::get());
        return $this->customeRespone($reviews, ' ', 200);
    }
    //Add review
    public function store(ReviewRequest $request)
    {
        $review = $request->validated();
        $review = Review::create([
            'comment'  => $review['comment'],
            'rate' => $review['rate'],
            'user_id' => $review['user_id'],
            'hotel_id' => $review['hotel_id'],
        ]);
        $review->save();
        return $this->customeRespone($review, 'ok', 200);
    }
    //update
    public function update(ReviewRequest $request, $id)
    {
        $review = $request->validated();
        $review = Review::findOrFail($id);
        if ($review) {
            $review->update($request->all());
            return $this->customeRespone(new ReviewResource($review), 'the review update successfuly', 201);
        }
        return $this->customeRespone(null, 'the review not found', 400);
    }
    //show review by id
    public function show($id)
    {
        $review = Review::find($id);
        if ($review) {
            return $this->customeRespone(new ReviewResource($review), 'ok', 200);
        }
        return $this->customeRespone(null, 'the review not found', 404);
    }
    //delete review
    public function SoftDelete($id)
    {
        $review = Review::find($id);
        if ($review) {
            $review->delete($id);
            return $this->customeRespone(null, 'the review  deleted', 200);
        }
        return $this->customeRespone(null, 'the review  not found', 404);
    }
}
