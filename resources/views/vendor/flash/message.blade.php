@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else 
        <link rel="stylesheet" href="<?= url('css/thirdparty/sweetalert2.min.css') ?>">
        <script src="<?= url('js/thirdparty/sweetalert2.min.js') ?>"></script>
        <script>
            swal.fire({
                type: "{{ $message['level'] == 'danger' ? 'error' : $message['level'] }}",
                text: "{!! $message['message'] !!}"
            })
        </script>
       
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
