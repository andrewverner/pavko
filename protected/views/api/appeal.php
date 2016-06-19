<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 6/7/16
 * Time: 4:34 PM
 *
 * @var $model Appeal
 * @var $file File
 */
?>
ID <?php echo $model->id ?> / <?php echo $model->category ?> / <?php echo $model->user->last_name ?> <?php echo $model->user->first_name ?> <?php echo $model->user->middle_name ?> /
<?php echo $model->user->phone ?> / <?php echo $model->email ?><br /><br />
<?php echo $model->text; ?><br /><br />

<?php if ($model->files) : ?>
<ul>
<?php foreach ($model->files as $file) : ?>
    <li><?php echo CHtml::link($file->name,"http://690000.ru/attaches/{$file->name}") ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>