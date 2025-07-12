<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>短剧搜索工具</title>
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
            background-color: #ff6b81;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #ff4757;
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
            border-top: 4px solid #ff6b81;
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
        .drama-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .drama-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .drama-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        .drama-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            color: #666;
            font-size: 14px;
        }
        .drama-link {
            display: inline-block;
            background-color: #ff6b81;
            color: white;
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .drama-link:hover {
            background-color: #ff4757;
        }
        .no-results {
            text-align: center;
            padding: 20px;
            color: #666;
        }
        .search-history {
            margin-top: 10px;
        }
        .history-tag {
            display: inline-block;
            background-color: #f1f1f1;
            padding: 5px 10px;
            margin-right: 5px;
            margin-bottom: 5px;
            border-radius: 20px;
            font-size: 14px;
            color: #333;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .history-tag:hover {
            background-color: #e0e0e0;
        }
        .clear-history {
            background: none;
            border: none;
            color: #ff6b81;
            cursor: pointer;
            font-size: 14px;
            padding: 0;
            margin-left: 10px;
        }
        .clear-history:hover {
            text-decoration: underline;
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
        <h1>短剧搜索工具</h1>
        
        <?php
        $result = null;
        $search_text = '';
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_text'])) {
            $search_text = trim($_POST['search_text']);
            
            if (!empty($search_text)) {
                // API接口URL
                $api_url = "https://zy.6789o.com/duanjuapi/search.php?text=" . urlencode($search_text);
                
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
                    "msg" => "请输入要搜索的短剧名称"
                ];
            }
        }
        ?>
        
        <form method="post" action="" id="searchForm">
            <div class="form-group">
                <label for="search_text">请输入要搜索的短剧名称:</label>
                <input type="text" id="search_text" name="search_text" value="<?php echo htmlspecialchars($search_text); ?>" placeholder="例如: 游子归乡" required>
            </div>
            
            <div class="search-history" id="searchHistory">
                <!-- 搜索历史标签将在这里动态生成 -->
            </div>
            
            <button type="submit" id="submitBtn">搜索短剧</button>
            
            <div class="loading" id="loadingIndicator">
                <div class="loading-spinner"></div>
                <p>正在搜索，请稍候...</p>
            </div>
        </form>
        
        <?php if ($result): ?>
        <div class="result" style="display: block;">
            <?php if ($result["code"] == 200): ?>
                <h3 class="success">搜索成功!</h3>
                
                <?php if (!empty($result["data"])): ?>
                    <?php foreach ($result["data"] as $drama): ?>
                    <div class="drama-card">
                        <div class="drama-title"><?php echo htmlspecialchars($drama["name"]); ?></div>
                        <div class="drama-info">
                            <span>更新时间: <?php echo htmlspecialchars($drama["addtime"]); ?></span>
                            <button class="copy-btn" data-copy="<?php echo htmlspecialchars($drama["viewlink"]); ?>">复制链接</button>
                        </div>
                        <a href="<?php echo htmlspecialchars($drama["viewlink"]); ?>" target="_blank" class="drama-link">观看短剧</a>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-results">
                        <p>没有找到相关短剧，请尝试其他关键词</p>
                    </div>
                <?php endif; ?>
                
            <?php else: ?>
                <h3 class="error">搜索失败</h3>
                <p><?php echo htmlspecialchars($result["msg"]); ?></p>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchForm = document.getElementById('searchForm');
        const searchInput = document.getElementById('search_text');
        const loadingIndicator = document.getElementById('loadingIndicator');
        const submitBtn = document.getElementById('submitBtn');
        const searchHistoryContainer = document.getElementById('searchHistory');
        
        // 从本地存储加载搜索历史
        let searchHistory = JSON.parse(localStorage.getItem('duanjuSearchHistory')) || [];
        
        // 显示搜索历史
        function displaySearchHistory() {
            searchHistoryContainer.innerHTML = '';
            
            if (searchHistory.length > 0) {
                const historyLabel = document.createElement('span');
                historyLabel.textContent = '搜索历史: ';
                searchHistoryContainer.appendChild(historyLabel);
                
                // 最多显示5个历史记录
                const displayHistory = searchHistory.slice(0, 5);
                
                displayHistory.forEach(term => {
                    const historyTag = document.createElement('span');
                    historyTag.className = 'history-tag';
                    historyTag.textContent = term;
                    historyTag.addEventListener('click', function() {
                        searchInput.value = term;
                        searchForm.submit();
                    });
                    searchHistoryContainer.appendChild(historyTag);
                });
                
                // 添加清除历史按钮
                const clearBtn = document.createElement('button');
                clearBtn.className = 'clear-history';
                clearBtn.textContent = '清除历史';
                clearBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    localStorage.removeItem('duanjuSearchHistory');
                    searchHistory = [];
                    displaySearchHistory();
                });
                searchHistoryContainer.appendChild(clearBtn);
            }
        }
        
        // 初始显示搜索历史
        displaySearchHistory();
        
        // 表单提交时显示加载指示器并保存搜索历史
        searchForm.addEventListener('submit', function() {
            const searchTerm = searchInput.value.trim();
            
            if (searchTerm) {
                loadingIndicator.style.display = 'block';
                submitBtn.disabled = true;
                
                // 保存到搜索历史
                if (!searchHistory.includes(searchTerm)) {
                    searchHistory.unshift(searchTerm); // 添加到历史记录开头
                    
                    // 限制历史记录数量为10个
                    if (searchHistory.length > 10) {
                        searchHistory.pop();
                    }
                    
                    localStorage.setItem('duanjuSearchHistory', JSON.stringify(searchHistory));
                }
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
                        e.target.textContent = '复制链接';
                    }, 2000);
                } catch (err) {
                    console.error('复制失败:', err);
                }
                
                // 移除临时元素
                document.body.removeChild(textarea);
            }
        });
    });
    </script>
</body>
</html>