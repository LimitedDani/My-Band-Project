<link rel="stylesheet" href="css/admin.css">
<header>
    <nav class="nav has-shadow" role="navigation">
        <div class="container is-fluid">
            <div class="nav-left">
                <a class="nav-item brand">JA Community</a>
            </div>
            <span class="nav-toggle">

                    <span></span>
                <span></span>
                <span></span>
                </span>
            <ul class="nav-right nav-menu is-active">
                <li class="nav-item dropdown-toggle button-notify logout">
                    <a href="#" class=""><span class="lt" name="{$session.name}">{$session.name}</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="sidebar" class="panel sidebar" role="navigation">
        <ul>
            <li class="panel-item panel-highlight">
                <p class="panel-highlight-text">
                    <span class="subtitle is-6">Welcome</span>
                    <br>
                    <span class="title is-5">{$session.name}</span>
                </p>
            </li>
            <li class="panel-item">
                <a class="panel-title">
                    <span class="icon is-small"><i class="fa fa-dashboard"></i></span> Dashboard
                </a>
            </li>
            <li class="panel-item has-sub-panel">
                <a class="panel-title">
                    <span class="icon is-small"><i class="fa fa-thumb-tack"></i></span> Posts
                    <span class="icon is-small arrow"><i class="fa fa-angle-down"></i></span>
                </a>
                <ul class="sub-panel">
                    <li class="panel-item">
                        <a class="panel-title">All Posts</a>
                    </li>
                    <li class="panel-item">
                        <a class="panel-title">Add New</a>
                    </li>
                    <li class="panel-item">
                        <a class="panel-title">Categories</a>
                    </li>
                </ul>
            </li>
            <li class="panel-item">
                <a class="panel-title">
                    <span class="icon is-small"><i class="fa fa-user"></i></span> Users
                </a>
            </li>
        </ul>
    </div>
</header>
<main id="wrapper">
</main>
<script src="js/admin.js"></script>
</body>