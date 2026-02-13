<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OctaWipe</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500&family=Orbitron:wght@700&display=swap" rel="stylesheet">

    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        tailwind.config = { darkMode: 'class', theme: { extend: { fontFamily: { 'mono': ['Fira Code', 'monospace'], 'display': ['Orbitron', 'sans-serif'], }, }, }, }
    </script>
    <style>
        body { 
            font-family: 'Fira Code', monospace; 
            /* Dotted background for light mode */
            background-image: radial-gradient(circle at 1px 1px, #d1d5db 1px, transparent 0);
            background-size: 24px 24px;
        }
        .dark body {
            /* Dotted background for dark mode */
            background-image: radial-gradient(circle at 1px 1px, #475569 1px, transparent 0);
            background-size: 24px 24px;
        }
        
        .device-item.selected {
             background-color: #e0e7ff; /* Tailwind's bg-indigo-100 */
             border-left-color: #a5b4fc; /* Tailwind's border-l-indigo-300 */
        }
        .dark .device-item.selected {
            background-color: #334155; /* Tailwind's dark:bg-slate-700 */
            border-left-color: #a5b4fc; /* Tailwind's dark:border-l-indigo-300 */
        }
        
        #device-sidebar.collapsed { width: 5rem; }
        #device-sidebar.collapsed .sidebar-content { display: none; }
        #device-sidebar.collapsed .device-item .truncate { display: none; }
        #device-sidebar.collapsed #sidebar-toggle svg { transform: rotate(180deg); }
        #device-sidebar.collapsed .device-item { justify-content: center; }
        #device-sidebar.collapsed .device-item .flex-shrink-0:not(:last-child) { margin: 0; }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-900 text-gray-800 dark:text-slate-200 transition-colors duration-300">
    <div class="flex flex-col h-screen">
        
        <header class="sticky top-0 z-50 bg-white/80 dark:bg-slate-800/80 backdrop-blur-md">
            <div class="flex justify-between items-center px-6 py-3 border-b border-gray-200/50 dark:border-slate-700/50">
                <a href="/home.php" class="flex items-center gap-3">
                    <svg class="h-8 w-8 text-indigo-600 dark:text-indigo-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836l-8.25 8.25a.75.75 0 000 1.06l8.25 8.25a.75.75 0 001.06 0l8.25-8.25a.75.75 0 000-1.06l-8.25-8.25a.75.75 0 00-1.06 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836V12l8.25 8.25" />
                    </svg>
                    <h1 class="font-display text-2xl text-gray-800 dark:text-white tracking-wider">OctaWipe</h1>
                </a>

                <div class="flex items-center gap-8">
                    <nav class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-600 dark:text-slate-400">
                        <a href="../../../..//iso.php" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Download ISO</a>
                        <a href="../../../../Enterprise/index.php" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Enterprise solutions</a>
                        <a href="../../../..//faq.php" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">FAQs</a>
                        <a href="../../../..//contact.php" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Contact US</a>
                    </nav>
                    <a href="../../../..//login.php" class="px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 dark:hover:bg-indigo-500 transition-colors">
                        Login / Sign Up
                    </a>
                </div>
            </div>
        </header>

