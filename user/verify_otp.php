
<?php
session_start();

$message = "";

if (
    !isset($_SESSION['reset_email']) ||
    !isset($_SESSION['reset_otp_hash']) ||
    !isset($_SESSION['reset_otp_expiry'])
) {
    header("Location: forgot_password.php");
    exit;
}

if (time() >= $_SESSION['reset_otp_expiry']) {
    unset(
        $_SESSION['reset_email'],
        $_SESSION['reset_otp_hash'],
        $_SESSION['reset_otp_expiry'],
        $_SESSION['reset_otp_attempts']
    );

    $message = "OTP expired. Please request a new OTP.";
}

if (isset($_POST['verify_otp']) && $message == "") {

    $entered_otp = trim($_POST['otp'] ?? '');

    if (!preg_match('/^[0-9]{4}$/', $entered_otp)) {
        $message = "Please enter a valid 4-digit OTP.";
    } else {

        $_SESSION['reset_otp_attempts'] =
            ($_SESSION['reset_otp_attempts'] ?? 0) + 1;

        if ($_SESSION['reset_otp_attempts'] > 5) {

            unset(
                $_SESSION['reset_email'],
                $_SESSION['reset_otp_hash'],
                $_SESSION['reset_otp_expiry'],
                $_SESSION['reset_otp_attempts']
            );

            $message = "Too many attempts. Please request a new OTP.";

        } elseif (
            password_verify(
                $entered_otp,
                $_SESSION['reset_otp_hash']
            )
        ) {

            if (time() >= $_SESSION['reset_otp_expiry']) {

                unset(
                    $_SESSION['reset_email'],
                    $_SESSION['reset_otp_hash'],
                    $_SESSION['reset_otp_expiry'],
                    $_SESSION['reset_otp_attempts']
                );

                $message = "OTP expired. Please request a new OTP.";

            } else {

                unset(
                    $_SESSION['reset_otp_hash'],
                    $_SESSION['reset_otp_expiry'],
                    $_SESSION['reset_otp_attempts']
                );

                $_SESSION['reset_otp_verified'] = true;

                header("Location: reset_password.php");
                exit;
            }

        } else {
            $message = "Incorrect OTP. Please try again.";
        }
    }
}

$timer_expiry = isset($_SESSION['reset_otp_expiry'])
    ? (int) $_SESSION['reset_otp_expiry']
    : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verify OTP - Smart Tiffin Services</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #fff8df, #ffe5b4);
        }

        .otp-card {
            width: 100%;
            max-width: 420px;
            padding: 35px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
            animation: cardAppear 0.6s ease;
        }

        @keyframes cardAppear {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            text-align: center;
            font-size: 42px;
        }

        h2 {
            text-align: center;
            color: #ff7a1a;
        }

        .subtitle {
            text-align: center;
            color: #777;
            line-height: 1.6;
            margin-bottom: 22px;
        }

        .timer-box {
            text-align: center;
            margin-bottom: 22px;
            padding: 15px;
            background: #fff4e8;
            border: 1px solid #ffd4ad;
            border-radius: 12px;
            color: #555;
            font-size: 14px;
            font-weight: 600;
        }

        #countdown {
            display: block;
            margin-top: 7px;
            color: #ff7a1a;
            font-size: 32px;
            font-weight: 800;
            letter-spacing: 3px;
            transition: color 0.3s;
        }

        #countdown.warning {
            color: #dc2626;
            animation: timerPulse 1s infinite;
        }

        #countdown.expired {
            color: #dc2626;
            font-size: 23px;
            letter-spacing: 0;
            animation: none;
        }

        @keyframes timerPulse {
            50% {
                opacity: 0.55;
            }
        }

        input {
            width: 100%;
            padding: 14px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 9px;
            font-size: 22px;
            text-align: center;
            letter-spacing: 10px;
            outline: none;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input:focus {
            border-color: #ff7a1a;
            box-shadow: 0 0 0 3px rgba(255, 122, 26, 0.12);
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 9px;
            background: #ff7a1a;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
        }

        button:hover:not(:disabled) {
            background: #e8660b;
            transform: translateY(-2px);
        }

        button:disabled {
            background: #b8b8b8;
            cursor: not-allowed;
            transform: none;
        }

        .message {
            color: #c62828;
            text-align: center;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .back-link {
            display: block;
            margin-top: 22px;
            text-align: center;
            color: #ff7a1a;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            color: #e8660b;
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .otp-card {
                padding: 25px 20px;
            }
        }
    </style>
</head>

<body>

    <div class="otp-card">

        <div class="logo">🍱</div>

        <h2>Verify OTP</h2>

        <p class="subtitle">
            Enter the 4-digit OTP sent to your registered email.
            The OTP is valid for 1 minute.
        </p>

        <div class="timer-box" id="timer-box">
            OTP expires in
            <span id="countdown">01:00</span>
        </div>

        <?php if ($message != "") { ?>
            <p class="message">
                <?php echo htmlspecialchars($message); ?>
            </p>
        <?php } ?>

        <?php if (isset($_SESSION['reset_otp_hash'])) { ?>

            <form method="post" id="otp-form">

                <input
                    type="text"
                    name="otp"
                    id="otp-input"
                    placeholder="0000"
                    inputmode="numeric"
                    pattern="[0-9]{4}"
                    maxlength="4"
                    autocomplete="one-time-code"
                    required
                >

                <button
                    type="submit"
                    name="verify_otp"
                    id="verify-button">
                    Verify OTP
                </button>

            </form>

        <?php } ?>

        <a href="forgot_password.php" class="back-link">
            ← Request New OTP
        </a>

    </div>

    <script>
        const countdown = document.getElementById("countdown");
        const timerBox = document.getElementById("timer-box");
        const otpForm = document.getElementById("otp-form");
        const otpInput = document.getElementById("otp-input");
        const verifyButton = document.getElementById("verify-button");

        const expiryTime = <?php echo $timer_expiry; ?>;

        function updateTimer() {
            const currentTime = Math.floor(Date.now() / 1000);
            const remaining = Math.max(0, expiryTime - currentTime);

            if (remaining <= 0) {
                countdown.textContent = "OTP Expired";
                countdown.classList.remove("warning");
                countdown.classList.add("expired");

                if (otpInput) {
                    otpInput.disabled = true;
                }

                if (verifyButton) {
                    verifyButton.disabled = true;
                    verifyButton.textContent = "OTP Expired";
                }

                if (timerBox) {
                    timerBox.firstChild.textContent = "";
                }

                return;
            }

            const minutes = Math.floor(remaining / 60);
            const seconds = remaining % 60;

            countdown.textContent =
                String(minutes).padStart(2, "0") + ":" +
                String(seconds).padStart(2, "0");

            if (remaining <= 10) {
                countdown.classList.add("warning");
            } else {
                countdown.classList.remove("warning");
            }

            setTimeout(updateTimer, 250);
        }

        if (expiryTime > 0) {
            updateTimer();
        } else {
            countdown.textContent = "OTP Expired";
            countdown.classList.add("expired");

            if (otpInput) otpInput.disabled = true;
            if (verifyButton) verifyButton.disabled = true;
        }

        if (otpForm) {
            otpForm.addEventListener("submit", function (event) {
                if (Math.floor(Date.now() / 1000) >= expiryTime) {
                    event.preventDefault();

                    countdown.textContent = "OTP Expired";
                    countdown.classList.add("expired");

                    if (otpInput) otpInput.disabled = true;
                    if (verifyButton) {
                        verifyButton.disabled = true;
                        verifyButton.textContent = "OTP Expired";
                    }
                }
            });
        }
    </script>

</body>
</html>