<!-- //菜鸟乐园：https://www.zhclash.org/  https://www.cainiaoly.com/
//菜鸟乐园：互联网站长综合交流论坛，生活分享趣事平台，收集各路教程，主题插件，网站源码，主机测评，域名行情，原创开发等内容！
//持续更新中，欢迎关注！
//站点招收常驻欢迎来玩！ -->
<?php
require_once 'header.php';

$success_msg = '';
$error_msg = '';

// 处理表单提交
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // 验证输入
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $error_msg = "所有字段都必须填写！";
    } elseif ($new_password !== $confirm_password) {
        $error_msg = "新密码和确认密码不匹配！";
    } elseif (strlen($new_password) < 6) {
        $error_msg = "新密码长度必须至少为6个字符！";
    } else {
        // 验证当前密码
        $admin_id = $_SESSION['admin_id'];
        $sql = "SELECT password FROM admins WHERE id = $admin_id";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            if (password_verify($current_password, $admin['password'])) {
                // 更新密码
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $sql = "UPDATE admins SET password = '$hashed_password' WHERE id = $admin_id";
                
                if ($conn->query($sql) === TRUE) {
                    $success_msg = "密码已成功更新！";
                } else {
                    $error_msg = "更新密码失败: " . $conn->error;
                }
            } else {
                $error_msg = "当前密码不正确！";
            }
        } else {
            $error_msg = "管理员账号不存在！";
        }
    }
}
?>

<div class="card">
    <div class="card-header">
        <h2>修改密码</h2>
    </div>
    
    <?php if (!empty($success_msg)): ?>
    <div class="alert alert-success"><?php echo $success_msg; ?></div>
    <?php endif; ?>
    
    <?php if (!empty($error_msg)): ?>
    <div class="alert alert-danger"><?php echo $error_msg; ?></div>
    <?php endif; ?>
    
    <form method="post" action="">
        <div class="form-group">
            <label for="current_password">当前密码</label>
            <input type="password" id="current_password" name="current_password" required>
        </div>
        
        <div class="form-group">
            <label for="new_password">新密码</label>
            <input type="password" id="new_password" name="new_password" required>
            <small>密码长度至少为6个字符</small>
        </div>
        
        <div class="form-group">
            <label for="confirm_password">确认新密码</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        
        <div style="margin-top: 20px;">
            <button type="submit" class="btn btn-success">更新密码</button>
        </div>
    </form>
</div>

</div>
</body>
</html>