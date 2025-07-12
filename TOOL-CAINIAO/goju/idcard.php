<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>身份证信息查询工具</title>
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
        .id-format-guide {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }
        .random-id-btn {
            background-color: #ff9800;
            margin-left: 10px;
        }
        .random-id-btn:hover {
            background-color: #e68a00;
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
        <h1>身份证信息查询工具</h1>
        
        <?php
        $result = null;
        $id_card = '';
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_card'])) {
            $id_card = trim($_POST['id_card']);
            
            if (!empty($id_card)) {
                // 验证身份证号码格式
                if (preg_match('/(^\d{15}$)|(^\d{17}(\d|X|x)$)/', $id_card)) {
                    // API接口URL
                    $api_url = "https://zj.v.api.aa1.cn/api/sfz/?sfz=" . urlencode($id_card);
                    
                    // 准备cURL请求
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $api_url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // 设置超时时间为30秒
                    
                    // 执行请求
                    $response = curl_exec($ch);
                    $curl_error = curl_error($ch);
                    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    
                    curl_close($ch);
                    
                    if ($response !== false && !empty($response)) {
                        $decoded_response = json_decode($response, true);
                        
                        if ($decoded_response !== null) {
                            $result = $decoded_response;
                        } else {
                            $result = [
                                "code" => 500,
                                "msg" => "无法解析API返回的数据: " . substr($response, 0, 100) . (strlen($response) > 100 ? '...' : '')
                            ];
                        }
                    } else {
                        $result = [
                            "code" => 500,
                            "msg" => "请求失败: " . $curl_error . " (HTTP状态码: " . $http_code . ")"
                        ];
                    }
                } else {
                    $result = [
                        "code" => 400,
                        "msg" => "无效的身份证号码格式"
                    ];
                }
            } else {
                $result = [
                    "code" => 400,
                    "msg" => "请输入身份证号码"
                ];
            }
        }
        ?>
        
        <form method="post" action="" id="idCardForm">
            <div class="form-group">
                <label for="id_card">请输入身份证号码:</label>
                <div style="display: flex; align-items: center;">
                    <input type="text" id="id_card" name="id_card" value="<?php echo htmlspecialchars($id_card); ?>" placeholder="请输入15位或18位身份证号码" required>
                    <button type="button" id="randomIdBtn" class="random-id-btn">随机生成</button>
                </div>
                <div class="id-format-guide">
                    格式: 18位数字，最后一位可能是数字或字母X
                </div>
            </div>
            
            <button type="submit" id="submitBtn">查询信息</button>
            
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
            <?php if ($result["code"] != 200): ?>
                <h3 class="error">查询失败</h3>
                <p><?php echo htmlspecialchars($result["msg"]); ?></p>
            <?php else: ?>
                <div class="info-card">
                    <div class="info-header">
                        <div class="info-title">身份证信息</div>
                        <div class="info-status status-valid"><?php echo htmlspecialchars($result["msg"]); ?></div>
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">身份证号码</div>
                            <div class="info-value">
                                <?php echo htmlspecialchars($result["data"]["sfz"]); ?>
                                <button class="copy-btn" data-copy="<?php echo htmlspecialchars($result["data"]["sfz"]); ?>">复制</button>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">加密号码</div>
                            <div class="info-value"><?php echo htmlspecialchars($result["data"]["sfz_mw"]); ?></div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">省份</div>
                            <div class="info-value"><?php echo htmlspecialchars($result["data"]["province"]); ?></div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">城市</div>
                            <div class="info-value"><?php echo htmlspecialchars($result["data"]["city"]); ?></div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">性别</div>
                            <div class="info-value"><?php echo htmlspecialchars($result["data"]["xb"]); ?></div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">年龄</div>
                            <div class="info-value"><?php echo htmlspecialchars($result["data"]["age"]); ?> 岁</div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">年龄状态</div>
                            <div class="info-value"><?php echo htmlspecialchars($result["data"]["age_isage"]); ?></div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">人生阶段</div>
                            <div class="info-value"><?php echo htmlspecialchars($result["data"]["age_job"]); ?></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <div class="footer">
            <p>本工具仅用于身份证号码格式验证和信息查询，不会存储您的身份证信息。</p>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const idCardForm = document.getElementById('idCardForm');
        const loadingIndicator = document.getElementById('loadingIndicator');
        const submitBtn = document.getElementById('submitBtn');
        const idCardInput = document.getElementById('id_card');
        const historyList = document.getElementById('historyList');
        const noHistoryMsg = document.getElementById('noHistoryMsg');
        const clearHistoryBtn = document.getElementById('clearHistoryBtn');
        const randomIdBtn = document.getElementById('randomIdBtn');
        
        // 表单提交时显示加载指示器
        idCardForm.addEventListener('submit', function(e) {
            if (idCardInput.value.trim() === '') {
                e.preventDefault();
                alert('请输入身份证号码');
                return;
            }
            
            loadingIndicator.style.display = 'block';
            submitBtn.disabled = true;
            
            // 保存到查询历史
            saveToHistory(idCardInput.value.trim());
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
        function saveToHistory(idCard) {
            // 从本地存储获取历史记录
            let history = JSON.parse(localStorage.getItem('idCardHistory')) || [];
            
            // 检查是否已存在相同身份证号码
            const existingIndex = history.findIndex(item => item.idCard === idCard);
            
            // 如果存在，先移除
            if (existingIndex !== -1) {
                history.splice(existingIndex, 1);
            }
            
            // 添加新记录到开头
            history.unshift({
                idCard: idCard,
                timestamp: new Date().getTime()
            });
            
            // 限制历史记录数量为10条
            if (history.length > 10) {
                history = history.slice(0, 10);
            }
            
            // 保存回本地存储
            localStorage.setItem('idCardHistory', JSON.stringify(history));
            
            // 更新历史记录显示
            loadHistory();
        }
        
        // 加载查询历史
        function loadHistory() {
            const history = JSON.parse(localStorage.getItem('idCardHistory')) || [];
            
            if (history.length === 0) {
                noHistoryMsg.style.display = 'block';
                return;
            }
            
            noHistoryMsg.style.display = 'none';
            
            let historyHTML = '';
            
            history.forEach(item => {
                const date = new Date(item.timestamp);
                const formattedDate = `${date.getFullYear()}-${(date.getMonth()+1).toString().padStart(2, '0')}-${date.getDate().toString().padStart(2, '0')} ${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}`;
                
                // 对身份证号码进行部分隐藏处理
                const maskedIdCard = item.idCard.replace(/^(.{6})(.*)(.{4})$/, '$1******$3');
                
                historyHTML += `
                <div class="history-item" data-id="${item.idCard}">
                    <strong>${maskedIdCard}</strong> - ${formattedDate}
                </div>
                `;
            });
            
            historyList.innerHTML = historyHTML;
            
            // 添加点击事件
            document.querySelectorAll('.history-item').forEach(item => {
                item.addEventListener('click', function() {
                    const idCard = this.getAttribute('data-id');
                    idCardInput.value = idCard;
                    idCardForm.submit();
                });
            });
        }
        
        // 清空历史记录
        clearHistoryBtn.addEventListener('click', function() {
            if (confirm('确定要清空所有查询历史记录吗？')) {
                localStorage.removeItem('idCardHistory');
                loadHistory();
            }
        });
        
        // 随机生成身份证号码
        randomIdBtn.addEventListener('click', function() {
            // 随机生成地区码（前6位）
            const areaCodes = [
                '110101', '110102', '110105', '110106', '110107', '110108', '110109', '110111',
                '120101', '120102', '120103', '120104', '120105', '120106', '120110', '120111',
                '130101', '130102', '130103', '130104', '130105', '130107', '130108', '130109',
                '210101', '210102', '210103', '210104', '210105', '210106', '210111', '210112',
                '310101', '310104', '310105', '310106', '310107', '310109', '310110', '310112',
                '440101', '440103', '440104', '440105', '440106', '440111', '440112', '440113'
            ];
            const areaCode = areaCodes[Math.floor(Math.random() * areaCodes.length)];
            
            // 随机生成出生日期（中间8位）
            const now = new Date();
            const year = Math.floor(Math.random() * 80) + 1940;
            const month = Math.floor(Math.random() * 12) + 1;
            const day = Math.floor(Math.random() * 28) + 1; // 简化处理，避免月份天数问题
            const birthDate = `${year}${month.toString().padStart(2, '0')}${day.toString().padStart(2, '0')}`;
            
            // 随机生成顺序码（后3位）
            const sequenceCode = Math.floor(Math.random() * 999).toString().padStart(3, '0');
            
            // 组合前17位
            const idCardPrefix = `${areaCode}${birthDate}${sequenceCode}`;
            
            // 计算校验码
            const weights = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
            const checkCodes = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];
            
            let sum = 0;
            for (let i = 0; i < 17; i++) {
                sum += parseInt(idCardPrefix[i]) * weights[i];
            }
            
            const checkCode = checkCodes[sum % 11];
            
            // 完整的身份证号码
            const idCard = idCardPrefix + checkCode;
            
            // 填入输入框
            idCardInput.value = idCard;
        });
        
        // 初始加载历史记录
        loadHistory();
        
        <?php if ($result && $result["code"] == 200): ?>
        // 如果有查询结果且成功，保存到历史记录
        saveToHistory('<?php echo htmlspecialchars($id_card); ?>');
        <?php endif; ?>
    });
    </script>
</body>
</html>