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


// custom thành phố miền
document.addEventListener('DOMContentLoaded', function() {
    // Filter cities by domain
    const domainSelect = document.getElementById('domain-select');
    const citySelect = document.getElementById('city-select');
    const allCityOptions = Array.from(citySelect.options);

    domainSelect.addEventListener('change', function() {
        const selectedDomain = this.value;
        
        // Reset city select
        citySelect.innerHTML = '<option value="">-- Chọn thành phố --</option>';
        
        // Filter and add matching cities
        allCityOptions.forEach(option => {
            if (option.value === '') return; // Skip default option
            
            const cityDomain = option.getAttribute('data-domain');
            if (!selectedDomain || cityDomain === selectedDomain) {
                citySelect.appendChild(option.cloneNode(true));
            }
        });
    });

    // Preview images
    document.querySelectorAll('.image-input').forEach(input => {
        input.addEventListener('change', function(e) {
            const previewId = this.getAttribute('data-preview');
            const preview = document.getElementById(previewId);
            const img = preview.querySelector('img');
            
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    img.classList.remove('d-none');
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    });

    // Add activity
    let activityIndex = 1;
    document.addEventListener('click', function(e) {
        if (e.target.closest('.add-activity')) {
            e.preventDefault();
            const wrapper = document.getElementById('activities-wrapper');
            const newActivity = `
                <div class="d-flex mb-2 activity-item">
                    <input type="text" 
                           name="activities[${activityIndex}][name]" 
                           placeholder="Tên hoạt động" 
                           class="form-control me-2">
                    <input type="text" 
                           name="activities[${activityIndex}][icon]" 
                           placeholder="Icon flaticon" 
                           class="form-control me-2">
                    <button type="button" class="btn btn-danger remove-activity">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            `;
            wrapper.insertAdjacentHTML('beforeend', newActivity);
            activityIndex++;
        }
        
        if (e.target.closest('.remove-activity')) {
            e.preventDefault();
            e.target.closest('.activity-item').remove();
        }
    });
});