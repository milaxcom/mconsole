@extends('mconsole::app')

@section('content')

<div class="row">
	<div class="col-md-4 col-sm-6">
		@if (isset($item))
			{!! Form::model($item, ['method' => 'PUT', 'route' => ['mconsole.users.update', $item->id]]) !!}
		@else
			{!! Form::open(['method' => 'POST', 'url' => '/mconsole/users']) !!}
		@endif
			<div class="form-body">
				@include('mconsole::forms.text', [
					'label' => trans('mconsole::users.form.name'),
					'name' => 'name',
					'placeholder' => 'John Appleseed'
				])
				@include('mconsole::forms.text', [
					'label' => trans('mconsole::users.form.email'),
					'name' => 'email',
					'placeholder' => 'example@milax.com'
				])
				@include('mconsole::forms.select', [
					'label' => trans('mconsole::users.form.language'),
					'name' => 'lang',
					'options' => [
						'ru' => 'ru',
						'en' => 'en',
					],
				])
				@include('mconsole::forms.select', [
					'label' => trans('mconsole::users.form.role'),
					'name' => 'role_id',
					'options' => $roles,
				])
				@if (!isset($item))
					@include('mconsole::forms.password', [
						'label' => trans('mconsole::users.form.name'),
						'name' => 'password',
						'placeholder' => 'Password',
					])
				@endif
				
			</div>
			<div class="form-actions">
				@include('mconsole::forms.submit')
			</div>
		{!! Form::close() !!}
	</div>
</div>

@endsection