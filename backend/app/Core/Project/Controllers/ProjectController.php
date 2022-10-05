<?php

namespace App\Core\Project\Controllers;

use Illuminate\Http\Request;
use App\Core\Project\Models\Project;
use Illuminate\Support\Facades\Validator;
use App\Core\Common\Controllers\Controller;
use App\Core\Project\Resources\ProjectResource;

class ProjectController extends Controller
{
    public function list() {
        return response()->success(ProjectResource::collection(auth()->user()->projects));
    }

    public function show(Project $project) {
        return response()->success(new ProjectResource($project));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'description' => 'required|min:8'
        ]);
        if($validator->fails()){
            return response()->error($validator->errors(), 'Validation errors', 422);
        }
        $project = Project::query()->create($request->only('name', 'description'));

        /**
         * @var User $user
         */
        $user = auth()->user();
        $user->projects()->attach($project->id);

        return response()->success(new ProjectResource($project));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'description' => 'required|min:8'
        ]);
        if($validator->fails()){
            return response()->error($validator->errors(), 'Validation errors', 422);
        }
        $project = Project::query()->find($id);
        if (!$project) {
            return response()->error([], 'Project not found!');
        }
        $project->update($request->only('name', 'description'));

        return response()->success(new ProjectResource($project));
    }

    public function delete($id)
    {
        $project = Project::query()->find($id);
        if (!$project) {
            return response()->error([], 'Project not found!');
        }
        $project->delete();
        return response()->success(null, 'Deleted successfully!');
    }
}
