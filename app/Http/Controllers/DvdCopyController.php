<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\DvdCopy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DvdCopyController extends BaseController
{
    public function index(): JsonResponse
    {
        $dvdCopies = DvdCopy::with('dvd')->get();

        return $this->sendResponse($dvdCopies, 'DVD copies retrieved successfully.');
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'dvd_id' => 'required|uuid|exists:dvds,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Request with errors, please fix these errors below.', $validator->errors(), 422);
        }

        $dvdCopy = DvdCopy::create($request->all());

        return $this->sendResponse($dvdCopy, 'DVD copy created successfully.', 201);
    }

    public function show(string $id): JsonResponse
    {
        $dvdCopy = DvdCopy::with('dvd')->findOrFail($id);

        return $this->sendResponse($dvdCopy, 'DVD copy retrieved successfully.');
    }

    public function destroy(string $id): JsonResponse
    {
        $dvdCopy = DvdCopy::findOrFail($id);
        $dvdCopy->delete();

        return $this->sendResponse([], 'DVD copy deleted successfully.');
    }
}
