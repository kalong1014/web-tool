<!-- //菜鸟乐园：https://www.zhclash.org/  https://www.cainiaoly.com/
//菜鸟乐园：互联网站长综合交流论坛，生活分享趣事平台，收集各路教程，主题插件，网站源码，主机测评，域名行情，原创开发等内容！
//持续更新中，欢迎关注！
//站点招收常驻欢迎来玩！ -->
<?php
require_once 'header.php';

$success_count = 0;
$error_count = 0;
$scan_results = [];

// 处理扫描请求
if (isset($_POST['scan'])) {
    $goju_dir = '../goju';
    
    // 检查目录是否存在
    if (is_dir($goju_dir)) {
        $files = scandir($goju_dir);
        
        foreach ($files as $file) {
            if ($file != '.' && $file != '..' && pathinfo($file, PATHINFO_EXTENSION) == 'php') {
                $file_id = pathinfo($file, PATHINFO_FILENAME);
                
                // 检查工具是否已存在
                $sql = "SELECT id FROM tools WHERE tool_id = '$file_id'";
                $result = $conn->query($sql);
                
                if ($result->num_rows == 0) {
                    // 尝试从文件中提取标题
                    $file_content = file_get_contents($goju_dir . '/' . $file);
                    $title = $file_id; // 默认使用文件名作为标题
                    
                    // 尝试从<title>标签中提取标题
                    if (preg_match('/<title>(.*?)<\/title>/i', $file_content, $matches)) {
                        $title = trim($matches[1]);
                        // 移除可能的后缀
                        $title = preg_replace('/ - .*$/', '', $title);
                    }
                    
                    // 确定工具类别
                    $category_id = 0;
                    $category_name = '未分类';
                    
                    if (strpos($file_id, 'ip') !== false || strpos($file_id, 'port') !== false || strpos($file_id, 'net') !== false) {
                        $category_sql = "SELECT id, name FROM categories WHERE category_id = 'network'";
                    } elseif (strpos($file_id, 'convert') !== false || strpos($file_id, 'encode') !== false || strpos($file_id, 'decode') !== false || strpos($file_id, 'translate') !== false) {
                        $category_sql = "SELECT id, name FROM categories WHERE category_id = 'converter'";
                    } elseif (strpos($file_id, 'query') !== false || strpos($file_id, 'search') !== false || strpos($file_id, 'info') !== false || strpos($file_id, 'beian') !== false || strpos($file_id, 'whois') !== false) {
                        $category_sql = "SELECT id, name FROM categories WHERE category_id = 'info'";
                    } elseif (strpos($file_id, 'encrypt') !== false || strpos($file_id, 'decrypt') !== false || strpos($file_id, 'password') !== false || strpos($file_id, 'sensitive') !== false) {
                        $category_sql = "SELECT id, name FROM categories WHERE category_id = 'security'";
                    } else {
                        $category_sql = "SELECT id, name FROM categories WHERE category_id = 'other'";
                    }
                    
                    $category_result = $conn->query($category_sql);
                    if ($category_result->num_rows > 0) {
                        $category = $category_result->fetch_assoc();
                        $category_id = $category['id'];
                        $category_name = $category['name'];
                    }
                    
                    // 添加工具到数据库
                    $description = "实用的在线工具";
                    $icon = "https://cdn-icons-png.flaticon.com/128/2541/2541988.png";
                    $url = "goju/" . $file;
                    
                    $sql = "INSERT INTO tools (tool_id, title, description, icon, url, category_id, status) 
                            VALUES ('$file_id', '$title', '$description', '$icon', '$url', $category_id, 1)";
                    
                    if ($conn->query($sql) === TRUE) {
                        $success_count++;
                        $scan_results[] = [
                            'file' => $file,
                            'title' => $title,
                            'category' => $category_name,
                            'status' => 'success',
                            'message' => '成功添加'
                        ];
                    } else {
                        $error_count++;
                        $scan_results[] = [
                            'file' => $file,
                            'title' => $title,
                            'category' => $category_name,
                            'status' => 'error',
                            'message' => '添加失败: ' . $conn->error
                        ];
                    }
                } else {
                    $scan_results[] = [
                        'file' => $file,
                        'title' => '',
                        'category' => '',
                        'status' => 'info',
                        'message' => '工具已存在，跳过'
                    ];
                }
            }
        }
        
        if (count($scan_results) == 0) {
            $scan_results[] = [
                'file' => '',
                'title' => '',
                'category' => '',
                'status' => 'info',
                'message' => '没有找到新的工具'
            ];
        }
    } else {
        $error_msg = "goju目录不存在！";
    }
}

// 获取已有工具数量
$sql = "SELECT COUNT(*) as total FROM tools";
$result = $conn->query($sql);
$tools_count = $result->fetch_assoc()['total'];

// 获取goju目录中的文件数量
$goju_dir = '../goju';
$files_count = 0;
if (is_dir($goju_dir)) {
    $files = scandir($goju_dir);
    foreach ($files as $file) {
        if ($file != '.' && $file != '..' && pathinfo($file, PATHINFO_EXTENSION) == 'php') {
            $files_count++;
        }
    }
}
?>

<?php if (isset($error_msg)): ?>
<div class="alert alert-danger"><?php echo $error_msg; ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h2>新应用获取</h2>
        <form method="post" action="">
            <button type="submit" name="scan" class="btn btn-primary">扫描新应用</button>
        </form>
    </div>
    
    <div style="margin-bottom: 20px; display: flex; gap: 20px;">
        <div style="background-color: #f1f1f1; padding: 15px; border-radius: 8px; flex: 1;">
            <h3 style="margin-top: 0;">已有工具</h3>
            <p style="font-size: 24px; font-weight: bold; margin-bottom: 0;"><?php echo $tools_count; ?></p>
        </div>
        <div style="background-color: #f1f1f1; padding: 15px; border-radius: 8px; flex: 1;">
            <h3 style="margin-top: 0;">goju目录文件</h3>
            <p style="font-size: 24px; font-weight: bold; margin-bottom: 0;"><?php echo $files_count; ?></p>
        </div>
        <?php if ($success_count > 0): ?>
        <div style="background-color: #d4edda; padding: 15px; border-radius: 8px; flex: 1;">
            <h3 style="margin-top: 0;">新增工具</h3>
            <p style="font-size: 24px; font-weight: bold; margin-bottom: 0;"><?php echo $success_count; ?></p>
        </div>
        <?php endif; ?>
        <?php if ($error_count > 0): ?>
        <div style="background-color: #f8d7da; padding: 15px; border-radius: 8px; flex: 1;">
            <h3 style="margin-top: 0;">添加失败</h3>
            <p style="font-size: 24px; font-weight: bold; margin-bottom: 0;"><?php echo $error_count; ?></p>
        </div>
        <?php endif; ?>
    </div>
    
    <?php if (!empty($scan_results)): ?>
    <h3>扫描结果</h3>
    <table class="table">
        <thead>
            <tr>
                <th>文件名</th>
                <th>工具名称</th>
                <th>分类</th>
                <th>状态</th>
                <th>消息</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($scan_results as $result): ?>
            <tr>
                <td><?php echo htmlspecialchars($result['file']); ?></td>
                <td><?php echo htmlspecialchars($result['title']); ?></td>
                <td><?php echo htmlspecialchars($result['category']); ?></td>
                <td>
                    <?php if ($result['status'] == 'success'): ?>
                        <span class="status-badge status-active">成功</span>
                    <?php elseif ($result['status'] == 'error'): ?>
                        <span class="status-badge status-inactive">失败</span>
                    <?php else: ?>
                        <span class="status-badge" style="background-color: #e2e3e5; color: #383d41;">信息</span>
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($result['message']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
    
    <div style="margin-top: 20px;">
        <h3>使用说明</h3>
        <p>点击"扫描新应用"按钮，系统将自动扫描goju目录中的PHP文件，并将新的工具添加到数据库中。</p>
        <p>系统会尝试从文件中提取工具名称，并根据文件名自动分类。您可以在添加后在工具管理中编辑详细信息。</p>
        <p>已存在的工具将被跳过，不会重复添加。</p>
    </div>
</div>

</div>
</body>
</html>