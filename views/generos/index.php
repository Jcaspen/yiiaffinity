<?php
use yii\helpers\Html;

$this->title ='Géneros';
$this->params['breadcrumbs'][]= $this->title;

?>
<div class="row">
    <table class="table table-striped">
        <thead>
            <th>Género</th>
            <th>Nº de Peliculas</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            <?php foreach ($filas as $fila): ?>
                <tr>
                    <td><?= Html::encode($fila['genero']) ?></td>
                    <td><?= Html::encode($fila['cantidad']) ?></td>

                    <td>
                        <?= Html::a('Modificar', ['generos/update', 'id' => $fila['id']], ['class' => 'btn-xs btn-info']) ?>
                        <?= Html::a('Borrar', ['generos/delete', 'id' => $fila['id']], [
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
        <?= Html::a('Insertar Género', ['generos/create'], ['class' => 'btn btn-info']) ?>
    </div>
</div>
