<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>违禁词检测工具</title>
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
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            min-height: 150px;
            font-family: Arial, sans-serif;
            resize: vertical;
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
        .highlight-changes {
            background-color: #ffecb3;
            padding: 2px;
            border-radius: 3px;
        }
        .char-count {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>违禁词检测工具</h1>
        
        <?php
        $result = null;
        $original_text = '';
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['text'])) {
            $original_text = $_POST['text'];
            
            if (!empty($original_text)) {
                // API接口URL
                $api_url = "https://api.songzixian.com/api/sensitive-word?dataSource=local_sensitive_word&text=" . urlencode($original_text);
                
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
                        "message" => "请求失败: " . curl_error($ch)
                    ];
                }
                
                curl_close($ch);
            } else {
                $result = [
                    "code" => 400,
                    "message" => "请输入要检测的文本"
                ];
            }
        }
        ?>
        
        <form method="post" action="" id="checkForm">
            <div class="form-group">
                <label for="text">请输入要检测的文本:</label>
                <textarea id="text" name="text" placeholder="在此输入需要检测的文本内容..."><?php echo htmlspecialchars($original_text); ?></textarea>
                <div class="char-count"><span id="charCount">0</span> 个字符</div>
            </div>
            
            <button type="submit" id="submitBtn">检测违禁词</button>
            
            <div class="loading" id="loadingIndicator">
                <div class="loading-spinner"></div>
                <p>正在检测，请稍候...</p>
            </div>
        </form>
        
        <?php if ($result): ?>
        <div class="result" style="display: block;">
            <?php if ($result["code"] == 200): ?>
                <h3 class="success">检测完成!</h3>
                <div class="info-card">
                    <div class="info-item">
                        <div class="info-content">
                            <span class="info-label">原始文本:</span>
                            <span class="info-value"><?php echo htmlspecialchars($original_text); ?></span>
                        </div>
                        <button class="copy-btn" data-copy="<?php echo htmlspecialchars($original_text); ?>">复制</button>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-content">
                            <span class="info-label">过滤后文本:</span>
                            <span class="info-value" id="filteredText"><?php echo htmlspecialchars($result["data"]["text"]); ?></span>
                        </div>
                        <button class="copy-btn" data-copy="<?php echo htmlspecialchars($result["data"]["text"]); ?>">复制</button>
                    </div>
                    
                    <div class="info-item" id="diffContainer">
                        <div class="info-content">
                            <span class="info-label">变更对比:</span>
                            <span class="info-value" id="diffText"></span>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-content">
                            <span class="info-label">请求ID:</span>
                            <span class="info-value"><?php echo htmlspecialchars($result["requestId"]); ?></span>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <h3 class="error">检测失败</h3>
                <p><?php echo htmlspecialchars($result["message"]); ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const textArea = document.getElementById('text');
        const charCount = document.getElementById('charCount');
        const checkForm = document.getElementById('checkForm');
        const loadingIndicator = document.getElementById('loadingIndicator');
        const submitBtn = document.getElementById('submitBtn');
        
        // 字符计数
        function updateCharCount() {
            const count = textArea.value.length;
            charCount.textContent = count;
        }
        
        textArea.addEventListener('input', updateCharCount);
        updateCharCount(); // 初始化计数
        
        // 表单提交时显示加载指示器
        checkForm.addEventListener('submit', function() {
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
        
        // 如果有结果，显示文本差异
        <?php if ($result && $result["code"] == 200): ?>
        const originalText = <?php echo json_encode($original_text); ?>;
        const filteredText = <?php echo json_encode($result["data"]["text"]); ?>;
        
        // 简单的差异比较
        function highlightDifferences(original, filtered) {
            if (original === filtered) {
                return "没有检测到违禁词";
            }
            
            let diffHtml = "";
            let i = 0, j = 0;
            
            while (i < original.length || j < filtered.length) {
                if (i < original.length && j < filtered.length && original[i] === filtered[j]) {
                    diffHtml += original[i];
                    i++;
                    j++;
                } else {
                    // 找到不同的部分
                    let originalPart = "";
                    let filteredPart = "";
                    
                    // 收集原始文本中的不同部分
                    while (i < original.length && (j >= filtered.length || original[i] !== filtered[j])) {
                        originalPart += original[i];
                        i++;
                    }
                    
                    // 收集过滤后文本中的不同部分
                    while (j < filtered.length && (i >= original.length || original[i] !== filtered[j])) {
                        filteredPart += filtered[j];
                        j++;
                    }
                    
                    if (originalPart) {
                        diffHtml += '<span class="highlight-changes" title="被替换的内容: ' + originalPart + '">' + filteredPart + '</span>';
                    }
                }
            }
            
            return diffHtml;
        }
        
        document.getElementById('diffText').innerHTML = highlightDifferences(originalText, filteredText);
        <?php endif; ?>
    });
    </script>
</body>
</html>