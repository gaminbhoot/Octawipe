<?php include '../header.php'; ?>

<?php
// --- REAL DATA LOADING ---
// Reads device information from the 'devices.json' file.
$jsonFile = '../devices.json';
$devices = []; // Default to an empty array for safety.

if (file_exists($jsonFile)) {
    $jsonData = file_get_contents($jsonFile);
    $decodedData = json_decode($jsonData, true);
    // Ensure the decoded data is a valid array.
    if (is_array($decodedData)) {
        $devices = $decodedData;
    }
}
// --- END DATA LOADING ---

/**
 * Gets an appropriate SVG icon based on the device's disk type.
 * @param string|null $diskType The type of the disk (e.g., "USB Drive").
 * @return string The SVG icon HTML.
 */
function getDeviceIcon($diskType) {
    // Standardize the input for reliable matching.
    $type = strtolower(trim($diskType ?? ''));
    
    if (strpos($type, 'usb') !== false) {
        // USB Icon
        return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8"><path d="M6 20h0a4 4 0 0 1-4-4V8a4 4 0 0 1 4-4h12a4 4 0 0 1 4 4v8a4 4 0 0 1-4 4h0"/><path d="M12 4v9"/><path d="M10 9l2 2 2-2"/><path d="M12 13v3"/><path d="M10 16h4"/></svg>';
    }
    if (strpos($type, 'sata') !== false || strpos($type, 'ssd') !== false || strpos($type, 'nvme') !== false) {
        // SSD/SATA/NVMe Icon
        return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M7 7h4"/><path d="M7 12h10"/><path d="M7 17h7"/></svg>';
    }
    // Default Disk Icon
    return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"/><path d="M12 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg>';
}
?>
        <div class="flex flex-1 overflow-hidden">
            <aside id="device-sidebar" class="w-96 bg-white dark:bg-slate-800/50 border-r border-gray-200 dark:border-slate-700/50 flex flex-col shrink-0 transition-all duration-300 ease-in-out">
                <div class="flex justify-between items-center p-4 border-b border-gray-200 dark:border-slate-700/50">
                    <h2 class="text-lg font-semibold dark:text-white sidebar-content">Devices</h2>
                    <button id="sidebar-toggle" class="p-1 rounded-full text-gray-500 dark:text-slate-400 hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors">
                        <svg class="w-5 h-5 transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 overflow-y-auto">
                    <div class="p-4 sidebar-content"><h3 class="text-xs font-semibold uppercase text-gray-400 dark:text-slate-500">Connected Devices (<?php echo count($devices); ?>)</h3></div>
                    <div id="device-list" class="space-y-1 px-2">
                        <?php if (!empty($devices)): ?>
                            <?php foreach ($devices as $device): ?>
                                <?php
                                $model = isset($device['model']) ? trim($device['model']) : 'Unknown Model';
                                $diskType = isset($device['disk_type']) ? $device['disk_type'] : 'N/A';
                                $sizeGb = isset($device['size_gb']) ? $device['size_gb'] : 0;
                                $status = !empty($device['partitions']) ? 'connected' : 'ready';
                                $deviceDetailsJson = htmlspecialchars(json_encode($device), ENT_QUOTES, 'UTF-8');
                                ?>
                                <div class="device-item group cursor-pointer p-3 border-l-4 border-transparent hover:bg-gray-100 dark:hover:bg-slate-700/50 rounded-lg transition-colors"
                                     data-details='<?php echo $deviceDetailsJson; ?>'>
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center gap-3 overflow-hidden">
                                            <span class="text-gray-500 dark:text-slate-400 flex-shrink-0"><?php echo getDeviceIcon($diskType); ?></span>
                                            <div class="truncate">
                                                <p class="font-semibold text-gray-900 dark:text-slate-100 truncate"><?php echo htmlspecialchars($model); ?></p>
                                                <p class="text-xs text-gray-500 dark:text-slate-400 truncate"><?php echo htmlspecialchars($diskType); ?></p>
                                            </div>
                                        </div>
                                        <div class="text-right flex-shrink-0 sidebar-content">
                                            <span class="text-xs font-medium px-2 py-1 rounded-full <?php echo $status === 'connected' ? 'text-green-600 bg-green-100 dark:text-green-300 dark:bg-green-900/30' : 'text-blue-600 bg-blue-100 dark:text-blue-300 dark:bg-blue-900/30'; ?>">
                                                <?php echo $status; ?>
                                            </span>
                                            <p class="text-sm font-medium text-gray-600 dark:text-slate-300 mt-1"><?php echo htmlspecialchars($sizeGb); ?> GB</p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="p-4 text-center text-gray-500 sidebar-content">No devices found. Check `devices.json`.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </aside>

            <main class="flex-1 flex items-start justify-center p-4 md:p-10 bg-dots overflow-y-auto">
                 <div id="main-content" class="w-full max-w-3xl">
                    <!-- This content will be dynamically generated by JavaScript -->
                </div>
            </main>
        </div>

        <!-- Floating Theme Toggle Button -->
        <div class="fixed bottom-6 right-6 z-50">
            <button id="theme-toggle" class="p-3 bg-white dark:bg-slate-700 rounded-full text-gray-500 dark:text-slate-400 hover:bg-gray-200 dark:hover:bg-slate-600 shadow-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-slate-900">
                <svg id="theme-icon-sun" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                <svg id="theme-icon-moon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
            </button>
        </div>

        <!-- Wipe Confirmation Modal -->
        <div id="wipe-warning-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm">
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-xl max-w-md w-full p-6 text-center border dark:border-slate-700">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100 dark:bg-red-800/50">
                    <svg class="h-6 w-6 text-red-600 dark:text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Heads Up!</h3>
                <div id="warning-text" class="mt-2 text-sm text-gray-600 dark:text-slate-400">
                    <!-- Warning message will be inserted here -->
                </div>
                <div class="mt-6 flex justify-center gap-4">
                    <button id="cancel-wipe-button" class="px-6 py-2 rounded-lg bg-gray-200 dark:bg-slate-700 text-gray-800 dark:text-slate-200 hover:bg-gray-300 dark:hover:bg-slate-600 font-semibold">Cancel</button>
                    <button id="proceed-wipe-button" class="px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 font-semibold">Proceed</button>
                </div>
            </div>
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/collapse@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deviceItems = document.querySelectorAll('.device-item');
            const mainContentContainer = document.getElementById('main-content');
            let wipeInterval = null; // To hold the simulation interval

            // --- Theme Toggle Logic ---
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

            // --- Sidebar Collapse Logic ---
            const sidebar = document.getElementById('device-sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');

            function applySidebarState(state) {
                if (state === 'collapsed') {
                    sidebar.classList.add('collapsed');
                } else {
                    sidebar.classList.remove('collapsed');
                }
            }

            const savedSidebarState = localStorage.getItem('sidebarState');
            if (savedSidebarState) {
                applySidebarState(savedSidebarState);
            }

            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                const newState = sidebar.classList.contains('collapsed') ? 'collapsed' : 'expanded';
                localStorage.setItem('sidebarState', newState);
            });

             // --- Main Content Update Functions ---
            function updateMainContent(deviceElement) {
                clearInterval(wipeInterval); // Stop any ongoing wipe simulation
                if (!deviceElement) {
                    mainContentContainer.innerHTML = '<p class="text-center text-gray-500 dark:text-slate-400">Please select a device to view details.</p>';
                    return;
                }

                const device = JSON.parse(deviceElement.dataset.details);
                
                const model = device.model ? device.model.trim() : 'Unknown Model';
                const vendor = device.vendor ? device.vendor.trim() : 'N/A';
                const serial = device.serial || 'N/A';
                const diskType = device.disk_type || 'N/A';
                const interfaceType = device.interface || 'N/A';
                const sizeGb = device.size_gb || 0;
                const temperature = (device.temperature_c !== null && typeof device.temperature_c !== 'undefined') ? device.temperature_c + ' °C' : 'N/A';

                let partitionsHtml = '';
                if (device.partitions && device.partitions.length > 0) {
                    const partitionItemsHtml = device.partitions.map(part => {
                        const usage = part.usage_pct || 0;
                        let colorClass = 'bg-green-500';
                        if (usage > 75) colorClass = 'bg-red-500';
                        else if (usage > 30) colorClass = 'bg-yellow-500';
                        return `
                            <div>
                                <div class="flex justify-between items-center mb-1">
                                    <span class="font-semibold text-gray-800 dark:text-slate-200 text-sm truncate pr-2" title="${part.mount || ''}">${part.mount || 'N/A'} (${part.fs || 'N/A'})</span>
                                    <span class="font-mono text-sm text-gray-600 dark:text-slate-300">${usage}% used</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-slate-600 rounded-full h-2.5">
                                    <div class="${colorClass} h-2.5 rounded-full" style="width: ${usage}%"></div>
                                </div>
                            </div>`;
                    }).join('');
                     partitionsHtml = `
                     <div x-data="{ open: true }" class="bg-gray-50 dark:bg-slate-700/50 rounded-lg">
                        <button @click="open = !open" class="w-full flex justify-between items-center text-left font-semibold text-gray-700 dark:text-slate-300 p-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-slate-800">
                            <span>Partitions (${device.partitions.length})</span>
                            <svg :class="{'rotate-180': open}" class="w-5 h-5 text-gray-500 transform transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <div x-show="open" x-collapse class="p-4 border-t border-gray-200 dark:border-slate-600">
                            <div class="space-y-3">${partitionItemsHtml}</div>
                        </div>
                    </div>`;
                } else {
                     partitionsHtml = `<div class="bg-gray-50 dark:bg-slate-700/50 p-4 rounded-lg text-center text-sm text-gray-500 dark:text-slate-400">No partitions mounted.</div>`;
                }


                let methodsHtml = '<p class="text-sm text-gray-500 dark:text-slate-400">No wipe methods available.</p>';
                if (device.methods && device.methods.length > 0) {
                    methodsHtml = device.methods.map((method, index) => {
                        const methodName = method.method || 'Unknown Method';
                        const time = (method.estimated_time_min !== null) ? method.estimated_time_min.toFixed(2) : '?';
                        const checked = index === 0 ? 'checked' : '';
                        return `
                        <label class="flex justify-between items-center p-3 rounded-lg border dark:border-slate-600 has-[:checked]:bg-indigo-50 has-[:checked]:border-indigo-500 dark:has-[:checked]:bg-slate-700 cursor-pointer transition-all overflow-hidden">
                            <input type="radio" name="wipe_method" value="${methodName}" class="sr-only" ${checked}>
                            <span class="font-medium text-gray-800 dark:text-slate-200 truncate pr-4">${methodName}</span>
                            <span class="font-mono text-sm text-indigo-600 dark:text-indigo-400 font-semibold flex-shrink-0">${time} min</span>
                        </label>`;
                    }).join('');
                    methodsHtml = `<div id="wipe-methods-list" class="space-y-2">${methodsHtml}</div>`;
                }

                mainContentContainer.innerHTML = `
                    <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-lg border border-gray-200/50 dark:border-slate-700/50">
                        <div class="mb-6">
                            <h2 class="text-2xl font-bold dark:text-white">${model}</h2>
                            <p class="text-sm text-gray-500 dark:text-slate-400">${device.device || 'N/A'}</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <div class="space-y-4">
                                <h3 class="font-semibold text-gray-700 dark:text-slate-300 border-b dark:border-slate-700 pb-2">Device Information</h3>
                                <div class="text-sm space-y-3">
                                    <p class="flex items-center"><span class="w-6 flex justify-center items-center text-gray-400 dark:text-slate-500"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg></span><strong class="w-24 pl-2">Vendor:</strong> <span class="font-mono">${vendor}</span></p>
                                    <p class="flex items-center"><span class="w-6 flex justify-center items-center text-gray-400 dark:text-slate-500"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" /></svg></span><strong class="w-24 pl-2">Serial:</strong> <span class="font-mono">${serial}</span></p>
                                    <p class="flex items-center"><span class="w-6 flex justify-center items-center text-gray-400 dark:text-slate-500"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 8v-5z" /></svg></span><strong class="w-24 pl-2">Type:</strong> <span class="font-mono">${diskType}</span></p>
                                    <p class="flex items-center"><span class="w-6 flex justify-center items-center text-gray-400 dark:text-slate-500"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg></span><strong class="w-24 pl-2">Interface:</strong> <span class="font-mono">${interfaceType}</span></p>
                                    <p class="flex items-center"><span class="w-6 flex justify-center items-center text-gray-400 dark:text-slate-500"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.657 7.343A8 8 0 0117.657 18.657z" /><path stroke-linecap="round" stroke-linejoin="round" d="M9.5 12.5c0-1.583 1.223-2.889 2.75-3.222" /></svg></span><strong class="w-24 pl-2">Temp:</strong> <span class="font-mono">${temperature}</span></p>
                                    <p class="flex items-center"><span class="w-6 flex justify-center items-center text-gray-400 dark:text-slate-500"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg></span><strong class="w-24 pl-2">Size:</strong> <span class="font-mono">${sizeGb} GB</span></p>
                                </div>
                                <div class="mt-4">
                                    ${partitionsHtml}
                                 </div>
                            </div>
                            <div class="space-y-4">
                                <h3 class="font-semibold text-gray-700 dark:text-slate-300 border-b dark:border-slate-700 pb-2">Wipe Methods</h3>
                                ${methodsHtml}
                                <button id="start-wipe-button" class="mt-4 w-full bg-indigo-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-slate-800 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                    Select a method
                                </button>
                            </div>
                        </div>
                    </div>`;

                updateWipeButtonText(device);
                
                document.getElementById('wipe-methods-list')?.addEventListener('change', () => updateWipeButtonText(device));
                document.getElementById('start-wipe-button')?.addEventListener('click', () => showWipeWarning(deviceElement));
            }
            
            function updateWipeButtonText(device) {
                const wipeButton = document.getElementById('start-wipe-button');
                if (!wipeButton) return;
                
                const selectedMethodInput = document.querySelector('input[name="wipe_method"]:checked');
                if (selectedMethodInput) {
                    wipeButton.textContent = `Wipe ${device.device || ''} with ${selectedMethodInput.value}`;
                    wipeButton.disabled = false;
                } else {
                    wipeButton.textContent = 'Select a method';
                    wipeButton.disabled = true;
                }
            }
            
            function showWipeWarning(deviceElement) {
                const modal = document.getElementById('wipe-warning-modal');
                const warningText = document.getElementById('warning-text');
                const cancelButton = document.getElementById('cancel-wipe-button');
                const proceedButton = document.getElementById('proceed-wipe-button');
                const device = JSON.parse(deviceElement.dataset.details);

                // --- Stage 1: Initial Warning ---
                warningText.innerHTML = `Are you sure you want to wipe <strong>${device.model}</strong>? <br> This action will permanently delete all data.`;
                proceedButton.textContent = 'Proceed';
                proceedButton.className = 'px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 font-semibold';
                
                const proceedStage1 = () => {
                    // --- Stage 2: Final Confirmation ---
                    warningText.innerHTML = `Please double-check that <strong>${device.model} (${device.device})</strong> is the correct drive. <br> This process is irreversible.`;
                    proceedButton.textContent = 'Confirm & Wipe';
                    proceedButton.className = 'px-6 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 font-semibold';
                    
                    proceedButton.removeEventListener('click', proceedStage1);
                    proceedButton.addEventListener('click', proceedStage2);
                };
                
                const proceedStage2 = () => {
                    modal.classList.add('hidden');
                    beginWipeSimulation(deviceElement);
                    proceedButton.removeEventListener('click', proceedStage2);
                };

                proceedButton.addEventListener('click', proceedStage1, { once: true });

                cancelButton.onclick = () => {
                    modal.classList.add('hidden');
                     proceedButton.removeEventListener('click', proceedStage1);
                     proceedButton.removeEventListener('click', proceedStage2);
                };

                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function beginWipeSimulation(deviceElement) {
                const device = JSON.parse(deviceElement.dataset.details);
                const totalSectors = device.total_sectors || 0;
                const sizeGb = device.size_gb || 0;
                
                let partitionsProgressHtml = `
                    <div class="bg-gray-50 dark:bg-slate-800/50 p-4 rounded-lg shadow-md flex items-center gap-3">
                        <span class="text-indigo-500 dark:text-indigo-400 bg-indigo-100 dark:bg-slate-700 p-2 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.75 3.75h6.5c1.036 0 1.875.84 1.875 1.875v12.75c0 1.035-.84 1.875-1.875 1.875h-6.5c-1.036 0-1.875-.84-1.875-1.875V5.625c0-1.036.84-1.875 1.875-1.875zM12 5.25v.008" /></svg></span>
                        <div class="flex-grow">
                            <p class="text-sm font-semibold text-gray-500 dark:text-slate-400 text-left">PARTITIONS</p>
                            <p class="text-xl font-bold font-mono text-gray-800 dark:text-slate-200 text-left">N/A</p>
                        </div>
                    </div>`;

                if (device.partitions && device.partitions.length > 0) {
                     const partitionItemsHtml = device.partitions.map((part, index) => `
                        <div>
                             <div class="flex justify-between items-center mb-1">
                                <span class="font-semibold text-gray-800 dark:text-slate-200 text-sm truncate pr-2" title="${part.mount || ''}">${part.mount || `Partition ${index + 1}`}</span>
                                <span id="partition-usage-${index}" class="font-mono text-sm text-gray-600 dark:text-slate-300">${part.usage_pct || 0}%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-slate-600 rounded-full h-2.5">
                                <div id="partition-progress-${index}" class="bg-blue-500 h-2.5 rounded-full transition-all duration-500" style="width: ${part.usage_pct || 0}%"></div>
                            </div>
                        </div>
                    `).join('');
                     partitionsProgressHtml = `<div class="bg-gray-50 dark:bg-slate-800/50 p-4 rounded-lg shadow-md">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="text-indigo-500 dark:text-indigo-400 bg-indigo-100 dark:bg-slate-700 p-2 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.75 3.75h6.5c1.036 0 1.875.84 1.875 1.875v12.75c0 1.035-.84 1.875-1.875 1.875h-6.5c-1.036 0-1.875-.84-1.875-1.875V5.625c0-1.036.84-1.875 1.875-1.875zM12 5.25v.008" /></svg></span>
                            <p class="text-sm font-semibold text-gray-500 dark:text-slate-400 text-left">PARTITIONS</p>
                        </div>
                        <div class="space-y-3">${partitionItemsHtml}</div>
                     </div>`;
                }


                mainContentContainer.innerHTML = `
                <div>
                    <div class="bg-white dark:bg-slate-800 p-6 rounded-xl shadow-lg border border-gray-200/50 dark:border-slate-700/50">
                         <div class="flex justify-between items-start mb-4 pt-8">
                            <div>
                                <h2 class="text-2xl font-bold dark:text-white">${device.model}</h2>
                                <p class="text-sm text-gray-500 dark:text-slate-400">${device.disk_type} &bull; ${sizeGb}GB</p>
                            </div>
                            <div class="text-right">
                               <p class="text-sm font-semibold text-gray-500 dark:text-slate-400">TIME REMAINING</p>
                               <p id="time-remaining" class="text-xl font-mono font-bold text-indigo-600 dark:text-indigo-400">--:--</p>
                            </div>
                        </div>
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-lg font-bold text-indigo-600 dark:text-indigo-400">Operation Progress</span>
                                <span id="progress-percent" class="text-lg font-bold font-mono text-indigo-600 dark:text-indigo-400">0%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-slate-700 rounded-full h-4">
                                <div id="progress-bar" class="bg-indigo-500 h-4 rounded-full transition-all duration-500" style="width: 0%"></div>
                            </div>
                             <div class="text-center mt-2">
                                <p class="text-sm text-gray-500 dark:text-slate-400 font-mono">
                                    Sectors Wiped: <span id="sectors-wiped">0</span> / ${totalSectors.toLocaleString()}
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4">
                             <div class="bg-gray-50 dark:bg-slate-800/50 p-3 rounded-full shadow-md flex items-center gap-3">
                                <span class="text-indigo-500 dark:text-indigo-400 bg-indigo-100 dark:bg-slate-700 p-2 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M12 6V3m0 18v-3" /><circle cx="12" cy="12" r="4" /></svg></span>
                                 <div class="flex-grow">
                                    <p class="text-sm font-semibold text-gray-500 dark:text-slate-400 text-left">SECTORS</p>
                                    <p id="sectors-ratio" class="text-xl font-bold font-mono text-gray-800 dark:text-slate-200 text-left">0.0M / ${(totalSectors / 1000000).toFixed(1)}M</p>
                                </div>
                            </div>
                            ${partitionsProgressHtml}
                            <div class="bg-gray-50 dark:bg-slate-800/50 p-3 rounded-full shadow-md flex items-center gap-3">
                                <span class="text-indigo-500 dark:text-indigo-400 bg-indigo-100 dark:bg-slate-700 p-2 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4M4 7v5c0 2.21 3.582 4 8 4s8-1.79 8-4V7" /></svg></span>
                                <div class="flex-grow">
                                    <p class="text-sm font-semibold text-gray-500 dark:text-slate-400 text-left">DATA WRITTEN</p>
                                    <p id="data-written" class="text-xl font-bold font-mono text-gray-800 dark:text-slate-200 text-left">0.0 GB</p>
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-slate-800/50 p-3 rounded-full shadow-md flex items-center gap-3">
                                 <span class="text-indigo-500 dark:text-indigo-400 bg-indigo-100 dark:bg-slate-700 p-2 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg></span>
                                <div class="flex-grow">
                                    <p class="text-sm font-semibold text-gray-500 dark:text-slate-400 text-left">WRITE SPEED</p>
                                    <p id="write-speed" class="text-xl font-bold font-mono text-gray-800 dark:text-slate-200 text-left">0 MB/s</p>
                                </div>
                            </div>
                             <div class="bg-gray-50 dark:bg-slate-800/50 p-3 rounded-full shadow-md flex items-center gap-3">
                                 <span class="text-indigo-500 dark:text-indigo-400 bg-indigo-100 dark:bg-slate-700 p-2 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h5M20 20v-5h-5M4 4l16 16" /></svg></span>
                                <div class="flex-grow">
                                    <p class="text-sm font-semibold text-gray-500 dark:text-slate-400 text-left">PASSES</p>
                                    <p id="passes" class="text-xl font-bold font-mono text-gray-800 dark:text-slate-200 text-left">1 / 1</p>
                                </div>
                            </div>
                             <div class="bg-gray-50 dark:bg-slate-800/50 p-3 rounded-full shadow-md flex items-center gap-3">
                                <span class="text-indigo-500 dark:text-indigo-400 bg-indigo-100 dark:bg-slate-700 p-2 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></span>
                                <div class="flex-grow">
                                    <p class="text-sm font-semibold text-gray-500 dark:text-slate-400 text-left">ERRORS</p>
                                    <p id="errors" class="text-xl font-bold font-mono text-gray-800 dark:text-slate-200 text-left">0</p>
                                </div>
                            </div>
                        </div>
                        <div id="wipe-controls" class="mt-6 flex justify-end">
                            <button id="stop-wipe-button" class="bg-red-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-red-700 transition-colors">
                                Terminate
                            </button>
                        </div>
                    </div>
                    <div id="report-generation-container" class="mt-4 bg-white dark:bg-slate-800 p-6 rounded-xl shadow-lg border border-gray-200/50 dark:border-slate-700/50 hidden">
                         <div class="flex items-center justify-center gap-3 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-500 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                               <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-slate-200">Generate Wipe Report</h3>
                        </div>
                        <div class="flex justify-center gap-4">
                            <button id="pdf-report-btn" class="bg-green-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-green-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>Generate PDF</button>
                            <button id="json-report-btn" class="bg-green-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-green-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>Generate JSON</button>
                        </div>
                    </div>
                </div>`;

                const wipeControls = document.getElementById('wipe-controls');
                const reportContainer = document.getElementById('report-generation-container');
                
                wipeControls.querySelector('#stop-wipe-button').addEventListener('click', () => {
                    clearInterval(wipeInterval);
                    updateMainContent(deviceElement);
                });

                // --- Simulation Logic ---
                let sectorsWiped = 0;
                let startTime = Date.now();
                
                wipeInterval = setInterval(() => {
                    const randomSpeedMBs = 80 + Math.random() * 70;
                    const sectorsPerSecond = (randomSpeedMBs * 1024 * 1024) / 512;
                    sectorsWiped += sectorsPerSecond;

                    if (sectorsWiped >= totalSectors) {
                        sectorsWiped = totalSectors;
                        clearInterval(wipeInterval);
                        
                        document.getElementById('wipe-controls').classList.add('hidden');
                        reportContainer.classList.remove('hidden');
                        reportContainer.querySelector('#pdf-report-btn').disabled = false;
                        reportContainer.querySelector('#json-report-btn').disabled = false;
                    }

                    const progress = (sectorsWiped / totalSectors);
                    const percent = Math.min(100, progress * 100);
                    const dataWrittenGB = (sectorsWiped * 512) / (1024 * 1024 * 1024);
                    
                    const elapsedTimeSeconds = (Date.now() - startTime) / 1000;
                    const estimatedTotalTime = (elapsedTimeSeconds / progress);
                    let remainingSeconds = Math.max(0, estimatedTotalTime - elapsedTimeSeconds);
                     if (!isFinite(remainingSeconds)) remainingSeconds = (device.methods[0].estimated_time_min || 1) * 60;


                    // Update UI
                    document.getElementById('progress-bar').style.width = `${percent}%`;
                    document.getElementById('progress-percent').textContent = `${percent.toFixed(1)}%`;
                    document.getElementById('sectors-wiped').textContent = Math.round(sectorsWiped).toLocaleString();
                    document.getElementById('data-written').textContent = `${dataWrittenGB.toFixed(1)} GB`;
                    document.getElementById('write-speed').textContent = `${randomSpeedMBs.toFixed(1)} MB/s`;
                    document.getElementById('sectors-ratio').textContent = `${(sectorsWiped / 1000000).toFixed(1)}M / ${(totalSectors / 1000000).toFixed(1)}M`;
                    
                    if (device.partitions && device.partitions.length > 0) {
                        device.partitions.forEach((part, index) => {
                            const initialUsage = part.usage_pct || 0;
                            const newUsage = initialUsage * (1 - progress);
                            
                            const progressBar = document.getElementById(`partition-progress-${index}`);
                            const usageText = document.getElementById(`partition-usage-${index}`);

                            if (progressBar) {
                                progressBar.style.width = `${newUsage.toFixed(2)}%`;
                            }
                            if (usageText) {
                                usageText.textContent = `${newUsage.toFixed(0)}% used`;
                            }
                        });
                    }

                    const minutes = Math.floor(remainingSeconds / 60);
                    const seconds = Math.floor(remainingSeconds % 60);
                    document.getElementById('time-remaining').textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

                }, 1000);
            }

            // --- Initial Load ---
            deviceItems.forEach(item => {
                item.addEventListener('click', () => {
                    deviceItems.forEach(el => el.classList.remove('selected'));
                    item.classList.add('selected');
                    updateMainContent(item);
                });
            });

            if (deviceItems.length > 0) {
                deviceItems[0].classList.add('selected');
                updateMainContent(deviceItems[0]);
            } else {
                 updateMainContent(null);
            }
        });
    </script>
</body>
</html>

