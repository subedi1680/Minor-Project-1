document.getElementById("send-otp-button").addEventListener("click", function() {
    var phone = document.getElementById("phone").value;
    
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "forgotpassword.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {

            alert(xhr.responseText);
            
            document.getElementById("otp-verification").style.display = "block";
        }
    };
    xhr.send("phone=" + phone);
});

document.getElementById("change-password-button").addEventListener("click", function() {
    var otp = document.getElementById("otp").value;
    var newPassword = document.getElementById("new-password").value;
    var confirmPassword = document.getElementById("confirm-password").value;
    
    if (otp === "" || newPassword === "" || confirmPassword === "") {
        alert("Please fill in all fields.");
        return;
    }
    if (newPassword !== confirmPassword) {
        alert("Passwords do not match.");
        return;
    }
    
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "changepassword.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText);

            window.location.href = "index.html";
        }
    };
    xhr.send("otp=" + otp + "&new_password=" + newPassword);
});
