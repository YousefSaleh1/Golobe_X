<?php

namespace App\Http\Controllers\API;

use App\Models\Card;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCardRequest;
use App\Http\Resources\CardResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $cards = Card::where('user_id',$id)->get();
        if ($cards) {
            return $this->customeRespone(CardResource::collection($cards),"Done",200);

        }
        return $this->customeRespone(null,"You don't have any cards",400);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCardRequest $request)
    {
        $validated = $request->validated();

        $user_id = Auth::user()->id;
        $card = Card::create([
            'user_id'       =>$user_id,
            'cardNumber'    =>$request->cardNumber,
            'expDate'       =>$request->expDate,
            'cvc'           =>$request->cvc,
            'nameOnCard'    =>$request->nameOnCard,
            'country'       =>$request->country,
            'securitySave'  =>$request->securitySave,
        ]);

        if($card){
            return $this->customeRespone(new CardResource($card),"the card stored successfully",200);
        }else {
            return $this->customeRespone(null,"there is something wrong",200);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $card = Card::find($id);
        $user_id = Auth::user()->id;
        if($user_id == $card->user_id){
            return $this->customeRespone(new CardResource($card),"Done",200);
        }else{
            return $this->customeRespone(null,"you can only show your card",400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCardRequest $request, string $id)
    {
        $card = Card::find($id);
        $user_id = Auth::user()->id;
        $validated = $request->validated();

        if($user_id == $card->user_id){
            $card->update([
                'cardNumber'    =>$request->cardNumber,
                'expDate'       =>$request->expDate,
                'cvc'           =>$request->cvc,
                'nameOnCard'    =>$request->nameOnCard,
                'country'       =>$request->country,
                'securitySave'  =>$request->securitySave,
            ]);
            return $this->customeRespone(new CardResource($card),"Done",200);
        }else{
            return $this->customeRespone(null,"you can only update your card",400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $card = Card::find($id);
        $user_id = Auth::user()->id;
        if($user_id == $card->user_id){
            $card->delete();
            return $this->customeRespone("","Done",200);
        }else{
            return $this->customeRespone(null,"you can only delete your card",400);
        }
    }
}
