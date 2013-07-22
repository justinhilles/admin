{{ Form::tag($form['action_route'], (isset($form['object']) ? $form['object'] : null)) }}
    <div id="tree" class="span2">
        <ul class="nav nav-list">
            @include($form['left'])
        </ul>
    </div>
    <div class="span7">
        <?php $fields = $form['center'];?>
        @include('admin::admin._fieldset')
    </div>
    <div class="span2 well pull-right">
        <?php $fields = $form['right'];?>
        @include('admin::admin._fieldset')
    </div>
    <div class="span12">
        {{ Form::buttons($form['back_route'], $form['links']) }}
    </div>
{{ Form::close() }}

@include('cms::admin.global.errors', array('errors' => $errors))