<?php
 include 'functions.php';
// include 'dbconnection.php';
//  include 'api.php';

 $pdo = pdo_connect_mysql();
 $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
 $records_per_page = 5;


 $stmt = $pdo->prepare('SELECT * FROM contacts ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
 $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);


 $num_contacts = $pdo->query('SELECT COUNT(*) FROM contacts')->fetchColumn();
?>

<?=template_header('Read')?>

<div class="content read">
	<h2> Contacts</h2>
	<a href="create.php" class="create-contact">Create Contact</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>project</td>
                <td>article</td>
                <td>granularity</td>
                <td>timestamp</td>
                <td>access</td>
                <td>agent</td>
                <td>views</td>
                
            </tr>
        </thead>
        <tbody>

    <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?=$contact['id']?></td>
                <td><?=$contact['project']?></td>
                <td><?=$contact['article']?></td>
                <td><?=$contact['granularity']?></td>
                <td><?=$contact['timestamp']?></td>
                <td><?=$contact['access']?></td>
                <td><?=$contact['agent']?></td>
                <td><?=$contact['views']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$contact['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$contact['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_contacts): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
        	</div>
</div>

<?=template_footer()?>