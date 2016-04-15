@extends('mconsole::app')

@section('content')

<div class="row">
	<div class="col-md-4 col-sm-6">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue sbold uppercase">{{ trans('mconsole::presets.form.main') }}</span>
                </div>
            </div>
            <div class="portlet-body form">
            		<div class="form-body">
                        @if (isset($item))
                			{!! Form::model($item, ['method' => 'PUT', 'route' => ['mconsole.tags.update', $item->id]]) !!}
                		@else
                			{!! Form::open(['method' => 'POST', 'url' => '/mconsole/tags']) !!}
                		@endif
        				@include('mconsole::forms.text', [
        					'label' => trans('mconsole::tags.form.name.label'),
        					'name' => 'name',
        					'placeholder' => trans('mconsole::tags.form.name.placeholder')
        				])
                        
                        @include('mconsole::forms.colorpicker', [
                            'label' => trans('mconsole::tags.form.color.label'),
                            'name' => 'color',
                            'value' => isset($item) ? $item->color : '#0E76B3'
                        ])
                        
                    </div>
                    
        			<div class="form-actions">
        				@include('mconsole::forms.submit')
        			</div>
                </div>
            </div>
        </div>
		{!! Form::close() !!}
	</div>
</div>

@endsection

@section('page.scripts')
    <script src="/massets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js" type="text/javascript"></script>
    <script src="/massets/global/plugins/jquery-minicolors/jquery.minicolors.min.js" type="text/javascript"></script>
    <script>
        $('.color-picker').minicolors({
            theme: 'bootstrap'
        });
    </script>
@endsection