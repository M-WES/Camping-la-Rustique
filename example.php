<?php

require 'Login.php';

// Example usage of $loggedIn
if (isset($loggedIn) && $loggedIn) {
    // Display content for logged-in users
    echo '<p>Welcome, ' . $_SESSION['username'] . '!</p>';
    echo '<a href="?logout">Logout</a>';
} else {
    // Display login form for non-logged-in users
    echo '<form method="post" action="login.php">';
    echo '    <label for="username">Username:</label>';
    echo '    <input type="text" name="username" required>';
    echo '    <label for="password">Password:</label>';
    echo '    <input type="password" name="password" required>';
    echo '    <button type="submit">Login</button>';
    echo '</form>';
}


?>

</body>
</html>