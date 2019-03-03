<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="container-fluid title-container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Zadanie rekrutacytjne</h1>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="text-center">Lista ofert</h2>
            </div>
        </div>
    
        <div id="offers-list" class="row">
            <div class="loading-container loading-container-fixed">
                <div class="loading-container">
                    <div class="circle"></div>
                    <div class="circle-small"></div>
                    <div class="circle-inner-inner"></div>
                    <div class="circle-inner"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    console.log('ttt');
$.ajax({
    'type' : 'POST',
    'url'  : '/get-offers',
    'data' : {
        '_csrf': $('[name="csrf-token"]').attr('content'),  
    }
}).done(function(data){
    
    $('#offers-list .loading-container').css('opacity','0');
    setTimeout(function(){
        $('#offers-list').html(data);
    }, 300);
    
});
</script>