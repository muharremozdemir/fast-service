<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Kod Yazdırma - Toplu</title>
    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none !important;
            }
            .page-break {
                page-break-after: always;
            }
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f5f5f5;
        }

        .print-container {
            background: white;
            padding: 15px;
            max-width: 210mm;
            width: 100%;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            box-sizing: border-box;
        }

        .qr-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin-bottom: 15px;
            width: 100%;
            box-sizing: border-box;
        }

        .qr-item {
            text-align: center;
            padding: 5px;
            border: 1px dashed #ddd;
            page-break-inside: avoid;
            box-sizing: border-box;
            align-items: center;
            min-height: 0;
        }

        .qr-code {
            width: 100%;
            max-width: 100%;
            height: auto;
            margin: 0 auto 5px;
            display: block;
            box-sizing: border-box;
        }

        .qr-code svg {
            width: 100% !important;
            height: auto !important;
            max-width: 100%;
        }

        .qr-room-number {
            font-weight: bold;
            font-size: 12px;
            margin-bottom: 2px;
            color: #333;
            line-height: 1.2;
        }

        .qr-room-name {
            font-size: 9px;
            color: #666;
            margin-bottom: 1px;
            line-height: 1.2;
        }

        .qr-floor {
            font-size: 8px;
            color: #999;
            line-height: 1.2;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #333;
        }

        .header-left {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            max-width: 50%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .header-right {
            font-size: 12px;
            color: #666;
            text-align: right;
        }

        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #007bff;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            z-index: 1000;
        }

        .print-button:hover {
            background: #0056b3;
        }

        .back-button {
            position: fixed;
            top: 20px;
            left: 20px;
            background: #6c757d;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            z-index: 1000;
            text-decoration: none;
            display: inline-block;
        }

        .back-button:hover {
            background: #5a6268;
            color: white;
            text-decoration: none;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .print-button,
            .back-button {
                display: none;
            }
            .print-container {
                box-shadow: none;
                padding: 8mm;
                max-width: 100%;
                width: 100%;
            }
            .qr-grid {
                gap: 6px;
            }
            .qr-item {
                padding: 4px;
            }
            .header {
                margin-bottom: 10px;
                padding-bottom: 8px;
            }
            .header-left {
                font-size: 18px;
                max-width: 50%;
            }
            .header-right {
                font-size: 11px;
            }
        }

        @page {
            size: A4;
            margin: 8mm;
        }
    </style>
</head>
<body>
    <button class="print-button no-print" onclick="window.print()">
        <i class="fas fa-print"></i> Yazdır
    </button>
    <a href="{{ route('admin.rooms.index') }}" class="back-button no-print">
        <i class="fas fa-arrow-left"></i> Geri Dön
    </a>

    <div class="print-container">
        <div class="header">
            <div class="header-left">
                @if($company)
                    {{ $company->name }} - QR Kod Etiketleri
                @else
                    QR Kod Etiketleri
                @endif
            </div>
            <div class="header-right">
                Toplam {{ count($qrCodes) }} Oda - {{ date('d.m.Y H:i') }}
            </div>
        </div>

        <div class="qr-grid">
            @foreach($qrCodes as $index => $item)
                <div class="qr-item">
                    <div class="qr-code">
                        {!! $item['qrCode'] !!}
                    </div>
                    <div class="qr-room-number">{{ $item['room']->room_number }}</div>
                    @if($item['room']->name)
                        <div class="qr-room-name">{{ $item['room']->name }}</div>
                    @endif
                    @if($item['room']->floor)
                        <div class="qr-floor">{{ $item['room']->floor->name }}</div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</body>
</html>

