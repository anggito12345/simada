<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<div class='btn-group'>
    <input class="toggle" onChange="window.location.href='{{route('organisasis.changeSetting', $id)}}'" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Buka" data-off="Kunci" {{ $setting ? 'checked' : '' }}>

</div>