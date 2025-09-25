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


// booking page js
document.addEventListener("DOMContentLoaded", () => {
  // Lấy giá từ tour data (cần truyền từ Laravel)
  const priceAdult = Number.parseFloat(document.querySelector("[data-price-adult]")?.dataset.priceAdult || 0)
  const priceChild = Number.parseFloat(document.querySelector("[data-price-child]")?.dataset.priceChild || 0)

  // Lấy các elements
  const numAdultsInput = document.getElementById("numAdults")
  const numChildrenInput = document.getElementById("numChildren")
  const quantityAdultsDisplay = document.querySelector(".quantity_adults")
  const quantityChildrenDisplay = document.querySelector(".quantity_children")
  const agreeCheckbox = document.getElementById("agree")
  const submitButton = document.querySelector('.booking-btn[type="submit"]')
  const officePaymentRadio = document.querySelector('input[value="office-payment"]')

  // Disable các phương thức thanh toán khác
  const otherPaymentMethods = document.querySelectorAll('input[name="payment"]:not([value="office-payment"])')
  otherPaymentMethods.forEach((method) => {
    method.disabled = true
    method.closest(".payment-option").style.opacity = "0.5"
    method.closest(".payment-option").style.pointerEvents = "none"
  })

  // Mặc định chọn thanh toán tại văn phòng
  if (officePaymentRadio) {
    officePaymentRadio.checked = true
  }

  // Xử lý nút cộng/trừ
  const quantityButtons = document.querySelectorAll(".quantity-btn")

  quantityButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const input = this.parentElement.querySelector(".quantity-input")
      const isIncrement = this.textContent === "+"
      const isDecrement = this.textContent === "-"

      let currentValue = Number.parseInt(input.value)
      const minValue = Number.parseInt(input.getAttribute("min"))

      if (isIncrement) {
        currentValue++
      } else if (isDecrement && currentValue > minValue) {
        currentValue--
      }

      input.value = currentValue
      updateSummary()
    })
  })

  // Cập nhật tóm tắt đơn hàng
  function updateSummary() {
    const numAdults = Number.parseInt(numAdultsInput.value)
    const numChildren = Number.parseInt(numChildrenInput.value)

    // Cập nhật số lượng hiển thị
    quantityAdultsDisplay.textContent = numAdults
    quantityChildrenDisplay.textContent = numChildren

    // Tính toán giá
    const adultTotal = numAdults * priceAdult
    const childTotal = numChildren * priceChild
    const totalPrice = adultTotal + childTotal

    // Cập nhật giá hiển thị
    const summaryItems = document.querySelectorAll(".summary-item")

    // Cập nhật giá người lớn
    const adultPriceElement = summaryItems[0].querySelector(".total-price")
    if (adultPriceElement) {
      adultPriceElement.textContent = formatPrice(adultTotal) + " VNĐ"
    }

    // Cập nhật giá trẻ em
    const childPriceElement = summaryItems[1].querySelector(".total-price")
    if (childPriceElement) {
      childPriceElement.textContent = formatPrice(childTotal) + " VNĐ"
    }

    // Cập nhật tổng cộng
    const totalPriceElement = document.querySelector(".summary-item.total-price span:last-child")
    if (totalPriceElement) {
      totalPriceElement.textContent = formatPrice(totalPrice) + " VNĐ"
    }

    // Cập nhật hidden inputs cho form submit
    updateHiddenInputs(numAdults, numChildren, totalPrice)
  }

  // Tạo hidden inputs để gửi dữ liệu
  function updateHiddenInputs(numAdults, numChildren, totalPrice) {
    // Xóa các hidden inputs cũ
    const oldInputs = document.querySelectorAll(
      'input[name="numAdults"], input[name="numChildren"], input[name="totalPrice"]',
    )
    oldInputs.forEach((input) => input.remove())

    // Tạo hidden inputs mới
    const form = document.querySelector(".booking-container")

    const adultInput = document.createElement("input")
    adultInput.type = "hidden"
    adultInput.name = "numAdults"
    adultInput.value = numAdults
    form.appendChild(adultInput)

    const childInput = document.createElement("input")
    childInput.type = "hidden"
    childInput.name = "numChildren"
    childInput.value = numChildren
    form.appendChild(childInput)

    const priceInput = document.createElement("input")
    priceInput.type = "hidden"
    priceInput.name = "totalPrice"
    priceInput.value = totalPrice
    form.appendChild(priceInput)
  }

  // Format giá tiền
  function formatPrice(price) {
    return new Intl.NumberFormat("vi-VN").format(price)
  }

  // Validation checkbox và enable/disable submit button
  function toggleSubmitButton() {
    const isAgreed = agreeCheckbox.checked
    const isPaymentSelected = document.querySelector('input[name="payment"]:checked')

    if (isAgreed && isPaymentSelected) {
      submitButton.disabled = false
      submitButton.style.opacity = "1"
      submitButton.style.cursor = "pointer"
    } else {
      submitButton.disabled = true
      submitButton.style.opacity = "0.5"
      submitButton.style.cursor = "not-allowed"
    }
  }

  // Event listeners cho validation
  agreeCheckbox.addEventListener("change", toggleSubmitButton)

  const paymentRadios = document.querySelectorAll('input[name="payment"]')
  paymentRadios.forEach((radio) => {
    radio.addEventListener("change", toggleSubmitButton)
  })

  // Xử lý submit form
  const form = document.querySelector(".booking-container")
  form.addEventListener("submit", (e) => {
    if (!agreeCheckbox.checked) {
      e.preventDefault()
      alert("Vui lòng đồng ý với điều khoản thanh toán để tiếp tục!")
      return false
    }

    const selectedPayment = document.querySelector('input[name="payment"]:checked')
    if (!selectedPayment) {
      e.preventDefault()
      alert("Vui lòng chọn phương thức thanh toán!")
      return false
    }

    // Hiển thị loading
    submitButton.textContent = "Đang xử lý..."
    submitButton.disabled = true
  })

  // Khởi tạo
  toggleSubmitButton()
  updateSummary()
})

