<?php include 'header.php'; ?>

<main class="flex-grow flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-4xl w-full">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-display font-bold text-gray-900 dark:text-white">
                Get in Touch
            </h2>
            <p class="mt-4 text-lg text-gray-600 dark:text-slate-400">
                We'd love to hear from you. Please fill out the form below or use our contact details.
            </p>
        </div>

        <div class="bg-white dark:bg-slate-800/50 shadow-xl rounded-2xl backdrop-blur-sm border border-gray-200/50 dark:border-slate-700/50 overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <!-- Contact Form -->
                <div class="p-8 sm:p-10">
                    <form action="#" method="POST" class="space-y-6">
                        <div>
                            <label for="full-name" class="block text-sm font-medium text-gray-700 dark:text-slate-300">Full Name</label>
                            <div class="mt-1">
                                <input type="text" name="full-name" id="full-name" autocomplete="name" required class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm placeholder-gray-400 dark:placeholder-slate-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-50 dark:bg-slate-700 text-gray-900 dark:text-slate-200">
                            </div>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-slate-300">Email</label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email" autocomplete="email" required class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm placeholder-gray-400 dark:placeholder-slate-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-50 dark:bg-slate-700 text-gray-900 dark:text-slate-200">
                            </div>
                        </div>
                        <div>
                             <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-slate-300">Subject</label>
                            <div class="mt-1">
                                <input type="text" name="subject" id="subject" required class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm placeholder-gray-400 dark:placeholder-slate-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-50 dark:bg-slate-700 text-gray-900 dark:text-slate-200">
                            </div>
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-slate-300">Message</label>
                            <div class="mt-1">
                                <textarea id="message" name="message" rows="4" required class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm placeholder-gray-400 dark:placeholder-slate-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-50 dark:bg-slate-700 text-gray-900 dark:text-slate-200"></textarea>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-slate-900 transition-colors">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="p-8 sm:p-10 bg-slate-50 dark:bg-slate-800">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Contact Information</h3>
                    <p class="mt-2 text-gray-600 dark:text-slate-400">Our team is ready to assist you.</p>
                    <div class="mt-8 space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 h-6 w-6 text-indigo-600 dark:text-indigo-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-4.67c.12-.313.253-.617.4- .922" /></svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-base font-medium text-gray-900 dark:text-white">Team Name</p>
                                <p class="mt-1 text-gray-600 dark:text-slate-400">Octagon</p>
                            </div>
                        </div>
                         <div class="flex items-start">
                            <div class="flex-shrink-0 h-6 w-6 text-indigo-600 dark:text-indigo-400">
                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" /></svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-base font-medium text-gray-900 dark:text-white">Team ID</p>
                                <p class="mt-1 text-gray-600 dark:text-slate-400">51700</p>
                            </div>
                        </div>
                         <div class="flex items-start">
                            <div class="flex-shrink-0 h-6 w-6 text-indigo-600 dark:text-indigo-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-base font-medium text-gray-900 dark:text-white">Email</p>
                                <p class="mt-1 text-gray-600 dark:text-slate-400">support@octawipe.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

    </div> <!-- Closes the flex container from header.php -->

    <script>
        // You can add page-specific JS here if needed
    </script>
</body>
</html>
