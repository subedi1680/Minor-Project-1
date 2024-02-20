document.addEventListener("DOMContentLoaded", function() {
    const sendOTPButton = document.getElementById('send-otp-button');
    const verifyOTPButton = document.getElementById('verify-otp-button');
    const changePasswordButton = document.getElementById('change-password-button');
    let otpField = document.getElementById('otp-field');
    const changePasswordFields = document.getElementById('change-password-fields');

    sendOTPButton.addEventListener('click', function(event) {
        event.preventDefault();
        const email = document.getElementById('email').value.trim();

        if (email === '') {
            alert('Please enter your email.');
            return;
        }

        const formData = new FormData();
        formData.append('sendotp', 'true');
        formData.append('email', email);

        fetch('forgotpassword.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            otpField.style.display = 'block';
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    verifyOTPButton.addEventListener('click', function(event) {
        event.preventDefault();
        const enteredOTP = document.getElementById('otp').value.trim();

        if (enteredOTP === '') {
            alert('Please enter OTP.');
            return;
        }

        const formData = new FormData();
        formData.append('verifyotp', 'true');
        formData.append('otp', enteredOTP);
        formData.append('email', document.getElementById('email').value.trim());

        fetch('forgotpassword.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            if (data === 'Password updated successfully!') {
                changePasswordFields.style.display = 'block';
                otpField.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    changePasswordButton.addEventListener('click', function(event) {
        event.preventDefault();
        const newPassword = document.getElementById('new-password').value.trim();
        const confirmPassword = document.getElementById('confirm-password').value.trim();

        if (newPassword === '' || confirmPassword === '') {
            alert('Please enter both new password and confirm password.');
            return;
        }

        if (newPassword !== confirmPassword) {
            alert('New password and confirm password do not match.');
            return;
        }

        const formData = new FormData();
        formData.append('email', document.getElementById('email').value.trim());
        formData.append('new-password', newPassword);
        formData.append('confirm-password', confirmPassword);

        fetch('forgotpassword.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
