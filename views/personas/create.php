<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Insertar un nuevo participante';
$this->params['breadcrumbs'][] = ['label' => 'Personas', 'url' => ['personas/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin() ?>
    <?= $form->field($persona, 'persona') ?>
    <div class="form-group">
        <?= Html::submitButton('Insertar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancelar', ['personas/index'], ['class' => 'btn btn-danger']) ?>
    </div>
<?php ActiveForm::end() ?>
