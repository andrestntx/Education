<a href="{{ $widget_url }}" class="widget">
    <div class="widget-content widget-content-mini text-right clearfix">
        <div class="widget-icon pull-left {{ $widget_themed }}" style="width:95px; height: 95px; line-height: 90px;">
            <i class="{{ $widget_icon }} text-light-op"></i>
        </div>
        <h2 class="widget-heading h2">
            <strong>+ <span data-toggle="counter" data-to="{{ $widget_count }}">{{ $widget_count }}</span></strong>
        </h2>
        <span class="text-muted h4">{{ $widget_title }}</span>
    </div>
</a>
