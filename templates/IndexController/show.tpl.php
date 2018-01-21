
<p>
	Title: <?=cleanVal($book->getTitle()) ?> <br />
	Price: <?=cleanVal($book->getGrossPrice()) ?> <br />
	Created at: <?=cleanVal($book->getCreatedAt()->format('Y-m-d H:i:s')) ?>
</p>
