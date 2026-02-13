<?php include 'header.php'; ?>

<main class="flex-grow flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-display font-bold text-gray-900 dark:text-white">
                Sign in to your account
            </h2>
        </div>

        <div class="mt-8 bg-white dark:bg-slate-800/50 shadow-xl rounded-2xl p-8 sm:p-10 space-y-6 backdrop-blur-sm border border-gray-200/50 dark:border-slate-700/50">
            <form class="space-y-6" action="#" method="POST">
                <input type="hidden" name="remember" value="true">
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
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 dark:border-slate-600 rounded-md shadow-sm placeholder-gray-400 dark:placeholder-slate-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-slate-50 dark:bg-slate-700 text-gray-900 dark:text-slate-200">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-slate-600 rounded bg-slate-50 dark:bg-slate-700">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-900 dark:text-slate-300">
                            Remember me
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                            Forgot your password?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-slate-900 transition-colors">
                        Sign in
                    </button>
                </div>
            </form>
        </div>

        <p class="mt-2 text-center text-sm text-gray-600 dark:text-slate-400">
            Don't have an account?
            <a href="signup.php" class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                Sign up
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
