<div class="form-group">
	<label>{{ $label }}</label>
	{!! Form::hidden($name, null, ['placeholder' => (isset($placeholder)) ? $placeholder : null, 'class' => 'form-control ' . isset($class) ? $class : null]) !!}
</div>