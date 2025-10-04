// thông báo tự động đóng
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



// custom form thêm tour
document.addEventListener('DOMContentLoaded', function() {
    let activityIndex = 1;

    document.querySelector('#activities-wrapper').addEventListener('click', function(e) {
        if (e.target.closest('.add-activity')) {
            e.preventDefault();

            const wrapper = document.getElementById('activities-wrapper');

            const newRow = document.createElement('div');
            newRow.classList.add('d-flex', 'mb-2', 'activity-item');
            newRow.innerHTML = `
                <input type="text" name="activities[${activityIndex}][name]" placeholder="Tên hoạt động" class="form-control me-2">
                <input type="text" name="activities[${activityIndex}][icon]" placeholder="Icon flaticon" class="form-control me-2">
                <button type="button" class="btn btn-danger remove-activity"><i class="fas fa-minus"></i></button>
            `;
            wrapper.appendChild(newRow);
            activityIndex++;
        }

        // Xóa hoạt động
        if (e.target.closest('.remove-activity')) {
            e.preventDefault();
            e.target.closest('.activity-item').remove();
        }
    });
});

// thêm ảnh

  document.addEventListener('DOMContentLoaded', function() {
        const imageInputs = document.querySelectorAll('.image-input');

        imageInputs.forEach(input => {
            input.addEventListener('change', function(event) {
                const file = event.target.files[0];
                const previewContainer = input.nextElementSibling;
                const img = previewContainer.querySelector('img');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        img.src = e.target.result;
                        img.classList.remove('d-none');
                    };
                    reader.readAsDataURL(file);
                } else {
                    img.src = '';
                    img.classList.add('d-none');
                }
            });
        });
    });