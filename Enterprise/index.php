<?php include '../header.php'; ?>

<main class="flex-grow">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-4xl font-display font-bold text-gray-900 dark:text-white sm:text-5xl">
                Enterprise Data Erasure
            </h2>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500 dark:text-slate-400">
                Powerful, scalable, and compliant solutions for your organization's data sanitization needs.
            </p>
        </div>

        <div class="mt-16 grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Single Wipe Card -->
            <a href="single_wipe.php" class="group block bg-white dark:bg-slate-800/50 border border-gray-200/50 dark:border-slate-700/50 rounded-2xl shadow-lg hover:shadow-indigo-500/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-slate-900 transition-all duration-300">
                <div class="p-8 flex flex-col items-center text-center">
                    <div class="flex items-center justify-center h-24 w-24 bg-indigo-100 dark:bg-slate-700 rounded-full mb-6 group-hover:bg-indigo-200 dark:group-hover:bg-slate-600 transition-colors">
                        <svg class="h-12 w-12 text-gray-800 dark:text-slate-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25A2.25 2.25 0 015.25 3h13.5A2.25 2.25 0 0121 5.25z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-display font-semibold text-gray-900 dark:text-white">
                        Single Wipe
                    </h3>
                    <p class="mt-3 text-gray-600 dark:text-slate-400">
                        Securely erase individual hard drives or solid-state drives connected directly to your workstation. Ideal for processing single assets or small batches of devices.
                    </p>
                </div>
            </a>

            <!-- Network Wipe Card -->
            <a href="network_wipe.php" class="group block bg-white dark:bg-slate-800/50 border border-gray-200/50 dark:border-slate-700/50 rounded-2xl shadow-lg hover:shadow-indigo-500/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-slate-900 transition-all duration-300">
                <div class="p-8 flex flex-col items-center text-center">
                     <div class="flex items-center justify-center h-24 w-24 bg-indigo-100 dark:bg-slate-700 rounded-full mb-6 group-hover:bg-indigo-200 dark:group-hover:bg-slate-600 transition-colors">
                        <svg class="h-12 w-12 text-gray-800 dark:text-slate-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 0 1 7.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 0 1 1.06 0Z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-display font-semibold text-gray-900 dark:text-white">
                        Network Wipe
                    </h3>
                    <p class="mt-3 text-gray-600 dark:text-slate-400">
                        Deploy data erasure routines to multiple devices across your network simultaneously via PXE boot. The perfect solution for large-scale IT asset decommissioning.
                    </p>
                </div>
            </a>
        </div>
    </div>
</main>

</div> <!-- Closes the flex container from header.php -->
</body>
</html>

