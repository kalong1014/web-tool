<!-- //菜鸟乐园：https://www.zhclash.org/  https://www.cainiaoly.com/
//菜鸟乐园：互联网站长综合交流论坛，生活分享趣事平台，收集各路教程，主题插件，网站源码，主机测评，域名行情，原创开发等内容！
//持续更新中，欢迎关注！
//站点招收常驻欢迎来玩！ -->
<?php
require_once 'header.php';

// 处理删除请求
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM tools WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $success_msg = "工具已成功删除！";
    } else {
        $error_msg = "删除失败: " . $conn->error;
    }
}

// 处理状态切换
if (isset($_GET['toggle_status']) && is_numeric($_GET['toggle_status'])) {
    $id = $_GET['toggle_status'];
    $sql = "UPDATE tools SET status = 1 - status WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $success_msg = "工具状态已更新！";
    } else {
        $error_msg = "状态更新失败: " . $conn->error;
    }
}

// 分页
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 10;
$offset = ($page - 1) * $per_page;

// 搜索
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$search_condition = '';
if (!empty($search)) {
    $search_condition = "WHERE t.title LIKE '%$search%' OR t.description LIKE '%$search%' OR t.tool_id LIKE '%$search%'";
}

// 分类筛选
$category_filter = isset($_GET['category']) ? (int)$_GET['category'] : 0;
if ($category_filter > 0) {
    $search_condition = empty($search_condition) ? "WHERE t.category_id = $category_filter" : $search_condition . " AND t.category_id = $category_filter";
}

// 获取总记录数
$sql = "SELECT COUNT(*) as total FROM tools t $search_condition";
$result = $conn->query($sql);
$total_records = $result->fetch_assoc()['total'];
$total_pages = ceil($total_records / $per_page);

// 获取工具列表
$sql = "SELECT t.*, c.name as category_name 
        FROM tools t 
        LEFT JOIN categories c ON t.category_id = c.id 
        $search_condition
        ORDER BY t.id DESC 
        LIMIT $offset, $per_page";
$tools = $conn->query($sql);

// 获取所有分类
$sql = "SELECT * FROM categories ORDER BY name";
$categories = $conn->query($sql);
?>

<?php if (isset($success_msg)): ?>
<div class="alert alert-success"><?php echo $success_msg; ?></div>
<?php endif; ?>

<?php if (isset($error_msg)): ?>
<div class="alert alert-danger"><?php echo $error_msg; ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h2>工具管理</h2>
        <a href="tool_edit.php" class="btn btn-primary">添加新工具</a>
    </div>
    
    <div style="margin-bottom: 20px; display: flex; justify-content: space-between;">
        <form method="get" action="" style="display: flex; gap: 10px; flex-grow: 1; max-width: 600px;">
            <input type="text" name="search" placeholder="搜索工具..." value="<?php echo htmlspecialchars($search); ?>" style="flex-grow: 1;">
            <select name="category" style="width: 150px;">
                <option value="0">所有分类</option>
                <?php while ($category = $categories->fetch_assoc()): ?>
                <option value="<?php echo $category['id']; ?>" <?php echo $category_filter == $category['id'] ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($category['name']); ?>
                </option>
                <?php endwhile; ?>
            </select>
            <button type="submit" class="btn btn-primary">搜索</button>
            <?php if (!empty($search) || $category_filter > 0): ?>
            <a href="tools.php" class="btn btn-danger">清除</a>
            <?php endif; ?>
        </form>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>工具名称</th>
                <th>工具标识</th>
                <th>分类</th>
                <th>URL</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($tools->num_rows > 0): ?>
                <?php while ($tool = $tools->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $tool['id']; ?></td>
                    <td><?php echo htmlspecialchars($tool['title']); ?></td>
                    <td><?php echo htmlspecialchars($tool['tool_id']); ?></td>
                    <td><?php echo htmlspecialchars($tool['category_name'] ?? '未分类'); ?></td>
                    <td><?php echo htmlspecialchars($tool['url']); ?></td>
                    <td>
                        <?php if ($tool['status'] == 1): ?>
                            <span class="status-badge status-active">启用</span>
                        <?php else: ?>
                            <span class="status-badge status-inactive">禁用</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="tool_edit.php?id=<?php echo $tool['id']; ?>" class="btn btn-primary">编辑</a>
                        <a href="tools.php?toggle_status=<?php echo $tool['id']; ?>" class="btn btn-success" onclick="return confirm('确定要<?php echo $tool['status'] == 1 ? '禁用' : '启用'; ?>该工具吗？')">
                            <?php echo $tool['status'] == 1 ? '禁用' : '启用'; ?>
                        </a>
                        <a href="<?php echo '../' . $tool['url']; ?>" target="_blank" class="btn btn-primary">查看</a>
                        <a href="tools.php?delete=<?php echo $tool['id']; ?>" class="btn btn-danger" onclick="return confirm('确定要删除该工具吗？此操作不可恢复！')">删除</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align: center;">暂无工具</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <?php if ($total_pages > 1): ?>
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?><?php echo $category_filter > 0 ? '&category=' . $category_filter : ''; ?>">&laquo; 上一页</a>
        <?php endif; ?>
        
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <?php if ($i == $page): ?>
                <a href="#" class="active"><?php echo $i; ?></a>
            <?php else: ?>
                <a href="?page=<?php echo $i; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?><?php echo $category_filter > 0 ? '&category=' . $category_filter : ''; ?>"><?php echo $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>
        
        <?php if ($page < $total_pages): ?>
            <a href="?page=<?php echo $page + 1; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?><?php echo $category_filter > 0 ? '&category=' . $category_filter : ''; ?>">下一页 &raquo;</a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>

</div>
</body>
</html>