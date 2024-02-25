document.addEventListener('DOMContentLoaded', function() {
    var sendOTPButton = document.getElementById('send-otp-button');
    var verifyOTPButton = document.getElementById('verify-otp-button');
    var changePasswordButton = document.getElementById('change-password-button');
    var otpField = document.getElementById('otp-field');
    var changePasswordField = document.getElementById('change-password-fields');

    sendOTPButton.addEventListener('click', function(event) {
        event.preventDefault();
        var email = document.getElementById('email').value;
        
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    otpField.style.display = 'block';
                } else {
                    alert('Error sending OTP. Please try again.');
                }
            }
        };
        xhr.open('POST', 'forgotpassword.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('sendotp=true&email=' + encodeURIComponent(email));
    });

    verifyOTPButton.addEventListener('click', function(event) {
        event.preventDefault();
        var enteredOTP = document.getElementById('otp').value;
        var email = document.getElementById('email').value;
        
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    changePasswordField.style.display = 'block';
                    otpField.style.display = 'none'; // Hide OTP field if verification successful
                } else {
                    alert('Incorrect OTP! Please try again.');
                }
            }
        };
        xhr.open('POST', 'forgotpassword.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('verifyotp=true&email=' + encodeURIComponent(email) + '&otp=' + encodeURIComponent(enteredOTP));
    });

    changePasswordButton.addEventListener('click', function(event) {
        event.preventDefault();
        var newPassword = document.getElementById('new-password').value;
        var confirmPassword = document.getElementById('confirm-password').value;
        var email = document.getElementById('email').value;

        if (newPassword === confirmPassword) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        alert('Password updated successfully!');
                    } else {
                        alert('Error updating password. Please try again.');
                    }
                }
            };
            xhr.open('POST', 'forgotpassword.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('updatepassword=true&email=' + encodeURIComponent(email) + '&new-password=' + encodeURIComponent(newPassword));
        } else {
            alert("Passwords do not match. Please try again.");
        }
    });
});
