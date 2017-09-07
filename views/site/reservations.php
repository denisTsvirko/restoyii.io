<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->registerJsFile('@web/js/phone.js',['depends' => 'yii\web\YiiAsset']);
$this->title = 'Reservations';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php //$this->registerJsFile('@web/js/scripts.js')
$css = <<<CSS
    li{
      line-height: 5 !important;
    }
CSS;
$this->registerCss($css);
?>
<section id="content_reserv">
    <div class="row">
        <div class="offset1 span13">

            <div class="container_reserv">
                <div class="item_reserv">
                    <div class="text_item"> MAIN - Hall</div>
                    <img  src="../images/etag.jpg" >
                </div>
                <div class="item_reserv">
                    <div class="text_item"> VIP - Hall</div>
                    <img  src="../images/vip.jpg" >
                </div>
            </div>

            <div class="container_reserv text_in">
                <p >
                    Where it is better to spend the evening?
                    How to choose the right place for a business meeting?
                    How not to be mistaken with the order of the table?
                    These questions are often puzzling many Restaurant Guests,
                    who are planning a responsible event or just an evening for relaxation.
                </p>
                <p >
                    After booking the table all information about the order will be
                    kept by our administrator, and at the entrance to the restaurant
                    you just need to give your name and phone number so that you will
                    be led to the ordered table.
                </p>
                <p>
                    If you want to book a VIP-hall for PRIVAT-events (banquets,
                    birthdays, professional and corporate parties), after completing
                    the reservation request, the administrator will contact you to
                    discuss the menu.
                </p>
                <p>
                    The minimum order amount is 150$.
                    Now you can order your favorite table in the Old City,
                    just a couple of clicks, without exhausting attempts to get
                    through and long conversations with the administrator.
                </p>
            </div>

            <div class="container_form_resv">
                <div class="item_reserv">
                    <img  src="../images/reserved_1.jpg" >
                </div>
                <div class="item_reserv" >
                    <?php $form = ActiveForm::begin()?>

                    <label class="text_cent_reserver" >Date & Time - visit</label>
                    <div class="row">
                        <?= $form->field($reservation, 'date',['options' => ['class' => 'span2']])->label(false)->input('date', ['class' => 'span2'])?>
                        <?= $form->field($reservation, 'time',['options' => ['class' => 'span2']])->label(false)->input('time', ['class' => 'span2'])?>
                    </div>

                    <label class="text_cent_reserver" >Room & Number table</label>
                    <div class="row">
                        <?= $form->field($reservation, 'room',['options' => ['class' => 'span2']])->label(false)->dropDownList(
                        $massRooms,
                        [
                            'prompt' => 'Hall',
                            'class' => 'span2',
                        ]
                        ); ?>
                        <?= $form->field($reservation, 'numberTable',['options' => ['class' => 'span2']])->label(false)->dropDownList(
                            $massTables,
                            [
                                'class' => 'span2',
                                'prompt' => 'Table'
                            ]); ?>
                    </div>

                    <label class="text_cent_reserver" >Events & Numbar of guests</label>
                    <div class="row">
                        <?= $form->field($reservation, 'event',['options' => ['class' => 'span3']])->label(false)->dropDownList(
                            $massEvents,
                            [
                                'prompt' => 'Event',
                                'class' => 'span3',
                            ]

                            ); ?>
                        <?= $form->field($reservation, 'numguests',['options' => ['class' => 'span1']])->label(false)->input('number', ['class' => 'span1','maxlength'=>'2', 'max'=>'50', 'min'=>'1'])?>
                    </div>


                    <?= $form->field($reservation, 'name')->input('text', ['class' => 'span4', 'placeholder'=>'Name', 'maxlength'=>'45' ])?>
                    <?= $form->field($reservation, 'phone')->input('text', ['class' => 'span4', 'placeholder'=>'+_ _ (_ _) _ _ _-_ _-_ _'])?>
                    <?= $form->field($reservation, 'email')->input('text', ['class' => 'span4', 'placeholder'=>'E-mail', 'maxlength'=>'45'])?>
                    <?= $form->field($reservation, 'offers')->textarea(['rows' => 3,'class' =>'span4 marg_col', 'maxlength'=>150]) ?>
                    <?= Html::submitButton('Reserve', ['class' => 'spoiler_links button_map']) ?>
                    <?php ActiveForm::end() ?>
                    
                    <?php if(Yii::$app->session->hasFlash('success')):?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <?php echo Yii::$app->session->getFlash('success');?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(Yii::$app->session->hasFlash('error')):?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <?php echo Yii::$app->session->getFlash('error');?>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div>

        </div>
    </div>

</section>

<?php
    $js = <<<JS
    var oldVal=0;
    $('#reservation-room').on('click',function() {
        var val = $('#reservation-room').val();
        if((oldVal!=parseInt(val))&&(val!='')){
            oldVal = val;
            console.log("new: "+val);
            $.ajax({
                url:'/reservations',
                data:{room: parseInt(val)},
                type:'POST',
                datatype:'json',
                success:function(res) {                
                    addTables(JSON.parse(res));
                },
                error:function() {
                alert('Error!');
                }
            });
            
        }
        function addTables(res) {    
            $('#reservation-numbertable option').slice(1).remove();
             
            for(k in res) { 
                str = k+": "+ res[k]; 
                $('#reservation-numbertable').append("<option value='"+k+"'>"+res[k]+"</option>");
            }        
        }

    });
JS;
$this->registerJs($js);
?>
