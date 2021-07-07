<script>
new inlineDatepicker(document.getElementById('tgl_lahir'), {
    format: 'DD-MM-YYYY',
    buttonClear: true,
    minYear: 1940,
    maxYear: new Date().getFullYear() - 20
});


$('#pid_organisasi').select2({
    ajax: {
        url: "<?= url('api/public/get-organisasi') ?>",
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

$('#pid_organisasi').on('change', function (e) {
    $("#jabatan").val("").trigger("change")
});

</script>

@if(isset($users))
<script>

App.Helpers.defaultSelect2(
    $("#pid_organisasi"),
        `${$('[base-path]').val()}/api/organisasis/${<?= $users->pid_organisasi ?>}`,
        "id",
        "nama",
        () => {
        App.Helpers.defaultSelect2(
            $("#jabatan"),
            `${$('[base-path]').val()}/api/jabatans/${<?= $users->jabatan ?>}`,
            "id",
            "nama",
            () => {

            }
        )
    }
)
</script>
@endif
