<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>多语言翻译工具</title>
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
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            min-height: 120px;
            font-family: Arial, sans-serif;
            resize: vertical;
        }
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: white;
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
        .translation-result {
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 15px;
            background-color: white;
        }
        .translation-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .translation-title {
            font-weight: bold;
            color: #333;
        }
        .translation-meta {
            font-size: 14px;
            color: #666;
        }
        .translation-content {
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 4px;
            min-height: 100px;
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
        .language-pair {
            display: flex;
            gap: 10px;
        }
        .language-pair > div {
            flex: 1;
        }
        .char-count {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
            text-align: right;
        }
        .swap-btn {
            background-color: #f1f1f1;
            color: #333;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 20px;
            margin-top: 25px;
            transition: background-color 0.3s;
        }
        .swap-btn:hover {
            background-color: #e0e0e0;
        }
        .history-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .history-item:hover {
            background-color: #f5f5f5;
        }
        .history-text {
            font-size: 14px;
            color: #333;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .history-langs {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        .tabs {
            display: flex;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .tab {
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: all 0.3s;
        }
        .tab.active {
            border-bottom: 2px solid #4285f4;
            color: #4285f4;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>多语言翻译工具</h1>
        
        <div class="tabs">
            <div class="tab active" data-tab="translate">翻译</div>
            <div class="tab" data-tab="history">历史记录</div>
        </div>
        
        <div class="tab-content active" id="translate-tab">
            <?php
            $result = null;
            $source_text = '';
            $source_lang = 'auto';
            $target_lang = 'en';
            
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['source_text'])) {
                $source_text = trim($_POST['source_text']);
                $target_lang = $_POST['target_lang'];
                
                if (!empty($source_text)) {
                    // API接口URL
                    $api_url = "https://findmyip.net/api/translate.php?text=" . urlencode($source_text) . "&target_lang=" . urlencode($target_lang);
                    
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
                        "message" => "请输入要翻译的文本"
                    ];
                }
            }
            ?>
            
            <form method="post" action="" id="translateForm">
                <div class="language-pair">
                    <div class="form-group">
                        <label for="source_lang">源语言:</label>
                        <select id="source_lang" name="source_lang">
                            <option value="auto" selected>自动检测</option>
                            <option value="zh">中文</option>
                            <option value="en">英语</option>
                            <option value="ja">日语</option>
                            <option value="ko">韩语</option>
                            <option value="fr">法语</option>
                            <option value="de">德语</option>
                            <option value="es">西班牙语</option>
                            <option value="it">意大利语</option>
                            <option value="ru">俄语</option>
                            <option value="pt">葡萄牙语</option>
                            <option value="vi">越南语</option>
                            <option value="th">泰语</option>
                            <option value="ar">阿拉伯语</option>
                        </select>
                    </div>
                    
                    <button type="button" class="swap-btn" id="swapLangBtn">⇄</button>
                    
                    <div class="form-group">
                        <label for="target_lang">目标语言:</label>
                        <select id="target_lang" name="target_lang">
                            <option value="en" <?php echo $target_lang == 'en' ? 'selected' : ''; ?>>英语</option>
                            <option value="zh" <?php echo $target_lang == 'zh' ? 'selected' : ''; ?>>中文</option>
                            <option value="ja" <?php echo $target_lang == 'ja' ? 'selected' : ''; ?>>日语</option>
                            <option value="ko" <?php echo $target_lang == 'ko' ? 'selected' : ''; ?>>韩语</option>
                            <option value="fr" <?php echo $target_lang == 'fr' ? 'selected' : ''; ?>>法语</option>
                            <option value="de" <?php echo $target_lang == 'de' ? 'selected' : ''; ?>>德语</option>
                            <option value="es" <?php echo $target_lang == 'es' ? 'selected' : ''; ?>>西班牙语</option>
                            <option value="it" <?php echo $target_lang == 'it' ? 'selected' : ''; ?>>意大利语</option>
                            <option value="ru" <?php echo $target_lang == 'ru' ? 'selected' : ''; ?>>俄语</option>
                            <option value="pt" <?php echo $target_lang == 'pt' ? 'selected' : ''; ?>>葡萄牙语</option>
                            <option value="vi" <?php echo $target_lang == 'vi' ? 'selected' : ''; ?>>越南语</option>
                            <option value="th" <?php echo $target_lang == 'th' ? 'selected' : ''; ?>>泰语</option>
                            <option value="ar" <?php echo $target_lang == 'ar' ? 'selected' : ''; ?>>阿拉伯语</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="source_text">输入要翻译的文本:</label>
                    <textarea id="source_text" name="source_text" placeholder="在此输入需要翻译的文本内容..."><?php echo htmlspecialchars($source_text); ?></textarea>
                    <div class="char-count"><span id="charCount">0</span> / 5000 个字符</div>
                </div>
                
                <button type="submit" id="submitBtn">翻译</button>
                
                <div class="loading" id="loadingIndicator">
                    <div class="loading-spinner"></div>
                    <p>正在翻译，请稍候...</p>
                </div>
            </form>
            
            <?php if ($result): ?>
            <div class="result" style="display: block;">
                <?php if ($result["code"] == 200): ?>
                    <div class="translation-result">
                        <div class="translation-header">
                            <div class="translation-title">
                                <?php 
                                    $source_lang_name = $result["data"]["source_lang"] == "zh" ? "中文" : $result["data"]["source_lang"];
                                    $target_lang_name = "";
                                    
                                    switch($result["data"]["target_lang"]) {
                                        case "zh": $target_lang_name = "中文"; break;
                                        case "en": $target_lang_name = "英语"; break;
                                        case "ja": $target_lang_name = "日语"; break;
                                        case "ko": $target_lang_name = "韩语"; break;
                                        case "fr": $target_lang_name = "法语"; break;
                                        case "de": $target_lang_name = "德语"; break;
                                        case "es": $target_lang_name = "西班牙语"; break;
                                        case "it": $target_lang_name = "意大利语"; break;
                                        case "ru": $target_lang_name = "俄语"; break;
                                        case "pt": $target_lang_name = "葡萄牙语"; break;
                                        case "vi": $target_lang_name = "越南语"; break;
                                        case "th": $target_lang_name = "泰语"; break;
                                        case "ar": $target_lang_name = "阿拉伯语"; break;
                                        default: $target_lang_name = $result["data"]["target_lang"];
                                    }
                                    
                                    echo $source_lang_name . " → " . $target_lang_name;
                                ?>
                            </div>
                            <div class="translation-meta">
                                处理时间: <?php echo htmlspecialchars($result["processTime"]); ?>
                                <button class="copy-btn" data-copy="<?php echo htmlspecialchars($result["data"]["translate_result"]); ?>">复制结果</button>
                            </div>
                        </div>
                        <div class="translation-content">
                            <?php echo nl2br(htmlspecialchars($result["data"]["translate_result"])); ?>
                        </div>
                    </div>
                <?php else: ?>
                    <h3 class="error">翻译失败</h3>
                    <p><?php echo isset($result["message"]) ? htmlspecialchars($result["message"]) : "未知错误"; ?></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="tab-content" id="history-tab">
            <h3>翻译历史</h3>
            <div style="text-align: right; margin-bottom: 15px;">
                <button type="button" id="clearAllHistoryBtn" class="copy-btn" style="background-color: #f44336;">清空所有历史</button>
            </div>
            <div id="historyContainer">
                <!-- 历史记录将在这里动态生成 -->
                <p id="noHistory" style="text-align: center; color: #666;">暂无翻译历史</p>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const textArea = document.getElementById('source_text');
        const charCount = document.getElementById('charCount');
        const translateForm = document.getElementById('translateForm');
        const loadingIndicator = document.getElementById('loadingIndicator');
        const submitBtn = document.getElementById('submitBtn');
        const swapLangBtn = document.getElementById('swapLangBtn');
        const sourceLangSelect = document.getElementById('source_lang');
        const targetLangSelect = document.getElementById('target_lang');
        const historyContainer = document.getElementById('historyContainer');
        const noHistoryMsg = document.getElementById('noHistory');
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');
        const clearAllHistoryBtn = document.getElementById('clearAllHistoryBtn');
        
        // 清空所有历史记录
        clearAllHistoryBtn.addEventListener('click', function() {
            if (confirm('确定要清空所有翻译历史记录吗？此操作不可恢复。')) {
                localStorage.removeItem('translateHistory');
                loadHistory(); // 重新加载历史记录（显示空状态）
                alert('历史记录已清空');
            }
        });
        
        // 字符计数
        function updateCharCount() {
            const count = textArea.value.length;
            charCount.textContent = count;
            
            // 如果超过5000字符，禁用提交按钮
            if (count > 5000) {
                submitBtn.disabled = true;
                charCount.style.color = '#f44336';
            } else {
                submitBtn.disabled = false;
                charCount.style.color = '#666';
            }
        }
        
        textArea.addEventListener('input', updateCharCount);
        updateCharCount(); // 初始化计数
        
        // 表单提交时显示加载指示器
        translateForm.addEventListener('submit', function(e) {
            if (textArea.value.trim() === '') {
                e.preventDefault();
                alert('请输入要翻译的文本');
                return;
            }
            
            loadingIndicator.style.display = 'block';
            submitBtn.disabled = true;
            
            // 保存到翻译历史
            saveToHistory();
        });
        
        // 语言切换
        swapLangBtn.addEventListener('click', function() {
            // 不能切换自动检测
            if (sourceLangSelect.value === 'auto') {
                alert('自动检测语言不能切换');
                return;
            }
            
            const tempLang = sourceLangSelect.value;
            sourceLangSelect.value = targetLangSelect.value;
            targetLangSelect.value = tempLang;
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
                        e.target.textContent = '复制结果';
                    }, 2000);
                } catch (err) {
                    console.error('复制失败:', err);
                }
                
                // 移除临时元素
                document.body.removeChild(textarea);
            }
        });
        
        // 标签切换
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // 移除所有标签的active类
                tabs.forEach(t => t.classList.remove('active'));
                
                // 添加当前标签的active类
                this.classList.add('active');
                
                // 隐藏所有内容
                tabContents.forEach(content => content.classList.remove('active'));
                
                // 显示对应内容
                const tabId = this.getAttribute('data-tab') + '-tab';
                document.getElementById(tabId).classList.add('active');
                
                // 如果切换到历史记录标签，加载历史记录
                if (this.getAttribute('data-tab') === 'history') {
                    loadHistory();
                }
            });
        });
        
        // 保存翻译历史到本地存储
        function saveToHistory() {
            const sourceText = textArea.value.trim();
            if (sourceText === '') return;
            
            const sourceLang = sourceLangSelect.value;
            const targetLang = targetLangSelect.value;
            
            // 从本地存储获取历史记录
            let history = JSON.parse(localStorage.getItem('translateHistory')) || [];
            
            // 添加新记录到开头
            history.unshift({
                sourceText: sourceText,
                sourceLang: sourceLang,
                targetLang: targetLang,
                timestamp: new Date().getTime()
            });
            
            // 限制历史记录数量为20条
            if (history.length > 20) {
                history = history.slice(0, 20);
            }
            
            // 保存回本地存储
            localStorage.setItem('translateHistory', JSON.stringify(history));
        }
        
        // 加载翻译历史
        function loadHistory() {
            const history = JSON.parse(localStorage.getItem('translateHistory')) || [];
            
            if (history.length === 0) {
                noHistoryMsg.style.display = 'block';
                historyContainer.innerHTML = '';
                return;
            }
            
            noHistoryMsg.style.display = 'none';
            
            let historyHTML = '';
            
            history.forEach(item => {
                const date = new Date(item.timestamp);
                const formattedDate = `${date.getFullYear()}-${(date.getMonth()+1).toString().padStart(2, '0')}-${date.getDate().toString().padStart(2, '0')} ${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}`;
                
                let sourceLangName = item.sourceLang === 'auto' ? '自动检测' : getLangName(item.sourceLang);
                let targetLangName = getLangName(item.targetLang);
                
                historyHTML += `
                <div class="history-item" data-source="${encodeURIComponent(item.sourceText)}" data-source-lang="${item.sourceLang}" data-target-lang="${item.targetLang}">
                    <div class="history-text">${item.sourceText.substring(0, 50)}${item.sourceText.length > 50 ? '...' : ''}</div>
                    <div class="history-langs">${sourceLangName} → ${targetLangName} · ${formattedDate}</div>
                </div>
                `;
            });
            
            historyContainer.innerHTML = historyHTML;
            
            // 添加点击事件
            document.querySelectorAll('.history-item').forEach(item => {
                item.addEventListener('click', function() {
                    const sourceText = decodeURIComponent(this.getAttribute('data-source'));
                    const sourceLang = this.getAttribute('data-source-lang');
                    const targetLang = this.getAttribute('data-target-lang');
                    
                    // 填充表单
                    textArea.value = sourceText;
                    sourceLangSelect.value = sourceLang;
                    targetLangSelect.value = targetLang;
                    
                    // 更新字符计数
                    updateCharCount();
                    
                    // 切换到翻译标签
                    document.querySelector('.tab[data-tab="translate"]').click();
                    
                    // 自动提交表单
                    translateForm.submit();
                });
            });
        }
        
        // 获取语言名称
        function getLangName(langCode) {
            const langMap = {
                'zh': '中文',
                'en': '英语',
                'ja': '日语',
                'ko': '韩语',
                'fr': '法语',
                'de': '德语',
                'es': '西班牙语',
                'it': '意大利语',
                'ru': '俄语',
                'pt': '葡萄牙语',
                'vi': '越南语',
                'th': '泰语',
                'ar': '阿拉伯语'
            };
            
            return langMap[langCode] || langCode;
        }
        
        <?php if ($result && $result["code"] == 200): ?>
        // 如果有翻译结果，保存到历史记录
        saveToHistory();
        <?php endif; ?>
    });
    </script>
</body>
</html>