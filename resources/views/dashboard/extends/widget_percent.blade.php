<div class="widget-content widget-content-mini themed-background-muted text-center">
	<i class="fa fa-bar-chart-o"></i> {{ $title }}
</div>
<div class="widget-content text-center">
	<div class="pie-chart easyPieChart" data-percent="{{ $value }}" data-line-width="3" data-bar-color="#cccccc" data-track-color="#f9f9f9" style="width: 80px; height: 80px; line-height: 80px;">
		<span><strong>{{ $value }}%</strong></span>
		<canvas width="80" height="80"></canvas>
	</div>
</div>
<div class="widget-content themed-background-muted">
	<div class="progress progress-striped progress-mini active remove-margin">
		<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $value }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $value }}%"></div>
	</div>
</div>