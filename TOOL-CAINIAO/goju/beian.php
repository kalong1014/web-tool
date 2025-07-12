<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>网站备案信息查询工具</title>
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
            font-family: monospace;
            font-size: 16px;
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
        .info-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }
        .info-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .info-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .info-status {
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 14px;
        }
        .status-valid {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .status-invalid {
            background-color: #f2dede;
            color: #a94442;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        .info-item {
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }
        .info-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
        .info-value {
            font-size: 16px;
            font-weight: bold;
            color: #333;
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
        .domain-format-guide {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }
        .example-domains {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }
        .example-domain {
            display: inline-block;
            margin-right: 10px;
            margin-bottom: 5px;
            padding: 3px 8px;
            background-color: #f1f1f1;
            border-radius: 3px;
            cursor: pointer;
        }
        .example-domain:hover {
            background-color: #e0e0e0;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>网站备案信息查询工具</h1>
        
        <?php
        $result = null;
        $domain = '';
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['domain'])) {
            $domain = trim($_POST['domain']);
            
            if (!empty($domain)) {
                // 验证域名格式
                if (filter_var($domain, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
                    // 提取主域名
                    $domain_parts = explode('.', $domain);
                    if (count($domain_parts) > 2) {
                        // 取最后两部分作为主域名
                        $main_domain = $domain_parts[count($domain_parts) - 2] . '.' . $domain_parts[count($domain_parts) - 1];
                    } else {
                        $main_domain = $domain;
                    }
                    
                    // API接口URL
                    $api_url = "https://tools.mgtv100.com/external/v1/pear/icp";
                    
                    // 准备POST数据
                    $post_data = [
                        'domain' => $main_domain
                    ];
                    
                    // 准备cURL请求
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $api_url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // 设置超时时间为30秒
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
                    curl_setopt($ch, CURLOPT_HTTPHEADER, [
                        'Content-Type: application/json',
                        'Accept: application/json'
                    ]);
                    
                    // 执行请求
                    $response = curl_exec($ch);
                    $curl_error = curl_error($ch);
                    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    
                    curl_close($ch);
                    
                    if ($response !== false && !empty($response)) {
                        $decoded_response = json_decode($response, true);
                        
                        if ($decoded_response !== null) {
                            $result = $decoded_response;
                            $result['queried_domain'] = $domain;
                            $result['main_domain'] = $main_domain;
                        } else {
                            $result = [
                                "status" => "error",
                                "code" => 500,
                                "message" => "无法解析API返回的数据: " . substr($response, 0, 100) . (strlen($response) > 100 ? '...' : '')
                            ];
                        }
                    } else {
                        $result = [
                            "status" => "error",
                            "code" => 500,
                            "message" => "请求失败: " . $curl_error . " (HTTP状态码: " . $http_code . ")"
                        ];
                    }
                } else {
                    $result = [
                        "status" => "error",
                        "code" => 400,
                        "message" => "无效的域名格式"
                    ];
                }
            } else {
                $result = [
                    "status" => "error",
                    "code" => 400,
                    "message" => "请输入要查询的域名"
                ];
            }
        }
        ?>
        
        <form method="post" action="" id="icpForm">
            <div class="form-group">
                <label for="domain">请输入要查询的域名:</label>
                <input type="text" id="domain" name="domain" value="<?php echo htmlspecialchars($domain); ?>" placeholder="例如: baidu.com" required>
                <div class="domain-format-guide">
                    格式: 请输入不带http://或https://的域名，如baidu.com、qq.com等
                </div>
                <div class="example-domains">
                    示例: 
                    <span class="example-domain" data-domain="baidu.com">baidu.com</span>
                    <span class="example-domain" data-domain="qq.com">qq.com</span>
                    <span class="example-domain" data-domain="163.com">163.com</span>
                    <span class="example-domain" data-domain="taobao.com">taobao.com</span>
                    <span class="example-domain" data-domain="jd.com">jd.com</span>
                </div>
            </div>
            
            <button type="submit" id="submitBtn">查询备案信息</button>
            
            <div class="loading" id="loadingIndicator">
                <div class="loading-spinner"></div>
                <p>正在查询，请稍候...</p>
            </div>
        </form>
        
        <div class="history-container">
            <div class="history-title">
                <span>查询历史</span>
                <button type="button" id="clearHistoryBtn" class="clear-history">清空历史</button>
            </div>
            <div class="history-list" id="historyList">
                <div class="no-history" id="noHistoryMsg">暂无查询历史</div>
                <!-- 历史记录将在这里动态生成 -->
            </div>
        </div>
        
        <?php if ($result): ?>
        <div class="result" style="display: block;">
            <?php if ($result["status"] !== "success"): ?>
                <h3 class="error">查询失败</h3>
                <p><?php echo isset($result["message"]) ? htmlspecialchars($result["message"]) : "未知错误"; ?></p>
            <?php else: ?>
                <div class="info-card">
                    <div class="info-header">
                        <div class="info-title">备案信息查询结果</div>
                        <div class="info-status status-valid">查询成功</div>
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">查询域名</div>
                            <div class="info-value">
                                <?php echo htmlspecialchars($result["queried_domain"]); ?>
                                <button class="copy-btn" data-copy="<?php echo htmlspecialchars($result["queried_domain"]); ?>">复制</button>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">主域名</div>
                            <div class="info-value">
                                <?php echo htmlspecialchars($result["main_domain"]); ?>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">主办单位</div>
                            <div class="info-value"><?php echo isset($result["data"]["hostingparty"]) ? htmlspecialchars($result["data"]["hostingparty"]) : "未知"; ?></div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">备案号</div>
                            <div class="info-value">
                                <?php echo isset($result["data"]["filingnumber"]) ? htmlspecialchars($result["data"]["filingnumber"]) : "未知"; ?>
                                <?php if (isset($result["data"]["filingnumber"])): ?>
                                <button class="copy-btn" data-copy="<?php echo htmlspecialchars($result["data"]["filingnumber"]); ?>">复制</button>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">单位性质</div>
                            <div class="info-value"><?php echo isset($result["data"]["unitnature"]) ? htmlspecialchars($result["data"]["unitnature"]) : "未知"; ?></div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">审核时间</div>
                            <div class="info-value"><?php echo isset($result["data"]["audittime"]) ? htmlspecialchars($result["data"]["audittime"]) : "未知"; ?></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <div class="footer">
            <p>本工具仅用于网站备案信息查询，数据仅供参考。</p>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const icpForm = document.getElementById('icpForm');
        const loadingIndicator = document.getElementById('loadingIndicator');
        const submitBtn = document.getElementById('submitBtn');
        const domainInput = document.getElementById('domain');
        const historyList = document.getElementById('historyList');
        const noHistoryMsg = document.getElementById('noHistoryMsg');
        const clearHistoryBtn = document.getElementById('clearHistoryBtn');
        const exampleDomains = document.querySelectorAll('.example-domain');
        
        // 表单提交时显示加载指示器
        icpForm.addEventListener('submit', function(e) {
            if (domainInput.value.trim() === '') {
                e.preventDefault();
                alert('请输入要查询的域名');
                return;
            }
            
            // 移除可能的http://或https://前缀
            let domain = domainInput.value.trim();
            domain = domain.replace(/^https?:\/\//, '');
            domain = domain.replace(/\/.*$/, ''); // 移除路径部分
            
            domainInput.value = domain;
            
            loadingIndicator.style.display = 'block';
            submitBtn.disabled = true;
            
            // 保存到查询历史
            saveToHistory(domain);
        });
        
        // 示例域名点击事件
        exampleDomains.forEach(function(element) {
            element.addEventListener('click', function() {
                const domain = this.getAttribute('data-domain');
                domainInput.value = domain;
                icpForm.submit();
            });
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
        
        // 保存查询历史到本地存储
        function saveToHistory(domain) {
            // 从本地存储获取历史记录
            let history = JSON.parse(localStorage.getItem('icpHistory')) || [];
            
            // 检查是否已存在相同域名
            const existingIndex = history.findIndex(item => item.domain === domain);
            
            // 如果存在，先移除
            if (existingIndex !== -1) {
                history.splice(existingIndex, 1);
            }
            
            // 添加新记录到开头
            history.unshift({
                domain: domain,
                timestamp: new Date().getTime()
            });
            
            // 限制历史记录数量为10条
            if (history.length > 10) {
                history = history.slice(0, 10);
            }
            
            // 保存回本地存储
            localStorage.setItem('icpHistory', JSON.stringify(history));
            
            // 更新历史记录显示
            loadHistory();
        }
        
        // 加载查询历史
        function loadHistory() {
            const history = JSON.parse(localStorage.getItem('icpHistory')) || [];
            
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
                <div class="history-item" data-domain="${item.domain}">
                    <strong>${item.domain}</strong> - ${formattedDate}
                </div>
                `;
            });
            
            historyList.innerHTML = historyHTML;
            
            // 添加点击事件
            document.querySelectorAll('.history-item').forEach(item => {
                item.addEventListener('click', function() {
                    const domain = this.getAttribute('data-domain');
                    domainInput.value = domain;
                    icpForm.submit();
                });
            });
        }
        
        // 清空历史记录
        clearHistoryBtn.addEventListener('click', function() {
            if (confirm('确定要清空所有查询历史记录吗？')) {
                localStorage.removeItem('icpHistory');
                loadHistory();
            }
        });
        
        // 初始加载历史记录
        loadHistory();
        
        <?php if ($result && $result["status"] === "success"): ?>
        // 如果有查询结果且成功，保存到历史记录
        saveToHistory('<?php echo htmlspecialchars($domain); ?>');
        <?php endif; ?>
    });
    </script>
</body>
</html>