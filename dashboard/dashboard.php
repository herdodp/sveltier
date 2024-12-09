<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style type="text/css">
        /* Reset and base styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    color: #333;
    background-color: #f4f4f4;
}

/* Dashboard layout */
.dashboard {
    display: grid;
    grid-template-areas:
        "header header"
        "sidebar main";
    grid-template-columns: 200px 1fr;
    grid-template-rows: auto 1fr;
    min-height: 100vh;
}

/* Header styles */
.header {
    grid-area: header;
    background-color: #333;
    color: #fff;
    padding: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header h1 {
    font-size: 1.5rem;
}

.user-info {
    display: flex;
    align-items: center;
}

.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-left: 1rem;
}

/* Sidebar styles */
.sidebar {
    grid-area: sidebar;
    background-color: #2c3e50;
    color: #fff;
    padding: 1rem;
}

.sidebar ul {
    list-style-type: none;
}

.sidebar ul li {
    margin-bottom: 1rem;
}

.sidebar ul li a {
    color: #fff;
    text-decoration: none;
    display: flex;
    align-items: center;
}

.sidebar ul li a i {
    margin-right: 0.5rem;
}

/* Main content styles */
.main-content {
    grid-area: main;
    padding: 1rem;
    display: grid;
    gap: 1rem;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
}

.card {
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    padding: 1rem;
}

.card h2 {
    margin-bottom: 1rem;
    color: #2c3e50;
}

/* Stats styles */
.stats {
    display: flex;
    justify-content: space-between;
}

.stat-item {
    text-align: center;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: bold;
    color: #3498db;
}

.stat-label {
    font-size: 0.9rem;
    color: #7f8c8d;
}

/* Responsive design */
@media (max-width: 768px) {
    .dashboard {
        grid-template-areas:
            "header"
            "sidebar"
            "main";
        grid-template-columns: 1fr;
    }

    .sidebar {
        padding: 0.5rem;
    }

    .sidebar ul {
        display: flex;
        justify-content: space-between;
    }

    .sidebar ul li {
        margin-bottom: 0;
    }

    .sidebar ul li a {
        flex-direction: column;
        align-items: center;
        font-size: 0.8rem;
    }

    .sidebar ul li a i {
        margin-right: 0;
        margin-bottom: 0.25rem;
    }

    .main-content {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .header {
        flex-direction: column;
        align-items: flex-start;
    }

    .user-info {
        margin-top: 1rem;
    }

    .stats {
        flex-direction: column;
    }

    .stat-item {
        margin-bottom: 1rem;
    }
}


    </style>
</head>
<body>
    <div class="dashboard">
        <header class="header">
            <h1>Admin Dashboard</h1>
            <div class="user-info">
                <span>Welcome, Admin</span>
                <img src="/placeholder.svg?height=40&width=40" alt="Admin Avatar" class="avatar">
            </div>
        </header>
        <nav class="sidebar">
            <ul>
                <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="#"><i class="fas fa-chart-bar"></i> Analytics</a></li>
                <li><a href="#"><i class="fas fa-users"></i> Users</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
            </ul>
        </nav>
        <main class="main-content">
            <div class="card">
                <h2>Overview</h2>
                <p>Welcome to your admin dashboard. Here you can manage your website and view important statistics.</p>
            </div>
            <div class="card">
                <h2>Recent Activity</h2>
                <ul>
                    <li>User John Doe logged in</li>
                    <li>New post created: "Welcome to our site"</li>
                    <li>Comment approved on "Hello World"</li>
                </ul>
            </div>
            <div class="card">
                <h2>Quick Stats</h2>
                <div class="stats">
                    <div class="stat-item">
                        <span class="stat-value">1,234</span>
                        <span class="stat-label">Total Users</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">56</span>
                        <span class="stat-label">New Posts</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">789</span>
                        <span class="stat-label">Comments</span>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

