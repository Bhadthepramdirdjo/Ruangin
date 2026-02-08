<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Disetujui - Ruangin</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        .badge-approved {
            display: inline-block;
            background-color: #10b981;
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
            margin-bottom: 30px;
        }
        .greeting strong {
            color: #667eea;
        }
        .info-section {
            background-color: #f9fafb;
            border-left: 4px solid #667eea;
            padding: 25px;
            margin: 20px 0;
            border-radius: 8px;
        }
        .info-section h3 {
            margin: 0 0 20px 0;
            color: #667eea;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .info-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            padding: 15px 0;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 0;
        }
        .info-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .info-label {
            font-weight: 700;
            color: #475569;
            flex: 0 0 40%;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }
        .info-value {
            color: #1e293b;
            flex: 1;
            text-align: left;
            font-size: 15px;
            font-weight: 500;
            word-break: break-word;
        }
        .cta-button {
            display: inline-block;
            background-color: #667eea;
            color: white;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            margin: 30px 0;
            transition: background-color 0.3s;
        }
        .cta-button:hover {
            background-color: #5a67d8;
        }
        .important-note {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 5px;
            color: #92400e;
            font-size: 14px;
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
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>✅ Booking Disetujui!</h1>
            <p>Ruangin - Sistem Booking Ruangan</p>
            <div class="badge-approved">Status: Disetujui</div>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Halo <strong>{{ $userName }}</strong>,
            </div>

            <p>
                Selamat! Booking ruangan Anda telah <strong style="color: #10b981;">DISETUJUI</strong> oleh administrator sistem Ruangin.
                Silakan persiapkan segala kebutuhan Anda untuk menggunakan ruangan sesuai dengan jadwal yang telah ditentukan.
            </p>

            <!-- Booking Details -->
            <div class="info-section">
                <h3>📋 Detail Booking Anda</h3>
                <div class="info-row">
                    <div>
                        <div class="info-label">Nama Ruangan</div>
                        <div class="info-value"><strong>{{ $ruangan->nama_ruangan }}</strong></div>
                    </div>
                    <div>
                        <div class="info-label">Kode Ruangan</div>
                        <div class="info-value">{{ $ruangan->kode }}</div>
                    </div>
                </div>
                <div class="info-row">
                    <div>
                        <div class="info-label">Kapasitas</div>
                        <div class="info-value">{{ $ruangan->kapasitas }} orang</div>
                    </div>
                    <div>
                        <div class="info-label">Tipe Ruangan</div>
                        <div class="info-value">{{ ucfirst($ruangan->tipe) }}</div>
                    </div>
                </div>
                <div class="info-row">
                    <div>
                        <div class="info-label">Tanggal Booking</div>
                        <div class="info-value"><strong>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</strong></div>
                    </div>
                    <div>
                        <div class="info-label">Jam Peminjaman</div>
                        <div class="info-value"><strong>{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</strong></div>
                    </div>
                </div>
                <div class="info-row">
                    <div>
                        <div class="info-label">Keperluan</div>
                        <div class="info-value">{{ $booking->keperluan }}</div>
                    </div>
                </div>
            </div>

            <!-- Important Note -->
            <div class="important-note">
                ⏰ <strong>Penting:</strong> Harap datang tepat waktu sesuai dengan jadwal yang telah ditentukan.
                Jika terjadi perubahan atau pembatalan, segera informasikan kepada administrator.
            </div>

            <!-- CTA Button -->
            <div style="text-align: center;">
                <a href="{{ $bookingUrl }}" class="cta-button">Lihat Detail Lengkap</a>
            </div>

            <div class="divider"></div>

            <p style="color: #666; font-size: 14px;">
                Jika Anda memiliki pertanyaan atau memerlukan bantuan, silakan hubungi tim support kami.
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
