<!-- //菜鸟乐园：https://www.zhclash.org/  https://www.cainiaoly.com/
//菜鸟乐园：互联网站长综合交流论坛，生活分享趣事平台，收集各路教程，主题插件，网站源码，主机测评，域名行情，原创开发等内容！
//持续更新中，欢迎关注！
//站点招收常驻欢迎来玩！ -->
<?php
require_once 'header.php';

// 获取统计数据
$sql = "SELECT COUNT(*) as total FROM tools";
$result = $conn->query($sql);
$tools_count = $result->fetch_assoc()['total'];

$sql = "SELECT COUNT(*) as total FROM categories";
$result = $conn->query($sql);
$categories_count = $result->fetch_assoc()['total'];

// 获取最近添加的工具
$sql = "SELECT t.*, c.name as category_name 
        FROM tools t 
        LEFT JOIN categories c ON t.category_id = c.id 
        ORDER BY t.created_at DESC LIMIT 5";
$recent_tools = $conn->query($sql);

// 获取最近的操作日志（如果有日志表的话）
?>

<div class="card">
    <div class="card-header">
        <h2>系统概览</h2>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
        <div style="background-color: #3498db; color: white; padding: 20px; border-radius: 8px;">
            <h3 style="margin-top: 0;">工具总数</h3>
            <p style="font-size: 24px; font-weight: bold; margin-bottom: 0;"><?php echo $tools_count; ?></p>
        </div>
        <div style="background-color: #2ecc71; color: white; padding: 20px; border-radius: 8px;">
            <h3 style="margin-top: 0;">分类总数</h3>
            <p style="font-size: 24px; font-weight: bold; margin-bottom: 0;"><?php echo $categories_count; ?></p>
        </div>
        <div style="background-color: #e74c3c; color: white; padding: 20px; border-radius: 8px;">
            <h3 style="margin-top: 0;">今日访问</h3>
            <p style="font-size: 24px; font-weight: bold; margin-bottom: 0;">--</p>
        </div>
        <div style="background-color: #f39c12; color: white; padding: 20px; border-radius: 8px;">
            <h3 style="margin-top: 0;">总访问量</h3>
            <p style="font-size: 24px; font-weight: bold; margin-bottom: 0;">--</p>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2>最近添加的工具</h2>
        <a href="tools.php" class="btn btn-primary">查看所有工具</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>工具名称</th>
                <th>分类</th>
                <th>状态</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($recent_tools->num_rows > 0): ?>
                <?php while ($tool = $recent_tools->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $tool['id']; ?></td>
                    <td><?php echo htmlspecialchars($tool['title']); ?></td>
                    <td><?php echo htmlspecialchars($tool['category_name'] ?? '未分类'); ?></td>
                    <td>
                        <?php if ($tool['status'] == 1): ?>
                            <span class="status-badge status-active">启用</span>
                        <?php else: ?>
                            <span class="status-badge status-inactive">禁用</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo date('Y-m-d H:i', strtotime($tool['created_at'])); ?></td>
                    <td>
                        <a href="tool_edit.php?id=<?php echo $tool['id']; ?>" class="btn btn-primary">编辑</a>
                        <a href="<?php echo $tool['url']; ?>" target="_blank" class="btn btn-success">查看</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">暂无工具</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="card">
    <div class="card-header">
        <h2>快捷操作</h2>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px;">
        <a href="tool_edit.php" style="text-decoration: none;">
            <div style="background-color: #f1f1f1; padding: 20px; border-radius: 8px; text-align: center;">
                <div style="font-size: 24px; margin-bottom: 10px;">➕</div>
                <div style="font-weight: bold; color: #333;">添加新工具</div>
            </div>
        </a>
        <a href="category_edit.php" style="text-decoration: none;">
            <div style="background-color: #f1f1f1; padding: 20px; border-radius: 8px; text-align: center;">
                <div style="font-size: 24px; margin-bottom: 10px;">📁</div>
                <div style="font-weight: bold; color: #333;">添加新分类</div>
            </div>
        </a>
        <a href="scan_tools.php" style="text-decoration: none;">
            <div style="background-color: #f1f1f1; padding: 20px; border-radius: 8px; text-align: center;">
                <div style="font-size: 24px; margin-bottom: 10px;">🔍</div>
                <div style="font-weight: bold; color: #333;">扫描新应用</div>
            </div>
        </a>
        <a href="settings.php" style="text-decoration: none;">
            <div style="background-color: #f1f1f1; padding: 20px; border-radius: 8px; text-align: center;">
                <div style="font-size: 24px; margin-bottom: 10px;">⚙️</div>
                <div style="font-weight: bold; color: #333;">站点设置</div>
            </div>
        </a>
    </div>
</div>

</div>
</body>
</html>