<?php
use yii\helpers\Html;

$this->params['breadcrumbs'][]= $this->title;
$this->title='Películas';
?>
<div class="row">
    <table class="table table-striped">
        <thead>
            <th>Título</th>
            <th>Año</th>
            <th>Género</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            <?php foreach ($filas as $fila): ?>
                <tr>
                    <td><?= Html::encode($fila['titulo']) ?></td>
                    <td><?= Html::encode($fila['anyo']) ?></td>
                    <td><?= Html::a($fila['genero'], ['generos/update', 'id' => $fila['genero_id']]) ?></td>
                    <td>
                        <?= Html::a('Modificar', ['peliculas/update', 'id' => $fila['id']], ['class' => 'btn-xs btn-info']) ?>
                        <?= Html::a('Borrar', ['peliculas/delete', 'id' => $fila['id']], [
                            'class' => 'btn-xs btn-danger',
                            'data-confirm' => '¿Seguro que desea borrar?',
                            'data-method' => 'POST',
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<div class="row">
    <div class="text-center">
        <?= Html::a('Insertar película', ['peliculas/create'], ['class' => 'btn btn-info']) ?>
    </div>
</div>
