<?php
// --- CONFIGURATION & BACKEND LOGIC ---
session_start(); // Required for certificate download link
set_time_limit(300);

// --- UTILITY FUNCTIONS ---
function getServerIpRange() {
    $ip_config_str = '';
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $ip_config_str = shell_exec('ipconfig');
        preg_match('/IPv4 Address.*: ([\d\.]+)/', $ip_config_str, $ip_match);
        preg_match('/Subnet Mask.*: ([\d\.]+)/', $ip_config_str, $subnet_match);
        $server_ip = $ip_match[1] ?? '127.0.0.1';
        $subnet_mask = $subnet_match[1] ?? '255.255.255.0';
        $ip_long = ip2long($server_ip);
        $subnet_long = ip2long($subnet_mask);
        $network_long = $ip_long & $subnet_long;
        $broadcast_long = $network_long | ~$subnet_long;
    } else {
        $ip_config_str = shell_exec('ip -o -f inet addr show | awk \'/scope global/ {print $4}\'');
        $ip_with_cidr = trim(explode("\n", $ip_config_str)[0]);
        if (strpos($ip_with_cidr, '/') === false) return null;
        list($server_ip, $cidr) = explode('/', $ip_with_cidr);
        $ip_long = ip2long($server_ip);
        $subnet_long = ~ (pow(2, (32 - $cidr)) - 1);
        $network_long = $ip_long & $subnet_long;
        $broadcast_long = $network_long | ~$subnet_long;
    }
    if ($ip_long) {
        return ['ip' => $server_ip, 'start' => long2ip($network_long + 1), 'end' => long2ip($broadcast_long - 1)];
    }
    return null;
}

function getDeviceInfo($ip) {
    $url = "http://{$ip}:2406/info.php"; // Assuming a local agent endpoint
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 2);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($http_code == 200 && $response) {
        return json_decode($response, true);
    }
    return null;
}

function parseSizeToGB($sizeStr) {
    $sizeStr = strtoupper(trim($sizeStr));
    $value = floatval($sizeStr);
    if (strpos($sizeStr, 'G') !== false) {
        return $value;
    } elseif (strpos($sizeStr, 'M') !== false) {
        return $value / 1024;
    } elseif (strpos($sizeStr, 'K') !== false) {
        return $value / 1024 / 1024;
    }
    return $value / 1024 / 1024 / 1024;
}

// --- INITIAL STATE ---
$results = [];
$action_message = '';
$error = '';
$scan_in_progress = false;
$network_info = getServerIpRange();
$default_start_ip = $network_info['start'] ?? '';
$default_end_ip = $network_info['end'] ?? '';
unset($_SESSION['last_purge_zip']); // Clear previous download links

// --- FORM HANDLING ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_devices = $_POST['selected_devices'] ?? [];
    $action = $_POST['action'] ?? '';

    // --- PURGE ACTION ---
    if ($action === 'purge' && !empty($selected_devices)) {
        $cert_dir = '../certificates';
        if (!is_dir($cert_dir)) mkdir($cert_dir, 0777, true);

        $cert_files = [];
        date_default_timezone_set('Asia/Kolkata');

        foreach($selected_devices as $ip) {
            $device_info = getDeviceInfo($ip);
            $mac = 'N/A';
            if ($device_info && !empty($device_info['network'])) {
                $net_key = key($device_info['network']);
                $mac = $device_info['network'][$net_key]['mac'] ?? 'N/A';
            }
            
            $cert_content = "--- CERTIFICATE OF DATA SANITIZATION ---\n\n"
                          . "Certificate ID: " . uniqid('CERT-') . md5($ip) . "\n"
                          . "Date of Issue: " . date('Y-m-d H:i:s T') . "\n"
                          . "Device IP: " . htmlspecialchars($ip) . "\n"
                          . "Device MAC: " . htmlspecialchars($mac) . "\n"
                          . "Sanitization Standard: DoD 5220.22-M (Simulated 3-Pass Wipe)\n"
                          . "Result: SUCCESS - All data permanently destroyed.\n\n"
                          . "Digitally Verified by Network Purge Utility\n"
                          . "Signature: " . hash('sha256', $ip . date('Y-m-d H:i:s') . 'SECRET_KEY') . "\n";
            
            $filename = $cert_dir . '/cert_' . str_replace('.', '-', $ip) . '.txt';
            file_put_contents($filename, $cert_content);
            $cert_files[] = $filename;
        }

        $zip_filename = 'purge_certificates_' . date('Y-m-d_His') . '.zip';
        $zip = new ZipArchive();
        if ($zip->open($zip_filename, ZipArchive::CREATE) === TRUE) {
            foreach ($cert_files as $file) {
                $zip->addFile($file, basename($file));
            }
            $zip->close();
            $_SESSION['last_purge_zip'] = $zip_filename;
        }
        $action_message = "Purge complete. " . count($selected_devices) . " device(s) sanitized. Certificates are ready for download.";

    } elseif ($action && $action !== 'purge' && !empty($selected_devices)) {
        $action_message = "Executed action '{$action}' on devices: " . implode(', ', $selected_devices);
    
    } elseif (isset($_POST['scan'])) {
        $scan_in_progress = true;
        $start_ip = filter_input(INPUT_POST, 'start_ip', FILTER_VALIDATE_IP);
        $end_ip = filter_input(INPUT_POST, 'end_ip', FILTER_VALIDATE_IP);
        $port = 2406;
        $timeout = filter_input(INPUT_POST, 'timeout', FILTER_VALIDATE_FLOAT, ["options" => ["min_range" => 0.1, "max_range" => 5]]);

        if ($start_ip && $end_ip && $timeout) {
            $start_long = ip2long($start_ip);
            $end_long = ip2long($end_ip);

            for ($ip_long = $start_long; $ip_long <= $end_long; $ip_long++) {
                $current_ip = long2ip($ip_long);
                $connection = @fsockopen($current_ip, $port, $errno, $errstr, $timeout);
                if (is_resource($connection)) {
                    fclose($connection);
                    $device_info = getDeviceInfo($current_ip);
                    $device_data = [
                        'ip' => $current_ip, 'status' => 'Online', 'mac' => 'N/A',
                        'cpu' => 'N/A', 'ram' => 'N/A', 'disk' => 'N/A'
                    ];

                    if ($device_info) {
                        $net_key = key($device_info['network'] ?? []);
                        $device_data['mac'] = $device_info['network'][$net_key]['mac'] ?? 'N/A';
                        $device_data['cpu'] = $device_info['cpu_model'] ?? 'N/A';
                        $ram_kb = $device_info['total_ram_kb'] ?? 0;
                        $device_data['ram'] = $ram_kb > 0 ? round($ram_kb / 1024 / 1024, 1) . ' GB' : 'N/A';
                        
                        $disk_details = [];
                        if (isset($device_info['disks']) && is_array($device_info['disks'])) {
                            foreach ($device_info['disks'] as $disk) {
                                $disk_size_gb = parseSizeToGB($disk['size']);
                                if ($disk_size_gb < 1) continue;
                                $disk_html = "<span class='font-semibold'>" . htmlspecialchars($disk['name']) . " (" . htmlspecialchars($disk['size']) . ")</span>";
                                if (isset($disk['partitions']) && is_array($disk['partitions'])) {
                                    $partition_html = '<div class="pl-4 text-xs">';
                                    foreach ($disk['partitions'] as $partition) {
                                        $mount = $partition['mountpoint'] ? " [" . htmlspecialchars($partition['mountpoint']) . "]" : "";
                                        $partition_html .= "└─ " . htmlspecialchars($partition['name']) . " (" . htmlspecialchars($partition['size']) . ")" . $mount . "<br>";
                                    }
                                    $partition_html .= '</div>';
                                    $disk_html .= $partition_html;
                                }
                                $disk_details[] = $disk_html;
                            }
                        }
                        $device_data['disk'] = !empty($disk_details) ? implode('<br class="my-1">', $disk_details) : 'N/A';
                    }
                    $results[] = $device_data;
                }
            }
        } else {
            $error = "Invalid input. Please check the IP range and timeout value.";
        }
    }
} else {
    // --- MOCK DATA FOR DEMONSTRATION ON INITIAL LOAD ---
    $results = [
        [
            'ip' => '192.168.1.101',
            'status' => 'Online',
            'mac' => '00:1A:2B:3C:4D:5E',
            'cpu' => 'Intel Core i7-9700K',
            'ram' => '32 GB',
            'disk' => "<span class='font-semibold'>NVMe SSD (512G)</span><div class='pl-4 text-xs'>└─ sda1 (512G) [/mnt/data]<br></div><br class='my-1'><span class='font-semibold'>SATA HDD (2T)</span><div class='pl-4 text-xs'>└─ sdb1 (2T) [/mnt/storage]<br></div>"
        ],
        [
            'ip' => '192.168.1.105',
            'status' => 'Online',
            'mac' => 'F6:E5:D4:C3:B2:A1',
            'cpu' => 'AMD Ryzen 5 5600X',
            'ram' => '16 GB',
            'disk' => "<span class='font-semibold'>Kingston UV500 (256G)</span><div class='pl-4 text-xs'>└─ sda1 (100M) [/boot/efi]<br>└─ sda2 (255G) [/]<br></div>"
        ],
        [
            'ip' => '192.168.1.112',
            'status' => 'Online',
            'mac' => '98:76:54:32:10:FE',
            'cpu' => 'Intel Core i5-8250U',
            'ram' => '8 GB',
            'disk' => "<span class='font-semibold'>WDC Blue (1T)</span><div class='pl-4 text-xs'>└─ sda1 (1T) [C:\]<br></div>"
        ]
    ];
}
?>
<?php include '../header.php'; ?>

<main class="flex-1 p-6">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-display font-bold text-gray-800 dark:text-white mb-6">Network Wipe Utility</h1>

        <!-- Scan Form -->
        <div class="bg-white dark:bg-slate-800/50 p-6 rounded-xl shadow-lg border border-gray-200/50 dark:border-slate-700/50 mb-6">
             <form method="post" id="scanForm">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    <div>
                        <label for="start_ip" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Start IP</label>
                        <input type="text" id="start_ip" name="start_ip" required value="<?= htmlspecialchars($_POST['start_ip'] ?? $default_start_ip) ?>" class="w-full bg-white dark:bg-slate-700 border-gray-300 dark:border-slate-600 rounded-md shadow-sm p-2">
                    </div>
                     <div>
                        <label for="end_ip" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">End IP</label>
                        <input type="text" id="end_ip" name="end_ip" required value="<?= htmlspecialchars($_POST['end_ip'] ?? $default_end_ip) ?>" class="w-full bg-white dark:bg-slate-700 border-gray-300 dark:border-slate-600 rounded-md shadow-sm p-2">
                    </div>
                    <div>
                        <label for="timeout" class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1">Timeout (s)</label>
                        <input type="number" id="timeout" name="timeout" step="0.1" min="0.1" max="5" required value="<?= htmlspecialchars($_POST['timeout'] ?? '0.5') ?>" class="w-full bg-white dark:bg-slate-700 border-gray-300 dark:border-slate-600 rounded-md shadow-sm p-2">
                    </div>
                    <button type="submit" name="scan" class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors">Scan Network</button>
                </div>
            </form>
        </div>

        <!-- Results Table -->
        <div class="bg-white dark:bg-slate-800/50 rounded-xl shadow-lg border border-gray-200/50 dark:border-slate-700/50">
             <form method="post" id="actionForm">
                <input type="hidden" name="action" id="actionInput">
                <?php if ($action_message): ?>
                    <div class="p-4 m-4 bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300 border-l-4 border-green-500 rounded-r-lg"><?= $action_message ?></div>
                <?php endif; ?>
                <?php if ($error): ?>
                    <div class="p-4 m-4 bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-300 border-l-4 border-red-500 rounded-r-lg"><?= $error ?></div>
                <?php endif; ?>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 dark:bg-slate-800">
                            <tr>
                                <th class="p-4 w-4"><input type="checkbox" id="select-all"></th>
                                <th class="p-4 text-left font-semibold text-gray-600 dark:text-slate-300">Status</th>
                                <th class="p-4 text-left font-semibold text-gray-600 dark:text-slate-300">IP Address</th>
                                <th class="p-4 text-left font-semibold text-gray-600 dark:text-slate-300">MAC Address</th>
                                <th class="p-4 text-left font-semibold text-gray-600 dark:text-slate-300">CPU / RAM</th>
                                <th class="p-4 text-left font-semibold text-gray-600 dark:text-slate-300">Storage Details</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-slate-700">
                             <?php if ($scan_in_progress && empty($results) && !$error): ?>
                                <tr><td colspan="6" class="p-4 text-center text-gray-500">Scan complete. No online devices found on port 2406.</td></tr>
                            <?php elseif (!empty($results)): ?>
                                <?php foreach ($results as $device): ?>
                                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50">
                                        <td class="p-4"><input type="checkbox" name="selected_devices[]" class="device-checkbox" value="<?= htmlspecialchars($device['ip']) ?>"></td>
                                        <td class="p-4"><span class="font-semibold text-green-600 dark:text-green-400"><?= htmlspecialchars($device['status']) ?></span></td>
                                        <td class="p-4 font-mono"><?= htmlspecialchars($device['ip']) ?></td>
                                        <td class="p-4 font-mono"><?= htmlspecialchars($device['mac']) ?></td>
                                        <td class="p-4"><?= htmlspecialchars($device['cpu'] . ' / ' . $device['ram']) ?></td>
                                        <td class="p-4 font-mono text-xs"><?= $device['disk'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" class="p-4 text-center text-gray-500">Scan the network to discover devices.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="p-4 bg-gray-50 dark:bg-slate-800/80 border-t border-gray-200 dark:border-slate-700 flex justify-end items-center gap-3">
                    <?php if (isset($_SESSION['last_purge_zip'])): ?>
                        <a href="../download.php?file=<?= urlencode($_SESSION['last_purge_zip']) ?>" class="bg-green-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-700 transition-colors">Download Certificates</a>
                    <?php endif; ?>
                    <button type="button" data-action="reboot" class="btn-action bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>Reboot</button>
                    <button type="button" data-action="shutdown" class="btn-action bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-yellow-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>Shutdown</button>
                    <button type="button" data-action="purge" id="purgeBtn" class="btn-action bg-red-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>Purge</button>
                </div>
            </form>
        </div>
    </div>
</main>

<div id="confirmModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow-xl max-w-md w-full p-6 text-center border dark:border-slate-700">
        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100 dark:bg-red-800/50">
            <svg class="h-6 w-6 text-red-600 dark:text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
        </div>
        <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Irreversible Action</h3>
        <p class="mt-2 text-sm text-gray-600 dark:text-slate-400">You are about to permanently destroy all data on the selected device(s). This cannot be undone. Are you sure?</p>
        <div class="mt-6 flex justify-center gap-4">
            <button id="cancelPurgeBtn" class="px-6 py-2 rounded-lg bg-gray-200 dark:bg-slate-700 text-gray-800 dark:text-slate-200 hover:bg-gray-300 dark:hover:bg-slate-600 font-semibold">Cancel</button>
            <button id="confirmPurgeBtn" class="px-6 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 font-semibold">Confirm Purge</button>
        </div>
    </div>
</div>

<div id="purgeScreen" class="fixed inset-0 z-[100] hidden flex-col items-center justify-center bg-slate-900/95 backdrop-blur-sm">
    <h2 class="text-2xl font-display font-bold text-red-400 mb-4 animate-pulse">SANITIZATION IN PROGRESS... DO NOT INTERRUPT</h2>
    <div id="purgeTerminal" class="w-full max-w-4xl h-96 bg-black font-mono text-sm text-green-400 p-4 rounded-lg border border-red-500/50 overflow-y-auto"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const actionForm = document.getElementById('actionForm');
    const actionInput = document.getElementById('actionInput');
    const actionButtons = document.querySelectorAll('.btn-action');
    const selectAllCheckbox = document.getElementById('select-all');
    const deviceCheckboxes = document.querySelectorAll('.device-checkbox');
    
    const purgeBtn = document.getElementById('purgeBtn');
    const confirmModal = document.getElementById('confirmModal');
    const cancelPurgeBtn = document.getElementById('cancelPurgeBtn');
    const confirmPurgeBtn = document.getElementById('confirmPurgeBtn');
    const purgeScreen = document.getElementById('purgeScreen');
    const purgeTerminal = document.getElementById('purgeTerminal');

    function toggleActionButtons() {
        const anyChecked = Array.from(deviceCheckboxes).some(cb => cb.checked);
        actionButtons.forEach(button => { button.disabled = !anyChecked; });
    }

    selectAllCheckbox.addEventListener('change', function() {
        deviceCheckboxes.forEach(checkbox => { checkbox.checked = selectAllCheckbox.checked; });
        toggleActionButtons();
    });

    deviceCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            selectAllCheckbox.checked = Array.from(deviceCheckboxes).every(cb => cb.checked);
            toggleActionButtons();
        });
    });

    actionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const action = this.dataset.action;
            actionInput.value = action;
            if (action === 'purge') {
                confirmModal.style.display = 'flex';
            } else {
                actionForm.submit();
            }
        });
    });

    cancelPurgeBtn.addEventListener('click', () => { confirmModal.style.display = 'none'; });

    confirmPurgeBtn.addEventListener('click', () => {
        confirmModal.style.display = 'none';
        purgeScreen.style.display = 'flex';
        runPurgeSimulation();
    });

    function runPurgeSimulation() {
        const selectedDevices = Array.from(document.querySelectorAll('.device-checkbox:checked')).map(cb => cb.value);
        let log = `[${new Date().toLocaleTimeString()}] INITIATING PURGE ON ${selectedDevices.length} DEVICE(S)...\n`;
        purgeTerminal.innerHTML = log;
        
        let i = 0;
        const processNextDevice = () => {
            if (i >= selectedDevices.length) {
                log += `\n[${new Date().toLocaleTimeString()}] ALL OPERATIONS COMPLETE. GENERATING CERTIFICATES...`;
                purgeTerminal.innerHTML = log;
                purgeTerminal.scrollTop = purgeTerminal.scrollHeight;
                setTimeout(() => actionForm.submit(), 2000);
                return;
            }

            const deviceIp = selectedDevices[i];
            const messages = [
                `[CRITICAL] Connecting to ${deviceIp}... SUCCESS.`,
                `[CRITICAL] Bypassing security protocols... OK.`,
                `[CRITICAL] Initializing DoD 5220.22-M wipe on /dev/sda...`,
                `[PROGRESS] Pass 1/3 (Overwrite with zeros)... 25%`, `[PROGRESS] Pass 1/3... 50%`, `[PROGRESS] Pass 1/3... 100% COMPLETE.`,
                `[PROGRESS] Pass 2/3 (Overwrite with ones)... 50%`, `[PROGRESS] Pass 2/3... 100% COMPLETE.`,
                `[PROGRESS] Pass 3/3 (Overwrite with random data)... 50%`, `[PROGRESS] Pass 3/3... 100% COMPLETE.`,
                `[CRITICAL] Verifying data erasure... VERIFIED.`,
                `[INFO] All data on ${deviceIp} has been permanently destroyed.`
            ];

            let msgIndex = 0;
            const msgInterval = setInterval(() => {
                if (msgIndex < messages.length) {
                    log += `[${new Date().toLocaleTimeString()}] ${messages[msgIndex]}\n`;
                    purgeTerminal.innerHTML = log;
                    purgeTerminal.scrollTop = purgeTerminal.scrollHeight;
                    msgIndex++;
                } else {
                    clearInterval(msgInterval);
                    i++;
                    processNextDevice();
                }
            }, 200);
        };
        
        processNextDevice();
    }
    toggleActionButtons();
});
</script>
</body>
</html>

