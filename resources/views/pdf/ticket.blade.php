<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Flight reservation ticket - {{ $flight->id }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #1e293b; line-height: 1.5; margin: 0; padding: 0; }
        .ticket-box {
            border: 2px solid #2563eb;
            border-radius: 15px;
            padding: 30px;
            max-width: 700px;
            margin: 40px auto;
            position: relative;
            background-color: #ffffff;
        }
        .type-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #2563eb;
            color: white;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header {
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 20px;
            margin-bottom: 25px;
            text-align: left;
        }
        .header h1 { color: #1e40af; margin: 0; font-size: 28px; font-weight: 800; }
        .header p { margin: 5px 0 0 0; font-size: 14px; color: #64748b; }

        .route-display {
            background: #eff6ff;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            text-align: center;
            border: 1px solid #dbeafe;
        }
        .route-city { font-size: 22px; font-weight: 900; color: #1e3a8a; text-transform: uppercase; }
        .route-arrow { color: #3b82f6; margin: 0 15px; font-size: 20px; }

        .info-grid { width: 100%; border-collapse: collapse; }
        .info-grid td { padding: 15px 10px; width: 50%; vertical-align: top; }
        .info-label { font-size: 11px; color: #94a3b8; text-transform: uppercase; font-weight: bold; margin-bottom: 5px; }
        .info-value { font-size: 17px; font-weight: bold; color: #0f172a; }

        .highlight-box {
            background-color: #f8fafc;
            border-left: 4px solid #2563eb;
            padding: 15px;
            margin-top: 10px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            border-top: 1px solid #f1f5f9;
            padding-top: 20px;
        }
        .barcode {
            margin-top: 15px;
            font-family: 'Courier', monospace;
            letter-spacing: 5px;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="ticket-box">
        <div class="type-badge">
            {{ $flight->return_date ? 'Round trip' : 'One way' }}
        </div>

        <div class="header">
            <h1 class="">Travel Agency</h1>
            <p>Flight reservation #{{ str_pad($flight->id, 6, "0", STR_PAD_LEFT) }}</p>
        </div>

        <div class="route-display">
            <span class="route-city">Madrid (MAD)</span>
            <span class="route-arrow">{{ $flight->return_date ? 'to' : 'to' }}</span>
            <span class="route-city">{{ $flight->destination->name }}</span>
        </div>

        <table class="info-grid">
            <tr>
                <td>
                    <div class="info-label">Main passenger</div>
                    <div class="info-value">{{ $user->firstname }} {{ $user->surname }}</div>
                </td>
                <td>
                    <div class="info-label">Number of passengers</div>
                    <div class="info-value">{{ $flight->people_count }} {{ $flight->people_count > 1 ? 'People' : 'Person' }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="info-label">Departure date</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($flight->departure_date)->format('d/m/Y') }}</div>
                </td>
                <td>
                    <div class="info-label">Return date</div>
                    <div class="info-value">
                        @if($flight->return_date)
                            {{ \Carbon\Carbon::parse($flight->return_date)->format('d/m/Y') }}
                        @else
                            <span style="color: #cbd5e1; font-style: italic;">No aplica</span>
                        @endif
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="info-label">Airline</div>
                    <div class="info-value">{{ $flight->airline_name ?? 'Iberojet' }}</div>
                </td>
                <td>
                    <div class="info-label">Seat number</div>
                    <div class="info-value" style="color: #2563eb;">{{ $flight->seat_number }}</div>
                </td>
            </tr>
        </table>

        <div class="highlight-box">
            <table width="100%">
                <tr>
                    <td style="font-size: 12px; color: #64748b;">Reservation status: <strong>{{ strtoupper($flight->status) }}</strong></td>
                    <td style="text-align: right; font-size: 18px; font-weight: bold; color: #1e3a8a;">Price: {{ number_format($flight->price, 2) }}€</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p><strong>Warning:</strong> You must be in the counter at least two hours before of the departure date.</p>
            <p>This document is a travel confirmation.</p>
            <div class="barcode">||||| {{ $flight->user_id }}-{{ $flight->id }}-{{ $flight->destination_id }} |||||</div>
            <p style="margin-top: 15px;"><em>Thank you for trust in Travel Agency for your next adventure!</em></p>
        </div>
    </div>
</body>
</html>.