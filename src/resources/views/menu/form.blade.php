<div class="row">
	<div class="col-md-4 col-sm-6">
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                    'back' => '/mconsole/menus',
                    'title' => trans('mconsole::menus.form.main'),
                ])
            <div class="portlet-body form">
            		<div class="form-body">
                        @if (isset($item))
                			{!! Form::model($item, ['method' => 'PUT', 'route' => ['mconsole.menus.update', $item->id]]) !!}
                		@else
                			{!! Form::open(['method' => 'POST', 'url' => '/mconsole/menus']) !!}
                		@endif
        				@include('mconsole::forms.text', [
        					'label' => trans('mconsole::menus.form.name'),
        					'name' => 'name',
        					'placeholder' => trans('mconsole::menus.form.placeholder')
        				])
                        @include('mconsole::forms.state')
                    </div>
                    
        			<div class="form-actions">
        				@include('mconsole::forms.submit')
        			</div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-6">
            <div class="portlet light">
                @include('mconsole::partials.portlet-title', [
                    'name' => 'tree',
                    'title' => trans('mconsole::menus.form.tree'),
                ])
                <div class="portlet-body form">
            		<div class="form-body">
        				@include('mconsole::forms.hidden', [
        					'name' => 'tree',
        				])
                        @trans([
                            'menu-editor-text' => trans('mconsole::menus.form.text'),
                            'menu-editor-add' => trans('mconsole::menus.form.add'),
                            'menu-editor-delete' => trans('mconsole::menus.form.delete'),
                            'menu-editor-link' => trans('mconsole::menus.form.link'),
                            'menu-editor-blank' => trans('mconsole::menus.form.blank'),
                        ])
                    </div>
                </div>
            </div>
        </div>
		{!! Form::close() !!}
	</div>
</div>