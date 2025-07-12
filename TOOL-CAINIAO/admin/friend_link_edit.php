<!-- //菜鸟乐园：https://www.zhclash.org/  https://www.cainiaoly.com/
//菜鸟乐园：互联网站长综合交流论坛，生活分享趣事平台，收集各路教程，主题插件，网站源码，主机测评，域名行情，原创开发等内容！
//持续更新中，欢迎关注！
//站点招收常驻欢迎来玩！ -->
<?php
require_once 'header.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$link = null;

// 如果是编辑模式，获取友情链接信息
if ($id > 0) {
    $sql = "SELECT * FROM friend_links WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $link = $result->fetch_assoc();
    } else {
        $error_msg = "未找到指定的友情链接！";
    }
}

// 处理表单提交
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $url = $conn->real_escape_string($_POST['url']);
    $description = $conn->real_escape_string($_POST['description']);
    $sort_order = (int)$_POST['sort_order'];
    $status = isset($_POST['status']) ? 1 : 0;
    
    // 验证必填字段
    if (empty($name) || empty($url)) {
        $error_msg = "名称和URL不能为空！";
    } else {
        if ($id > 0) {
            // 更新友情链接
            $sql = "UPDATE friend_links SET 
                    name = '$name', 
                    url = '$url', 
                    description = '$description', 
                    sort_order = $sort_order, 
                    status = $status 
                    WHERE id = $id";
            
            if ($conn->query($sql) === TRUE) {
                $success_msg = "友情链接更新成功！";
                // 重新获取友情链接信息
                $sql = "SELECT * FROM friend_links WHERE id = $id";
                $result = $conn->query($sql);
                $link = $result->fetch_assoc();
            } else {
                $error_msg = "更新失败: " . $conn->error;
            }
        } else {
            // 添加新友情链接
            $sql = "INSERT INTO friend_links (name, url, description, sort_order, status) 
                    VALUES ('$name', '$url', '$description', $sort_order, $status)";
            
            if ($conn->query($sql) === TRUE) {
                $new_id = $conn->insert_id;
                $success_msg = "友情链接添加成功！";
                // 重定向到编辑页面
                echo "<script>window.location.href = 'friend_link_edit.php?id=$new_id&success=1';</script>";
                exit;
            } else {
                $error_msg = "添加失败: " . $conn->error;
            }
        }
    }
}

// 如果是从添加成功后重定向过来的
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $success_msg = "友情链接添加成功！";
}
?>

<?php if (isset($success_msg)): ?>
<div class="alert alert-success"><?php echo $success_msg; ?></div>
<?php endif; ?>

<?php if (isset($error_msg)): ?>
<div class="alert alert-danger"><?php echo $error_msg; ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h2><?php echo $id > 0 ? '编辑友情链接' : '添加友情链接'; ?></h2>
        <a href="friend_links.php" class="btn btn-primary">返回友情链接列表</a>
    </div>
    
    <form method="post" action="">
        <div class="form-group">
            <label for="name">名称 <span style="color: red;">*</span></label>
            <input type="text" id="name" name="name" value="<?php echo isset($link['name']) ? htmlspecialchars($link['name']) : ''; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="url">URL <span style="color: red;">*</span></label>
            <input type="url" id="url" name="url" value="<?php echo isset($link['url']) ? htmlspecialchars($link['url']) : 'https://'; ?>" required>
            <small>请输入完整的URL，包括http://或https://</small>
        </div>
        
        <div class="form-group">
            <label for="description">描述</label>
            <textarea id="description" name="description"><?php echo isset($link['description']) ? htmlspecialchars($link['description']) : ''; ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="sort_order">排序</label>
            <input type="number" id="sort_order" name="sort_order" value="<?php echo isset($link['sort_order']) ? (int)$link['sort_order'] : 0; ?>" min="0">
            <small>数字越小排序越靠前</small>
        </div>
        
        <div class="form-group">
            <label>
                <input type="checkbox" name="status" value="1" <?php echo !isset($link['status']) || $link['status'] == 1 ? 'checked' : ''; ?>> 显示链接
            </label>
        </div>
        
        <div style="margin-top: 20px;">
            <button type="submit" class="btn btn-success"><?php echo $id > 0 ? '更新友情链接' : '添加友情链接'; ?></button>
            <a href="friend_links.php" class="btn btn-danger" style="margin-left: 10px;">取消</a>
        </div>
    </form>
</div>

</div>
</body>
</html>