<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
 if (isset($_GET['id'])) {
    if (!empty($_POST)) {
         $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $project = isset($_POST['project']) ? $_POST['project'] : '';
        $article = isset($_POST['article']) ? $_POST['article'] : '';
        $granularity = isset($_POST['granularity']) ? $_POST['granularity'] : '';
        $timestamp = isset($_POST['timestamp']) ? $_POST['timestamp'] : '';
        $access = isset($_POST['access']) ? $_POST['access'] : '';
        $agent = isset($_POST['agent']) ? $_POST['agent'] : '';
        $views = isset($_POST['views']) ? $_POST['views'] : '';
         $stmt = $pdo->prepare('UPDATE contacts SET id = ?, project = ?, article = ?, granularity = ?, timestamp = ?, agent = ? ,access=  ?,views =?  WHERE id = ?');
        $stmt->execute([$id, $project, $article, $granularity, $timestamp, $agent,$access, $views, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
     $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Update Contact #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>
        <label for="name">Name</label>
        <input type="text" name="id" placeholder="1" value="<?=$contact['id']?>" id="id">
        <input type="text" name="name" placeholder="John Doe" value="<?=$contact['name']?>" id="name">
        <label for="email">Email</label>
        <label for="phone">Phone</label>
        <input type="text" name="email" placeholder="johndoe@example.com" value="<?=$contact['email']?>" id="email">
        <input type="text" name="phone" placeholder="2025550143" value="<?=$contact['phone']?>" id="phone">
        <label for="title">Title</label>
        <label for="created">Created</label>
        <input type="text" name="title" placeholder="Employee" value="<?=$contact['title']?>" id="title">
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i', strtotime($contact['created']))?>" id="created">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>

    </div>

<?=template_footer()?>