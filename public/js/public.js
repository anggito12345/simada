var App = {
    Helpers: {
        defaultSelect2: (select2Ele, url, valueField, textField, callbackDone) => {
        
            $.ajax({
                type: 'GET',
                url: url,
            }).then(function (data) {
                
                const generateText = (data, textFieldParam) => {
                    if (Array.isArray(textFieldParam)) {
                        let concatText = ""
                        for(let i=0; i<textFieldParam.length; i++) {
                            if (data[textFieldParam[i]] != undefined) {
                                concatText += data[textFieldParam[i]]
                            } else {
                                concatText += textFieldParam[i]
                            }
                        }

                        return concatText
                    } else {
                        return data[textFieldParam]
                    }
                }
                // create the option and append to Select2
                var option = new Option(generateText(data.data, textField), 
                        data.data[valueField], 
                    true, 
                    true);

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
        },
        
    }
}

jQuery.fn.extend({
    generatedLookup: 1,
    lookupGeneratedValue: {},
    customLookup: {},
    datasourceLookup: {},
    selectedIdLookup: {},    
    cacheLookupConfig: {},
    saveLookup: (idlookupParam) => {
        $("[name="+$.fn.customLookup[idlookupParam].maskid+"]").val($.fn.datasourceLookup[$.fn.selectedIdLookup[idlookupParam]][$.fn.customLookup[idlookupParam].textField]);
        $("[name="+$.fn.customLookup[idlookupParam].realid+"]").val($.fn.datasourceLookup[$.fn.selectedIdLookup[idlookupParam]][$.fn.customLookup[idlookupParam].valueField]);

        if($.fn.customLookup[idlookupParam].select != undefined && typeof $.fn.customLookup[idlookupParam].select == "function") {
            $.fn.customLookup[idlookupParam].select($.fn.datasourceLookup[$.fn.selectedIdLookup[idlookupParam]])
        }
    },
    isExistChecked: (idlookupParam,id) => {
        return $.fn.selectedIdLookup[idlookupParam] == id
    },
    onCheckLookup: (idlookupParam, id, type) => { 

        if (type == "checkbox") {
            let index = $.fn.lookupGeneratedValue[idlookupParam].map((e) => {
                return String(e.id)
            }).indexOf(id);
            if (index > -1) {
                $.fn.lookupGeneratedValue[idlookupParam].splice(index, 1);
            } else {            
                $.fn.lookupGeneratedValue[idlookupParam].push($.fn.datasourceLookup[id])
            }       
        } else {
            $.fn.lookupGeneratedValue[idlookupParam] = [$.fn.datasourceLookup[id]]

            $.fn.selectedIdLookup[idlookupParam] = id

            if ($.fn.customLookup[idlookupParam].autoClose) {
                $.fn.saveLookup(idlookupParam)
                $("#" + idlookupParam).modal("hide")
            }            
        }
            
    },
    CreateModalLookup: function(config) {
        let idlookup = "modal-lookup"
        let title = ""        
        let typeInput = "checkbox"
        let name = "name-lookup"
        let filters = []

        if (config.id != undefined) {
            idlookup = config.id
            name = "name-" + idlookup
        }

        if (config.title != undefined) {
            title = config.title
        }

        if (config.customLookup.typeInput != undefined) {
            typeInput = config.customLookup.typeInput
        }

        if (config.customLookup.filters != undefined) {
            filters = config.customLookup.filters
        }

        config.language = {
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
        }

        config.columns.unshift({
            className: "text-center",
            sortable: false,
            "render": function ( data, type, full, meta ) {
                $.fn.datasourceLookup[full.id] = full
                if ($.fn.isExistChecked(idlookup, full.id)) {
                    return '<input type="'+typeInput+'" name="'+name+'" checked onclick="$.fn.onCheckLookup(\''+idlookup+'\', \''+full.id+'\',\''+typeInput+'\')" />';
                } else {
                    return '<input type="'+typeInput+'" name="'+name+'" onclick="$.fn.onCheckLookup(\''+idlookup+'\', \''+full.id+'\', \''+typeInput+'\')" />';
                }
                
            } 
        })

        

        config.customLookup.idlookup = idlookup

        $.fn.customLookup[idlookup] = config.customLookup
        $.fn.lookupGeneratedValue[idlookup] = []

        let buttonSaveAndClose = ""
        const idButtonSaveAndClose = "button-save-and-close-" + idlookup

        if (!$.fn.customLookup[idlookup].autoClose) {
            buttonSaveAndClose = '<button id=\''+idButtonSaveAndClose+'\' type="button" class="btn btn-primary" >Save</button>'
        }

        let filtersHTML = ""
        

        const modalTemplate = `
        <div class="modal fade" id="`+idlookup+`" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">`+title+`</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-lookup">
                    <div class="container">
                        <div class="box box-primary">
                            <div class="box-header">
                                Filters:
                            </div>
                            <div class="box-body">
                                `+filtersHTML+`
                            </div>
                        <div>
                        <table class="table table-bordered table-striped" id='table-`+idlookup+`'>
                            <thead>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>                    
                </div>
                <div class="modal-footer">
                    `+buttonSaveAndClose+`
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
        `

        $("body").append(modalTemplate)

        if (!$.fn.customLookup[idlookup].autoClose) {
            $("#"+idButtonSaveAndClose).click(() => {
                $.fn.saveLookup(idlookup)
                $("#" + idlookup).modal("hide")
            })
        }

        for (let i = 0; i < filters.length; i ++) {
            const filterPlace = $("#" + idlookup + " .box-body")
            let typeFilter = "text"
            let input
            let name = ""
            let className = "form-control"
            let title = ""
            const wrapInput = document.createElement('div')
            const labelInput = document.createElement('label')

            if (filters[i].type != undefined) {
                typeFilter = filters[i].type
            }

            if (filters[i].className != undefined) {
                className = filters[i].className
            }

            if (filters[i].name != undefined) {
                title = filters[i].name
                name = idlookup + '-' + filters[i].name
            }

            if (filters[i].title != undefined) {
                title = filters[i].title
            }

            switch (typeFilter) {
                case 'text':
                    input = document.createElement("input")                    
                    break;
                case 'select2':
                    // it like select but configured with select2
                    if (filters[i].select2config == undefined) {
                        console.error('select2Configuration is required when using select2 type input')
                        return
                    }

                    input = document.createElement("select")                   
                    break;
            
                default:
                    input = document.createElement("input")
                    break;
            }            

            input.name = name
            input.id = 'input-' + name
            input.className = className    
                  

            labelInput.innerText = title
            
            wrapInput.className = "form-group"
            wrapInput.appendChild(labelInput)
            wrapInput.appendChild(input)

            filterPlace.append(wrapInput.outerHTML)   
            
            $("[name="+idlookup+"-"+filters[i].name+"]")[0].addEventListener('keyup', () => {
                $("#table-" + idlookup).DataTable().ajax.reload()
            })  

            if (filters[i].type == 'select2') {               
                $("#" + input.id).select2(filters[i].select2config)
                $("#" + input.id).find('option').remove()

                $("#" + input.id).on('change', () => {
                    $("#table-" + idlookup).DataTable().ajax.reload()
                })

                if(filters[i].select2config.custom != undefined) {
                    if(filters[i].select2config.custom.select != undefined && typeof filters[i].select2config.custom.select == 'function') {
                        $("#" + input.id).on('select2:select', filters[i].select2config.custom.select)
                    }  
                    
                    if(filters[i].select2config.custom.change != undefined && typeof filters[i].select2config.custom.change == 'function') {
                        $("#" + input.id).on('change', filters[i].select2config.custom.change)
                    }  
                }
            }
        }

        if (config.ajax != undefined) {
            config.ajax.data = (d) => {
                d['search-lookup'] = {}
                for (let i = 0; i < filters.length; i ++) {
                    if (filters[i].type == "select2") {
                        let defaultValueField = "id"

                        if(filters[i].select2config == undefined) {
                            console.error('select2Configuration is required when using select2 type input')                            
                        }

                        if(filters[i].select2config.custom != undefined) {
                            if(filters[i].select2config.custom.valueField != undefined) {
                                defaultValueField = filters[i].select2config.custom.valueField                           
                            }            
                        }

                        d['search-lookup'][filters[i].name] = {
                            operator: '=',
                            value: $("[name="+idlookup+"-"+filters[i].name+"]").select2('data')[0] == undefined ? null : $("[name="+idlookup+"-"+filters[i].name+"]").select2('data')[0][defaultValueField]
                        }
                    } else {
                        d['search-lookup'][filters[i].name] = {
                            value: $("[name="+idlookup+"-"+filters[i].name+"]").val(),
                            operator: '~*'
                        }
                    }                    
                    
                }

                return d
            }
        }

        $("#table-" + idlookup).DataTable(config)
    },
    LookupTable: function(config) {
        this.setValAjax = (url) => {
            const promise = new Promise((resolve, reject) => {
                this.each(() => {
                    for( let i = 0 ; i < this.length; i ++ ) {
                        const recentConfig = $.fn.cacheLookupConfig[this[i]]
                        let data = {}                            
                        
                        data[recentConfig.DataTable.custom.valueField] = $("[name="+data[recentConfig.DataTable.custom.maskid]+"]").val()
                        
                        $.ajax({
                            method: "GET",
                            dataType: "json",
                            data: data,
                            url: url
                        }).then((d) => {
                            resolve(d.data)
                            if (d.data != null) {                   
                                $("[name="+recentConfig.DataTable.customLookup.realid+"]").val(d.data[recentConfig.DataTable.custom.valueField])
                                $("[name="+recentConfig.DataTable.customLookup.maskid+"]").val(d.data[recentConfig.DataTable.custom.textField])
    
                                $.fn.selectedIdLookup[recentConfig.DataTable.id] = d.data[recentConfig.DataTable.custom.valueField]
    
                                $("#table-" + recentConfig.DataTable.id).DataTable().draw()                                
                                
                            } else {
                            }
                            
                            
                        })
                    }
                })
            })
            

            return promise
        }

        this.invokeEvent = {
            select: (url) => {
                this.each(() => {
                    for( let i = 0 ; i < this.length; i ++ ) {
                        const recentConfig = $.fn.cacheLookupConfig[this[i]]
                        let data = {}                            
                    }
                })
            }
        }

        return this.each(() => {
            for( let i = 0 ; i < this.length; i ++ ) {
                const currEle = this[i]        
                if (config == undefined) {                
                    return                     
                }
                                                       
                const idElement = currEle.id + i +"-wrap-lookup"
                const inputNameElement = currEle.name
                const currSource = $.fn.generatedLookup + "-lookup-input"

                currEle.setAttribute('data-source', currSource)
                currEle.style.display = "none"
                currEle.outerHTML = "<span id='"+idElement+"'>" + currEle.outerHTML + "</span>"
                                                
                const maskEle = currEle
                const inputNameElementMask = currEle.name + "-mask"
                maskEle.name = inputNameElementMask
                maskEle.style.display = "block"
                maskEle.className = "form-control width-80"
                maskEle.disabled = true
                maskEle.setAttribute('data-target', currSource)

                let configDataTable = config.DataTable

                let customLookup = {
                    maskid: inputNameElementMask,
                    realid: inputNameElement,
                    autoClose: false,   
                    typeInput: 'radio',
                    textField: 'text',
                    valueField: 'value'               
                }

                if (configDataTable.custom != undefined){
                    configDataTable.customLookup = {...customLookup, ...configDataTable.custom}
                } else {
                    configDataTable.customLookup = customLookup
                }

                if (configDataTable.id == undefined) {
                    configDataTable.id = "modal-" + currSource
                } 

                

                $.fn.CreateModalLookup(configDataTable)

                // icon button
                let iconButton = document.createElement("i")
                iconButton.className += "fa fa-search"

                // button search
                let buttonSearch = document.createElement("span")
                buttonSearch.className += "btn btn-default"
                buttonSearch.appendChild(iconButton)
                buttonSearch.addEventListener('click', function() {
                    $("#modal-" + currSource).modal('show')
                })

                let wrapInsideMask = document.createElement("div")
                wrapInsideMask.className += 'lookup-100'
                wrapInsideMask.appendChild(maskEle)
                wrapInsideMask.appendChild(buttonSearch)

                let wrapElement = document.getElementById(idElement)
                wrapElement.className += ' lookup-100'
                wrapElement.appendChild(wrapInsideMask)

                config.DataTable = configDataTable
                $.fn.cacheLookupConfig[currEle] = config 
                $.fn.generatedLookup++;
                

                if (configDataTable.customLookup.change != null && typeof configDataTable.customLookup.change == "function") {
                    $("[name="+configDataTable.customLookup.maskid+"]").change(() => {
                        configDataTable.customLookup.change($.fn.customLookup[idlookupParam].select($.fn.datasourceLookup[$.fn.selectedIdLookup[idlookupParam]]))
                    })
                }
            }            
        })
    }
})