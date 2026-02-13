<?php include 'header.php'; ?>

<main class="flex-grow flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-display font-bold text-gray-900 dark:text-white">
                Create an account
            </h2>
        </div>

        <div class="mt-8 bg-white dark:bg-slate-800/50 shadow-xl rounded-2xl p-8 sm:p-10 space-y-6 backdrop-blur-sm border border-gray-200/50 dark:border-slate-700/50">
            
            <!-- Social Sign Up Buttons -->
            <div class="space-y-4">
                 <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-slate-200 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600">
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M47.532 24.552c0-1.566-.14-3.084-.408-4.548H24.48v8.616h12.948c-.564 2.772-2.22 5.148-4.824 6.78l.012.168 7.032 5.46c4.104-3.792 6.84-9.6 6.84-16.476z" fill="#4285F4"></path>
                        <path d="M24.48 48c6.492 0 11.964-2.136 15.948-5.784l-7.032-5.46c-2.16 1.452-4.908 2.316-8.916 2.316-6.852 0-12.66-4.608-14.736-10.764l-.204.024-7.224 5.616C6.012 41.172 14.604 48 24.48 48z" fill="#34A853"></path>
                        <path d="M9.744 28.38c-.552-1.668-.864-3.444-.864-5.304s.312-3.636.864-5.304l-.024-.204-7.224-5.616C1.224 15.132 0 19.392 0 24.072s1.224 8.94 3.288 12.132l7.248-5.616z" fill="#FBBC05"></path>
                        <path d="M24.48 9.492c3.516 0 6.6.12 8.784 2.592l6.228-6.228C36.432 2.196 30.972 0 24.48 0 14.604 0 6.012 6.828 3.288 15.936l7.248 5.616C12.564 14.94 18.372 9.492 24.48 9.492z" fill="#EA4335"></path>
                    </svg>
                    Sign up with Google
                </a>
                 <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-slate-200 bg-white dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600">
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.74 0H0V10.74H10.74V0Z" fill="#F25022"></path>
                        <path d="M22.74 0H12V10.74H22.74V0Z" fill="#7FBA00"></path>
                        <path d="M10.74 12H0V22.74H10.74V12Z" fill="#00A4EF"></path>
                        <path d="M22.74 12H12V22.74H22.74V12Z" fill="#FFB900"></path>
                    </svg>
                    Sign up with Microsoft
                </a>
            </div>

            <!-- Divider -->
            <div class="relative flex py-2 items-center">
                <div class="flex-grow border-t border-gray-300 dark:border-slate-600"></div>
                <span class="flex-shrink mx-4 text-sm text-gray-500 dark:text-slate-400">OR</span>
                <div class="flex-grow border-t border-gray-300 dark:border-slate-600"></div>
            </div>

            <form class="space-y-6" action="#" method="POST">
                <div>
                    <label for="email-address" class="block text-sm font-medium text-gray-700 dark:text-slate-300">
                        Email address
                    </label>
                    <div class="mt-1">
                        <input id="email-address" name="email" type="email" autocomplete="email" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm placeholder-gray-400 dark:placeholder-slate-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-50 dark:bg-slate-700 text-gray-900 dark:text-slate-200">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-slate-300">
                        Password
                    </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm placeholder-gray-400 dark:placeholder-slate-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-50 dark:bg-slate-700 text-gray-900 dark:text-slate-200">
                    </div>
                </div>
                
                 <div>
                    <label for="confirm-password" class="block text-sm font-medium text-gray-700 dark:text-slate-300">
                        Confirm Password
                    </label>
                    <div class="mt-1">
                        <input id="confirm-password" name="confirm-password" type="password" autocomplete="new-password" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm placeholder-gray-400 dark:placeholder-slate-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-50 dark:bg-slate-700 text-gray-900 dark:text-slate-200">
                    </div>
                </div>


                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-slate-900 transition-colors">
                        Create account
                    </button>
                </div>
            </form>
        </div>

        <p class="mt-2 text-center text-sm text-gray-600 dark:text-slate-400">
            Already have an account?
            <a href="login.php" class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                Sign in
            </a>
        </p>
    </div>
</main>

    </div> <!-- Closes the flex container from header.php -->

    <script>
        // You can add page-specific JS here if needed
    </script>
</body>
</html>
