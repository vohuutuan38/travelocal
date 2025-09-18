<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Chào mừng</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f9;
      margin: 0;
      padding: 0;
      color: #333;
    }

    .email-container {
      max-width: 850px;
      margin: 20px auto;
      background: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      border: 1px solid #e0e0e0;
    }

    .email-header {
      background: #0099ff;
      color: #fff;
      text-align: center;
      padding: 30px 20px;
    }

    .email-header h1 {
      margin: 0;
      font-size: 22px;
    }

    .email-body {
      padding: 25px 20px;
      text-align: center;
    }

    .username {
      display: inline-block;
      color: #0099ff;
      border-radius: 20px;
      font-weight: bold;
    }

    .success-box {
      background: #e6f9f0;
      color: #2f855a;
      padding: 12px;
      border-radius: 6px;
      margin: 20px 0;
      font-weight: 500;
    }

    .cta-button {
      display: inline-block;
      background: #0099ff;
      color: #fff !important;
      padding: 12px 25px;
      border-radius: 25px;
      text-decoration: none;
      font-weight: bold;
      margin-top: 15px;
    }

    .cta-button:hover {
      background: #007acc;
    }

    .footer {
      background: #f7f7f7;
      text-align: center;
      padding: 20px;
      font-size: 13px;
      color: #666;
      border-top: 1px solid #e0e0e0;
    }

    .footer a {
      color: #0099ff;
      margin: 0 6px;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="email-container">
    <!-- Header -->
    <div class="email-header">
      <h1>🎉 Chào mừng đến với Traveloka!</h1>
      <p style="color: black">Tài khoản của bạn đã được tạo thành công</p>
    </div>

    <!-- Body -->
    <div class="email-body">
      <h2>Xin chào, <span class="username">{{ $user->userName }}</span></h2>
     

      <div class="success-box">
        ✔ Chúc mừng! Bạn đã đăng ký tài khoản thành công.
      </div>

      <p><strong>Email đăng ký:</strong><br>{{ $user->email }}</p>

      <a href="#" class="cta-button">✈ Khám phá tour ngay</a>

      <p style="margin-top:20px; font-size:14px; color:#555;">
        ❤️ Cảm ơn bạn đã tin tưởng và lựa chọn <b>Traveloka</b>!  
        Nếu có bất kỳ câu hỏi nào, đừng ngần ngại liên hệ với chúng tôi.
      </p>
    </div>

    <!-- Footer -->
    <div class="footer">
      <p>Cảm ơn bạn đã gia nhập cộng đồng Traveloka.<br>
      Chúng tôi cam kết mang đến cho bạn những trải nghiệm du lịch tuyệt vời nhất.</p>
      <p>
        <a href="#">Facebook</a> | 
        <a href="#">Instagram</a> | 
        <a href="#">YouTube</a>
      </p>
    </div>
  </div>
</body>
</html>
