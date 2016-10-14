<?php /* name of this file is the reason disease title (removing special chars and replacing spaces with '_') of the particular reason this file belongs  */  ?>
<div class="col-md-12">
    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
            </div>
            <h2 class="panel-title">Mens Facial Cosmetics and Skincare</h2>
        </header>
        <div class="panel-body">
            <div class="tabs tabs-primary">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#cosmetics_beginning" data-toggle="tab"><i class="fa fa-star"></i> Beginning Information</a>
                    </li>
                    <li>
                        <a href="#cosmetics_treatment" data-toggle="tab">Treatment Questions</a>
                    </li>                    
                </ul>
                <div class="tab-content">
                    <div id="cosmetics_beginning" class="tab-pane active">
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('facial_surgeries', 'Have you Ever Had Any Type of Facial Surgeries or Facial Enhancements? If So What Kind?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('facial_surgeries', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('facial_surgeries', '1', $cosmetics && $cosmetics->facial_surgeries == '1', ['id' => 'facial_surgeries1']) }}
                                            {{ Form::label('facial_surgeries1', 'Yes') }}
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('facial_surgeries', '0', $cosmetics && $cosmetics->facial_surgeries == '0', ['id' => 'facial_surgeries2']) }}
                                            {{ Form::label('facial_surgeries2', 'No') }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-6 facialActive">
                                <div class="form-group">
                                    {{ Form::label('facial_kind', 'What kind?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6">
                                        <?php $kind = [ 'Botox/Fillers' => 'Botox/Fillers', 'Plastic Sugery' => 'Plastic Sugery', 'Spa Facials' => 'Spa Facials']; ?>
                                        {{ Form::select('facial_kind', ['' => 'Please Select'] + $kind, $cosmetics ? $cosmetics->facial_kind:null, ['class' => 'form-control input']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('face_wash', 'What Do you wash your face with?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6">
                                        <?php $type = [ 'Whatevers On Sale' => 'Whatevers On Sale', 'Basic Soap' => 'Basic Soap', 'Specialty Soap' => 'Specialty Soap', 'Skincare Product' => 'Skincare Product']; ?>
                                        {{ Form::select('face_wash', ['' => 'Please Select'] + $type, $cosmetics ? $cosmetics->face_wash:null, ['class' => 'form-control input']) }}
                                    </div>
                                </div>                              
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('exposure', 'How Much Exposure do you have to the sun?  (Consider Work, Recreation, and Daily life)', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6">
                                        <?php $exposure = [ 'A lot' => 'A lot', 'Fair Amount' => 'Fair Amount', 'Average' => 'Average', 'Very Little' => 'Very Little']; ?>
                                        {{ Form::select('exposure', ['' => 'Please Select'] + $exposure, $cosmetics ? $cosmetics->exposure : null, ['class' => 'form-control input']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('skin_look', 'Choose the way you feel about how you feel your skin looks.', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6">
                                        <?php $type = [ 'Leathery' => 'Leathery', 'Sun Damaged' => 'Sun Damaged', 'Old and loose' => 'Old and loose', 'Looks Great' => 'Looks Great']; ?>
                                        {{ Form::select('skin_look', ['' => 'Please Select'] + $type, $cosmetics ? $cosmetics->skin_look : null, ['class' => 'form-control input']) }}
                                    </div>
                                </div>                              
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('look_score', 'On a Scale of 1-10  (10 Being Very Important) How Important is it for you to look good for work, dating, spouse, or Just for your personel confidence?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6">
                                        <?php $scale = commonScale(); ?>
                                        {{ Form::select('look_score', ['' => 'Please Select'] + $scale, $cosmetics ? $cosmetics->look_score : null, ['class' => 'form-control input']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('happy_score', 'On a Scale of 1-10  (10 Being Very Happy) How Happy Are you with the way you look?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6">
                                        {{ Form::select('happy_score', ['' => 'Please Select'] + $scale, $cosmetics ? $cosmetics->happy_score : null, ['class' => 'form-control input']) }}
                                    </div>
                                </div>                              
                            </div>                            
                        </div>
                        
                    </div>
                    <div id="cosmetics_treatment" class="tab-pane">
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('crowsfeet', 'Do you have Crowsfeet(Wrinkles around the eyes)', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('crowsfeet', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('crowsfeet', '1', $cosmetics && $cosmetics->crowsfeet == '1', ['id' => 'crowsfeet1']) }}
                                            {{ Form::label('crowsfeet1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('crowsfeet', '0', $cosmetics && $cosmetics->crowsfeet == '0', ['id' => 'crowsfeet2']) }}
                                            {{ Form::label('crowsfeet2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('facial_expression', 'When you Change your facial Expression do you see your forehead wrinkle up?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('facial_expression', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('facial_expression', '1', $cosmetics && $cosmetics->facial_expression == '1', ['id' => 'facial_expression1']) }}
                                            {{ Form::label('facial_expression1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('facial_expression', '0', $cosmetics && $cosmetics->facial_expression == '0', ['id' => 'facial_expression2']) }}
                                            {{ Form::label('facial_expression2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('sunken', 'Has your face become more sunken in over the years?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('sunken', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('sunken', '1', $cosmetics && $cosmetics->sunken == '1', ['id' => 'sunken1']) }}
                                            {{ Form::label('sunken1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('sunken', '0', $cosmetics && $cosmetics->sunken == '0', ['id' => 'sunken2']) }}
                                            {{ Form::label('sunken2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('bullfrog_looking', 'Do you have excessive fat below your chin on your kneck? (Bullfrog Looking)', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('bullfrog_looking', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('bullfrog_looking', '1', $cosmetics && $cosmetics->bullfrog_looking == '1', ['id' => 'bullfrog_looking1']) }}
                                            {{ Form::label('bullfrog_looking1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('bullfrog_looking', '0', $cosmetics && $cosmetics->bullfrog_looking == '0', ['id' => 'bullfrog_looking2']) }}
                                            {{ Form::label('bullfrog_looking2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('loose_skin', 'Does your face have a lot of Loose skin which has developed over time?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('loose_skin', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('loose_skin', '1', $cosmetics && $cosmetics->loose_skin == '1', ['id' => 'loose_skin1']) }}
                                            {{ Form::label('loose_skin1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('loose_skin', '0', $cosmetics && $cosmetics->loose_skin == '0', ['id' => 'loose_skin2']) }}
                                            {{ Form::label('loose_skin2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('thin_lip', 'Do you feel your lips are too thin?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('thin_lip', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('thin_lip', '1', $cosmetics && $cosmetics->thin_lip == '1', ['id' => 'thin_lip1']) }}
                                            {{ Form::label('thin_lip1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('thin_lip', '0', $cosmetics && $cosmetics->thin_lip == '0', ['id' => 'thin_lip2']) }}
                                            {{ Form::label('thin_lip2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>      
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('face_spot', 'Have you noticed dark, grey, red or other permanent spots on your face?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('face_spot', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('face_spot', '1', $cosmetics && $cosmetics->face_spot == '1', ['id' => 'face_spot1']) }}
                                            {{ Form::label('face_spot1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('face_spot', '0', $cosmetics && $cosmetics->face_spot == '0', ['id' => 'face_spot2']) }}
                                            {{ Form::label('face_spot2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('acne', 'Do you suffer from Acne or have Acne Scars?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('acne', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('acne', '1', $cosmetics && $cosmetics->acne == '1', ['id' => 'acne1']) }}
                                            {{ Form::label('acne1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('acne', '0', $cosmetics && $cosmetics->acne == '0', ['id' => 'acne2']) }}
                                            {{ Form::label('acne2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 inputRow">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('skin_tag', 'Have you noticed Skin Tags or broken blood vessels on the nose or on your face?', ['class' => 'col-sm-6 control-label']) }}
                                    <div class="col-sm-6 toggle-radio-custom">
                                        <div class="col-sm-3 radio-custom radio-primary">
											{{ Form::radio('skin_tag', '', true, ['class' => 'hidden']) }}
                                            {{ Form::radio('skin_tag', '1', $cosmetics && $cosmetics->skin_tag == '0', ['id' => 'skin_tag1']) }}
                                            {{ Form::label('skin_tag1', 'Yes') }} 
                                        </div>
                                        <div class="col-sm-3 radio-custom radio-primary">
                                            {{ Form::radio('skin_tag', '0', $cosmetics && $cosmetics->skin_tag == '0', ['id' => 'skin_tag2']) }}
                                            {{ Form::label('skin_tag2', 'No') }} 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>