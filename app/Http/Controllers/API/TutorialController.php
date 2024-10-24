<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TutorialRequest;
use App\Models\Tutorial;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
    public function __construct(private Tutorial $tutorial){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tutorials =$this->tutorial->all();

        if(!$tutorials){
            return response()->json([
                "status" => 'failed',
                "message" => "No Tutorial Available"
            ],404);
        }

        return response()->json([
            "status" => 'success',
            "data" => $tutorials
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TutorialRequest $request)
    {
        $validatedData = $request->validated();

        if ($validatedData['published'] === 'true' || 
        $validatedData['published'] === 'True' || 
        $validatedData['published'] === 'TRUE' || 
        $validatedData['published'] === 'T') 
        {
            $validatedData['published'] = true;
        } 
        else{
            $validatedData['published'] = false;
       }

        if(!$tutorial = $this->tutorial->create($validatedData)){
            return response()->json([
                "status" => 'failed',
                "message" => "Failed to Create Tutorial"
            ],400);
        }

        return response()->json([
            "status" => 'success',
            "message" => "Tutorial Created Successfully",
            "data" => $tutorial
        ], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tutorial = $this->tutorial->findOrFail($id);

        if(!$tutorial){
            return response()->json([
                "status" => 'failed',
                "message" => "Tutorial not Found"
            ],404);
        }

        return response()->json([
            "status" => 'success',
            "message" => "Tutorial Found",
            "data" => $tutorial
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TutorialRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $tutorial = $this->tutorial->findOrFail($id);

        if(!$tutorial){
            return response()->json([
                "status" => 'failed',
                "message" => "Tutorial not Found"
            ],404);
        }

        if(!$updatedTutorial = $tutorial->update($validatedData)){
            return response()->json([
                "status" => 'failed',
                "message" => "Tutorial Update Failed"
            ],400);
        }

        return response()->json([
            "status" => 'success',
            "message" => "Tutorial Updated",
            "data" => $updatedTutorial
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tutorial = $this->tutorial->findOrFail($id);

        if(!$tutorial){
            return response()->json([
                "status" => 'failed',
                "message" => "Tutorial not Found"
            ],404);
        }

        $deletedTutorial = $tutorial->delete();

        return response()->json([
            "status" => 'success',
            "message" => "Tutorial Deleted",
            "data" => $deletedTutorial
        ], 200);
    }
}
