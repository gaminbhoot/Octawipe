<?php 
$path_prefix = './'; // Set the path prefix for the header links
include 'header.php'; 
?>

<main class="flex-1 px-4 py-8 md:px-6 md:py-12">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-slate-800/50 rounded-xl shadow-lg border border-gray-200/50 dark:border-slate-700/50 p-6 md:p-10">

            <!-- Header Section -->
            <div class="text-center mb-8">
                <svg class="h-16 w-16 mx-auto text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 13.5l3 3m0 0l3-3m-3 3v-6m1.06-4.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                </svg>
                <h1 class="text-4xl font-display font-bold text-gray-800 dark:text-white mt-4">OctaWipe Bootable ISO</h1>
                <p class="mt-2 text-lg text-gray-600 dark:text-slate-400">Create a bootable USB drive to run OctaWipe on any compatible machine, independent of its operating system.</p>
            </div>

            <!-- Instructions Section -->
            <div class="space-y-8">
                
                <!-- Prerequisites -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white border-b dark:border-slate-700 pb-2">1. Prerequisites</h2>
                    <ul class="list-disc list-inside mt-4 space-y-2 text-gray-600 dark:text-slate-400">
                        <li>A USB flash drive (at least 2GB). <strong class="text-red-500">Note: All data on this drive will be erased.</strong></li>
                        <li>The <a href="#download" class="text-indigo-500 hover:underline font-semibold">OctaWipe ISO file</a> (see download link below).</li>
                        <li>The <a href="https://rufus.ie/en/" target="_blank" rel="noopener noreferrer" class="text-indigo-500 hover:underline font-semibold">Rufus utility</a> for Windows. (For macOS or Linux, you can use similar tools like balenaEtcher).</li>
                    </ul>
                </div>

                <!-- Creation Steps -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white border-b dark:border-slate-700 pb-2">2. Creating the Bootable Drive</h2>
                    <ol class="list-decimal list-inside mt-4 space-y-4 text-gray-600 dark:text-slate-400">
                        <li><strong>Launch Rufus:</strong> Open the Rufus application. It will automatically detect your connected USB drives.</li>
                        <li><strong>Select your USB drive:</strong> From the 'Device' dropdown menu, choose the USB drive you want to make bootable.</li>
                        <li><strong>Select the ISO:</strong> Click the 'SELECT' button and navigate to the location where you saved the `OctaWipe.iso` file.</li>
                        <li><strong>Confirm Settings:</strong> For most modern computers, the default settings (Partition scheme: GPT, Target system: UEFI) will work correctly. You shouldn't need to change these.</li>
                        <li><strong>Start the Process:</strong> Click the 'START' button. Rufus will show a final warning that all data on the selected USB drive will be destroyed. Confirm this to proceed.</li>
                        <li><strong>Wait for Completion:</strong> The process will take a few minutes. Once the progress bar is full and says 'READY', your bootable OctaWipe drive is complete.</li>
                    </ol>
                </div>
                
                 <!-- How to Use -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white border-b dark:border-slate-700 pb-2">3. How to Use</h2>
                     <ol class="list-decimal list-inside mt-4 space-y-4 text-gray-600 dark:text-slate-400">
                        <li><strong>Insert Drive:</strong> Insert the newly created bootable USB drive into the computer you wish to wipe.</li>
                        <li><strong>Power On & Enter Boot Menu:</strong> Restart or power on the machine. As it starts, immediately press the key to open the boot device selection menu. Common keys are <kbd class="font-semibold text-gray-800 dark:text-slate-200">F12</kbd>, <kbd class="font-semibold text-gray-800 dark:text-slate-200">F10</kbd>, <kbd class="font-semibold text-gray-800 dark:text-slate-200">F2</kbd>, or <kbd class="font-semibold text-gray-800 dark:text-slate-200">ESC</kbd>. The correct key is usually displayed on the initial startup screen.</li>
                        <li><strong>Select USB Drive:</strong> Using your keyboard's arrow keys, navigate the boot menu and select your USB drive, then press Enter.</li>
                        <li><strong>Load OctaWipe:</strong> The computer will now boot from the USB drive. The OctaWipe dashboard will load automatically, ready for use.</li>
                     </ol>
                     <div class="mt-4 p-4 bg-indigo-50 dark:bg-slate-700/50 rounded-lg text-sm">
                        <p class="font-semibold text-indigo-800 dark:text-indigo-300">Troubleshooting Tip:</p>
                        <p class="text-indigo-700 dark:text-indigo-400">If the USB drive doesn't appear in the boot menu, you may need to enter the main BIOS/UEFI settings (often by pressing <kbd class="font-semibold">DEL</kbd> or <kbd class="font-semibold">F2</kbd>) and disable the "Secure Boot" option.</p>
                     </div>
                </div>
            </div>

            <!-- Download Button -->
            <div id="download" class="mt-12 text-center">
                <a href="#" class="inline-block px-10 py-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 dark:hover:bg-indigo-500 transition-colors text-lg shadow-lg hover:shadow-xl">
                    Download OctaWipe.iso (v1.0.0)
                </a>
                <p class="text-xs text-gray-500 dark:text-slate-500 mt-2">File size: approx. 850 MB</p>
            </div>
        </div>
    </div>
</main>

</body>
</html>

