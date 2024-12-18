<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Dvd;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DvdController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $dvds = Dvd::with('genre')->get();
        return $this->sendResponse($dvds, 'DVDs retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'genre_id' => 'required|uuid|exists:genres,id',
            'rental_price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Request with errors, please fix these errors below.', $validator->errors(), 422);
        }

        $dvd = Dvd::create($request->all());
        return $this->sendResponse($dvd, 'DVD created successfully.', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $dvd = Dvd::with('genre')->findOrFail($id);
        return $this->sendResponse($dvd, 'DVD retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'genre_id' => 'required|uuid|exists:genres,id',
            'rental_price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Request with errors, please fix these errors below.', $validator->errors(), 422);
        }

        $dvd = Dvd::findOrFail($id);
        $dvd->update($request->all());
        return $this->sendResponse($dvd, 'DVD updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        Dvd::destroy($id);
        return $this->sendResponse([], 'DVD deleted successfully.');
    }
}
