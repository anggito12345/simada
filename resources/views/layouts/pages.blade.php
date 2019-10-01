<?php   
    $controllerName = isset(request()->route()->getAction()['as']) ? request()->route()->getAction()['as'] : "";

    if (strpos($controllerName, ".") > -1) {
        $controllerName = explode(".",$controllerName)[0];
    }
    
    
?>

@if($controllerName != "")
    <script src="<?= url('js/pages/'.$controllerName.'.ko.js?key='.sha1(time())) ?>"></script>
@endif


<script>
    
    viewModel.jsLoaded(true)
    ko.applyBindings(viewModel)
</script>
