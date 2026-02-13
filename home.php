<?php include 'header.php'; ?>

        <style>
            /* Animation keyframes */
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }

            /* Classes to apply animations */
            .animate-on-scroll {
                opacity: 0; /* Start hidden */
            }
            .animated {
                animation-duration: 0.8s;
                animation-fill-mode: forwards;
                animation-timing-function: cubic-bezier(0.2, 0.8, 0.2, 1);
            }
        </style>

        <main class="flex flex-1 flex-col items-center justify-center">
            <!-- Hero Section -->
            <section class="w-full px-6 py-12 md:py-20">
                <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div class="text-center md:text-left animate-on-scroll">
                        <h1 class="text-4xl md:text-6xl font-display font-bold text-gray-800 dark:text-white tracking-wide leading-tight">
                            Secure Data Erasure, Simplified.
                        </h1>
                        <p class="mt-6 max-w-xl mx-auto md:mx-0 text-lg text-gray-600 dark:text-slate-400">
                            OctaWipe provides professional-grade tools to permanently and securely erase data from your storage devices, ensuring your sensitive information is irrecoverable.
                        </p>
                        <div class="mt-10">
                            <a href="enterprise/single_wipe.php" class="px-8 py-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 dark:hover:bg-indigo-500 transition-colors text-lg">
                                Launch Wiping Tool
                            </a>
                        </div>
                    </div>
                    <div class="hidden md:block animate-on-scroll" style="animation-delay: 0.2s;">
                        <img src="logo.png" alt="OctaWipe Logo" class="w-full h-80 object-cover rounded-2xl shadow-2xl">
                    </div>
                </div>
            </section>

            <!-- About Section -->
            <section class="w-full bg-white dark:bg-slate-800/50 py-16 animate-on-scroll">
                <div class="max-w-4xl mx-auto px-6 text-center">
                    <h2 class="text-3xl font-display font-bold text-gray-800 dark:text-white">About OctaWipe</h2>
                    <p class="mt-4 max-w-2xl mx-auto text-gray-600 dark:text-slate-400">
                        In a world where data is more valuable than ever, ensuring its complete removal is critical. OctaWipe was built to provide a powerful, yet easy-to-use solution for individuals and businesses to securely sanitize storage media. We bridge the gap between complex command-line utilities and user-friendly applications, making data security accessible to everyone.
                    </p>
                </div>
            </section>

            <!-- Why Us Section -->
            <section class="w-full py-20">
                <div class="max-w-5xl mx-auto px-6 text-center">
                    <h2 class="text-3xl font-display font-bold text-gray-800 dark:text-white animate-on-scroll">Why Choose OctaWipe?</h2>
                    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-10">
                        <!-- Feature 1 -->
                        <div class="flex flex-col items-center animate-on-scroll">
                            <div class="flex items-center justify-center h-16 w-16 bg-indigo-100 dark:bg-slate-700 rounded-full">
                                <svg class="h-8 w-8 text-indigo-600 dark:text-indigo-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.286zm0 13.036h.008v.008h-.008v-.008z" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">Secure & Compliant</h3>
                            <p class="mt-2 text-gray-600 dark:text-slate-400">Utilizes industry-standard wiping algorithms to ensure data is permanently destroyed and forensically unrecoverable, helping you meet compliance requirements.</p>
                        </div>
                        <!-- Feature 2 -->
                        <div class="flex flex-col items-center animate-on-scroll" style="animation-delay: 0.2s;">
                            <div class="flex items-center justify-center h-16 w-16 bg-indigo-100 dark:bg-slate-700 rounded-full">
                               <svg class="h-8 w-8 text-indigo-600 dark:text-indigo-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">Intuitive Interface</h3>
                            <p class="mt-2 text-gray-600 dark:text-slate-400">A clean, straightforward dashboard that automatically detects connected devices and displays all the information you need to make informed decisions.</p>
                        </div>
                        <!-- Feature 3 -->
                        <div class="flex flex-col items-center animate-on-scroll" style="animation-delay: 0.4s;">
                            <div class="flex items-center justify-center h-16 w-16 bg-indigo-100 dark:bg-slate-700 rounded-full">
                                <svg class="h-8 w-8 text-indigo-600 dark:text-indigo-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.75h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5-13.5h16.5M3.75 6h16.5M3.75 18h16.5M3.75 12h16.5m-16.5-3.75h16.5" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">Cross-Platform</h3>
                            <p class="mt-2 text-gray-600 dark:text-slate-400">Designed to be deployed as a bootable ISO, OctaWipe runs independently of your primary OS, allowing it to wipe any compatible storage device.</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Floating Theme Toggle Button -->
        <div class="fixed bottom-6 right-6 z-50">
            <button id="theme-toggle" class="p-3 bg-white dark:bg-slate-700 rounded-full text-gray-500 dark:text-slate-400 hover:bg-gray-200 dark:hover:bg-slate-600 shadow-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-slate-900">
                <svg id="theme-icon-sun" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                <svg id="theme-icon-moon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
            </button>
        </div>
        
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeToggleBtn = document.getElementById('theme-toggle');
            const sunIcon = document.getElementById('theme-icon-sun');
            const moonIcon = document.getElementById('theme-icon-moon');
            const root = document.documentElement;

            function updateThemeUI() {
                if (root.classList.contains('dark')) {
                    sunIcon.style.display = 'block'; 
                    moonIcon.style.display = 'none';
                } else {
                    sunIcon.style.display = 'none';
                    moonIcon.style.display = 'block';
                }
            }
            
            if(themeToggleBtn) {
                themeToggleBtn.addEventListener('click', () => {
                    root.classList.toggle('dark');
                    localStorage.theme = root.classList.contains('dark') ? 'dark' : 'light';
                    updateThemeUI();
                });
                updateThemeUI();
            }

            // --- Animation on Scroll Logic ---
            const animatedElements = document.querySelectorAll('.animate-on-scroll');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                        entry.target.style.animationName = 'fadeInUp';
                        observer.unobserve(entry.target); // Optional: stop observing once animated
                    }
                });
            }, {
                threshold: 0.1 // Trigger when 10% of the element is visible
            });

            animatedElements.forEach(el => {
                observer.observe(el);
            });
        });
    </script>
</body>
</html>
