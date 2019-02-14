<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Listado de personas';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Listado de personas</h1>
<table class="table table-striped">
    <thead>
        <th>#</th>
        <th>Participante</th>
        <th>Acciones</th>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $total = 0;
        ?>
        <?php foreach ($filas as $persona): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= Html::encode($persona->nombre) ?></td>
                <td>
                    <?= Html::a('Modificar', ['personas/update', 'id' => $persona->id], ['class' => 'btn-xs btn-info']) ?>
                    <?= Html::a('Borrar', ['personas/delete', 'id' => $persona->id], [
                        'class' => 'btn-xs btn-danger',
                        'data-confirm' => '¿Seguro que desea borrar?',
                        'data-method' => 'POST',
                    ]) ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<div class="row">
    <div class="text-center">
        <?= Html::a('Insertar persona', ['persona/create'], ['class' => 'btn btn-info']) ?>
    </div>
</div>
