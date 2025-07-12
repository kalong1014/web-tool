<!-- //菜鸟乐园：https://www.zhclash.org/  https://www.cainiaoly.com/
//菜鸟乐园：互联网站长综合交流论坛，生活分享趣事平台，收集各路教程，主题插件，网站源码，主机测评，域名行情，原创开发等内容！
//持续更新中，欢迎关注！
//站点招收常驻欢迎来玩！ -->
<?php
session_start();
require_once '../config/config.php';

// 检查是否登录
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

// 获取当前页面
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>后台管理 - 在线工具箱</title>
    <style>
        body {
            font-family: 'Microsoft YaHei', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding-top: 20px;
            flex-shrink: 0;
        }
        .sidebar-header {
            padding: 0 20px 20px 20px;
            border-bottom: 1px solid #34495e;
            margin-bottom: 20px;
        }
        .sidebar-header h2 {
            margin: 0;
            font-size: 20px;
        }
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar-menu li {
            margin-bottom: 5px;
        }
        .sidebar-menu a {
            display: block;
            padding: 12px 20px;
            color: #ecf0f1;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background-color: #34495e;
        }
        .sidebar-menu a.active {
            border-left: 4px solid #3498db;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #2c3e50;
        }
        .user-info {
            display: flex;
            align-items: center;
        }
        .user-info span {
            margin-right: 15px;
        }
        .logout-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            font-size: 14px;
        }
        .logout-btn:hover {
            background-color: #c0392b;
        }
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .card-header h2 {
            margin: 0;
            color: #2c3e50;
        }
        .btn {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        .btn-primary {
            background-color: #3498db;
            color: white;
            border: none;
        }
        .btn-primary:hover {
            background-color: #2980b9;
        }
        .btn-success {
            background-color: #2ecc71;
            color: white;
            border: none;
        }
        .btn-success:hover {
            background-color: #27ae60;
        }
        .btn-danger {
            background-color: #e74c3c;
            color: white;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c0392b;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        .table th {
            background-color: #f9f9f9;
            font-weight: bold;
            color: #333;
        }
        .table tr:hover {
            background-color: #f5f5f5;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="url"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        textarea {
            min-height: 100px;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
        }
        .status-active {
            background-color: #d4edda;
            color: #155724;
        }
        .status-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination a {
            display: inline-block;
            padding: 8px 12px;
            margin: 0 5px;
            border-radius: 4px;
            background-color: #f1f1f1;
            color: #333;
            text-decoration: none;
        }
        .pagination a.active {
            background-color: #3498db;
            color: white;
        }
        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
        .sidebar-footer {
            padding: 15px 20px;
            text-align: center;
            font-size: 12px;
            color: #95a5a6;
            border-top: 1px solid #34495e;
            margin-top: 30px;
        }
        .sidebar-footer p {
            margin: 5px 0;
        } 
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>工具箱管理系统</h2>
        </div>
        <ul class="sidebar-menu">
            <li><a href="index.php" <?php echo $current_page == 'index.php' ? 'class="active"' : ''; ?>>控制面板</a></li>
            <li><a href="tools.php" <?php echo $current_page == 'tools.php' || $current_page == 'tool_edit.php' ? 'class="active"' : ''; ?>>工具管理</a></li>
            <li><a href="categories.php" <?php echo $current_page == 'categories.php' || $current_page == 'category_edit.php' ? 'class="active"' : ''; ?>>分类管理</a></li>
            <li><a href="scan_tools.php" <?php echo $current_page == 'scan_tools.php' ? 'class="active"' : ''; ?>>新应用获取</a></li>
            <li><a href="friend_links.php" <?php echo $current_page == 'friend_links.php' || $current_page == 'friend_link_edit.php' ? 'class="active"' : ''; ?>>友情链接</a></li>
            <li><a href="settings.php" <?php echo $current_page == 'settings.php' ? 'class="active"' : ''; ?>>站点设置</a></li>
            <li><a href="change_password.php" <?php echo $current_page == 'change_password.php' ? 'class="active"' : ''; ?>>修改密码</a></li>
            <li><a href="../index.php" target="_blank">访问前台</a></li>
        </ul>
        <div class="sidebar-footer">
            <p>©Copyright <?php echo date('Y'); ?> 管理后台</p>
            <p><a href="https://www.zhclash.org/" target="_blank">菜鸟乐园</a></p>
        </div>
    </div>
    
    <div class="main-content">
        <div class="header">
            <h1>
                <?php 
                switch ($current_page) {
                    case 'index.php':
                        echo '控制面板';
                        break;
                    case 'tools.php':
                        echo '工具管理';
                        break;
                    case 'tool_edit.php':
                        echo isset($_GET['id']) ? '编辑工具' : '添加工具';
                        break;
                    case 'categories.php':
                        echo '分类管理';
                        break;
                    case 'category_edit.php':
                        echo isset($_GET['id']) ? '编辑分类' : '添加分类';
                        break;
                    case 'scan_tools.php':
                        echo '新应用获取';
                        break;
                    case 'settings.php':
                        echo '站点设置';
                        break;
                    default:
                        echo '后台管理';
                }
                ?>
            </h1>
            <div class="user-info">
                <span>欢迎，<?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                <a href="logout.php" class="logout-btn">退出登录</a>
            </div>
        </div>