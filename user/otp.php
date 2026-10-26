<?php
include('../admin/connection.php');
session_start();

// Demo OTP
if (!isset($_SESSION['otp'])) {
    $_SESSION['otp'] = rand(1000, 9999);
}

$message = "";

if (isset($_POST['verify'])) {

    $entered_otp = $_POST['otp'];

    if ($entered_otp == $_SESSION['otp']) {
        $message = "OTP Verified Successfully!";
        echo "<script>window.location.assign('login.php');</script>";
        $email=$_SESSION['otp_email'];
        $q1=mysqli_query($con,"update user_records set status=1 where email='$email'");
    } else {
        $message = "Invalid OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>OTP Verification - Tiffin Services</title>

    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    body {
        min-height: 100vh;
        background: linear-gradient(135deg, #fff8df, #ffeaa7);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .otp-card {
        width: 430px;
        background: #fff;
        padding: 40px;
        border-radius: 22px;
        text-align: center;
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.12);
    }

    .logo {
        width: 70px;
        height: 70px;
        margin: auto;
        background: #ffbd00;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
    }

    .brand {
        margin-top: 15px;
        font-size: 28px;
        font-weight: bold;
        color: #29220f;
    }

    .brand span {
        color: #f2ad00;
    }

    .tagline {
        color: #777;
        margin-top: 5px;
        margin-bottom: 30px;
    }

    h2 {
        color: #29220f;
        margin-bottom: 10px;
    }

    .text {
        color: #777;
        font-size: 14px;
        line-height: 1.6;
    }

    .mobile {
        display: inline-block;
        margin: 15px 0 25px;
        padding: 10px 18px;
        background: #fff6d8;
        color: #d99b00;
        border-radius: 20px;
        font-weight: bold;
    }

    .otp-inputs {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-bottom: 25px;
    }

    .otp-inputs input {
        width: 55px;
        height: 60px;
        border: 1.5px solid #ddd;
        border-radius: 12px;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        outline: none;
    }

    .otp-inputs input:focus {
        border-color: #f2ad00;
        box-shadow: 0 0 0 3px rgba(242, 173, 0, 0.15);
    }

    .verify-btn {
        width: 100%;
        padding: 14px;
        border: none;
        border-radius: 11px;
        background: #f2b000;
        color: white;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
    }

    .verify-btn:hover {
        background: #d99b00;
    }

    .resend {
        margin-top: 22px;
        color: #777;
        font-size: 14px;
    }

    .resend a {
        color: #e0a000;
        font-weight: bold;
        text-decoration: none;
    }

    .timer {
        margin-top: 8px;
        color: #999;
        font-size: 13px;
    }

    .change {
        display: block;
        margin-top: 22px;
        color: #555;
        text-decoration: none;
        font-size: 14px;
    }

    .message {
        margin-top: 18px;
        font-weight: bold;
        color: #d99b00;
    }
    </style>
</head>

<body>

    <div class="otp-card">

        <div class="logo">🍱</div>

        <div class="brand">
            <span>Tiffin</span> Services
        </div>

        <div class="tagline">
            Ghar jaisa khana, har din!
        </div>

        <h2>Verify Your OTP</h2>

        <p class="text">
            We have sent a 4-digit OTP to your<br>
            registered mobile number
        </p>

        <div class="mobile">
            📱 +91 XXXXX XXXXX
        </div>

        <form method="POST">

            <div class="otp-inputs">

                <input type="text" name="otp1" maxlength="1" required>
                <input type="text" name="otp2" maxlength="1" required>
                <input type="text" name="otp3" maxlength="1" required>
                <input type="text" name="otp4" maxlength="1" required>

            </div>

            <input type="hidden" name="otp" id="fullOtp">

            <button type="submit" name="verify" class="verify-btn">
                Verify OTP ✓
            </button>

        </form>

        <div class="resend">
            Didn't receive the code?
            <a href="#">Resend OTP</a>
        </div>

        <div class="timer">
            ⏱ Resend available in 00:30
        </div>

        <a href="#" class="change">
            ← Change Mobile Number
        </a>

        <?php if ($message != "") { ?>
        <div class="message">
            <?php echo $message; ?>
        </div>
        <?php } ?>

    </div>

    <script>
    const inputs = document.querySelectorAll(".otp-inputs input");

    inputs.forEach((input, index) => {

        input.addEventListener("input", () => {

            if (input.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }

            let otp = "";

            inputs.forEach(box => {
                otp += box.value;
            });

            document.getElementById("fullOtp").value = otp;
        });

        input.addEventListener("keydown", (e) => {

            if (e.key === "Backspace" &&
                input.value === "" &&
                index > 0) {

                inputs[index - 1].focus();
            }
        });

    });
    </script>

</body>

</html>