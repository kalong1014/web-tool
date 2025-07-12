<!-- //菜鸟乐园：https://www.zhclash.org/  https://www.cainiaoly.com/
//菜鸟乐园：互联网站长综合交流论坛，生活分享趣事平台，收集各路教程，主题插件，网站源码，主机测评，域名行情，原创开发等内容！
//持续更新中，欢迎关注！
//站点招收常驻欢迎来玩！ -->
<?php
require_once 'header.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$tool = null;

// 如果是编辑模式，获取工具信息
if ($id > 0) {
    $sql = "SELECT * FROM tools WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $tool = $result->fetch_assoc();
    } else {
        $error_msg = "未找到指定的工具！";
    }
}

// 处理表单提交
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tool_id = $conn->real_escape_string($_POST['tool_id']);
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $icon = $conn->real_escape_string($_POST['icon']);
    $url = $conn->real_escape_string($_POST['url']);
    $category_id = (int)$_POST['category_id'];
    $status = isset($_POST['status']) ? 1 : 0;
    
    // 验证必填字段
    if (empty($tool_id) || empty($title) || empty($url)) {
        $error_msg = "工具标识、名称和URL不能为空！";
    } else {
        if ($id > 0) {
            // 更新工具
            $sql = "UPDATE tools SET 
                    tool_id = '$tool_id', 
                    title = '$title', 
                    description = '$description', 
                    icon = '$icon', 
                    url = '$url', 
                    category_id = $category_id, 
                    status = $status 
                    WHERE id = $id";
            
            if ($conn->query($sql) === TRUE) {
                $success_msg = "工具更新成功！";
                // 重新获取工具信息
                $sql = "SELECT * FROM tools WHERE id = $id";
                $result = $conn->query($sql);
                $tool = $result->fetch_assoc();
            } else {
                $error_msg = "更新失败: " . $conn->error;
            }
        } else {
            // 检查工具标识是否已存在
            $sql = "SELECT id FROM tools WHERE tool_id = '$tool_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $error_msg = "工具标识 '$tool_id' 已存在，请使用其他标识！";
            } else {
                // 添加新工具
                $sql = "INSERT INTO tools (tool_id, title, description, icon, url, category_id, status) 
                        VALUES ('$tool_id', '$title', '$description', '$icon', '$url', $category_id, $status)";
                
                if ($conn->query($sql) === TRUE) {
                    $new_id = $conn->insert_id;
                    $success_msg = "工具添加成功！";
                    // 重定向到编辑页面
                    header("Location: tool_edit.php?id=$new_id&success=1");
                    exit;
                } else {
                    $error_msg = "添加失败: " . $conn->error;
                }
            }
        }
    }
}

// 获取所有分类
$sql = "SELECT * FROM categories ORDER BY name";
$categories = $conn->query($sql);

// 如果是从添加成功后重定向过来的
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $success_msg = "工具添加成功！";
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
        <h2><?php echo $id > 0 ? '编辑工具' : '添加新工具'; ?></h2>
        <a href="tools.php" class="btn btn-primary">返回工具列表</a>
    </div>
    
    <form method="post" action="">
        <div class="form-group">
            <label for="tool_id">工具标识 <span style="color: red;">*</span></label>
            <input type="text" id="tool_id" name="tool_id" value="<?php echo isset($tool['tool_id']) ? htmlspecialchars($tool['tool_id']) : ''; ?>" required <?php echo $id > 0 ? 'readonly' : ''; ?>>
            <small>唯一标识符，只能包含字母、数字和下划线，一旦创建不可修改</small>
        </div>
        
        <div class="form-group">
            <label for="title">工具名称 <span style="color: red;">*</span></label>
            <input type="text" id="title" name="title" value="<?php echo isset($tool['title']) ? htmlspecialchars($tool['title']) : ''; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="description">工具描述</label>
            <textarea id="description" name="description"><?php echo isset($tool['description']) ? htmlspecialchars($tool['description']) : ''; ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="icon">图标URL</label>
            <input type="text" id="icon" name="icon" value="<?php echo isset($tool['icon']) ? htmlspecialchars($tool['icon']) : 'https://cdn-icons-png.flaticon.com/128/2541/2541988.png'; ?>">
            <small>工具图标的URL地址，建议使用正方形图标</small>
        </div>
        
        <div class="form-group">
            <label for="url">工具URL <span style="color: red;">*</span></label>
            <input type="text" id="url" name="url" value="<?php echo isset($tool['url']) ? htmlspecialchars($tool['url']) : ''; ?>" required>
            <small>工具的访问路径，例如：goju/tool.php</small>
        </div>
        
        <div class="form-group">
            <label for="category_id">所属分类</label>
            <select id="category_id" name="category_id">
                <option value="0">-- 选择分类 --</option>
                <?php while ($category = $categories->fetch_assoc()): ?>
                <option value="<?php echo $category['id']; ?>" <?php echo isset($tool['category_id']) && $tool['category_id'] == $category['id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($category['name']); ?>
                </option>
                <?php endwhile; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label>
                <input type="checkbox" name="status" value="1" <?php echo !isset($tool['status']) || $tool['status'] == 1 ? 'checked' : ''; ?>> 启用工具
            </label>
        </div>
        
        <div style="margin-top: 20px;">
            <button type="submit" class="btn btn-success"><?php echo $id > 0 ? '更新工具' : '添加工具'; ?></button>
            <a href="tools.php" class="btn btn-danger" style="margin-left: 10px;">取消</a>
        </div>
    </form>
</div>

</div>
</body>
</html>