<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $genres = Genre::all();

        return $this->sendResponse($genres, 'Genres retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Request with errors, please fix these errors below.', $validator->errors(), 422);
        }

        $genre = Genre::create($request->all());

        return $this->sendResponse($genre, 'Genre created successfully.', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $genre = Genre::findOrFail($id);

        return $this->sendResponse($genre, 'Genre retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Request with errors, please fix these errors below.', $validator->errors(), 422);
        }

        $genre = Genre::findOrFail($id);
        $genre->update($request->all());

        return $this->sendResponse($genre, 'Genre updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        Genre::destroy($id);

        return $this->sendResponse([], 'Genre deleted successfully.');
    }
}
