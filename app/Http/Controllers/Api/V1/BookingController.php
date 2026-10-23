<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\BookingCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Book;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(StoreBookingRequest $request, Book $book, BookingService $bookingService)
    {
        $booking = $bookingService->createBooking($request->user(), $book, $request->validated());

        event(new BookingCreated($booking));

        return (new BookingResource($booking))
            ->response()
            ->setStatusCode(201);
    }

    public function myBookings(Request $request)
    {
        $bookings = $request->user()
            ->bookings()
            ->with('book')
            ->latest()
            ->paginate(10);

        return BookingResource::collection($bookings);
    }
}