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
    <?php if ($model->files) : ?>
    <tr>
        <td></td><td>
            <ul>
            <?php foreach ($model->files as $file) : ?>
                <li><?php echo CHtml::link($file->name,"http://690000.ru/attaches/{$file->name}") ?></li>
            <?php endforeach; ?>
            </ul>
        </td>
    </tr>
    <?php endif; ?>
</table>
