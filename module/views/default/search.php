<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$menuItems = [
        ['label' => 'Searches', 'url' => ['index']],
        ['label' => 'Search form', 'url' => ['search']],
    ];
   
?>
<?= $this->render('_menu', [
    'menuItems' => $menuItems
]) ?>

<div class="row"><div class="col-md-12">
<?php
$form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]);

?>

<?=
    $form
    ->field($model, 'search')
    ->label(false)
    ->textInput()

?>
</div>
    <div class="col-md-12">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-block btn-flat']) ?>
    </div>
    <div style="margin-top:40px;" class="col-md-12">
    </div>
    
</div>
<div class="row">
    
<?php
ActiveForm::end();

?>
</div>
</div>