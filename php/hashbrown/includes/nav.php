<nav class="navMenu">
    <a href=".">Home</a>
    <a href="users.php">Users</a>
    <a href=<?php echo (isGranted() ? '"youtube.php"' : '"."'); ?>>Youtube</a>
    <?php echo (isGranted() ? '<a href="logout.php">Log Out</a>' : ''); ?>
    <a href="create-account.php">Create Account</a>
    <div class="dot"></div>
</nav>
