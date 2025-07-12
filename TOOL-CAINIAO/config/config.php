<!-- //菜鸟乐园：https://www.zhclash.org/  https://www.cainiaoly.com/
//菜鸟乐园：互联网站长综合交流论坛，生活分享趣事平台，收集各路教程，主题插件，网站源码，主机测评，域名行情，原创开发等内容！
//持续更新中，欢迎关注！
//站点招收常驻欢迎来玩！ -->
<?php
// 数据库配置
$db_host = 'localhost';
$db_user = 'cainiaoly_com';
$db_pass = '123456';
$db_name = 'cainiaoly_com';

// 创建数据库连接
$conn = new mysqli($db_host, $db_user, $db_pass);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 检查数据库是否存在，不存在则创建
$sql = "CREATE DATABASE IF NOT EXISTS $db_name DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if ($conn->query($sql) === TRUE) {
    // 选择数据库
    $conn->select_db($db_name);
    
    // 创建工具表
    $sql = "CREATE TABLE IF NOT EXISTS tools (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        tool_id VARCHAR(50) NOT NULL UNIQUE,
        title VARCHAR(100) NOT NULL,
        description TEXT,
        icon VARCHAR(255),
        url VARCHAR(255) NOT NULL,
        category_id INT(11),
        status TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $conn->query($sql);
    
    // 创建分类表
    $sql = "CREATE TABLE IF NOT EXISTS categories (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        category_id VARCHAR(50) NOT NULL UNIQUE,
        name VARCHAR(100) NOT NULL,
        description TEXT,
        status TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $conn->query($sql);
    
    // 创建管理员表
    $sql = "CREATE TABLE IF NOT EXISTS admins (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100),
        last_login TIMESTAMP,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->query($sql);
    
    // 创建设置表
    $sql = "CREATE TABLE IF NOT EXISTS settings (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        setting_key VARCHAR(50) NOT NULL UNIQUE,
        setting_value TEXT,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $conn->query($sql);
    
    // 检查是否有默认管理员，没有则创建
    $sql = "SELECT * FROM admins LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        // 创建默认管理员 admin/admin123
        $default_username = 'admin';
        $default_password = password_hash('admin123', PASSWORD_DEFAULT);
        $sql = "INSERT INTO admins (username, password) VALUES ('$default_username', '$default_password')";
        $conn->query($sql);
    }

    // 创建友情链接表
    $sql = "CREATE TABLE IF NOT EXISTS friend_links (
        id INT(11) NOT NULL AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        url VARCHAR(255) NOT NULL,
        description VARCHAR(255) DEFAULT '',
        sort_order INT(11) DEFAULT 0,
        status TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    if ($conn->query($sql) !== TRUE) {
        echo "创建友情链接表失败: " . $conn->error;
    }
    
    // 检查是否有默认分类，没有则创建
    $sql = "SELECT * FROM categories LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        // 创建默认分类
        $categories = [
            ['all', '全部', '所有工具'],
            ['network', '网络工具', '网络相关的工具集合'],
            ['info', '信息查询', '各类信息查询工具'],
            ['converter', '转换工具', '各种格式转换工具'],
            ['security', '安全工具', '安全相关的工具集合'],
            ['other', '其他工具', '未分类的其他工具']
        ];
        
        foreach ($categories as $category) {
            $cat_id = $category[0];
            $cat_name = $category[1];
            $cat_desc = $category[2];
            $sql = "INSERT INTO categories (category_id, name, description) VALUES ('$cat_id', '$cat_name', '$cat_desc')";
            $conn->query($sql);
        }
    }
    
    // 检查是否有默认设置，没有则创建
    $sql = "SELECT * FROM settings LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        // 创建默认设置
        $settings = [
            ['site_name', '在线工具箱'],
            ['site_description', '实用工具集合，提高工作效率'],
            ['site_keywords', '工具箱,在线工具,实用工具'],
            ['site_footer', '© ' . date('Y') . ' 在线工具箱 - 所有工具仅供学习和参考使用']
        ];
        
        foreach ($settings as $setting) {
            $key = $setting[0];
            $value = $setting[1];
            $sql = "INSERT INTO settings (setting_key, setting_value) VALUES ('$key', '$value')";
            $conn->query($sql);
        }
    }
} else {
    echo "创建数据库失败: " . $conn->error;
}

// 获取设置
function get_setting($key, $default = '') {
    global $conn;
    $sql = "SELECT setting_value FROM settings WHERE setting_key = '$key'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['setting_value'];
    }
    return $default;
}

// 更新设置
function update_setting($key, $value) {
    global $conn;
    $value = $conn->real_escape_string($value);
    $sql = "INSERT INTO settings (setting_key, setting_value) VALUES ('$key', '$value') 
            ON DUPLICATE KEY UPDATE setting_value = '$value'";
    return $conn->query($sql);
}

// 检查管理员登录状态
function is_admin_logged_in() {
    return isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']);
}

// 获取所有分类
function get_all_categories() {
    global $conn;
    $sql = "SELECT * FROM categories ORDER BY name";
    $result = $conn->query($sql);
    $categories = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
    return $categories;
}

// 获取所有工具
function get_all_tools() {
    global $conn;
    $sql = "SELECT t.*, c.name as category_name 
            FROM tools t 
            LEFT JOIN categories c ON t.category_id = c.id 
            ORDER BY t.title";
    $result = $conn->query($sql);
    $tools = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tools[] = $row;
        }
    }
    return $tools;
}
?>