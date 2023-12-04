<?php

namespace App\Http\Controllers\API;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadPhotoTrait;
use App\Http\Resources\CompanyResurce;
use App\Http\Resources\CompanyResource;

class CompanyController extends Controller
{
    use ApiResponseTrait;
    use UploadPhotoTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return $this->customeRespone(CompanyResource::collection($companies),"Done",200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        $validated = $request->validated();
        $path = $this->UploadPhoto($request,'companies','image');
        $company = Company::create([
            'name'  =>$request->name,
            'image' =>$path,
            'policies' =>$request->policies
        ]);

        if($company){
            return $this->customeRespone(new CompanyResource($company),"the company added successfully",200);
        }
        else {
            return $this->customeRespone(null,"the compny does'nt added,there something rong",400);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::find($id);
        if (!$company) {
            return $this->customeRespone(null, 'the company is not found', 400);
        }
        return $this->customeRespone(new CompanyResource($company),"ok",200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, string $id)
    {
        $company = Company::find($id);
        if (!$company) {
            return $this->customeRespone(null, 'the company is not found', 400);
        }
        $validated = $request->validated();
        if (!empty($request->image)) {
            $path = $this->UploadPhoto($request,'companies','image');
        } else {
            $path = $company->image;
        }
        $company->update([
            'name'  =>$request->name,
            'image' =>$path,
            'policies' =>$request->policies
        ]);
        return $this->customeRespone(new CompanyResource($company),"the company updated successfully",200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::find($id);
            if ($company) {
                $company->delete();
                return $this->customeRespone("","company has been  deleted",200);
            }
            return $this->customeRespone(null,"company not found ",404);
        }
}
