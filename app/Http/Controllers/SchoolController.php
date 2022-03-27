<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Http\Resources\School\SchoolResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SchoolController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $schools = School::all();

        return SchoolResource::collection($schools);
    }

    public function store(StoreSchoolRequest $request): JsonResponse
    {
        $school = School::create($request->all());

        return $this->responseCreated(
            'School created successfully',
            new SchoolResource($school));
    }

    public function show(School $school): JsonResponse
    {
        return $this->responseSuccess(
            'Success',
            new SchoolResource($school));
    }


    public function update(UpdateSchoolRequest $request, School $school): JsonResponse
    {
        $school->update($request->validated());

        return $this->responseSuccess(
            'School updated successfully',
            new SchoolResource($school));
    }


    public function destroy(School $school): JsonResponse
    {
        $school->delete();

        return $this->responseDeleted();
    }
}
