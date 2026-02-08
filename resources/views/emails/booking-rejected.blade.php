<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Ditolak - Ruangin</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        .header p {
            margin: 10px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .badge-rejected {
            display: inline-block;
            background-color: #dc2626;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-top: 10px;
        }
        .content {
            padding: 40px;
        }
        .greeting {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .greeting strong {
            color: #ef4444;
        }
        .message-box {
            background-color: #fef2f2;
            border-left: 4px solid #ef4444;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .message-box p {
            margin: 0;
            color: #7f1d1d;
            font-size: 15px;
        }
        .info-section {
            background-color: #f9fafb;
            border-left: 4px solid #f59e0b;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .info-section h3 {
            margin: 0 0 15px 0;
            color: #f59e0b;
            font-size: 16px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
            align-items: center;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: 700;
            color: #475569;
            flex: 0 0 40%;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .info-value {
            color: #1e293b;
            flex: 1;
            text-align: right;
            font-size: 15px;
            font-weight: 500;
        }
        .reason-box {
            background-color: #fef3c7;
            border-left: 4px solid #d97706;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .reason-box h4 {
            margin: 0 0 10px 0;
            color: #92400e;
            font-size: 15px;
        }
        .reason-box p {
            margin: 0;
            color: #78350f;
            font-size: 14px;
            font-style: italic;
        }
        .support-section {
            background-color: #e0f2fe;
            border-left: 4px solid #0284c7;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .support-section h4 {
            margin: 0 0 10px 0;
            color: #0c4a6e;
            font-size: 15px;
        }
        .support-section p {
            margin: 5px 0;
            color: #0c4a6e;
            font-size: 14px;
        }
        .cta-button {
            display: inline-block;
            background-color: #0284c7;
            color: white;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            margin: 20px 0;
            transition: background-color 0.3s;
        }
        .cta-button:hover {
            background-color: #0369a1;
        }
        .secondary-button {
            display: inline-block;
            background-color: #f59e0b;
            color: white;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            margin: 20px 10px 20px 0;
            transition: background-color 0.3s;
        }
        .secondary-button:hover {
            background-color: #d97706;
        }
        .footer {
            background-color: #f3f4f6;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #e5e7eb;
        }
        .divider {
            height: 1px;
            background-color: #e5e7eb;
            margin: 20px 0;
        }
        .positive-note {
            color: #666;
            font-size: 14px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>❌ Booking Ditolak</h1>
            <p>Ruangin - Sistem Booking Ruangan</p>
            <div class="badge-rejected">Status: Ditolak</div>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Halo <strong>{{ $userName }}</strong>,
            </div>

            <!-- Main Message -->
            <div class="message-box">
                <p>
                    Mohon maaf, booking ruangan Anda telah <strong>ditolak</strong> oleh administrator sistem Ruangin.
                    Kami memahami kekecewaan ini dan siap membantu Anda membuat booking baru.
                </p>
            </div>

            <!-- Booking Details -->
            <div class="info-section">
                <h3>📋 Detail Booking yang Ditolak</h3>
                <div class="info-row">
                    <div class="info-label">Nama Ruangan</div>
                    <div class="info-value"><strong>{{ $ruangan->nama_ruangan }}</strong></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Kode Ruangan</div>
                    <div class="info-value">{{ $ruangan->kode }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal Booking</div>
                    <div class="info-value"><strong>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</strong></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Jam Peminjaman</div>
                    <div class="info-value"><strong>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</strong></div>
                </div>
            </div>

            <!-- Reason (if provided) -->
            @if($reason)
            <div class="reason-box">
                <h4>📝 Alasan Penolakan:</h4>
                <p>{{ $reason }}</p>
            </div>
            @endif

            <!-- Support Section -->
            <div class="support-section">
                <h4>💡 Langkah Selanjutnya</h4>
                <p>✓ Periksa ketersediaan ruangan pada tanggal dan jam yang berbeda</p>
                <p>✓ Hubungi administrator jika memerlukan penjelasan lebih detail</p>
                <p>✓ Buat booking baru dengan detail yang telah disesuaikan</p>
            </div>

            <!-- CTA Buttons -->
            <div style="text-align: center;">
                <a href="{{ $bookingCreateUrl }}" class="secondary-button">📅 Buat Booking Baru</a>
            </div>

            <div class="divider"></div>

            <p class="positive-note" style="text-align: center;">
                Kami berharap dapat melayani Anda dengan booking berikutnya. <br>
                Jangan ragu untuk menghubungi kami jika ada yang dapat kami bantu.
            </p>

            <p style="color: #666; font-size: 14px; margin-top: 20px;">
                Terima kasih telah menggunakan <strong>Sistem Ruangin</strong> 🙏
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Email ini dikirim dari sistem Ruangin. Harap jangan reply email ini.</p>
            <p>&copy; {{ date('Y') }} Ruangin - Sistem Booking Ruangan. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
