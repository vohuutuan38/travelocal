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

});

// custom timeline

document.addEventListener('DOMContentLoaded', function () {
    let timelineIndex = 1;

    // Khi nhấn nút thêm timeline
    document.querySelector('#timeline-wrapper').addEventListener('click', function (e) {
        if (e.target.closest('.add-timeline')) {
            e.preventDefault();

            const wrapper = document.getElementById('timeline-wrapper');
            const newItem = document.createElement('div');
            newItem.classList.add('d-flex', 'mb-2', 'timeline-item');

            newItem.innerHTML = `
                <input type="text" name="timelines[${timelineIndex}][title]" 
                       placeholder="Ngày... :" 
                       class="form-control me-2 w-25">

                <textarea name="timelines[${timelineIndex}][description]" 
                          placeholder="Mô tả chi tiết" 
                          class="form-control me-2"></textarea>

                <button type="button" class="btn btn-danger remove-timeline">
                    <i class="fas fa-minus"></i>
                </button>
            `;

            wrapper.appendChild(newItem);
            timelineIndex++;
        }

        // Xóa timeline
        if (e.target.closest('.remove-timeline')) {
            e.preventDefault();
            e.target.closest('.timeline-item').remove();
        }
    });
});

// image guide
 document.querySelectorAll('.guide-image-input').forEach(input => {
        input.addEventListener('change', function() {
            const previewId = this.getAttribute('data-preview');
            const previewContainer = document.getElementById(previewId);
            const img = previewContainer.querySelector('img');

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

// image edir guide
document.querySelectorAll('.guide-edit-image').forEach(input => {
        input.addEventListener('change', function() {
            const previewId = this.getAttribute('data-preview');
            const preview = document.getElementById(previewId);
            let img = preview.querySelector('img');

            if (!img) {
                img = document.createElement('img');
                img.className = 'img-fluid rounded border mt-2';
                img.style.maxWidth = '200px';
                preview.appendChild(img);
            }

            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    img.src = e.target.result;
                    img.classList.remove('d-none');
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    });