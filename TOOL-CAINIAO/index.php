<!-- //菜鸟乐园：https://www.zhclash.org/  https://www.cainiaoly.com/
//菜鸟乐园：互联网站长综合交流论坛，生活分享趣事平台，收集各路教程，主题插件，网站源码，主机测评，域名行情，原创开发等内容！
//持续更新中，欢迎关注！
//站点招收常驻欢迎来玩！ -->

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once 'config/config.php';
    $site_name = get_setting('site_name', '在线工具箱');
    $site_description = get_setting('site_description', '实用工具集合，提高工作效率');
    $site_keywords = get_setting('site_keywords', '工具箱,在线工具,实用工具');
    ?>
    <title><?php echo htmlspecialchars($site_name); ?> - <?php echo htmlspecialchars($site_description); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($site_description); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($site_keywords); ?>">
    <style>
        body {
            font-family: 'Microsoft YaHei', Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .subtitle {
            color: #7f8c8d;
            font-size: 18px;
        }
        .tools-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .tool-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .tool-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .tool-icon {
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            border-bottom: 1px solid #eee;
        }
        .tool-icon img {
            max-width: 60px;
            max-height: 60px;
        }
        .tool-icon i {
            font-size: 48px;
            color: #3498db;
        }
        .tool-content {
            padding: 15px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .tool-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #2c3e50;
        }
        .tool-description {
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 15px;
            flex-grow: 1;
        }
        .tool-link {
            display: inline-block;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 4px;
            text-align: center;
            transition: background-color 0.3s;
            font-weight: bold;
            margin-top: auto;
        }
        .tool-link:hover {
            background-color: #2980b9;
        }
        .categories {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }
        .category-btn {
            background-color: #f1f1f1;
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 14px;
        }
        .category-btn:hover, .category-btn.active {
            background-color: #3498db;
            color: white;
        }
        .search-container {
            margin-bottom: 20px;
        }
        .search-input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #7f8c8d;
            font-size: 14px;
        }
        .no-tools {
            text-align: center;
            padding: 30px;
            color: #7f8c8d;
            font-size: 16px;
            grid-column: 1 / -1;
        }
        .admin-link {
            text-align: center;
            margin-top: 10px;
        }
        .admin-link a {
            color: #7f8c8d;
            text-decoration: none;
            font-size: 14px;
        }
        .admin-link a:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .tools-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }
        @media (max-width: 480px) {
            .tools-grid {
                grid-template-columns: 1fr;
            }
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #7f8c8d;
            font-size: 14px;
        }
        .no-tools {
            text-align: center;
            padding: 30px;
            color: #7f8c8d;
            font-size: 16px;
            grid-column: 1 / -1;
        }
        .admin-link {
            text-align: center;
            margin-top: 10px;
        }
        .admin-link a {
            color: #7f8c8d;
            text-decoration: none;
            font-size: 14px;
        }
        .admin-link a:hover {
            text-decoration: underline;
        }
        
        /* 美化版权信息和友情链接 */
        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        .copyright {
            font-size: 14px;
            color: #7f8c8d;
            padding: 10px 0;
        }
        .friend-links {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 15px 0;
            border-top: 1px solid #eee;
        }
        .friend-links h3 {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 15px;
            text-align: center;
        }
        .links-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }
        .link-item {
            color: #3498db;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .link-item:hover {
            background-color: #f1f1f1;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1><?php echo htmlspecialchars($site_name); ?></h1>
            <div class="subtitle"><?php echo htmlspecialchars($site_description); ?></div>
        </header>
        
        <div class="search-container">
            <input type="text" class="search-input" id="searchInput" placeholder="搜索工具...">
        </div>
        
        <div class="categories">
            <?php
            // 获取所有启用的分类
            $sql = "SELECT * FROM categories WHERE status = 1 ORDER BY name";
            $categories = $conn->query($sql);
            
            // 输出分类按钮
            if ($categories->num_rows > 0) {
                echo '<button class="category-btn active" data-category="all">全部</button>';
                while ($category = $categories->fetch_assoc()) {
                    echo '<button class="category-btn" data-category="' . htmlspecialchars($category['category_id']) . '">' . htmlspecialchars($category['name']) . '</button>';
                }
            }
            ?>
        </div>
        
        <div class="tools-grid" id="toolsGrid">
            <?php
            // 获取所有启用的工具
            $sql = "SELECT t.*, c.category_id as category_code 
                    FROM tools t 
                    LEFT JOIN categories c ON t.category_id = c.id 
                    WHERE t.status = 1 
                    ORDER BY t.title";
            $tools = $conn->query($sql);
            
            // 输出工具卡片
            if ($tools->num_rows > 0) {
                while ($tool = $tools->fetch_assoc()) {
                    echo '<div class="tool-card" data-category="' . htmlspecialchars($tool['category_code'] ?? 'other') . '">';
                    echo '<div class="tool-icon">';
                    echo '<img src="' . htmlspecialchars($tool['icon']) . '" alt="' . htmlspecialchars($tool['title']) . '">';
                    echo '</div>';
                    echo '<div class="tool-content">';
                    echo '<div class="tool-title">' . htmlspecialchars($tool['title']) . '</div>';
                    echo '<div class="tool-description">' . htmlspecialchars($tool['description']) . '</div>';
                    echo '<a href="' . htmlspecialchars($tool['url']) . '" class="tool-link">立即使用</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="no-tools">暂无可用工具</div>';
            }
            ?>
        </div>
        
        <div class="footer">
            <div class="footer-content">
                <?php
                // 获取友情链接
                $sql = "SELECT * FROM friend_links WHERE status = 1 ORDER BY sort_order, id";
                $links = $conn->query($sql);
                
                if ($links && $links->num_rows > 0): 
                ?>
                <div class="friend-links">
                    <h3>友情链接</h3>
                    <div class="links-container">
                        <?php while ($link = $links->fetch_assoc()): ?>
                            <a href="<?php echo htmlspecialchars($link['url']); ?>" target="_blank" class="link-item" title="<?php echo htmlspecialchars($link['description']); ?>">
                                <?php echo htmlspecialchars($link['name']); ?>
                            </a>
                        <?php endwhile; ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <div class="copyright">
                    <?php echo get_setting('site_footer', '© ' . date('Y') . ' 在线工具箱 - 所有工具仅供学习和参考使用'); ?>
                </div>
                
                <div class="admin-link">
                    <a href="admin/login.php">管理后台</a>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const toolsGrid = document.getElementById('toolsGrid');
        const categoryButtons = document.querySelectorAll('.category-btn');
        const toolCards = document.querySelectorAll('.tool-card');
        
        // 搜索功能
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            filterTools();
        });
        
        // 分类筛选
        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                // 移除所有按钮的active类
                categoryButtons.forEach(btn => btn.classList.remove('active'));
                // 为当前按钮添加active类
                this.classList.add('active');
                
                filterTools();
            });
        });
        
        // 工具筛选函数
        function filterTools() {
            const searchTerm = searchInput.value.toLowerCase();
            const activeCategory = document.querySelector('.category-btn.active').getAttribute('data-category');
            
            let visibleCount = 0;
            
            toolCards.forEach(card => {
                const title = card.querySelector('.tool-title').textContent.toLowerCase();
                const description = card.querySelector('.tool-description').textContent.toLowerCase();
                const category = card.getAttribute('data-category');
                
                // 检查搜索词和分类
                const matchesSearch = title.includes(searchTerm) || description.includes(searchTerm);
                const matchesCategory = activeCategory === 'all' || category === activeCategory;
                
                if (matchesSearch && matchesCategory) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // 如果没有匹配的工具，显示提示信息
            let noToolsMsg = document.querySelector('.no-tools');
            if (visibleCount === 0) {
                if (!noToolsMsg) {
                    noToolsMsg = document.createElement('div');
                    noToolsMsg.className = 'no-tools';
                    noToolsMsg.textContent = '没有找到匹配的工具';
                    toolsGrid.appendChild(noToolsMsg);
                }
                noToolsMsg.style.display = 'block';
            } else if (noToolsMsg) {
                noToolsMsg.style.display = 'none';
            }
        }
    });
    </script>
</body>
</html>