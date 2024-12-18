<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Jobs\UpdateDvdCopyAvailability;
use App\Models\Rental;
use App\Models\DvdCopy;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class RentalController extends BaseController
{
    public function rent(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|uuid|exists:customers,id',
            'dvd_copy_id' => 'required|uuid|exists:dvd_copies,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Request with errors, please fix these errors below.', $validator->errors(), 422);
        }

        $dvdCopy = DvdCopy::findOrFail($request->dvd_copy_id);
        if (!$dvdCopy->available) {
            return $this->sendError('DVD copy is not available for rent.', [], 422);
        }

        UpdateDvdCopyAvailability::dispatch($dvdCopy->id, false);

        $rental = Rental::create([
            'customer_id' => $request->customer_id,
            'dvd_copy_id' => $request->dvd_copy_id,
            'rental_price' => $dvdCopy->dvd->rental_price,
            'rented_at' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(2),
        ]);

        return $this->sendResponse($rental, 'DVD rented successfully.', 201);
    }

    public function return(string $id): JsonResponse
    {
        $rental = Rental::findOrFail($id);
        if ($rental->returned_at) {
            return $this->sendError('This rental has already been returned.', [], 422);
        }

        $rental->update([
            'returned_at' => Carbon::now(),
        ]);

        UpdateDvdCopyAvailability::dispatch($rental->dvd_copy_id, true);

        return $this->sendResponse($rental, 'DVD returned successfully.');
    }
}