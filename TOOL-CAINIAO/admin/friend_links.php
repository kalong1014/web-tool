<!-- //菜鸟乐园：https://www.zhclash.org/  https://www.cainiaoly.com/
//菜鸟乐园：互联网站长综合交流论坛，生活分享趣事平台，收集各路教程，主题插件，网站源码，主机测评，域名行情，原创开发等内容！
//持续更新中，欢迎关注！
//站点招收常驻欢迎来玩！ -->
<?php
require_once 'header.php';

// 处理删除请求
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM friend_links WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $success_msg = "友情链接已成功删除！";
    } else {
        $error_msg = "删除失败: " . $conn->error;
    }
}

// 处理状态切换
if (isset($_GET['toggle_status']) && is_numeric($_GET['toggle_status'])) {
    $id = $_GET['toggle_status'];
    $sql = "UPDATE friend_links SET status = 1 - status WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $success_msg = "友情链接状态已更新！";
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
    $search_condition = "WHERE name LIKE '%$search%' OR url LIKE '%$search%' OR description LIKE '%$search%'";
}

// 获取总记录数
$sql = "SELECT COUNT(*) as total FROM friend_links $search_condition";
$result = $conn->query($sql);
$total_records = $result->fetch_assoc()['total'];
$total_pages = ceil($total_records / $per_page);

// 获取友情链接列表
$sql = "SELECT * FROM friend_links $search_condition ORDER BY sort_order, id DESC LIMIT $offset, $per_page";
$links = $conn->query($sql);
?>

<?php if (isset($success_msg)): ?>
<div class="alert alert-success"><?php echo $success_msg; ?></div>
<?php endif; ?>

<?php if (isset($error_msg)): ?>
<div class="alert alert-danger"><?php echo $error_msg; ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h2>友情链接管理</h2>
        <a href="friend_link_edit.php" class="btn btn-primary">添加友情链接</a>
    </div>
    
    <div style="margin-bottom: 20px;">
        <form method="get" action="" style="display: flex; gap: 10px; max-width: 500px;">
            <input type="text" name="search" placeholder="搜索链接..." value="<?php echo htmlspecialchars($search); ?>" style="flex-grow: 1;">
            <button type="submit" class="btn btn-primary">搜索</button>
            <?php if (!empty($search)): ?>
            <a href="friend_links.php" class="btn btn-danger">清除</a>
            <?php endif; ?>
        </form>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>名称</th>
                <th>URL</th>
                <th>描述</th>
                <th>排序</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($links->num_rows > 0): ?>
                <?php while ($link = $links->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $link['id']; ?></td>
                    <td><?php echo htmlspecialchars($link['name']); ?></td>
                    <td><a href="<?php echo htmlspecialchars($link['url']); ?>" target="_blank"><?php echo htmlspecialchars($link['url']); ?></a></td>
                    <td><?php echo htmlspecialchars($link['description']); ?></td>
                    <td><?php echo $link['sort_order']; ?></td>
                    <td>
                        <?php if ($link['status'] == 1): ?>
                            <span class="status-badge status-active">显示</span>
                        <?php else: ?>
                            <span class="status-badge status-inactive">隐藏</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="friend_link_edit.php?id=<?php echo $link['id']; ?>" class="btn btn-primary">编辑</a>
                        <a href="friend_links.php?toggle_status=<?php echo $link['id']; ?>" class="btn btn-success" onclick="return confirm('确定要<?php echo $link['status'] == 1 ? '隐藏' : '显示'; ?>该友情链接吗？')">
                            <?php echo $link['status'] == 1 ? '隐藏' : '显示'; ?>
                        </a>
                        <a href="friend_links.php?delete=<?php echo $link['id']; ?>" class="btn btn-danger" onclick="return confirm('确定要删除该友情链接吗？此操作不可恢复！')">删除</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align: center;">暂无友情链接</td>
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