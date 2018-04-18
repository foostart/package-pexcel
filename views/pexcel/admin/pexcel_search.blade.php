
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i><?php echo trans('pexcel::pexcel_admin.page_search') ?></h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'admin_pexcel','method' => 'get']) !!}

        <!--TITLE-->
        <div class="form-group">
            {!! Form::label('pexcel_name', trans('pexcel::pexcel_admin.pexcel_name_label')) !!}
            {!! Form::text('pexcel_name', @$params['pexcel_name'], ['class' => 'form-control', 'placeholder' => trans('pexcel::pexcel_admin.pexcel_name_placeholder')]) !!}
        </div>
        <!--/END TITLE-->

        {!! Form::submit(trans('pexcel::pexcel_admin.search').'', ["class" => "btn btn-info pull-right"]) !!}
        {!! Form::close() !!}
    </div>
</div>


