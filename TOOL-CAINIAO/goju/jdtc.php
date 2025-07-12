<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>京东图床上传工具 -限制5MB大小</title>
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
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #f9f9f9;
        }
        button {
            background-color: #e2231a; /* 京东红色 */
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #c81e16;
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
        .preview-image {
            max-width: 100%;
            max-height: 300px;
            border-radius: 4px;
            margin-top: 10px;
            border: 1px solid #ddd;
        }
        .upload-area {
            border: 2px dashed #ddd;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: border-color 0.3s;
        }
        .upload-area:hover {
            border-color: #e2231a;
        }
        .upload-icon {
            font-size: 48px;
            color: #ddd;
            margin-bottom: 10px;
        }
        .upload-text {
            color: #666;
        }
        .loading {
            display: none;
            text-align: center;
            margin-top: 20px;
        }
        .loading-spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #e2231a;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>京东图床上传工具 -限制5MB大小</h1>
        
        <?php
        $result = null;
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
            $file = $_FILES["image"];
            
            if ($file["error"] == 0) {
                // API接口URL
                $api_url = "https://api.xinyew.cn/api/jdtc";
                
                // 准备cURL请求
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $api_url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                
                // 创建CURLFile对象
                $cfile = new CURLFile(
                    $file["tmp_name"],
                    $file["type"],
                    $file["name"]
                );
                
                // 设置POST数据 - 尝试不同的参数名称
                $post_data = array(
                    "file" => $cfile  // 将"image"改为"file"
                );
                
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                
                // 执行请求
                $response = curl_exec($ch);
                
                if ($response !== false) {
                    $result = json_decode($response, true);
                } else {
                    $result = [
                        "errno" => 1,
                        "message" => "上传失败: " . curl_error($ch)
                    ];
                }
                
                curl_close($ch);
            } else {
                $result = [
                    "errno" => 1,
                    "message" => "文件上传错误，错误代码: " . $file["error"]
                ];
            }
        }
        ?>
        
        <form method="post" action="" enctype="multipart/form-data" id="uploadForm">
            <div class="upload-area" id="uploadArea">
                <div class="upload-icon">📁</div>
                <div class="upload-text">点击或拖拽图片到此处上传</div>
                <input type="file" name="image" id="imageInput" accept="image/*" style="display: none;" required>
            </div>
            
            <div class="form-group">
                <label for="imagePreview">图片预览:</label>
                <div id="previewContainer" style="display: none;">
                    <img id="imagePreview" class="preview-image" src="#" alt="预览图">
                </div>
            </div>
            
            <button type="submit" id="submitBtn">上传到京东图床</button>
            
            <div class="loading" id="loadingIndicator">
                <div class="loading-spinner"></div>
                <p>正在上传，请稍候...</p>
            </div>
        </form>
        
        <?php if ($result): ?>
        <div class="result" style="display: block;">
            <?php if ($result["errno"] == 0): ?>
                <h3 class="success">上传成功!</h3>
                <div class="info-card">
                    <div class="info-item">
                        <div class="info-content">
                            <span class="info-label">文件名:</span>
                            <span class="info-value"><?php echo htmlspecialchars($result["data"]["fileName"]); ?></span>
                        </div>
                        <button class="copy-btn" data-copy="<?php echo htmlspecialchars($result["data"]["fileName"]); ?>">复制</button>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-content">
                            <span class="info-label">图片URL:</span>
                            <span class="info-value"><?php echo htmlspecialchars($result["data"]["url"]); ?></span>
                        </div>
                        <button class="copy-btn" data-copy="<?php echo htmlspecialchars($result["data"]["url"]); ?>">复制</button>
                    </div>
                    
                    <div style="text-align: center; margin-top: 15px;">
                        <img src="<?php echo htmlspecialchars($result["data"]["url"]); ?>" alt="上传的图片" class="preview-image">
                    </div>
                    
                    <div class="info-item">
                        <div class="info-content">
                            <span class="info-label">HTML代码:</span>
                            <span class="info-value">&lt;img src="<?php echo htmlspecialchars($result["data"]["url"]); ?>" alt="<?php echo htmlspecialchars($result["data"]["fileName"]); ?>"&gt;</span>
                        </div>
                        <button class="copy-btn" data-copy='<img src="<?php echo htmlspecialchars($result["data"]["url"]); ?>" alt="<?php echo htmlspecialchars($result["data"]["fileName"]); ?>">'>复制</button>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-content">
                            <span class="info-label">Markdown:</span>
                            <span class="info-value">![<?php echo htmlspecialchars($result["data"]["fileName"]); ?>](<?php echo htmlspecialchars($result["data"]["url"]); ?>)</span>
                        </div>
                        <button class="copy-btn" data-copy="![<?php echo htmlspecialchars($result["data"]["fileName"]); ?>](<?php echo htmlspecialchars($result["data"]["url"]); ?>)">复制</button>
                    </div>
                </div>
            <?php else: ?>
                <h3 class="error">上传失败</h3>
                <p><?php echo htmlspecialchars($result["message"]); ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const uploadArea = document.getElementById('uploadArea');
        const imageInput = document.getElementById('imageInput');
        const previewContainer = document.getElementById('previewContainer');
        const imagePreview = document.getElementById('imagePreview');
        const uploadForm = document.getElementById('uploadForm');
        const loadingIndicator = document.getElementById('loadingIndicator');
        const submitBtn = document.getElementById('submitBtn');
        
        // 点击上传区域触发文件选择
        uploadArea.addEventListener('click', function() {
            imageInput.click();
        });
        
        // 拖拽上传
        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            uploadArea.style.borderColor = '#e2231a';
        });
        
        uploadArea.addEventListener('dragleave', function() {
            uploadArea.style.borderColor = '#ddd';
        });
        
        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            uploadArea.style.borderColor = '#ddd';
            
            if (e.dataTransfer.files.length > 0) {
                imageInput.files = e.dataTransfer.files;
                handleFileSelect();
            }
        });
        
        // 文件选择后预览
        imageInput.addEventListener('change', handleFileSelect);
        
        function handleFileSelect() {
            if (imageInput.files && imageInput.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                
                reader.readAsDataURL(imageInput.files[0]);
            }
        }
        
        // 表单提交时显示加载指示器
        uploadForm.addEventListener('submit', function() {
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