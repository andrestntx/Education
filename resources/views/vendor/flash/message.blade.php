@if (Session::has('flash_notification.message'))
    @if (Session::has('flash_notification.overlay'))
        @include('flash::modal', ['modalClass' => 'flash-modal', 'title' => Session::get('flash_notification.title'), 'body' => Session::get('flash_notification.message')])
    @else
        <script type="text/javascript">
            $(function() {
                $.bootstrapGrowl("<h4><strong>Atención</strong></h4> <p style='font-size:16px;'>{{ Session::get('flash_notification.message') }}</p>", {
                    type: "{{ Session::get('flash_notification.level') }}",
                    delay: 5000,
                    allow_dismiss: true,
                    offset: {from: 'top', amount: 20}
                });
            });
        </script>
    @endif
@endif
