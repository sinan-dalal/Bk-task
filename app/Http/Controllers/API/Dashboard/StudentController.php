<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Models\Student;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Student\StudentResource;
use App\Http\Requests\Student\CreateStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admins']);
    }

    public function index(): AnonymousResourceCollection
    {
        $students = Student::all();

        return StudentResource::collection($students);
    }

    public function store(CreateStudentRequest $request): JsonResponse
    {
        $student = Student::create($request->all());

        return $this->responseCreated(
            'Student created successfully',
            new StudentResource($student));
    }

    public function show(Student $student): JsonResponse
    {
        return $this->responseSuccess(
            'Success',
            new StudentResource($student->load('school'))
        );
    }

    public function update(UpdateStudentRequest $request, Student $student): JsonResponse
    {
        $student->update($request->validated());

        return $this->responseSuccess(
            'Student updated Successfully',
            new StudentResource($student));
    }

    public function destroy(Student $student): JsonResponse
    {
        $student->delete();

        return $this->responseDeleted();
    }
}
