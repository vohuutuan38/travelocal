<div align="center">
  <img src="https://github.com/vohuutuan38/traveloka/blob/master/public/clients/images/logos/logo.png" alt="Travelocal Logo" width="200"/>
  <h1 align="center">Travelocal - Nền tảng đặt tour du lịch</h1>
  <p align="center">
    Một dự án website đặt tour du lịch được xây dựng bằng Laravel Framework, giúp kết nối du khách với những chuyến đi tuyệt vời.
  </p>
  
  <p align="center">
    <img src="https://img.shields.io/badge/PHP-8.2%2B-blue?style=for-the-badge&logo=php" alt="PHP Version">
    <img src="https://img.shields.io/badge/Laravel-11.x-orange?style=for-the-badge&logo=laravel" alt="Laravel Version">
    <img src="https://img.shields.io/github/license/your-username/your-repo-name?style=for-the-badge" alt="License">
    <img src="https://img.shields.io/github/stars/your-username/your-repo-name?style=for-the-badge" alt="Stars">
  </p>
</div>

---

## 🚀 Giới thiệu

**Travelocal** là một dự án mã nguồn mở được xây dựng với mục tiêu tạo ra một nền tảng đặt tour du lịch trực tuyến hiện đại, dễ sử dụng và hiệu quả. Người dùng có thể dễ dàng tìm kiếm, xem chi tiết và đặt các tour du lịch. Quản trị viên có một giao diện trực quan để quản lý tour, đơn đặt hàng và người dùng.

🔗 **Link Demo (Nếu có):** [travelocal.yourdomain.com](https://travelocal.yourdomain.com)

---

## ✨ Tính năng nổi bật

* **👨‍💻 Dành cho Khách hàng:**
    * 🔍 **Tìm kiếm & Lọc tour:** Tìm kiếm tour theo điểm đến, ngày đi, mức giá.
    * 📄 **Trang chi tiết tour:** Xem thông tin đầy đủ, lịch trình, hình ảnh và đánh giá.
    * 🛒 **Hệ thống đặt tour:** Quy trình đặt tour và thanh toán đơn giản.
    * 👤 **Quản lý tài khoản:** Xem lại lịch sử đặt tour, quản lý thông tin cá nhân.
    * ⭐ **Đánh giá & Xếp hạng:** Để lại nhận xét và chấm điểm cho các tour đã tham gia.

* **👑 Dành cho Quản trị viên (Admin):**
    * 📊 **Dashboard tổng quan:** Thống kê doanh thu, số lượng tour, đơn đặt hàng.
    * ✈️ **Quản lý Tour:** Thêm, xóa, sửa thông tin các tour du lịch.
    * 📦 **Quản lý Đơn đặt hàng:** Xem và cập nhật trạng thái các đơn đặt tour.
    * 👥 **Quản lý Người dùng:** Quản lý tài khoản khách hàng.

---

## 📸 Hình ảnh & Demo

| Trang chủ                                     | Trang tìm kiếm tour                                 | Trang chi tiết tour                                |
| --------------------------------------------- | --------------------------------------------------- | -------------------------------------------------- |
| ![Trang chủ](https://github.com/vohuutuan38/traveloka/blob/master/public/clients/images/readme/home.png) | ![Trang giới thiệu](https://github.com/vohuutuan38/traveloka/blob/master/public/clients/images/readme/about.png) | ![Trang tour](https://github.com/vohuutuan38/traveloka/blob/master/public/clients/images/readme/tour-list.png) |

*Bạn cũng có thể thêm một ảnh GIF để mô tả quá trình đặt tour tại đây.*

![GIF Demo đặt tour](LINK_ĐẾN_FILE_GIF)

---

## 🛠️ Công nghệ sử dụng

Dự án được xây dựng trên các công nghệ và nền tảng hàng đầu:

* **Backend:** PHP 8.2, Laravel 10
* **Frontend:** Blade, Tailwind CSS, Alpine.js
* **Cơ sở dữ liệu:** MySQL
* **Công cụ:** Vite, Composer, Git

---

## ⚙️ Hướng dẫn cài đặt

Để chạy dự án này trên máy cục bộ của bạn, hãy làm theo các bước sau:

1.  **Clone repository**
    ```bash
    git clone [https://github.com/your-username/your-repo-name.git](https://github.com/your-username/your-repo-name.git)
    cd your-repo-name
    ```

2.  **Cài đặt các gói phụ thuộc**
    ```bash
    composer install
    npm install
    ```

3.  **Cấu hình môi trường**
    * Sao chép file `.env.example` thành `.env`.
    ```bash
    cp .env.example .env
    ```
    * Mở file `.env` và cấu hình thông tin kết nối cơ sở dữ liệu (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

4.  **Tạo khóa ứng dụng**
    ```bash
    php artisan key:generate
    ```

5.  **Chạy file travelocal.sql trên xampp (để tạo cơ sở dữ liệu)**
    ```bash
    travelocal.sql
    ```

7.  **Khởi động server**
    ```bash
    php artisan serve
    ```

Bây giờ bạn có thể truy cập dự án tại địa chỉ `http://127.0.0.1:8000`.

---

## 👤 Tài khoản Admin mặc định

Nếu bạn đã chạy seeder, bạn có thể đăng nhập bằng tài khoản sau:

* **Email:** `admin@example.com`
* **Mật khẩu:** `password`

---

## 🤝 Đóng góp

Sự đóng góp của bạn làm cho cộng đồng mã nguồn mở trở nên tuyệt vời. Mọi đóng góp bạn thực hiện đều được **đánh giá cao**.

1.  Fork dự án
2.  Tạo một Branch mới (`git checkout -b feature/AmazingFeature`)
3.  Commit những thay đổi của bạn (`git commit -m 'Add some AmazingFeature'`)
4.  Push lên Branch (`git push origin feature/AmazingFeature`)
5.  Mở một Pull Request

---

## 📜 Bản quyền

Dự án này được cấp phép theo Giấy phép MIT. Xem file `LICENSE` để biết thêm chi tiết.

---

<div align="center">
  Made with ❤️ by Vohuutuan
</div>