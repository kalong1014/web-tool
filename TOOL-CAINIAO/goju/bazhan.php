<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>网站扒取工具</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>网站扒取工具</h1>
        
        <?php
        $result = null;
        $url = '';
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['url'])) {
            $url = trim($_POST['url']);
            
            if (!empty($url)) {
                // 调用API
                $api_url = "http://www.jz.baby/api.php?url=" . urlencode($url);
                $response = file_get_contents($api_url);
                
                if ($response !== false) {
                    $result = json_decode($response, true);
                } else {
                    $result = [
                        'status' => 'error',
                        'message' => '无法连接到API服务'
                    ];
                }
            } else {
                $result = [
                    'status' => 'error',
                    'message' => '请输入有效的URL'
                ];
            }
        }
        ?>
        
        <form method="post" action="">
            <div class="form-group">
                <label for="url">请输入要扒取的网站URL:</label>
                <input type="text" id="url" name="url" value="<?php echo htmlspecialchars($url); ?>" placeholder="例如: https://example.com" required>
            </div>
            <button type="submit">开始扒取</button>
        </form>
        
        <?php if ($result): ?>
        <div class="result" style="display: block;">
            <?php if ($result['status'] === 'success'): ?>
                <h3 class="success">扒取成功!</h3>
                <p><?php echo htmlspecialchars($result['message']); ?></p>
                <p>下载链接: <a href="<?php echo htmlspecialchars($result['download_url']); ?>" target="_blank"><?php echo htmlspecialchars($result['download_url']); ?></a></p>
            <?php else: ?>
                <h3 class="error">扒取失败</h3>
                <p><?php echo htmlspecialchars($result['message']); ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>