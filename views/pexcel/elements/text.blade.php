<!-- SAMPLE NAME -->
<div class="form-group">
    <?php $pexcel_name = $request->get('pexcel_titlename') ? $request->get('pexcel_name') : @$pexcel->pexcel_name ?>
    {!! Form::label($name, trans('pexcel::pexcel_admin.name').':') !!}
    {!! Form::text($name, $pexcel_name, ['class' => 'form-control', 'placeholder' => trans('pexcel::pexcel_admin.name').'']) !!}
</div>
<!-- /SAMPLE NAME -->