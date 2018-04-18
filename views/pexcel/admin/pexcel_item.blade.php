
@if( ! $pexcels->isEmpty() )
<table class="table table-hover">
    <thead>
        <tr>
            <td style='width:5%'>{{ trans('pexcel::pexcel_admin.order') }}</td>
            <th style='width:10%'>Pexcel ID</th>
            <th style='width:50%'>Pexcel title</th>
            <th style='width:20%'>{{ trans('pexcel::pexcel_admin.operations') }}</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $nav = $pexcels->toArray();
            $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
        ?>
        @foreach($pexcels as $pexcel)
        <tr>
            <td>
                <?php echo $counter; $counter++ ?>
            </td>
            <td>{!! $pexcel->pexcel_id !!}</td>
            <td>{!! $pexcel->pexcel_name !!}</td>
            <td>
                <a href="{!! URL::route('admin_pexcel.edit', ['id' => $pexcel->pexcel_id]) !!}"><i class="fa fa-edit fa-2x"></i></a>
                <a href="{!! URL::route('admin_pexcel.delete',['id' =>  $pexcel->pexcel_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                <span class="clearfix"></span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
 <span class="text-warning">
	<h5>
		{{ trans('pexcel::pexcel_admin.message_find_failed') }}
	</h5>
 </span>
@endif
<div class="paginator">
    {!! $pexcels->appends($request->except(['page']) )->render() !!}
</div>