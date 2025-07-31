<!--
<div class="container">
  <div class="container-fluid mech-gradient text-white p-4 text-center">
    <h2>Poe Mei</h2>
    <p class="lead">Mei is pronounced like May, and <em>shoganai</em>, it just is what it is.</p>
    <p>Transgendered Woman, Military Veteran, Developer and forever a student.</p>
  </div>
</div>
-->
<div class="container p-5 my-5 bg-dark text-white text-center">    
    <h1>Poe Mei</h1>
    <p class="lead">Welcome to my world!<p>
    <p>Developer, Military Vet, Transgendered Woman, and forever a student!</p>
</div>

<div class="container">
    <h2>My Updates</h2>
    <p class="lead">Introducing... DevBot->Rictus</p>
    <p>Rictus is a DevBot, that has a core set of functions and can be extended via plugins, allowing you to extend the functionality of the bot itself. Right now, it tracks error logs, file changes and directory changes, along with a mood to set for the day and only runs once a day via cron. I wrote this because I despies digging through error logs and on a plus side, Rictus will post to my blogs/posts so there is transparency, the bot can be run manually and it will update its post throughout.</p>
        <p>
        <blockquote class="blockquote text-center">
            <p class="mb-0">If you can't have fun doing it, why do it.
            <footer class="blockquote-footer"><br><em>~ Poe Mei</em></footer>
            </p>
        </blockquote>
        </p>
</div>
<hr class="my-5">
<?php
use app\core\db;
use app\core\post;

$db = new db();
$post = new post($db); // $postHandler renamed to match

$latest = $post->get_latest();

if ($latest):
    $author = !empty($latest['name']) ? $latest['name'] : 'Unknown';
?>
<div class="container mt-5 mb-5"> <!-- Added mb-5 for bottom spacing -->
  <div class="card border-0 shadow-lg rounded-4" style="background: linear-gradient(145deg, #2c2c2c, #3e3e3e); color: #f8f9fa;">
    <div class="card-body p-4">
      <h2 class="card-title fw-bold text-light"><?= htmlspecialchars($latest['title']) ?></h2>
      <p class="card-subtitle mb-3 fst-italic text-light">
        Posted by <?= htmlspecialchars($author) ?> on <?= date('l, F j, Y', strtotime($latest['created_at'])) ?><br>
        <small style="color: #bbb;">Last updated: <?= date('F j, Y \a\t g:i A', strtotime($latest['updated_at'])) ?></small>
      </p>
      <p class="card-text fs-5 text-light"><?= $latest['intro'] ?></p>
      <a href="<?= BASE_URL ?>posts/view/<?= urlencode($latest['post_slug']) ?>" class="btn btn-outline-warning rounded-pill mt-3">Read More</a>
    </div>
  </div>
</div>
<?php
else:
    echo '<div class="container mt-5 mb-5"><p class="text-muted">No devlog post available.</p></div>';
endif;
?>