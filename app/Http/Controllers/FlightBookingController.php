<?php

namespace App\Http\Controllers;

use App\Models\FlightBooking;
use App\Models\Destination;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FlightBookingController extends Controller

{
public function store(Request $request)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'departure_date' => 'required|date',
            'return_date'    => 'nullable|date|after_or_equal:departure_date',
            'passengers'     => 'required|integer|min:1',
        ]);

        $destination = Destination::findOrFail($request->destination_id);

        $basePrice = $destination->price * $request->passengers;
        
        $isRoundTrip = !empty($request->return_date);
        $finalPrice = $isRoundTrip ? ($basePrice * 1.8) : $basePrice;

        $fila = rand(1, 30);
        $letras = ['A', 'B', 'C', 'D', 'E', 'F'];
        $asientoAleatorio = $fila . $letras[array_rand($letras)];

        $tipoVuelo = $isRoundTrip ? 'roundtrip' : 'outbound';

        $flight = FlightBooking::create([
            'user_id'        => auth()->id(),
            'destination_id' => $request->destination_id,
            'departure_date' => $request->departure_date,
            'return_date'    => $request->return_date,
            'price'          => $finalPrice,
            'people_count'   => $request->passengers,  
            'type'           => $tipoVuelo,            
            'airline_name'   => 'SkyTravel Airlines',
            'seat_number'    => $asientoAleatorio,
            'status'         => 'confirmed'
        ]);

        return response()->json([
            'message' => '¡Vuelo reservado con éxito!', 
            'flight' => $flight
        ], 201);
    }

    public function myFlights()
    {
        return response()->json(
            FlightBooking::where('user_id', auth()->id())
                ->with('destination')
                ->orderBy('departure_date', 'asc')
                ->get()
        );
    }

    public function destroy($id)
    {
        $flightBooking = FlightBooking::where('user_id', auth()->id())->find($id);

        if (!$flightBooking) {
            return response()->json(['message' => 'Reserva de vuelo no encontrada'], 404);
        }

        $flightBooking->delete();
        return response()->json(['message' => 'Vuelo cancelado correctamente'], 200);
    }

    public function downloadTicket($id)
    {
        $flight = FlightBooking::with('destination')->where('user_id', auth()->id())->findOrFail($id);
        $user = auth()->user();

        $pdf = Pdf::loadView('pdf.ticket', [
            'flight' => $flight,
            'user' => $user
        ]);

        return $pdf->download("ticket-vuelo-{$id}.pdf");
    }
}