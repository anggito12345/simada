<script>
    $('#pid').select2({
        ajax: {
            url: "<?= url('api/organisasis') ?>",
            dataType: 'json',
            processResults: function (data) {
            // Transforms the top-level key of the response object from 'items' to 'results'
            return {
                results: data.data
            };
            }
        },
        theme: 'bootstrap' ,
    })


</script>

@if(isset($organisasi))
<script>
App.Helpers.defaultSelect2(
    $("#pid"),
        `${$('[base-path]').val()}/api/organisasis/${<?= $organisasi->pid ?>}`,
        "id",
        "nama",
        () => {}
)
</script>
@endif
