<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 6/7/16
 * Time: 4:34 PM
 *
 * @var $model Appeal
 */
?>

<table>
    <tr>
        <td></td><td><?php echo $model->user->last_name ?> <?php echo $model->user->first_name ?> <?php echo $model->user->middle_name ?></td>
    </tr>
    <tr>
        <td></td><td><?php echo $model->category ?></td>
    </tr>
    <tr>
        <td></td><td><?php echo $model->city ?></td>
    </tr>
    <tr>
        <td></td><td><?php echo $model->address ?></td>
    </tr>
    <tr>
        <td></td><td><?php echo $model->text ?></td>
    </tr>
    <?php if ($model->file) : ?>
    <tr>
        <td></td><td><?php echo CHtml::image("http://690000.ru/attaches/{$model->file}") ?></td>
    </tr>
    <?php endif; ?>
</table>
