<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ mới từ khách hàng - Travelocal</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, sans-serif; background-color: #f8fafc; margin: 0; padding: 30px;">
    <div style="max-width: 600px; background: #fff; margin: auto; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.08); overflow: hidden;">
        
        <!-- Header -->
        <div style="background: linear-gradient(90deg, #00bcd4, #2196f3); padding: 20px 30px; text-align: center;">
           
            <h2 style="color: #fff; margin-top: 10px; font-size: 22px;">Thư Liên Hệ Mới</h2>
        </div>

        <!-- Body -->
        <div style="padding: 25px 30px;">
            <p style="font-size: 16px; color: #333;">Xin chào Quản trị viên,</p>
            <p style="font-size: 15px; color: #555;">Bạn có một thư liên hệ mới từ khách hàng trên website <strong>Travelocal</strong>. Dưới đây là thông tin chi tiết:</p>

            <div style="background-color: #f3f8ff; padding: 15px 20px; border-left: 4px solid #2196f3; border-radius: 8px; margin: 20px 0;">
                <p style="margin: 8px 0; font-size: 15px;"><strong>👤 Họ và tên:</strong> {{ $data['name'] }}</p>
                <p style="margin: 8px 0; font-size: 15px;"><strong>📧 Email:</strong> {{ $data['email'] }}</p>
                <p style="margin: 8px 0; font-size: 15px;"><strong>📞 Số điện thoại:</strong> {{ $data['phone_number'] }}</p>
            </div>

            <h3 style="color: #333; font-size: 17px;">📝 Nội dung tin nhắn:</h3>
            <div style="background-color: #fff6e5; padding: 15px 20px; border: 1px solid #ffd08a; border-radius: 8px; color: #444; line-height: 1.6;">
                {{ $data['message'] }}
            </div>
        </div>

        <!-- Footer -->
        <div style="background-color: #f3f3f3; padding: 15px 30px; text-align: center; font-size: 13px; color: #888;">
            <p>© {{ date('Y') }} <strong>Travelocal</strong>. Tất cả các quyền được bảo lưu.</p>
            <p>Website: <a href="{{ url('/') }}" style="color: #2196f3; text-decoration: none;">{{ url('/') }}</a></p>
        </div>
    </div>
</body>
</html>
