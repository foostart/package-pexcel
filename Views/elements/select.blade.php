<!-- CATEGORY LIST -->
<div class="form-group">
    <?php $pexcel_name = $request->get('pexcel_titlename') ? $request->get('pexcel_name') : @$pexcel->pexcel_name ?>

    {!! Form::label('category_id', trans('pexcel::pexcel_admin.pexcel_categoty_name').':') !!}
    {!! Form::select('category_id', @$categories, @$pexcel->category_id, ['class' => 'form-control']) !!}
</div>
<!-- /CATEGORY LIST -->