<!--<?php
// Database connection configuration (MySQL)
$host = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '';
$database = getenv('DB_NAME') ?: 'tiffin_service';

// Establish MySQL connection
$conn = new mysqli($con, $username, $password, $database);

// Fallback mock data if DB is not yet connected
$user = [
    "name" => "Sandip",
    "location" => "Surat, Gujarat",
    "active_plan" => "Standard Plan",
    "days_left" => 22,
    "wallet_balance" => 850
];

$plans = [
    ["id" => "basic", "name" => "Basic Plan", "price" => 80, "badge" => "", "popular" => false, "items" => ["4 Chapati", "1 Sabji", "Dal", "Rice", "Salad"]],
    ["id" => "standard", "name" => "Standard Plan", "price" => 100, "badge" => "Most Popular", "popular" => true, "items" => ["5 Chapati", "2 Sabji", "Dal", "Rice", "Salad"]],
    ["id" => "premium", "name" => "Premium Plan", "price" => 130, "badge" => "", "popular" => false, "items" => ["5 Chapati", "2 Special Sabji", "Dal", "Rice", "Sweet"]]
];

$menu_items = [
    ["type" => "Lunch", "title" => "North Indian Homestyle Thali", "desc" => "Cold-pressed mustard oil, whole wheat phulkas, dal tadka, seasonal subji.", "calories" => "520 kcal", "rating" => 4.8, "img" => "https://images.unsplash.com/photo-1588644525273-f37b60d78512?crop=entropy&cs=srgb&fm=jpg&q=85"],
    ["type" => "Dinner", "title" => "Light & Healthy Dinner Thali", "desc" => "Low sodium meal featuring multigrain rotis, moong dal, steamed veggies.", "calories" => "440 kcal", "rating" => 4.9, "img" => "https://images.unsplash.com/photo-1542367592-8849eb950fd8?crop=entropy&cs=srgb&fm=jpg&q=85"],
    ["type" => "Special", "title" => "Rajasthani Special Thali", "desc" => "Panchmel dal, gatte ki sabji, garlic chutney, bajra rotis.", "calories" => "680 kcal", "rating" => 4.9, "img" => "https://images.unsplash.com/photo-1589778655375-3e622a9fc91c?crop=entropy&cs=srgb&fm=jpg&q=85"]
];
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TiffinService - Fresh, Healthy, Homemade</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="app-container">
        <!-- SIDEBAR NAVIGATION -->
        <aside class="sidebar" data-testid="sidebar-nav">
            <div class="sidebar-top">
                <div class="brand-logo">
                    <div class="logo-icon"><i class="fa-solid fa-utensils"></i></div>
                    <div>
                        <h2>TiffinService</h2>
                        <span>Fresh. Healthy. Homemade</span>
                    </div>
                </div>

                <nav class="nav-links">
                    <a href="#" class="nav-link active" data-testid="nav-link-dashboard"><i class="fa-solid fa-house"></i> Home</a>
                    <a href="#plans-section" class="nav-link" data-testid="nav-link-plans"><i class="fa-solid fa-box-archive"></i> Tiffin Plans</a>
                    <a href="#menu-section" class="nav-link" data-testid="nav-link-menu"><i class="fa-solid fa-calendar-days"></i> Today's Menu</a>
                    <a href="#" class="nav-link" data-testid="nav-link-orders"><i class="fa-solid fa-bag-shopping"></i> My Orders</a>
                    <a href="#" class="nav-link" data-testid="nav-link-subscription"><i class="fa-solid fa-credit-card"></i> Subscription</a>
                    <a href="#" class="nav-link" data-testid="nav-link-addresses"><i class="fa-solid fa-location-dot"></i> Addresses</a>
                    <a href="#" class="nav-link" data-testid="nav-link-profile"><i class="fa-solid fa-user"></i> Profile</a>
                    <a href="#" class="nav-link" data-testid="nav-link-wallet"><i class="fa-solid fa-wallet"></i> Wallet (₹<?php echo $user['wallet_balance']; ?>)</a>
                    <a href="#" class="nav-link" data-testid="nav-link-support"><i class="fa-solid fa-headset"></i> Help & Support</a>
                </nav>
            </div>

            <div class="sidebar-bottom">
                <a href="#" class="logout-btn" data-testid="nav-link-logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                <div class="express-banner">
                    <div class="express-header">
                        <span class="tag-orange">Fast & Reliable</span>
                        <span class="live-badge">Live</span>
                    </div>
                    <p>Delivery at your doorstep in Surat</p>
                    <button class="btn-orange-sm" data-testid="order-now-sidebar-btn" onclick="alert('Express delivery ordered!')">Order Now</button>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <!-- TOP HEADER -->
            <header class="top-header">
                <div class="location-picker" data-testid="location-picker">
                    <i class="fa-solid fa-location-dot text-orange"></i>
                    <div>
                        <small>Delivering to</small>
                        <p><strong><?php echo $user['location']; ?></strong> <i class="fa-solid fa-chevron-down text-xs"></i></p>
                    </div>
                </div>

                <div class="search-bar">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" id="searchInput" data-testid="header-search-input" placeholder="Search for plans, meals, items..." onkeyup="filterMenu()">
                </div>

                <div class="header-actions">
                    <button class="icon-btn" data-testid="header-cart-btn" onclick="alert('Cart has 2 items')"><i class="fa-solid fa-cart-shopping"></i><span class="badge-count">2</span></button>
                    <button class="icon-btn" data-testid="header-notification-btn" onclick="toggleNotifications()"><i class="fa-solid fa-bell"></i><span class="dot"></span></button>
                    
                    <div class="profile-pill" data-testid="header-user-avatar" onclick="toggleProfileMenu()">
                        <div class="text-right">
                            <p class="font-bold text-xs">Hello, <?php echo $user['name']; ?></p>
                            <p class="text-xs text-orange font-semibold"><?php echo $user['active_plan']; ?></p>
                        </div>
                        <div class="avatar-circle"><?php echo $user['name'][0]; ?></div>
                    </div>
                </div>
            </header>

            <!-- HERO BANNER -->
            <section class="hero-banner" data-testid="hero-banner">
                <div class="hero-text">
                    <span class="badge-pill">FRESH & HEALTHY</span>
                    <h1>Homemade Food,<br><span class="text-orange">Delivered with Care</span></h1>
                    <p>Enjoy delicious, hygienic and nutritious tiffins prepared with love and delivered to your doorstep.</p>
                    <div class="hero-btns">
                        <a href="#plans-section" class="btn-primary" data-testid="hero-cta-button">Explore Plans <i class="fa-solid fa-arrow-right"></i></a>
                        <a href="#menu-section" class="btn-secondary">View Today's Menu</a>
                    </div>
                    <div class="hero-dots">
                        <span class="dot-active"></span><span></span><span></span>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1542367592-8849eb950fd8?crop=entropy&cs=srgb&fm=jpg&q=85" alt="Delicious Indian Thali">
                    <div class="image-overlay-tag">
                        <span class="badge-orange">Today's Special</span>
                        <p>Stainless Steel Royal Thali Box</p>
                    </div>
                </div>
            </section>

            <!-- VALUE PROPOSITIONS -->
            <section class="value-props">
                <div class="prop-card">
                    <div class="prop-icon green"><i class="fa-solid fa-shield-halved"></i></div>
                    <div>
                        <h4>Fresh Ingredients</h4>
                        <p>We use only fresh and high quality ingredients.</p>
                    </div>
                </div>
                <div class="prop-card">
                    <div class="prop-icon orange"><i class="fa-solid fa-truck-fast"></i></div>
                    <div>
                        <h4>On-Time Delivery</h4>
                        <p>Your tiffin delivered on time, every time.</p>
                    </div>
                </div>
                <div class="prop-card">
                    <div class="prop-icon blue"><i class="fa-solid fa-sparkles"></i></div>
                    <div>
                        <h4>Hygienic & Safe</h4>
                        <p>Prepared in a clean and hygienic environment.</p>
                    </div>
                </div>
                <div class="prop-card">
                    <div class="prop-icon rose"><i class="fa-solid fa-heart"></i></div>
                    <div>
                        <h4>Healthy & Delicious</h4>
                        <p>Balanced nutrition with homemade taste.</p>
                    </div>
                </div>
            </section>

            <!-- POPULAR TIFFIN PLANS -->
            <section id="plans-section" class="plans-section">
                <div class="section-header">
                    <h2>Popular Tiffin Plans</h2>
                    <p>Choose the plan that suits you best. Easily pause or switch anytime.</p>
                </div>

                <div class="plans-grid">
                    <?php foreach ($plans as $plan): ?>
                        <div class="plan-card <?php echo $plan['popular'] ? 'popular' : ''; ?>" data-testid="plan-card-<?php echo $plan['id']; ?>">
                            <?php if ($plan['badge']): ?>
                                <div class="popular-badge"><?php echo $plan['badge']; ?></div>
                            <?php endif; ?>
                            
                            <div class="plan-top">
                                <div class="plan-icon"><i class="fa-solid fa-utensils"></i></div>
                                <?php if ($plan['name'] == $user['active_plan']): ?>
                                    <span class="active-pill"><i class="fa-solid fa-check"></i> Active Plan</span>
                                <?php endif; ?>
                            </div>

                            <div class="plan-title-box">
                                <h3><?php echo $plan['name']; ?></h3>
                                <div class="price">₹<?php echo $plan['price']; ?><span>/ day</span></div>
                            </div>

                            <ul class="plan-items">
                                <?php foreach ($plan['items'] as $item): ?>
                                    <li><i class="fa-solid fa-check check-icon"></i> <?php echo $item; ?></li>
                                <?php endforeach; ?>
                            </ul>

                            <button class="btn-plan <?php echo $plan['name'] == $user['active_plan'] ? 'btn-active-plan' : ($plan['popular'] ? 'btn-primary' : 'btn-outline'); ?>" 
                                    data-testid="subscribe-plan-btn-<?php echo $plan['id']; ?>"
                                    onclick="alert('Subscribed to <?php echo $plan['name']; ?>!')">
                                <?php echo $plan['name'] == $user['active_plan'] ? 'Current Active Plan' : 'Choose Plan'; ?>
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- TODAY'S MENU -->
            <section id="menu-section" class="menu-section">
                <div class="section-header-row">
                    <div>
                        <h2>Today's Fresh Menu</h2>
                        <p>Prepared fresh in our certified cloud kitchen.</p>
                    </div>
                    <div class="filter-btns">
                        <button class="filter-btn active" onclick="filterCategory('All', this)">All</button>
                        <button class="filter-btn" onclick="filterCategory('Lunch', this)">Lunch</button>
                        <button class="filter-btn" onclick="filterCategory('Dinner', this)">Dinner</button>
                    </div>
                </div>

                <div class="menu-grid" id="menuGrid">
                    <?php foreach ($menu_items as $index => $menu): ?>
                        <div class="menu-card" data-category="<?php echo $menu['type']; ?>" data-testid="menu-item-card-<?php echo $index+1; ?>">
                            <div class="menu-img-wrap">
                                <img src="<?php echo $menu['img']; ?>" alt="<?php echo $menu['title']; ?>">
                                <span class="meal-type-tag"><?php echo $menu['type']; ?></span>
                                <span class="rating-tag"><i class="fa-solid fa-star"></i> <?php echo $menu['rating']; ?></span>
                            </div>
                            <div class="menu-content">
                                <div class="menu-meta">
                                    <span><?php echo $menu['calories']; ?></span>
                                    <span class="chef-special">Chef Special</span>
                                </div>
                                <h4><?php echo $menu['title']; ?></h4>
                                <p><?php echo $menu['desc']; ?></p>
                            </div>
                            <div class="menu-footer">
                                <button class="btn-customize" data-testid="customize-meal-button-<?php echo $index+1; ?>" onclick="openModal('<?php echo $menu['title']; ?>')">
                                    <i class="fa-solid fa-sliders"></i> Customize & Order
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- STATS BANNER -->
            <section class="stats-banner">
                <div class="stat-item" data-testid="stat-card-happy-customers">
                    <div class="stat-icon emerald"><i class="fa-solid fa-user-group"></i></div>
                    <h3>10,000+</h3>
                    <p>Happy Customers</p>
                </div>
                <div class="stat-item" data-testid="stat-card-tiffins-delivered">
                    <div class="stat-icon orange"><i class="fa-solid fa-box"></i></div>
                    <h3>25,000+</h3>
                    <p>Tiffins Delivered Daily</p>
                </div>
                <div class="stat-item" data-testid="stat-card-reviews">
                    <div class="stat-icon amber"><i class="fa-solid fa-star"></i></div>
                    <div class="flex-center"><span>4.8</span> <div class="stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div></div>
                    <p>1200+ Reviews</p>
                </div>
                <div class="stat-item" data-testid="stat-card-support">
                    <div class="stat-icon blue"><i class="fa-solid fa-headset"></i></div>
                    <h3>24/7</h3>
                    <p>Customer Support</p>
                </div>
            </section>

            <!-- FOOTER -->
            <footer>
                <p>© 2026 TiffinService Inc. All rights reserved. Built with PHP & MySQL.</p>
                <p>Surat Cloud Kitchen #3 • FSSAI Certified #10721014000392</p>
            </footer>
        </main>
    </div>

    <!-- CUSTOMIZE MODAL -->
    <div id="customizeModal" class="modal-overlay" data-testid="meal-customizer-modal">
        <div class="modal-box">
            <div class="modal-header">
                <div>
                    <span class="badge-orange">Customize Meal</span>
                    <h3 id="modalMealTitle">North Indian Thali</h3>
                </div>
                <button class="modal-close" onclick="closeModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <label class="form-label">Select Roti Preference</label>
                <select class="form-select" id="rotiSelect">
                    <option>Whole Wheat Chapati (Phulka)</option>
                    <option>Multigrain Roti (+₹5)</option>
                    <option>Bajra Roti (Traditional)</option>
                </select>

                <label class="form-label">Select Rice / Grain</label>
                <select class="form-select" id="riceSelect">
                    <option>Jeera Basmati Rice</option>
                    <option>Steamed Sona Masuri Rice</option>
                    <option>Brown Rice (Dietary)</option>
                </select>

                <label class="form-label">Spice Level</label>
                <div class="spice-grid">
                    <button class="spice-btn" onclick="setSpice('Mild', this)">Mild</button>
                    <button class="spice-btn active" onclick="setSpice('Medium', this)">Medium</button>
                    <button class="spice-btn" onclick="setSpice('Spicy', this)">Spicy</button>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-cancel" onclick="closeModal()">Cancel</button>
                <button class="btn-primary" data-testid="modal-save-btn" onclick="saveCustomization()">Save & Apply Preference</button>
            </div>
        </div>
    </div>

    <!-- JavaScript Interactions -->
     <script>
        function openModal(title) {
            document.getElementById('modalMealTitle').innerText = title;
            document.getElementById('customizeModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('customizeModal').style.display = 'none';
        }

        function setSpice(level, btn) {
            document.querySelectorAll('.spice-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        }

        function saveCustomization() {
            alert('Meal preference saved successfully!');
            closeModal();
        }

        function filterCategory(category, btn) {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const cards = document.querySelectorAll('.menu-card');
            cards.forEach(card => {
                if (category === 'All' || card.getAttribute('data-category') === category) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function filterMenu() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let cards = document.querySelectorAll('.menu-card');
            cards.forEach(card => {
                let text = card.innerText.toLowerCase();
                card.style.display = text.includes(input) ? 'flex' : 'none';
            });
        }
    </script>
    
</body>
</html>
