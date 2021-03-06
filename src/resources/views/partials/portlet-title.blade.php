<div class="portlet-title">
    @if (isset($title))
        <div class="caption">
			<span class="caption-subject font-grey-mint sbold uppercase">{{ $title }}</span>
		</div>
    @endif
    <div class="actions">
        @if (isset($filters) && !is_null($filters))
            @if (FILTERS_ACTIVE)
                <a class="btn yellow-casablanca btn-circle" data-toggle="modal" href="#filters"><i class="fa fa-search"></i> {{ trans('mconsole::forms.filters.active') }}</a>
            @else
                <a class="btn default btn-circle" data-toggle="modal" href="#filters"><i class="fa fa-search"></i> {{ trans('mconsole::forms.filters.filter') }}</a>
            @endif
        @endif
        @if (isset($back))
            @include('mconsole::partials.title-button', [
                'href' => $back,
                'color' => 'grey-salsa',
                'icon' => 'rotate-left',
                'text' => trans('mconsole::tables.back'),
            ])
        @endif
        @if (isset($add))
            @include('mconsole::partials.title-button', [
                'href' => $add,
                'color' => 'green-jungle',
                'icon' => 'plus',
                'text' => trans('mconsole::tables.create'),
            ])
        @endif
        @if (isset($actions))
            {!! $actions !!}
        @endif
        @if (isset($fullscreen) && $fullscreen == true)
            <a title="" data-original-title="{{ trans('mconsole::mconsole.fullscreen') }}" class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"> </a>
        @endif
    </div>
</div>