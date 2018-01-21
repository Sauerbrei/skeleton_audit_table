<form action="index.php?action=<?=$action?>" method="POST">
	<input type="hidden" name="id" value="<?=intval($book->getId())?>" />
	<input type="text" name="title" id="title" placeholder="Title" value="<?=cleanVal($book->getTitle())?>" />
	<input type="text" name="price" id="price" placeholder="Price" value="<?=cleanVal($book->getPrice())?>" />
	<input type="submit" value="Save Book" />
</form>