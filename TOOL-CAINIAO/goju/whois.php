<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>域名WHOIS查询工具</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
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
            background-color: #4285f4;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #3367d6;
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
        .info-card {
            margin-top: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 15px;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .info-item {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 4px;
            background-color: #f9f9f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .info-content {
            display: flex;
            align-items: center;
            flex: 1;
        }
        .info-label {
            font-weight: bold;
            margin-right: 10px;
            color: #555;
            min-width: 150px;
        }
        .info-value {
            flex: 1;
            word-break: break-word;
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
        .loading {
            display: none;
            text-align: center;
            margin-top: 20px;
        }
        .loading-spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #4285f4;
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
        .domain-info {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .domain-icon {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }
        .expiry-warning {
            color: #ff9800;
            font-weight: bold;
        }
        .expiry-danger {
            color: #f44336;
            font-weight: bold;
        }
        .expiry-safe {
            color: #4CAF50;
            font-weight: bold;
        }
        .dns-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .dns-item {
            padding: 5px 0;
        }
        .dns-item:not(:last-child) {
            border-bottom: 1px dashed #eee;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>域名WHOIS查询工具</h1>
        
        <?php
        $result = null;
        $domain = '';
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['domain'])) {
            $domain = trim($_POST['domain']);
            
            if (!empty($domain)) {
                // API接口URL
                $api_url = "https://v2.api-m.com/api/whois?domain=" . urlencode($domain);
                
                // 准备cURL请求
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                
                // 执行请求
                $response = curl_exec($ch);
                
                if ($response !== false) {
                    $result = json_decode($response, true);
                } else {
                    $result = [
                        "code" => 500,
                        "msg" => "请求失败: " . curl_error($ch)
                    ];
                }
                
                curl_close($ch);
            } else {
                $result = [
                    "code" => 400,
                    "msg" => "请输入要查询的域名"
                ];
            }
        }
        ?>
        
        <form method="post" action="" id="whoisForm">
            <div class="form-group">
                <label for="domain">请输入要查询的域名:</label>
                <input type="text" id="domain" name="domain" value="<?php echo htmlspecialchars($domain); ?>" placeholder="例如: example.com" required>
            </div>
            
            <button type="submit" id="submitBtn">查询WHOIS信息</button>
            
            <div class="loading" id="loadingIndicator">
                <div class="loading-spinner"></div>
                <p>正在查询，请稍候...</p>
            </div>
        </form>
        
        <?php if ($result): ?>
        <div class="result" style="display: block;">
            <?php if ($result["code"] == 200): ?>
                <h3 class="success">查询成功!</h3>
                <div class="info-card">
                    <div class="domain-info">
                        <img src="https://www.google.com/s2/favicons?domain=<?php echo htmlspecialchars($domain); ?>" alt="网站图标" class="domain-icon">
                        <h3><?php echo htmlspecialchars($result["data"]["Domain Name"]); ?></h3>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-content">
                            <span class="info-label">域名:</span>
                            <span class="info-value"><?php echo htmlspecialchars($result["data"]["Domain Name"]); ?></span>
                        </div>
                        <button class="copy-btn" data-copy="<?php echo htmlspecialchars($result["data"]["Domain Name"]); ?>">复制</button>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-content">
                            <span class="info-label">注册商:</span>
                            <span class="info-value"><?php echo htmlspecialchars($result["data"]["Sponsoring Registrar"]); ?></span>
                        </div>
                        <button class="copy-btn" data-copy="<?php echo htmlspecialchars($result["data"]["Sponsoring Registrar"]); ?>">复制</button>
                    </div>
                    
                    <?php if (!empty($result["data"]["Registrar URL"])): ?>
                    <div class="info-item">
                        <div class="info-content">
                            <span class="info-label">注册商网址:</span>
                            <span class="info-value"><?php echo htmlspecialchars($result["data"]["Registrar URL"]); ?></span>
                        </div>
                        <button class="copy-btn" data-copy="<?php echo htmlspecialchars($result["data"]["Registrar URL"]); ?>">复制</button>
                    </div>
                    <?php endif; ?>
                    
                    <div class="info-item">
                        <div class="info-content">
                            <span class="info-label">注册人:</span>
                            <span class="info-value"><?php echo htmlspecialchars($result["data"]["Registrant"]); ?></span>
                        </div>
                        <button class="copy-btn" data-copy="<?php echo htmlspecialchars($result["data"]["Registrant"]); ?>">复制</button>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-content">
                            <span class="info-label">注册邮箱:</span>
                            <span class="info-value"><?php echo htmlspecialchars($result["data"]["Registrant Contact Email"]); ?></span>
                        </div>
                        <button class="copy-btn" data-copy="<?php echo htmlspecialchars($result["data"]["Registrant Contact Email"]); ?>">复制</button>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-content">
                            <span class="info-label">注册时间:</span>
                            <span class="info-value"><?php echo htmlspecialchars($result["data"]["Registration Time"]); ?></span>
                        </div>
                        <button class="copy-btn" data-copy="<?php echo htmlspecialchars($result["data"]["Registration Time"]); ?>">复制</button>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-content">
                            <span class="info-label">到期时间:</span>
                            <span class="info-value">
                                <?php 
                                    $expiry_date = strtotime($result["data"]["Expiration Time"]);
                                    $now = time();
                                    $days_left = round(($expiry_date - $now) / 86400);
                                    
                                    echo htmlspecialchars($result["data"]["Expiration Time"]);
                                    
                                    if ($days_left < 0) {
                                        echo ' <span class="expiry-danger">(已过期 ' . abs($days_left) . ' 天)</span>';
                                    } elseif ($days_left < 30) {
                                        echo ' <span class="expiry-danger">(即将过期，剩余 ' . $days_left . ' 天)</span>';
                                    } elseif ($days_left < 90) {
                                        echo ' <span class="expiry-warning">(剩余 ' . $days_left . ' 天)</span>';
                                    } else {
                                        echo ' <span class="expiry-safe">(剩余 ' . $days_left . ' 天)</span>';
                                    }
                                ?>
                            </span>
                        </div>
                        <button class="copy-btn" data-copy="<?php echo htmlspecialchars($result["data"]["Expiration Time"]); ?>">复制</button>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-content">
                            <span class="info-label">DNS服务器:</span>
                            <span class="info-value">
                                <?php if (is_array($result["data"]["DNS Serve"]) && !empty($result["data"]["DNS Serve"])): ?>
                                <ul class="dns-list">
                                    <?php foreach ($result["data"]["DNS Serve"] as $dns): ?>
                                    <li class="dns-item"><?php echo htmlspecialchars($dns); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php else: ?>
                                无DNS服务器信息
                                <?php endif; ?>
                            </span>
                        </div>
                        <button class="copy-btn" data-copy="<?php echo is_array($result["data"]["DNS Serve"]) ? implode("\n", $result["data"]["DNS Serve"]) : ''; ?>">复制</button>
                    </div>
                </div>
            <?php else: ?>
                <h3 class="error">查询失败</h3>
                <p><?php echo htmlspecialchars($result["msg"]); ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const whoisForm = document.getElementById('whoisForm');
        const loadingIndicator = document.getElementById('loadingIndicator');
        const submitBtn = document.getElementById('submitBtn');
        
        // 表单提交时显示加载指示器
        whoisForm.addEventListener('submit', function() {
            loadingIndicator.style.display = 'block';
            submitBtn.disabled = true;
        });
        
        // 复制功能
        const copyButtons = document.querySelectorAll('.copy-btn');
        
        copyButtons.forEach(button => {
            button.addEventListener('click', function() {
                const textToCopy = this.getAttribute('data-copy');
                
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
                    this.classList.add('copy-success');
                    this.textContent = '已复制';
                    
                    // 2秒后恢复按钮状态
                    setTimeout(() => {
                        this.classList.remove('copy-success');
                        this.textContent = '复制';
                    }, 2000);
                } catch (err) {
                    console.error('复制失败:', err);
                }
                
                // 移除临时元素
                document.body.removeChild(textarea);
            });
        });
    });
    </script>
</body>
</html>