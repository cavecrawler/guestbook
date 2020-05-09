<h1>Willkommen zu meinem Gästebuch!</h1>


<?php
include_once('Connection.php');

if (!empty($_GET['action']) && $_GET['action'] == 'submit') {
    // validate input and write somewhere
   
    $sql = 'INSERT INTO guestbook (name, message, post_time) VALUES('
    . $pdo->quote($_POST['name']) . ','
    . $pdo->quote($_POST['text']) . ','
    . $pdo->quote(date('Y-m-d H:i:s', $timestamp = time())) . ')'; // will only work with 200 or less character messages
    $pdo->exec($sql);
}

if (!empty($_GET['action']) && $_GET['action'] == 'form') {
    // display form
    ?>
    <form action="/guestbook/index.php?action=submit" method="POST">
        <input type="text" name="name"><br>
        <textarea name="text"></textarea>
        <input type="submit">
    </form>
    <?php
} else {
    echo 'Um einen Eintrag hinzuzufügen klicke <a href="/guestbook/index.php?action=form">hier</a><br>';
    // show current entries
    $sql = 'SELECT * FROM guestbook';
    foreach ( $pdo->query($sql) as $guestbookEntry) {
        echo '<br>' . $guestbookEntry['name'] . '<br>';
        echo $guestbookEntry['message'];
    }

}