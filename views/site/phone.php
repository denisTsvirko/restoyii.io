<div class="lb-overlay" id="phone">
    <div id="aut" class="aut" style="display: block;">

        <?php $form = ActiveForm::begin() ?>
        <a href="#" class="lb-close">Х</a>
        <div class="blockName"><br>
            <label>Name</label>
            <?= $form->field($call, 'name')->input('text', ['placeholder' => 'Name', 'maxlength' => '45'])->label(false) ?>
        </div>
        <div class="blockTel">
            <label>Phone number</label>
            <?= $form->field($call, 'phone')->input('text', ['placeholder' => '+_ _ (_ _) _ _ _-_ _-_ _'])->label(false) ?>
        </div>
        <?= Html::submitButton('CallMe', ['class' => 'spoiler_links button_map', 'id' => 'callme']) ?>
        <?php ActiveForm::end() ?>

        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <?php echo Yii::$app->session->getFlash('success'); ?>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('error')): ?>
            <?php echo Yii::$app->session->getFlash('error'); ?>
        <?php endif; ?>
    </div>
</div>

