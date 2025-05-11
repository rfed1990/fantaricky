<?php include 'header.php'; ?>

<!-- Aggiungi il file JavaScript per la gestione delle estensioni -->
<script src="js/extension-store.js" defer></script>

<div class="container mt-5 mb-5">
    <h1 class="text-center mb-4">Extension Store</h1>
    
    <div class="row g-4">
        <!-- Extension Card 1 -->
        <div class="col-md-4">
            <div class="card h-100">
                <img src="images/extension1.jpg" class="card-img-top" alt="Extension 1" onerror="this.src='images/default-extension.jpg'">
                <div class="card-body">
                    <h5 class="card-title">Advanced Analytics</h5>
                    <p class="card-text">Powerful analytics tools to track and analyze your website performance in real-time.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-success">Free</span>
                        <button class="btn btn-primary" onclick="toggleExtension('advanced-analytics', this)">Install</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Extension Card 2 -->
        <div class="col-md-4">
            <div class="card h-100">
                <img src="images/extension2.jpg" class="card-img-top" alt="Extension 2" onerror="this.src='images/default-extension.jpg'">
                <div class="card-body">
                    <h5 class="card-title">SEO Optimizer</h5>
                    <p class="card-text">Optimize your content for search engines with advanced SEO tools and recommendations.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-primary">$9.99/mo</span>
                        <button class="btn btn-primary" onclick="toggleExtension('seo-optimizer', this)">Install</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Extension Card 3 -->
        <div class="col-md-4">
            <div class="card h-100">
                <img src="images/extension3.jpg" class="card-img-top" alt="Extension 3" onerror="this.src='images/default-extension.jpg'">
                <div class="card-body">
                    <h5 class="card-title">Security Suite</h5>
                    <p class="card-text">Comprehensive security features to protect your website from threats and vulnerabilities.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-primary">$19.99/mo</span>
                        <button class="btn btn-primary" onclick="toggleExtension('security-suite', this)">Install</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Extension Card 4 -->
        <div class="col-md-4">
            <div class="card h-100">
                <img src="images/extension4.jpg" class="card-img-top" alt="Extension 4" onerror="this.src='images/default-extension.jpg'">
                <div class="card-body">
                    <h5 class="card-title">Social Media Integration</h5>
                    <p class="card-text">Seamlessly integrate social media feeds and sharing capabilities into your website.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-success">Free</span>
                        <button class="btn btn-primary" onclick="toggleExtension('social-media', this)">Install</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Extension Card 5 -->
        <div class="col-md-4">
            <div class="card h-100">
                <img src="images/extension5.jpg" class="card-img-top" alt="Extension 5" onerror="this.src='images/default-extension.jpg'">
                <div class="card-body">
                    <h5 class="card-title">Backup Pro</h5>
                    <p class="card-text">Automated backup solutions with cloud storage integration and instant restore capabilities.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-primary">$14.99/mo</span>
                        <button class="btn btn-primary" onclick="toggleExtension('backup-pro', this)">Install</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Extension Card 6 -->
        <div class="col-md-4">
            <div class="card h-100">
                <img src="images/extension6.jpg" class="card-img-top" alt="Extension 6" onerror="this.src='images/default-extension.jpg'">
                <div class="card-body">
                    <h5 class="card-title">Performance Optimizer</h5>
                    <p class="card-text">Optimize your website's performance with advanced caching and compression tools.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-primary">$12.99/mo</span>
                        <button class="btn btn-primary" onclick="toggleExtension('performance-optimizer', this)">Install</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>