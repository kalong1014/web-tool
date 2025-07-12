
<!-- //菜鸟乐园：https://www.zhclash.org/  https://www.cainiaoly.com/
//菜鸟乐园：互联网站长综合交流论坛，生活分享趣事平台，收集各路教程，主题插件，网站源码，主机测评，域名行情，原创开发等内容！
//持续更新中，欢迎关注！
//站点招收常驻欢迎来玩！ -->
<?php
require_once 'header.php';

// 处理删除请求
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // 检查是否有工具使用此分类
    $sql = "SELECT COUNT(*) as count FROM tools WHERE category_id = $id";
    $result = $conn->query($sql);
    $count = $result->fetch_assoc()['count'];
    
    if ($count > 0) {
        $error_msg = "无法删除该分类，因为有 $count 个工具正在使用它！";
    } else {
        $sql = "DELETE FROM categories WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            $success_msg = "分类已成功删除！";
        } else {
            $error_msg = "删除失败: " . $conn->error;
        }
    }
}

// 处理状态切换
if (isset($_GET['toggle_status']) && is_numeric($_GET['toggle_status'])) {
    $id = $_GET['toggle_status'];
    $sql = "UPDATE categories SET status = 1 - status WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $success_msg = "分类状态已更新！";
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
    $search_condition = "WHERE name LIKE '%$search%' OR description LIKE '%$search%' OR category_id LIKE '%$search%'";
}

// 获取总记录数
$sql = "SELECT COUNT(*) as total FROM categories $search_condition";
$result = $conn->query($sql);
$total_records = $result->fetch_assoc()['total'];
$total_pages = ceil($total_records / $per_page);

// 获取分类列表
$sql = "SELECT c.*, (SELECT COUNT(*) FROM tools WHERE category_id = c.id) as tool_count 
        FROM categories c 
        $search_condition
        ORDER BY c.id DESC 
        LIMIT $offset, $per_page";
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
        <h2>分类管理</h2>
        <a href="category_edit.php" class="btn btn-primary">添加新分类</a>
    </div>
    
    <div style="margin-bottom: 20px;">
        <form method="get" action="" style="display: flex; gap: 10px; max-width: 500px;">
            <input type="text" name="search" placeholder="搜索分类..." value="<?php echo htmlspecialchars($search); ?>" style="flex-grow: 1;">
            <button type="submit" class="btn btn-primary">搜索</button>
            <?php if (!empty($search)): ?>
            <a href="categories.php" class="btn btn-danger">清除</a>
            <?php endif; ?>
        </form>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>分类名称</th>
                <th>分类标识</th>
                <th>描述</th>
                <th>工具数量</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($categories->num_rows > 0): ?>
                <?php while ($category = $categories->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $category['id']; ?></td>
                    <td><?php echo htmlspecialchars($category['name']); ?></td>
                    <td><?php echo htmlspecialchars($category['category_id']); ?></td>
                    <td><?php echo htmlspecialchars($category['description']); ?></td>
                    <td><?php echo $category['tool_count']; ?></td>
                    <td>
                        <?php if ($category['status'] == 1): ?>
                            <span class="status-badge status-active">启用</span>
                        <?php else: ?>
                            <span class="status-badge status-inactive">禁用</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="category_edit.php?id=<?php echo $category['id']; ?>" class="btn btn-primary">编辑</a>
                        <a href="categories.php?toggle_status=<?php echo $category['id']; ?>" class="btn btn-success" onclick="return confirm('确定要<?php echo $category['status'] == 1 ? '禁用' : '启用'; ?>该分类吗？')">
                            <?php echo $category['status'] == 1 ? '禁用' : '启用'; ?>
                        </a>
                        <a href="categories.php?delete=<?php echo $category['id']; ?>" class="btn btn-danger" onclick="return confirm('确定要删除该分类吗？此操作不可恢复！<?php echo $category['tool_count'] > 0 ? '\n注意：该分类下有 ' . $category['tool_count'] . ' 个工具，需要先移除这些工具才能删除分类。' : ''; ?>')">删除</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align: center;">暂无分类</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <?php if ($total_pages > 1): ?>
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>">&laquo; 上一页</a>
        <?php endif; ?>
        
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <?php if ($i == $page): ?>
                <a href="#" class="active"><?php echo $i; ?></a>
            <?php else: ?>
                <a href="?page=<?php echo $i; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>"><?php echo $i; ?></a>
            <?php endif; ?>
        <?php endfor; ?>
        
        <?php if ($page < $total_pages): ?>
            <a href="?page=<?php echo $page + 1; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>">下一页 &raquo;</a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>

</div>
</body>
</html>