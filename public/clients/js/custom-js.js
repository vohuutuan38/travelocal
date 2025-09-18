$(document).ready(function () {
    $("#sign-in").click(function () {
        $(".sign-in").hide();
        $(".signup").show(1500);
    });

    $("#sign-up").click(function () {
        $(".sign-in").show(1500);
        $(".signup").hide();
    });

    $("#start_date , #end_date").datetimepicker({
        format: "d/m/Y",

        timepicker: false,
    });

    $("#userDropdown").click(function () {
        $("#dropdownMenu").toggle(500);
    });

    // validate đăng nhập
    $("#login-form").on("submit", function (e) {
        e.preventDefault(); // chặn gửi form mặc định

        let isValid = true;
        console.log(1);

        let username = $("#email_login").val().trim();
        let password = $("#password_login").val().trim();

        // Reset lỗi
        $("#email_login").removeClass("is-invalid");
        $("#password_login").removeClass("is-invalid");
        $("#validate_email").text("");
        $("#validate_password").text("");

        // Validate username
        if (username === "") {
            $("#email_login").addClass("is-invalid");
            $("#validate_email").text("Vui lòng nhập tên đăng nhập!");
            isValid = false;
        }

        // Validate password
        if (password === "") {
            $("#password_login").addClass("is-invalid");
            $("#validate_password").text("Vui lòng nhập mật khẩu!");
            isValid = false;
        } else if (password.length < 6) {
            $("#password_login").addClass("is-invalid");
            $("#validate_password").text("Mật khẩu phải có ít nhất 6 ký tự!");
            isValid = false;
        }

        // Nếu hợp lệ thì submit form
        if (isValid) {
            this.submit();
        }
    });

    // validate đăng ký

    $("#register-form").on("submit", function (e) {
        e.preventDefault(); // Ngăn submit mặc định

        let isValid = true;

        // Reset lỗi cũ
        $(".invalid-feedback-register").text("");
        $("input").removeClass("is-invalid");

        // Lấy giá trị
        let username = $("#user_name").val().trim();
        let email = $("#email").val().trim();
        let password = $("#password").val();
        let re_password = $("#re_password").val();

        // Validate username
        if (username === "") {
            $("#validate_username_register").text(
                "Vui lòng nhập tên đăng nhập"
            );
            $("#user_name").addClass("is-invalid");
            isValid = false;
        } else if (username.length < 3) {
            $("#validate_username_register").text(
                "Tên đăng nhập phải >= 3 ký tự"
            );
            $("#user_name").addClass("is-invalid");
            isValid = false;
        }

        // Validate email
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === "") {
            $("#validate_email_register").text("Vui lòng nhập email");
            $("#email").addClass("is-invalid");
            isValid = false;
        } else if (!emailPattern.test(email)) {
            $("#validate_email_register").text("Email không hợp lệ");
            $("#email").addClass("is-invalid");
            isValid = false;
        }

        // Validate password
        if (password === "") {
            $("#validate_password_register").text("Vui lòng nhập mật khẩu");
            $("#password").addClass("is-invalid");
            isValid = false;
        } else if (password.length < 6) {
            $("#validate_password_register").text("Mật khẩu phải >= 6 ký tự");
            $("#password").addClass("is-invalid");
            isValid = false;
        }

        // Validate repeat password
        if (re_password === "") {
            $("#validate_re_password_register").text(
                "Vui lòng nhập lại mật khẩu"
            );
            $("#re_password").addClass("is-invalid");
            isValid = false;
        } else if (re_password !== password) {
            $("#validate_re_password_register").text(
                "Mật khẩu nhập lại không khớp"
            );
            $("#re_password").addClass("is-invalid");
            isValid = false;
        }

        // Nếu hợp lệ thì submit
        if (isValid) {
            this.submit();
        }
    });



// check email tồn tại
 $('#email').on('blur', function() {
    let email = $(this).val();
    if(email !== '') {
        $.post(checkEmailUrl, {
            email: email,
            _token: csrfToken
        }, function(res) {
            if(res.exists) {
                $('#validate_email_register').text('Email đã tồn tại!');
            } else {
                $('#validate_email_register').text('');
            }
        });
    }
});


setTimeout(() => {
    let alert = document.getElementById("flash-message");
    if (alert) {
        alert.classList.add("hide"); // chạy animation slideOut
        setTimeout(() => {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 500); // đợi animation xong
    }
}, 3000);

    
});

document.addEventListener("DOMContentLoaded", () => {
    let alert = document.getElementById("flash-message");
    if (alert) {
        // khi load xong, thêm class để chạy slideIn
        setTimeout(() => {
            alert.classList.add("showing");
        }, 300); // delay 100ms cho dễ nhìn

        // sau 3s thì chạy slideOut
        setTimeout(() => {
            alert.classList.remove("showing");
            alert.classList.add("hiding");

            // chờ animation xong rồi close
            setTimeout(() => {
                let bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 500); 
        }, 3000);
    }
});

