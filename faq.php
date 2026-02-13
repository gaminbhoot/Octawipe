<?php include 'header.php'; ?>

<main class="flex-grow px-4 sm:px-6 lg:px-8 py-12">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-display font-bold text-gray-900 dark:text-white">
                Frequently Asked Questions
            </h2>
            <p class="mt-4 text-lg text-gray-600 dark:text-slate-400">
                Have questions? We've got answers. If you can't find what you're looking for, feel free to <a href="contact.php" class="text-indigo-600 dark:text-indigo-400 hover:underline">contact us</a>.
            </p>
        </div>

        <div class="space-y-4" id="faq-accordion">
            <!-- FAQ Item 1 -->
            <div class="bg-white dark:bg-slate-800/50 shadow-lg rounded-xl border border-gray-200/50 dark:border-slate-700/50 overflow-hidden">
                <button class="faq-question w-full flex justify-between items-center text-left p-6">
                    <span class="text-lg font-semibold text-gray-800 dark:text-slate-200">What is OctaWipe and why is it necessary?</span>
                    <svg class="faq-arrow h-6 w-6 text-gray-500 dark:text-slate-400 transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                    <div class="p-6 pt-0 text-gray-600 dark:text-slate-400">
                        <p>OctaWipe is a secure data wiping dashboard developed by Team Octagon. Unlike simply deleting files or formatting a drive (which often leaves data recoverable), OctaWipe securely overwrites the entire storage device with specific patterns. This ensures that sensitive data is permanently erased and cannot be recovered by forensic tools.</p>
                    </div>
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="bg-white dark:bg-slate-800/50 shadow-lg rounded-xl border border-gray-200/50 dark:border-slate-700/50 overflow-hidden">
                <button class="faq-question w-full flex justify-between items-center text-left p-6">
                    <span class="text-lg font-semibold text-gray-800 dark:text-slate-200">Is the wiping process truly irreversible?</span>
                     <svg class="faq-arrow h-6 w-6 text-gray-500 dark:text-slate-400 transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                    <div class="p-6 pt-0 text-gray-600 dark:text-slate-400">
                        <p>Yes. Once a device has been securely wiped with OctaWipe, the data cannot be recovered by conventional or forensic methods. Our methods are designed to meet recognized security standards. It is critical that you back up any important files before starting the wiping process.</p>
                    </div>
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="bg-white dark:bg-slate-800/50 shadow-lg rounded-xl border border-gray-200/50 dark:border-slate-700/50 overflow-hidden">
                <button class="faq-question w-full flex justify-between items-center text-left p-6">
                    <span class="text-lg font-semibold text-gray-800 dark:text-slate-200">What devices and wiping methods are supported?</span>
                     <svg class="faq-arrow h-6 w-6 text-gray-500 dark:text-slate-400 transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                    <div class="p-6 pt-0 text-gray-600 dark:text-slate-400">
                        <p>OctaWipe supports HDDs, SSDs, and USB drives detected by the system. We provide several overwrite methods, including single-pass (fast, basic security) and multi-pass options (for higher security needs), based on widely recognized standards like NIST 800-88.</p>
                    </div>
                </div>
            </div>
            
             <!-- FAQ Item 4 -->
            <div class="bg-white dark:bg-slate-800/50 shadow-lg rounded-xl border border-gray-200/50 dark:border-slate-700/50 overflow-hidden">
                <button class="faq-question w-full flex justify-between items-center text-left p-6">
                    <span class="text-lg font-semibold text-gray-800 dark:text-slate-200">Can I see the progress of the wipe?</span>
                     <svg class="faq-arrow h-6 w-6 text-gray-500 dark:text-slate-400 transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                    <div class="p-6 pt-0 text-gray-600 dark:text-slate-400">
                        <p>Yes, the dashboard provides live progress tracking for each wiping job, including the percentage complete and an estimated time to completion, so you are always informed.</p>
                    </div>
                </div>
            </div>

            <!-- FAQ Item 5 -->
            <div class="bg-white dark:bg-slate-800/50 shadow-lg rounded-xl border border-gray-200/50 dark:border-slate-700/50 overflow-hidden">
                <button class="faq-question w-full flex justify-between items-center text-left p-6">
                    <span class="text-lg font-semibold text-gray-800 dark:text-slate-200">What happens if a wipe is interrupted?</span>
                     <svg class="faq-arrow h-6 w-6 text-gray-500 dark:text-slate-400 transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                    <div class="p-6 pt-0 text-gray-600 dark:text-slate-400">
                        <p>If a wipe process is interrupted (e.g., due to a power failure), the disk will be in a partially wiped state. While some data will be destroyed, the drive will not be fully sanitized. We strongly recommend running the wipe process again from the beginning to ensure complete data security.</p>
                    </div>
                </div>
            </div>

             <!-- FAQ Item 6 -->
            <div class="bg-white dark:bg-slate-800/50 shadow-lg rounded-xl border border-gray-200/50 dark:border-slate-700/50 overflow-hidden">
                <button class="faq-question w-full flex justify-between items-center text-left p-6">
                    <span class="text-lg font-semibold text-gray-800 dark:text-slate-200">Are advanced features like remote or scheduled wipes available?</span>
                     <svg class="faq-arrow h-6 w-6 text-gray-500 dark:text-slate-400 transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                    <div class="p-6 pt-0 text-gray-600 dark:text-slate-400">
                        <p>Functionality for remote device wiping and scheduling automatic wipes are on our development roadmap and are planned for future enterprise updates. They are not available in the current release.</p>
                    </div>
                </div>
            </div>

            <!-- FAQ Item 7 -->
            <div class="bg-white dark:bg-slate-800/50 shadow-lg rounded-xl border border-gray-200/50 dark:border-slate-700/50 overflow-hidden">
                <button class="faq-question w-full flex justify-between items-center text-left p-6">
                    <span class="text-lg font-semibold text-gray-800 dark:text-slate-200">How do you ensure compliance and report integrity?</span>
                     <svg class="faq-arrow h-6 w-6 text-gray-500 dark:text-slate-400 transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                    <div class="p-6 pt-0 text-gray-600 dark:text-slate-400">
                        <p>We adhere to rigorous standards like NIST 800-88 for data sanitization. After every successful wipe, we provide a detailed report in both PDF and JSON formats. To guarantee these reports cannot be altered, their integrity is secured using blockchain technology, creating a tamper-proof audit trail for your compliance needs.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

</div> <!-- Closes the flex container from header.php -->

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const accordion = document.getElementById('faq-accordion');
        if (accordion) {
            const questions = accordion.querySelectorAll('.faq-question');

            questions.forEach(question => {
                question.addEventListener('click', () => {
                    const answer = question.nextElementSibling;
                    const arrow = question.querySelector('.faq-arrow');
                    
                    // Close all other answers
                    questions.forEach(q => {
                        if (q !== question) {
                            q.nextElementSibling.style.maxHeight = '0px';
                            q.querySelector('.faq-arrow').classList.remove('rotate-180');
                        }
                    });

                    // Toggle the clicked answer
                    if (answer.style.maxHeight && answer.style.maxHeight !== '0px') {
                        answer.style.maxHeight = '0px';
                        arrow.classList.remove('rotate-180');
                    } else {
                        answer.style.maxHeight = answer.scrollHeight + 'px';
                        arrow.classList.add('rotate-180');
                    }
                });
            });
        }
    });
</script>
</body>
</html>

