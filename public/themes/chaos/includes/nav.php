<nav class="navbar navbar-dark bg-dark text-white text-justify">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
        <img src="/images/favicon.ico" width="30" height="30" class="d-inline-block" alt="Poe Mei">
        </a>
        <ul class=" navbar nav text-white" align="left">
            <li class="nav-item">
                <a class="nav-link <?= nav_active('home') ?>" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= nav_active('posts') ?>" href="/posts">Posts</a>
            </li>
            <?php if (is_admin()) {
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="/admin">Admin</a>';
                echo '</li>';
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="/account/logout">Logout<a>';
                echo '</li>';
            }
            else { 
                echo '<li class="nav-item">';
                echo '<a class="nav-link" href="/account/login">Login<a>';
                echo '</li>';
            } ?>

            <li class="nav-item">
                <a class="nav-link disabled" href="#"></a>
            </li>
        </ul>
    </div>
</nav>
<!--
<pre><?php print_r($_SESSION); ?></pre>
-->