var App = {
    Helpers: {
        defaultSelect2: (select2Ele, url, keyField, valueField, callbackDone) => {
            $.ajax({
                type: 'GET',
                url: url,
            }).then(function (data) {
                // create the option and append to Select2
                var option = new Option(data.data[valueField], data.data[keyField], true, true);
                select2Ele.append(option).trigger('change');

                // manually trigger the `select2:select` event
                select2Ele.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });

                if (callbackDone != null) {
                    callbackDone();
                }                

            });
        },
        downloadFile : (path) => {
            window.open(path,'_blank');
        },
        getFormData: ($form) => {
            var unindexed_array = $form.serializeArray();
            var indexed_array = {};
                        
            $.map(unindexed_array, function(n, i){
                indexed_array[n['name']] = n['value'];
            });

            return indexed_array;
        }
    }
}