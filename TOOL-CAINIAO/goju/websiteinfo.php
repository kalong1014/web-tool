<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>网站信息查询工具</title>
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
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
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
            min-width: 80px;
        }
        .info-value {
            flex: 1;
            word-break: break-word;
        }
        .site-icon {
            max-width: 32px;
            max-height: 32px;
            vertical-align: middle;
            margin-right: 10px;
            border-radius: 4px;
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
        .icon-container {
            display: flex;
            align-items: center;
        }
        .result-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .result-header h3 {
            margin: 0;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>网站信息查询工具</h1>
        
        <?php
        $result = null;
        $url = '';
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['url'])) {
            $url = trim($_POST['url']);
            
            if (!empty($url)) {
                // 调用API
                $api_url = "https://api.ahfi.cn/api/websiteinfo?url=" . urlencode($url);
                
                // 使用cURL获取API响应
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $api_url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                $response = curl_exec($ch);
                
                if ($response !== false) {
                    $result = json_decode($response, true);
                } else {
                    $result = [
                        'code' => 500,
                        'message' => '无法连接到API服务: ' . curl_error($ch)
                    ];
                }
                curl_close($ch);
            } else {
                $result = [
                    'code' => 404,
                    'message' => '请输入有效的URL'
                ];
            }
        }
        ?>
        
        <form method="post" action="">
            <div class="form-group">
                <label for="url">请输入要查询的网站URL:</label>
                <input type="text" id="url" name="url" value="<?php echo htmlspecialchars($url); ?>" placeholder="例如: https://www.zhclash.org" required>
            </div>
            <button type="submit">查询信息</button>
        </form>
        
        <?php if ($result): ?>
        <div class="result" style="display: block;">
            <?php if ($result['code'] == 200): ?>
                <div class="result-header">
                    <h3 class="success">查询成功!</h3>
                    <span>查询网址: <?php echo htmlspecialchars($url); ?></span>
                </div>
                <div class="info-card">
                    <?php if (!empty($result['data']['ico_url'])): ?>
                    <div class="info-item">
                        <div class="info-content">
                            <span class="info-label">网站图标:</span>
                            <div class="icon-container">
                                <img src="<?php echo htmlspecialchars($result['data']['ico_url']); ?>" alt="网站图标" class="site-icon">
                                <span class="info-value"><?php echo htmlspecialchars($result['data']['ico_url']); ?></span>
                            </div>
                        </div>
                        <button class="copy-btn" data-copy="<?php echo htmlspecialchars($result['data']['ico_url']); ?>">复制</button>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($result['data']['title'])): ?>
                    <div class="info-item">
                        <div class="info-content">
                            <span class="info-label">网站标题:</span>
                            <span class="info-value"><?php echo htmlspecialchars($result['data']['title']); ?></span>
                        </div>
                        <button class="copy-btn" data-copy="<?php echo htmlspecialchars($result['data']['title']); ?>">复制</button>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($result['data']['description'])): ?>
                    <div class="info-item">
                        <div class="info-content">
                            <span class="info-label">网站描述:</span>
                            <span class="info-value"><?php echo htmlspecialchars($result['data']['description']); ?></span>
                        </div>
                        <button class="copy-btn" data-copy="<?php echo htmlspecialchars($result['data']['description']); ?>">复制</button>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($result['data']['keywords'])): ?>
                    <div class="info-item">
                        <div class="info-content">
                            <span class="info-label">网站关键词:</span>
                            <span class="info-value"><?php echo htmlspecialchars($result['data']['keywords']); ?></span>
                        </div>
                        <button class="copy-btn" data-copy="<?php echo htmlspecialchars($result['data']['keywords']); ?>">复制</button>
                    </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <h3 class="error">查询失败</h3>
                <p><?php echo htmlspecialchars($result['message']); ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
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