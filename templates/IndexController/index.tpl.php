
<ul>
	<?php foreach ($books AS $id => $book): /* @var $book Book*/ ?>
	<li>
		<a href="index.php?action=show&id=<?=intval($book->getId()) ?>">
			<?=cleanVal($book->getTitle()) ?>
		</a>
		|
		<a href="index.php?action=edit&id=<?=intval($book->getId()) ?>">
			Edit
		</a>
		|
		<a href="index.php?action=del&id=<?=intval($book->getId()) ?>">
			Delete
		</a>
	</li>
	<?php endforeach; ?>
</ul>
