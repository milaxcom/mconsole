<div class="form-group">
    <input type="hidden" name="{{ $name }}" value="0" />
    <div class="checkbox-list">
        <label class="checkbox">{!! Form::checkbox($name, 1, (isset($value)) ? $value : is_bool(Form::getValueAttribute($name)) ? (int) Form::getValueAttribute($name) : null) !!} {{ $label }}</label>
    </div>
</div>