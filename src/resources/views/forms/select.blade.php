<div class="form-group">
	<label>{{ $label }}</label>
    @if (isset($options) && is_array($options))
        <?php if (isset($value)): $val = $value; elseif (is_bool(Form::getValueAttribute($name))): $val = (int) Form::getValueAttribute($name); else: $val = null; endif; ?>
        {!! Form::select($name, $options, $val, ['class' => sprintf('form-control %s', isset($class) ? $class : null)]) !!}
    @elseif (isset($type))
        {!! Form::select($name, [
            '1' => trans(sprintf('mconsole::forms.options.%s.enabled', $type)),
            '0' => trans(sprintf('mconsole::forms.options.%s.disabled', $type)),
        ], (isset($value)) ? $value : is_bool(Form::getValueAttribute($name)) ? (int) Form::getValueAttribute($name) : null, ['class' => sprintf('form-control %s', isset($class) ? $class : null)]) !!}
    @endif
</div>