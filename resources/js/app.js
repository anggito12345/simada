var App = {
    helpers: {
        defaultSelect2: (select2Ele, url, keyField, valueField) => {
            $.ajax({
                type: 'GET',
                url: url,
            }).then(function (data) {
                // create the option and append to Select2
                var option = new Option(data[valueField], data[keyField], true, true);
                select2Ele.append(option).trigger('change');

                // manually trigger the `select2:select` event
                select2Ele.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });
            });
        },
        downloadFile : (path) => {
            window.open(path,'_blank');
        }
    }
}
