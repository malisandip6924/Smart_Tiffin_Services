
<?php
$pageTitle = "Privacy Policy";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?> | Smart Tiffin Services</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f8f6f2;
            color: #252525;
            line-height: 1.8;
        }

        .policy-hero {
            background: linear-gradient(135deg, #171717, #34302b);
            color: #fff;
            text-align: center;
            padding: 65px 20px;
        }

        .policy-hero h1 {
            font-size: 38px;
            margin-bottom: 12px;
            color: #ffad33;
        }

        .policy-hero p {
            font-size: 16px;
            color: #e5e5e5;
        }

        .policy-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .policy-card {
            background: #fff;
            padding: 35px;
            margin-bottom: 22px;
            border-radius: 14px;
            border: 1px solid #eee6db;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .policy-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .policy-card h2 {
            color: #e58b16;
            font-size: 22px;
            margin-bottom: 12px;
        }

        .policy-card p {
            color: #555;
            font-size: 15px;
        }

        .policy-card ul {
            padding-left: 25px;
            color: #555;
        }

        .policy-card li {
            margin: 6px 0;
        }

        .policy-note {
            background: #fff2dc;
            border-left: 5px solid #f39a18;
            padding: 18px 22px;
            border-radius: 8px;
            margin-bottom: 25px;
            color: #51412b;
        }

        .back-btn {
            display: inline-block;
            text-decoration: none;
            background: #f39a18;
            color: #171717;
            padding: 12px 25px;
            border-radius: 7px;
            font-weight: bold;
            margin: 10px 0 35px;
            transition: 0.3s;
        }

        .back-btn:hover {
            background: #171717;
            color: #fff;
        }

        @media (max-width: 600px) {
            .policy-hero {
                padding: 45px 15px;
            }

            .policy-hero h1 {
                font-size: 29px;
            }

            .policy-card {
                padding: 23px;
            }

            .policy-card h2 {
                font-size: 19px;
            }
        }
    </style>
</head>

<body>

    <section class="policy-hero">
        <h1>Privacy Policy</h1>
        <p>Your privacy matters to Smart Tiffin Services.</p>
    </section>

    <main class="policy-container">

        <div class="policy-note">
            We use the information you provide to support your account and help manage your tiffin service orders.
            Please read this policy to understand how your information may be handled.
        </div>

        <section class="policy-card">
            <h2>1. Information We Collect</h2>
            <p>When you register or use our website, we may collect information such as:</p>
            <ul>
                <li>Your name</li>
                <li>Email address</li>
                <li>Mobile number</li>
                <li>Account and order details you provide</li>
            </ul>
        </section>

        <section class="policy-card">
            <h2>2. How We Use Your Information</h2>
            <p>Your information may be used to:</p>
            <ul>
                <li>Create and manage your user account.</li>
                <li>Process and manage tiffin plan orders.</li>
                <li>Contact you about your account or orders.</li>
                <li>Provide customer support and improve website functionality.</li>
            </ul>
        </section>

        <section class="policy-card">
            <h2>3. Information Sharing</h2>
            <p>
                We do not intend to sell your personal information. Information may be shared
                with authorized service providers when necessary to operate the website or
                fulfill your orders, or when disclosure is required by law.
            </p>
        </section>

        <section class="policy-card">
            <h2>4. Data Security</h2>
            <p>
                We take reasonable steps to protect the information stored in our system.
                However, no website or method of electronic storage can guarantee absolute security.
                Please keep your account credentials confidential.
            </p>
        </section>

        <section class="policy-card">
            <h2>5. Cookies and Website Usage</h2>
            <p>
                The website may use session data or cookies if required for features such as
                login sessions and cart functionality. Any analytics or additional tracking
                should be disclosed here if those features are added.
            </p>
        </section>

        <section class="policy-card">
            <h2>6. Your Choices</h2>
            <p>
                If you want to correct your personal information, ask a question about your
                data, or request account-related assistance, please contact the website administrator
                using the contact details provided on our website.
            </p>
        </section>

        <section class="policy-card">
            <h2>7. Children's Privacy</h2>
            <p>
                This website is not specifically designed to collect personal information from
                children. If you believe a child has provided personal information inappropriately,
                contact the website administrator.
            </p>
        </section>

        <section class="policy-card">
            <h2>8. Changes to This Policy</h2>
            <p>
                We may update this Privacy Policy when our website or data practices change.
                Any revised version should be published on this page with an updated effective date.
            </p>
        </section>

        <section class="policy-card">
            <h2>9. Contact Us</h2>
            <p>
                If you have questions about this Privacy Policy, please contact us through the
                Contact Us page on Smart Tiffin Services.
            </p>
        </section>

        <center>
            <a href="index.php" class="back-btn">← Back to Home</a>
        </center>

    </main>

</body>
</html>