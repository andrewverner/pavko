<?php
/**
 * @var $this SiteController
 * @var $region Region
 */


$this->pageTitle=Yii::app()->name;
?>

<?php if ($regions) : ?>
	<ul>
	<?php foreach ($regions as $region) : ?>
		<li><?php echo CHtml::link($region->name,Yii::app()->createUrl("api/getRegion/{$region->id}"),['target' => '_blank']) ?></li>
	<?php endforeach; ?>
	</ul>
<?php endif; ?>
