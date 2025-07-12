<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IP端口扫描工具</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            display: none;
        }
        .success {
            color: #4CAF50;
        }
        .error {
            color: #f44336;
        }
        .loading {
            display: none;
            text-align: center;
            margin-top: 20px;
        }
        .loading-spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #4CAF50;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 2s linear infinite;
            margin: 0 auto;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .port-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .port-table th, .port-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .port-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .port-table tr:hover {
            background-color: #f5f5f5;
        }
        .port-status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
        }
        .port-open {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .port-closed {
            background-color: #f2dede;
            color: #a94442;
        }
        .summary {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .summary-item {
            margin-bottom: 10px;
        }
        .filter-controls {
            margin: 15px 0;
            display: flex;
            gap: 10px;
        }
        .filter-btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        .filter-btn.active {
            background-color: #4CAF50;
            color: white;
        }
        .filter-btn:not(.active) {
            background-color: #f1f1f1;
            color: #333;
        }
        .filter-btn:hover:not(.active) {
            background-color: #e0e0e0;
        }
        .port-info {
            display: flex;
            align-items: center;
        }
        .port-icon {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }
        .history-container {
            margin-top: 20px;
        }
        .history-title {
            font-weight: bold;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .history-list {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            background-color: #f9f9f9;
        }
        .history-item {
            padding: 8px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .history-item:last-child {
            border-bottom: none;
        }
        .history-item:hover {
            background-color: #f0f0f0;
        }
        .clear-history {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        .clear-history:hover {
            background-color: #d32f2f;
        }
        .no-history {
            text-align: center;
            color: #666;
            padding: 10px;
        }
        .copy-btn {
            background-color: #2196F3;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-left: 10px;
            transition: background-color 0.3s;
        }
        .copy-btn:hover {
            background-color: #0b7dda;
        }
        .copy-success {
            background-color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>IP端口扫描工具</h1>
        
        <?php
        $result = null;
        $ip_address = '';
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ip_address'])) {
            $ip_address = trim($_POST['ip_address']);
            
            if (!empty($ip_address)) {
                // 验证IP地址格式
                if (filter_var($ip_address, FILTER_VALIDATE_IP)) {
                    // 使用新的API接口 - 改用shodan API
                    $api_key = "YOUR_SHODAN_API_KEY"; // 替换为您的Shodan API密钥
                    $api_url = "https://api.shodan.io/shodan/host/{$ip_address}?key={$api_key}";
                    
                    // 如果没有Shodan API密钥，使用本地端口扫描
                    if ($api_key == "YOUR_SHODAN_API_KEY") {
                        // 使用PHP内置函数进行简单的端口扫描
                        $common_ports = [20, 21, 22, 23, 25, 53, 80, 110, 143, 443, 3306, 3389, 8080];
                        $ports_data = [];
                        $start_time = microtime(true);
                        
                        foreach ($common_ports as $port) {
                            $connection = @fsockopen($ip_address, $port, $errno, $errstr, 1);
                            $status = is_resource($connection);
                            if ($status) {
                                $service = getservbyport($port, 'tcp') ?: "未知服务";
                                fclose($connection);
                            } else {
                                $service = getservbyport($port, 'tcp') ?: "未知服务";
                            }
                            
                            $ports_data[] = [
                                "port" => $port,
                                "info" => $service,
                                "status" => $status
                            ];
                        }
                        
                        $end_time = microtime(true);
                        $take_up_time = round($end_time - $start_time, 3);
                        
                        $result = [
                            "data" => $ports_data,
                            "take_up_time" => $take_up_time
                        ];
                    } else {
                        // 使用Shodan API
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $api_url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                        
                        $response = curl_exec($ch);
                        $curl_error = curl_error($ch);
                        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        
                        curl_close($ch);
                        
                        if ($response !== false && !empty($response)) {
                            $decoded_response = json_decode($response, true);
                            
                            if ($decoded_response && isset($decoded_response['ports']) && !isset($decoded_response['error'])) {
                                $ports_data = [];
                                $start_time = microtime(true);
                                
                                foreach ($decoded_response['ports'] as $port) {
                                    $service = "";
                                    
                                    // 查找该端口的服务信息
                                    if (isset($decoded_response['data'])) {
                                        foreach ($decoded_response['data'] as $service_data) {
                                            if (isset($service_data['port']) && $service_data['port'] == $port) {
                                                $service = isset($service_data['product']) ? $service_data['product'] : "";
                                                $service .= isset($service_data['version']) ? " " . $service_data['version'] : "";
                                                break;
                                            }
                                        }
                                    }
                                    
                                    if (empty($service)) {
                                        $service = getservbyport($port, 'tcp') ?: "未知服务";
                                    }
                                    
                                    $ports_data[] = [
                                        "port" => $port,
                                        "info" => $service,
                                        "status" => true
                                    ];
                                }
                                
                                $end_time = microtime(true);
                                $take_up_time = round($end_time - $start_time, 3);
                                
                                $result = [
                                    "data" => $ports_data,
                                    "take_up_time" => $take_up_time
                                ];
                            } else {
                                $error_msg = isset($decoded_response['error']) ? $decoded_response['error'] : "API返回数据格式错误";
                                $result = [
                                    "error" => "API返回错误: " . $error_msg
                                ];
                            }
                        } else {
                            $result = [
                                "error" => "请求失败: " . $curl_error . " (HTTP状态码: " . $http_code . ")"
                            ];
                        }
                    }
                } else {
                    $result = [
                        "error" => "无效的IP地址格式"
                    ];
                }
            } else {
                $result = [
                    "error" => "请输入要扫描的IP地址"
                ];
            }
        }
        ?>
        
        <form method="post" action="" id="scanForm">
            <div class="form-group">
                <label for="ip_address">请输入要扫描的IP地址:</label>
                <input type="text" id="ip_address" name="ip_address" value="<?php echo htmlspecialchars($ip_address); ?>" placeholder="例如: 103.186.214.16" required>
            </div>
            
            <button type="submit" id="submitBtn">开始扫描</button>
            
            <div class="loading" id="loadingIndicator">
                <div class="loading-spinner"></div>
                <p>正在扫描端口，请稍候...</p>
            </div>
        </form>
        
        <div class="history-container">
            <div class="history-title">
                <span>扫描历史</span>
                <button type="button" id="clearHistoryBtn" class="clear-history">清空历史</button>
            </div>
            <div class="history-list" id="historyList">
                <div class="no-history" id="noHistoryMsg">暂无扫描历史</div>
                <!-- 历史记录将在这里动态生成 -->
            </div>
        </div>
        
        <?php if ($result): ?>
        <div class="result" style="display: block;">
            <?php if (isset($result["error"])): ?>
                <h3 class="error">扫描失败</h3>
                <p><?php echo htmlspecialchars($result["error"]); ?></p>
            <?php elseif (!isset($result["data"]) || !is_array($result["data"])): ?>
                <h3 class="error">扫描失败</h3>
                <p>API返回数据格式错误或服务暂时不可用</p>
            <?php else: ?>
                <h3 class="success">扫描完成!</h3>
                
                <div class="summary">
                    <div class="summary-item">
                        <strong>IP地址:</strong> <?php echo htmlspecialchars($ip_address); ?>
                        <button class="copy-btn" data-copy="<?php echo htmlspecialchars($ip_address); ?>">复制</button>
                    </div>
                    <div class="summary-item">
                        <strong>扫描耗时:</strong> <?php echo isset($result["take_up_time"]) ? htmlspecialchars($result["take_up_time"]) : "未知"; ?> 秒
                    </div>
                    <?php
                    $open_ports = 0;
                    $closed_ports = 0;
                    
                    foreach ($result["data"] as $port_data) {
                        if (isset($port_data["status"]) && $port_data["status"]) {
                            $open_ports++;
                        } else {
                            $closed_ports++;
                        }
                    }
                    ?>
                    <div class="summary-item">
                        <strong>开放端口:</strong> <?php echo $open_ports; ?> 个
                    </div>
                    <div class="summary-item">
                        <strong>关闭端口:</strong> <?php echo $closed_ports; ?> 个
                    </div>
                </div>
                
                <div class="filter-controls">
                    <button type="button" class="filter-btn active" data-filter="all">全部端口</button>
                    <button type="button" class="filter-btn" data-filter="open">开放端口</button>
                    <button type="button" class="filter-btn" data-filter="closed">关闭端口</button>
                </div>
                
                <table class="port-table">
                    <thead>
                        <tr>
                            <th>端口</th>
                            <th>服务</th>
                            <th>状态</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result["data"] as $port_data): ?>
                        <tr class="port-row <?php echo $port_data["status"] ? 'port-open-row' : 'port-closed-row'; ?>">
                            <td><?php echo htmlspecialchars($port_data["port"]); ?></td>
                            <td>
                            <div class="port-info">
                                    <?php
                                    // 从服务信息中提取服务名称
                                    $service_info = strtolower($port_data["info"]);
                                    $icon_name = "";
                                    
                                    // 提取主要服务名称
                                    if (strpos($service_info, 'http') !== false) {
                                        $icon_name = "http";
                                    } elseif (strpos($service_info, 'ftp') !== false) {
                                        $icon_name = "ftp";
                                    } elseif (strpos($service_info, 'ssh') !== false) {
                                        $icon_name = "ssh";
                                    } elseif (strpos($service_info, 'smtp') !== false) {
                                        $icon_name = "smtp";
                                    } elseif (strpos($service_info, 'mysql') !== false) {
                                        $icon_name = "mysql";
                                    } elseif (strpos($service_info, 'dns') !== false) {
                                        $icon_name = "dns";
                                    } else {
                                        $icon_name = explode(' ', $service_info)[0];
                                    }
                                    
                                    $icon_url = "https://cdn-icons-png.flaticon.com/128/2165/2165674.png"; // 默认图标
                                    
                                    // 为常见服务设置图标
                                    switch ($icon_name) {
                                        case "http":
                                            $icon_url = "https://cdn-icons-png.flaticon.com/128/2165/2165674.png";
                                            break;
                                        case "https":
                                            $icon_url = "https://cdn-icons-png.flaticon.com/128/2165/2165674.png";
                                            break;
                                        case "ftp":
                                            $icon_url = "https://cdn-icons-png.flaticon.com/128/2165/2165674.png";
                                            break;
                                        case "ssh":
                                            $icon_url = "https://cdn-icons-png.flaticon.com/128/2165/2165674.png";
                                            break;
                                        case "smtp":
                                            $icon_url = "https://cdn-icons-png.flaticon.com/128/2165/2165674.png";
                                            break;
                                        case "mysql":
                                            $icon_url = "https://cdn-icons-png.flaticon.com/128/2165/2165674.png";
                                            break;
                                        // 可以添加更多服务的图标
                                    }
                                    ?>
                                    <img src="<?php echo $icon_url; ?>" alt="<?php echo htmlspecialchars($port_data["info"]); ?>" class="port-icon">
                                    <?php echo htmlspecialchars($port_data["info"]); ?>
                                </div>
                            </td>
                            <td>
                                <span class="port-status <?php echo $port_data["status"] ? 'port-open' : 'port-closed'; ?>">
                                    <?php echo $port_data["status"] ? '开放' : '关闭'; ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const scanForm = document.getElementById('scanForm');
        const loadingIndicator = document.getElementById('loadingIndicator');
        const submitBtn = document.getElementById('submitBtn');
        const ipInput = document.getElementById('ip_address');
        const historyList = document.getElementById('historyList');
        const noHistoryMsg = document.getElementById('noHistoryMsg');
        const clearHistoryBtn = document.getElementById('clearHistoryBtn');
        
        // 表单提交时显示加载指示器
        scanForm.addEventListener('submit', function() {
            if (ipInput.value.trim() === '') {
                alert('请输入要扫描的IP地址');
                return false;
            }
            
            loadingIndicator.style.display = 'block';
            submitBtn.disabled = true;
            
            // 保存到扫描历史
            saveToHistory(ipInput.value.trim());
        });
        
        // 过滤端口显示
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('filter-btn')) {
                // 移除所有按钮的active类
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                
                // 添加当前按钮的active类
                e.target.classList.add('active');
                
                const filter = e.target.getAttribute('data-filter');
                const rows = document.querySelectorAll('.port-row');
                
                rows.forEach(row => {
                    switch (filter) {
                        case 'all':
                            row.style.display = '';
                            break;
                        case 'open':
                            row.style.display = row.classList.contains('port-open-row') ? '' : 'none';
                            break;
                        case 'closed':
                            row.style.display = row.classList.contains('port-closed-row') ? '' : 'none';
                            break;
                    }
                });
            }
        });
        
        // 复制功能
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('copy-btn')) {
                const textToCopy = e.target.getAttribute('data-copy');
                
                // 创建临时textarea元素
                const textarea = document.createElement('textarea');
                textarea.value = textToCopy;
                textarea.style.position = 'fixed';  // 防止影响页面布局
                document.body.appendChild(textarea);
                textarea.select();
                
                try {
                    // 执行复制命令
                    document.execCommand('copy');
                    
                    // 显示复制成功状态
                    e.target.classList.add('copy-success');
                    e.target.textContent = '已复制';
                    
                    // 2秒后恢复按钮状态
                    setTimeout(() => {
                        e.target.classList.remove('copy-success');
                        e.target.textContent = '复制';
                    }, 2000);
                } catch (err) {
                    console.error('复制失败:', err);
                }
                
                // 移除临时元素
                document.body.removeChild(textarea);
            }
        });
        
        // 保存扫描历史到本地存储
        function saveToHistory(ip) {
            // 从本地存储获取历史记录
            let history = JSON.parse(localStorage.getItem('portScanHistory')) || [];
            
            // 检查是否已存在相同IP
            const existingIndex = history.findIndex(item => item.ip === ip);
            
            // 如果存在，先移除
            if (existingIndex !== -1) {
                history.splice(existingIndex, 1);
            }
            
            // 添加新记录到开头
            history.unshift({
                ip: ip,
                timestamp: new Date().getTime()
            });
            
            // 限制历史记录数量为10条
            if (history.length > 10) {
                history = history.slice(0, 10);
            }
            
            // 保存回本地存储
            localStorage.setItem('portScanHistory', JSON.stringify(history));
            
            // 更新历史记录显示
            loadHistory();
        }
        
        // 加载扫描历史
        function loadHistory() {
            const history = JSON.parse(localStorage.getItem('portScanHistory')) || [];
            
            if (history.length === 0) {
                noHistoryMsg.style.display = 'block';
                return;
            }
            
            noHistoryMsg.style.display = 'none';
            
            let historyHTML = '';
            
            history.forEach(item => {
                const date = new Date(item.timestamp);
                const formattedDate = `${date.getFullYear()}-${(date.getMonth()+1).toString().padStart(2, '0')}-${date.getDate().toString().padStart(2, '0')} ${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}`;
                
                historyHTML += `
                <div class="history-item" data-ip="${item.ip}">
                    <strong>${item.ip}</strong> - ${formattedDate}
                </div>
                `;
            });
            
            historyList.innerHTML = historyHTML;
            
            // 添加点击事件
            document.querySelectorAll('.history-item').forEach(item => {
                item.addEventListener('click', function() {
                    const ip = this.getAttribute('data-ip');
                    ipInput.value = ip;
                    scanForm.submit();
                });
            });
        }
        
        // 清空历史记录
        clearHistoryBtn.addEventListener('click', function() {
            if (confirm('确定要清空所有扫描历史记录吗？')) {
                localStorage.removeItem('portScanHistory');
                loadHistory();
            }
        });
        
        // 初始加载历史记录
        loadHistory();
        
        <?php if ($result && !isset($result["error"]) && isset($result["data"]) && is_array($result["data"])): ?>
        // 如果有扫描结果且没有错误，保存到历史记录
        saveToHistory('<?php echo htmlspecialchars($ip_address); ?>');
        <?php endif; ?>
    });
    </script>
</body>
</html>