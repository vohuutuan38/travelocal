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