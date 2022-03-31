<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Phản hồi của chúng tôi - {{ config('app.name', 'CameraStore') }}</title>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }
            p {
                margin-top: 3px;
                margin-bottom: 3px;
            }
        </style>
    </head>
    <body>
        <p>Xin chào {{ $lienhe->hovaten }}!</p>
        <p>Xin cảm ơn bạn đã gửi phản hồi {{ config('app.name', 'CameraStore') }}.</p>
        <p>Phản hồi của bạn:</p>
        <p>- Nội dung: <strong>{{ $lienhe->noidung }}</strong></p>
        <p>Chúng tôi phẩn hồi:</p>
        <p>{{ $lienhe->phanhoi }}</p>
     

        <p>Trân trọng,</p>
        <p>{{ config('app.name', 'CameraStore') }}</p>
    </body>
</html>
