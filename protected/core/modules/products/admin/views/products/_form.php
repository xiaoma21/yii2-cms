<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use core\models\Category as Category;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model core\modules\products\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map(
            Category::get(
                0,
                Category::find()->where(['status'=>Category::STATUS_ENABLED, 'type' => Category::TYPE_PRODUCT])->asArray()->all()
            ), 'id', 'label'
        ),
        ['class' => 'form-control', 'prompt' => Yii::t('base', 'Please Filter')]
    ) ?>

    <?= $form->field($model, 'industry_id')->dropDownList(
        ArrayHelper::map(
            Category::get(
                0,
                Category::find()->where(['status'=>Category::STATUS_ENABLED, 'type' => Category::TYPE_INDUSTRY])->asArray()->all()
            ), 'id', 'label'
        ),
        ['class' => 'form-control', 'prompt' => Yii::t('base', 'Please Filter')]
    ) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'thumb')->widget('core\modules\file\widgets\Upload',
        [
            'url' => ['/file/file/upload'],
            'maxFileSize' => 10 * 1024 * 1024, // 10 MiB,
            'minFileSize' => 1,
            'acceptFileTypes' => new JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
        ]
    ); ?>

    <?= $form->field($model, 'images')->widget(
        'core\modules\file\widgets\Upload',
        [
            'url' => ['/file/file/upload'],
            'sortable' => true,
            'maxFileSize' => 10 * 1024 * 1024, // 10 MiB
            'maxNumberOfFiles' => '10',
        ]
    ) ?>

    <?= $form->field($model, 'description')->widget('kucha\ueditor\UEditor',[]) ?>

    <?= $form->field($model, 'sort_order')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList($model::getStatus()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('base', 'Create') : Yii::t('base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
