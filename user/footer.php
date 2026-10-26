<style>
html,
body {
    margin: 0;
    padding: 0;
}

.smart-footer,
.smart-footer * {
    box-sizing: border-box;
}

.smart-footer {
    width: 100%;
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
    overflow: hidden;
}
.footer-newsletter {
    position: relative;
    width: 100%;
    min-height: 360px;
    background: #ffa21a;
    padding: 80px 7% 120px;
    overflow: hidden;
}
.footer-newsletter::before {
    content: "";
    position: absolute;
    width: 220px;
    height: 220px;
    border: 2px solid rgba(255, 255, 255, 0.10);
    border-radius: 50%;
    right: -70px;
    top: 40px;
}
.footer-newsletter::after {
    content: "";
    position: absolute;
    width: 150px;
    height: 150px;
    border: 2px solid rgba(255, 255, 255, 0.08);
    border-radius: 50%;
    left: -70px;
    bottom: 20px;
}

/* Newsletter content */

.newsletter-inner {
    position: relative;
    z-index: 5;
    max-width: 1250px;
    margin: auto;

    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 70px;
}

.newsletter-text {
    max-width: 550px;
}

.newsletter-text h2 {
    margin: 0 0 18px;
    color: #111820;
    font-size: 45px;
    line-height: 1.1;
    font-weight: 800;
}

.newsletter-text h2 span {
    font-style: italic;
    font-weight: 500;
}

.newsletter-text p {
    margin: 0;
    color: #111820;
    font-size: 17px;
    line-height: 1.8;
}

/* Newsletter form */

.newsletter-form {
    width: 570px;
    max-width: 100%;
    background: #fff;
    border-radius: 60px;
    padding: 8px;
    display: flex;
    align-items: center;
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);
}

.newsletter-form input {
    flex: 1;
    border: none;
    outline: none;
    padding: 18px 25px;
    font-size: 16px;
    color: #222;
    background: transparent;
}

.newsletter-form input::placeholder {
    color: #777;
}

.newsletter-form button {
    border: none;
    background: #111820;
    color: #ffa21a;
    padding: 17px 30px;
    border-radius: 45px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
}

.newsletter-form button:hover {
    background: #ffa21a;
    color: #111820;
    transform: translateX(-3px);
}

/* =========================
   WAVE / FLOW
========================= */

.footer-wave {
    position: absolute;
    left: -5%;
    bottom: -1px;
    width: 110%;
    height: 120px;
    background: #111820;

    border-radius: 50% 50% 0 0 / 100% 100% 0 0;

    transform: translateY(55px);
}

/* =========================
   MAIN DARK FOOTER
========================= */

.footer-main {
    position: relative;
    width: 100%;
    background: #111820;
    color: #fff;
    padding: 75px 7% 30px;
}

.footer-container {
    max-width: 1250px;
    margin: auto;

    display: grid;
    grid-template-columns: 1.25fr 0.9fr 1.15fr 1.2fr;
    gap: 55px;
}

/* =========================
   FOOTER BRAND
========================= */

.footer-brand img {
    width: 220px;
    max-width: 100%;
    margin-bottom: 20px;
}

.footer-brand h2 {
    color: #fff;
    margin: 0 0 20px;
    font-size: 32px;
}

.footer-brand h2 span {
    color: #ffa21a;
}

.footer-line {
    width: 78px;
    height: 3px;
    background: #ffa21a;
    margin-bottom: 22px;
}

.footer-brand p {
    color: #aeb6bd;
    font-size: 15px;
    line-height: 1.8;
    max-width: 290px;
}

/* =========================
   SOCIAL ICONS
========================= */

.footer-social {
    display: flex;
    gap: 12px;
    margin-top: 25px;
}

.footer-social a {
    width: 45px;
    height: 45px;
    border: 1px solid #3a4249;
    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #fff;
    text-decoration: none;
    font-weight: bold;

    transition: all 0.3s ease;
}

.footer-social a:hover {
    background: #ffa21a;
    border-color: #ffa21a;
    color: #111820;
    transform: translateY(-5px);
}

/* =========================
   CALL BOX
========================= */

.call-box {
    margin-top: 28px;
    padding: 17px;
    background: #181f25;
    border: 1px solid #2b343c;
    border-radius: 12px;

    display: flex;
    align-items: center;
    gap: 15px;
}

.call-icon {
    width: 48px;
    height: 48px;
    flex-shrink: 0;

    background: rgba(255, 162, 26, 0.15);
    color: #ffa21a;

    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 21px;
}

.call-box small {
    color: #9da7af;
    display: block;
    margin-bottom: 4px;
}

.call-box strong {
    color: #ffa21a;
    font-size: 16px;
}

/* =========================
   FOOTER HEADINGS
========================= */

.footer-column h3 {
    position: relative;
    color: #fff;
    font-size: 21px;
    margin: 0 0 28px;
    padding-bottom: 13px;
}

.footer-column h3::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;

    width: 48px;
    height: 3px;

    background: #ffa21a;
}

/* =========================
   QUICK LINKS
========================= */

.footer-links {
    list-style: none;
    margin: 0;
    padding: 0;
}

.footer-links li {
    margin-bottom: 14px;
}

.footer-links a {
    color: #aeb6bd;
    text-decoration: none;
    font-size: 15px;

    transition: all 0.3s ease;
}

.footer-links a::before {
    content: "›";
    color: #ffa21a;
    font-size: 21px;
    margin-right: 9px;
}

.footer-links a:hover {
    color: #ffa21a;
    padding-left: 5px;
}

/* =========================
   SERVICES
========================= */

.service-item {
    display: flex;
    align-items: center;
    gap: 15px;

    padding: 13px 0;
    border-bottom: 1px dashed #303940;
}

.service-icon {
    width: 45px;
    height: 45px;
    flex-shrink: 0;

    border: 1px solid #3a4249;
    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #ffa21a;
    font-size: 18px;

    transition: all 0.3s ease;
}

.service-item:hover .service-icon {
    background: #ffa21a;
    color: #111820;
    border-color: #ffa21a;
}

.service-item strong {
    display: block;
    color: #fff;
    font-size: 15px;
    margin-bottom: 5px;
}

.service-item span {
    color: #77828b;
    font-size: 13px;
}

/* =========================
   STAY UPDATED
========================= */

.footer-column>p {
    color: #aeb6bd;
    font-size: 14px;
    line-height: 1.7;
    margin-bottom: 20px;
}

.footer-subscribe {
    display: flex;
    height: 52px;
    border: 1px solid #333c43;
    border-radius: 8px;
    overflow: hidden;
}

.footer-subscribe input {
    flex: 1;
    min-width: 0;

    background: #181f25;
    border: none;
    outline: none;

    padding: 0 15px;
    color: #fff;
}

.footer-subscribe input::placeholder {
    color: #747e86;
}

.footer-subscribe button {
    width: 58px;
    border: none;

    background: #ffa21a;
    color: #111820;

    font-size: 20px;
    cursor: pointer;

    transition: 0.3s;
}

.footer-subscribe button:hover {
    background: #fff;
}

/* =========================
   TRUST BOX
========================= */

.trust-box {
    display: grid;
    grid-template-columns: repeat(4, 1fr);

    margin-top: 25px;

    border: 1px solid #5c481d;
    border-radius: 10px;
    overflow: hidden;
}

.trust-item {
    text-align: center;
    padding: 15px 5px;

    border-right: 1px solid #303940;
}

.trust-item:last-child {
    border-right: none;
}

.trust-item .trust-icon {
    display: block;
    color: #ffa21a;
    font-size: 20px;
    margin-bottom: 8px;
}

.trust-item strong {
    display: block;
    color: #fff;
    font-size: 13px;
}

.trust-item span {
    display: block;
    color: #77828b;
    font-size: 11px;
    margin-top: 4px;
}

/* =========================
   BOTTOM FOOTER
========================= */

.footer-bottom {
    max-width: 1250px;
    margin: 55px auto 0;

    padding-top: 25px;

    border-top: 1px solid #2b343b;

    display: flex;
    align-items: center;
    justify-content: space-between;

    color: #7f8991;
    font-size: 13px;
}

.footer-bottom span {
    color: #ffa21a;
}

.footer-heart {
    color: #ff4b4b;
    font-size: 17px;
}

.footer-secure {
    display: flex;
    align-items: center;
    gap: 8px;
}

/* =========================
   RESPONSIVE
========================= */

@media (max-width: 1100px) {

    .footer-container {
        grid-template-columns: repeat(2, 1fr);
    }

    .newsletter-inner {
        gap: 35px;
    }

    .newsletter-text h2 {
        font-size: 36px;
    }

}

@media (max-width: 768px) {

    .footer-newsletter {
        padding: 60px 25px 100px;
    }

    .newsletter-inner {
        flex-direction: column;
        align-items: flex-start;
    }

    .newsletter-form {
        width: 100%;
    }

    .footer-main {
        padding: 60px 25px 25px;
    }

    .footer-container {
        grid-template-columns: 1fr;
        gap: 40px;
    }

    .footer-bottom {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }

}

@media (max-width: 500px) {

    .newsletter-text h2 {
        font-size: 30px;
    }

    .newsletter-text p {
        font-size: 14px;
    }

    .newsletter-form {
        flex-direction: column;
        background: transparent;
        box-shadow: none;
        gap: 10px;
    }

    .newsletter-form input {
        width: 100%;
        background: #fff;
        border-radius: 40px;
        padding: 17px 20px;
    }

    .newsletter-form button {
        width: 100%;
    }

    .trust-box {
        grid-template-columns: repeat(2, 1fr);
    }

    .trust-item:nth-child(2) {
        border-right: none;
    }

    .trust-item {
        border-bottom: 1px solid #303940;
    }

}
</style>


<footer class="smart-footer">

    <!-- =========================
         NEWSLETTER
    ========================== -->

    <div class="footer-newsletter">

        <div class="newsletter-inner">

            <div class="newsletter-text">
                <h2>
                    Subscribe For
                    <span>Latest News</span>
                </h2>

                <p>
                    Get the latest updates, healthy meal tips,
                    special offers and delicious tiffin updates
                    directly in your inbox.
                </p>
            </div>


            <form class="newsletter-form">

                <input type="email" placeholder="Enter your email address">

                <button type="submit">
                    Subscribe Now &nbsp; ➜
                </button>

            </form>

        </div>


        <!-- WAVE -->

        <div class="footer-wave"></div>

    </div>


    <!-- =========================
         DARK FOOTER
    ========================== -->

    <div class="footer-main">

        <div class="footer-container">


            <!-- BRAND -->

            <div class="footer-brand">

                <h2>
                    Smart<span>Tiffin</span>
                </h2>

                <div class="footer-line"></div>

                <p>
                    Delicious, healthy and hygienic meals
                    prepared with love and delivered fresh
                    to your doorstep. Your satisfaction is
                    our top priority.
                </p>


                <div class="footer-social">

                    <a href="#">W</a>
                    <a href="#">◎</a>
                    <a href="#">f</a>
                    <a href="#">𝕏</a>

                </div>


                <div class="call-box">

                    <div class="call-icon">
                        ☎
                    </div>

                    <div>

                        <small>Call for Order</small>

                        <strong>
                            +91 87587 06924
                        </strong>

                        <small>
                            Mon - Sun (8:00 AM - 10:00 PM)
                        </small>

                    </div>

                </div>

            </div>


            <!-- QUICK LINKS -->

            <div class="footer-column">

                <h3>Quick Links</h3>

                <ul class="footer-links">

                    <li>
                        <a href="index.php">Home</a>
                    </li>

                    <li>
                        <a href="aboutus.php">About Us</a>
                    </li>

                    <li>
                    <li>
                        <a href="contactus.php">Contact Us</a>
                    </li>

                    <li>
                        <a href="privacy.php">Privacy Policy</a>
                    </li>

                    <li>
                        <a href="#">Terms & Conditions</a>
                    </li>

                </ul>

            </div>


            <!-- SERVICES -->

            <div class="footer-column">

                <h3>Our Services</h3>


                <div class="service-item">

                    <div class="service-icon">
                        🍽
                    </div>

                    <div>
                        <strong>Daily Lunch Service</strong>
                        <span>Fresh & Healthy Meals</span>
                    </div>

                </div>


                <div class="service-item">

                    <div class="service-icon">
                        💼
                    </div>
                    <div>
                        <strong>Tiffin For Office</strong>
                        <span>Perfect Office Lunch</span>
                    </div>
                </div>
                <!--<div class="service-item">
                    <div class="service-icon">  🛵</div>
                    <div>
                        <strong>Home Delivery</strong>
                        <span>Fast & Safe Delivery</span>
                    </div>
                </div>
                <div class="service-item">
                    <div class="service-icon">
                        📅
                    </div>
                    <div>
                        <strong>Custom Meal Plans</strong>
                        <span>Plans Made For You</span>
                    </div>
                </div>-->
            </div>
            <!-- STAY UPDATED -->
            <div class="footer-column">
                <h3>Stay Updated</h3>
                <p>
                    Get the latest offers, healthy tips &
                    delicious meal updates.
                </p>
                <form class="footer-subscribe">
                    <input type="email" placeholder="Enter your email address">
                    <button type="submit"> ➤</button>
                </form>
                <!-- TRUST -->
                <div class="trust-box">
                    <div class="trust-item">
                        <span class="trust-icon"> 🍃</span>
                        <strong>100%</strong>
                        <span>Hygienic Food</span>
                    </div>
                    <div class="trust-item">
                        <span class="trust-icon">◷</span>
                        <strong>On Time</strong>
                        <span>Delivery</span>
                    </div>
                    <div class="trust-item">
                        <span class="trust-icon">♛</span>
                        <strong>Best</strong>
                        <span>Quality</span>
                    </div>
                    <div class="trust-item">
                        <span class="trust-icon">♧</span>
                        <strong>24/7</strong>
                        <span>Support</span>
                    </div>
                </div>
            </div>
        </div>


        <!-- =========================COPYRIGHT========================== -->

        <div class="footer-bottom">
            <div>
                © 2026 <span>Smart Tiffin Service</span>.
                All Rights Reserved.
            </div>
            <div>
                <span class="footer-heart">♥</span>
                Made with passion for healthy living
            </div>
            <div class="footer-secure"> 🛡 Secure & Trusted Service</div>
        </div>
    </div>
</footer>