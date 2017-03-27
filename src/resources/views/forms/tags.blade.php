<div class="form-group">
    <label for="multiple" class="control-label">{{ trans('mconsole::forms.tags.label') }}</label>
    <select name="tags[]" class="form-control tags-select" multiple data-lang-placeholder="{{ trans('mconsole::forms.tags.placeholder') }}">
        @foreach ($allTags as $tag)
            @if (!isset($categories) || isset($categories) && in_array($tag->category, $categories))
                @if (isset($tags) && $tags->where('id', $tag->id)->count() > 0)
                    <option data-color="{{ $tag->color }}" value="{{ $tag->id }}" selected="selected">{{ $tag->name }}</option>
                @else
                    <option data-color="{{ $tag->color }}" value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endif
            @endif
        @endforeach
    </select>
</div>