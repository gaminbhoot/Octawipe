# 🔐 OctaWipe — Secure Data Erasure Dashboard

> Professional-grade, browser-based dashboard for permanently and forensically wiping storage devices. Built by **Team Octagon**.

---

## 🚀 Live Prototype Demo

**[▶ Open the Interactive Prototype → octawipe.netlify.app](https://octawipe.jayjoshi.online/)**

> ⚠️ **This is a simulated UI prototype.** No real wiping occurs. The prototype demonstrates the full interface with animated wipe progress, device selection, and network operations. The real system requires a local PHP + Linux server environment.

---

## 📸 What the Prototype Covers

| Page | Description |
|---|---|
| **Home** | Landing page with hero, about section, and feature highlights |
| **Enterprise → Single Wipe** | Device sidebar, detail panel, method selection, 2-step confirmation modal, live wipe simulation |
| **Enterprise → Network Wipe** | Multi-device simultaneous wipe with staggered progress bars |
| **Download ISO** | ISO download page with version listing and checksums |
| **FAQs** | Accordion with 7 common questions |
| **Contact** | Contact form |
| **Login / Sign Up** | Authentication UI |

---

## ✨ Features

### Core Functionality
- **Automatic device detection** — reads from `devices.json`, displays model, serial, interface, temperature, and partition usage
- **Multiple wipe standards** — NIST 800-88 Purge, DoD 5220.22-M (3-pass), and custom quick wipe methods
- **Live wipe simulation** — real-time sectors wiped, data written (GB), write speed (MB/s), and per-partition drain animation
- **2-stage confirmation modal** — requires two deliberate confirmations before any wipe begins
- **Wipe report generation** — PDF and JSON certificate export after a successful wipe

### Network / Enterprise
- **Network Wipe** — simultaneous PXE-boot-style erasure across multiple networked machines
- **Wipe Certificates** — tamper-proof, blockchain-signed sanitization certificates (e.g. `cert_192-168-1-101.txt`)
- **Staggered multi-device progress** — each network device starts and progresses independently

### UI / UX
- **Dark / Light mode** — persisted via `localStorage`, respects system preference on first load
- **Collapsible device sidebar** — toggle between icon-only and full detail view
- **Fira Code + Orbitron fonts** — sharp, technical mono aesthetic throughout
- **Dotted grid background** — adapts cleanly to both dark and light themes
- **Fully responsive** — works on desktop and tablet

---

## 🗂️ Repository Structure

```
secure_wipe_dashboard/
│
├── index.php                    # Entry point — redirects to home
├── home.php                     # Landing page
├── header.php                   # Shared nav header (included by all pages)
├── login.php                    # Login page
├── signup.php                   # Sign-up page
├── faq.php                      # FAQ accordion page
├── contact.php                  # Contact form page
├── iso.php                      # ISO download page
│
├── Enterprise/
│   ├── index.php                # Enterprise solutions hub
│   ├── single_wipe.php          # Single device wipe dashboard
│   └── network_wipe.php         # Multi-device network wipe
│
├── devices.json                 # Connected device data (model, serial, partitions, wipe methods)
│
├── certificates/                # Post-wipe certificates (blockchain-signed)
│   ├── cert_192-168-1-101.txt
│   ├── cert_192-168-1-105.txt
│   └── cert_192-168-1-112.txt
│
└── logo.png                     # OctaWipe logo
```

---

## 🛠️ Local Setup (Real System)

### Prerequisites
- PHP 8.0+
- A Linux environment (the wipe backend uses native disk utilities)
- Apache or Nginx web server
- Connected storage devices accessible via `/dev/sd*` or `/dev/nvme*`

### Install

```bash
git clone https://github.com/YOUR_USERNAME/secure_wipe_dashboard.git
cd secure_wipe_dashboard
```

Point your web server's document root to the project folder, then open:

```
http://localhost/home.php
```

> On first load, `devices.json` is read to populate the device sidebar. Make sure it reflects your actual connected hardware, or use the included sample data for testing.

---

## ⚙️ How It Works

```
User opens dashboard
  │
  ├── devices.json is parsed by PHP
  │   └── device list rendered in sidebar (model, serial, type, size, partitions)
  │
  ├── User selects a device + wipe method
  │   └── 2-stage confirmation modal (Proceed → Confirm & Wipe)
  │
  ├── Wipe begins
  │   ├── Live progress: sectors wiped, GB written, MB/s speed, time remaining
  │   └── Partition usage bars drain to 0% in real time
  │
  └── Wipe complete
      ├── PDF certificate generated
      └── JSON report generated
          └── Signed with blockchain hash for tamper-proof audit trail
```

### Wipe Methods

| Method | Passes | Use Case |
|---|---|---|
| NIST 800-88 Purge | 1 | SSDs, NVMe — meets US federal compliance |
| DoD 5220.22-M | 3 | HDDs — US Department of Defense standard |
| Quick Test Wipe | 1 | Development / low-security testing only |

---

## 📜 Certificate Format

After each successful wipe, a certificate is generated:

```
--- CERTIFICATE OF DATA SANITIZATION ---

Certificate ID:        CERT-68d632dda7ba480f8cac1e092ca14301...
Date of Issue:         2025-09-26 11:59:49 IST
Device IP:             192.168.1.101
Sanitization Standard: DoD 5220.22-M (3-Pass Wipe)
Result:                SUCCESS - All data permanently destroyed.

Digitally Verified by Network Purge Utility
Signature:             914858770d709698ffef6ba367e5bfcd9f...
```

---

## 🔭 Roadmap

- [ ] Remote scheduled wipes
- [ ] Multi-user role management (admin / operator)
- [ ] Real-time device discovery via network scan
- [ ] Docker deployment support
- [ ] Mobile responsive layout improvements

---

## 📄 License

MIT — see [LICENSE](LICENSE).

---

*Built by Team Octagon.*
