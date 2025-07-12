<!-- //菜鸟乐园：https://www.zhclash.org/  https://www.cainiaoly.com/
//菜鸟乐园：互联网站长综合交流论坛，生活分享趣事平台，收集各路教程，主题插件，网站源码，主机测评，域名行情，原创开发等内容！
//持续更新中，欢迎关注！
//站点招收常驻欢迎来玩！ -->
<?php
require_once 'header.php';

// 处理表单提交
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $site_name = $conn->real_escape_string($_POST['site_name']);
    $site_description = $conn->real_escape_string($_POST['site_description']);
    $site_keywords = $conn->real_escape_string($_POST['site_keywords']);
    $site_footer = $conn->real_escape_string($_POST['site_footer']);
    
    // 更新设置
    $settings = [
        'site_name' => $site_name,
        'site_description' => $site_description,
        'site_keywords' => $site_keywords,
        'site_footer' => $site_footer
    ];
    
    $success = true;
    foreach ($settings as $key => $value) {
        if (!update_setting($key, $value)) {
            $success = false;
            break;
        }
    }
    
    if ($success) {
        $success_msg = "设置已成功更新！";
    } else {
        $error_msg = "更新设置失败: " . $conn->error;
    }
}

// 获取当前设置
$site_name = get_setting('site_name', '在线工具箱');
$site_description = get_setting('site_description', '实用工具集合，提高工作效率');
$site_keywords = get_setting('site_keywords', '工具箱,在线工具,实用工具');
$site_footer = get_setting('site_footer', '© ' . date('Y') . ' 在线工具箱 - 所有工具仅供学习和参考使用');
?>

<?php if (isset($success_msg)): ?>
<div class="alert alert-success"><?php echo $success_msg; ?></div>
<?php endif; ?>

<?php if (isset($error_msg)): ?>
<div class="alert alert-danger"><?php echo $error_msg; ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h2>站点设置</h2>
    </div>
    
    <form method="post" action="">
        <div class="form-group">
            <label for="site_name">站点名称</label>
            <input type="text" id="site_name" name="site_name" value="<?php echo htmlspecialchars($site_name); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="site_description">站点描述</label>
            <textarea id="site_description" name="site_description"><?php echo htmlspecialchars($site_description); ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="site_keywords">站点关键词</label>
            <input type="text" id="site_keywords" name="site_keywords" value="<?php echo htmlspecialchars($site_keywords); ?>">
            <small>多个关键词用英文逗号分隔</small>
        </div>
        
        <div class="form-group">
            <label for="site_footer">页脚内容</label>
            <textarea id="site_footer" name="site_footer"><?php echo htmlspecialchars($site_footer); ?></textarea>
        </div>
        
        <div style="margin-top: 20px;">
            <button type="submit" class="btn btn-success">保存设置</button>
        </div>
    </form>
</div>

</div>
</body>
</html>