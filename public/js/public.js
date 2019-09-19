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
            let funcData = null
            if (config.ajax.data != undefined) {
                funcData = config.ajax.data
            }
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

                if (typeof funcData == 'function') {
                    return funcData(d)
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


var inlineDatepicker = function(element, config) {

    defaultConfig = {
        format: 'YYYY-MM-DD',
        startYear: 2010,
        formatDefault: 'DD/MM/YYYY',
        buttonClear: false
    }

    const monthNames = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'Desember'
    ]

    if (config != null) {
        defaultConfig = {...defaultConfig, ...config}
    }
    
    const wrapperElement  = document.createElement('div')
    wrapperElement.className = 'row col-md-12'

    let classAtItem = 'col-md-4 no-padding'

    if (defaultConfig.buttonClear) {
        classAtItem = 'col-md-3 no-padding'
    }

    const wrapperInputElementTemplate = document.createElement('div')
    wrapperInputElementTemplate.className = classAtItem

    const yearPicker = document.createElement('select')
    yearPicker.className = 'form-control'

    const monthPicker = yearPicker.cloneNode(true)

    const dayPicker = yearPicker.cloneNode(true)    

    const dayPopulate = (daySelectElement) => {
        const saveRecentDayPicked = daySelectElement.value;

        daySelectElement.innerHTML = ''        

        const maxDateInYearAndMonth = new Date(yearPicker.value, monthPicker.value, 0).getDate()

        for(let dayStart = 1; dayStart <= maxDateInYearAndMonth; dayStart++) {
            const dayOption = document.createElement('option')
            dayOption.appendChild( document.createTextNode(dayStart) );
            dayOption.value = dayStart;

            daySelectElement.appendChild(dayOption)
        }

        if (saveRecentDayPicked > maxDateInYearAndMonth) {
            daySelectElement.value = 1
        } else {
            daySelectElement.value = saveRecentDayPicked
        }
    }
    
    const monthPopulate = (monthSelectElement) => {
        for(let monthStart = 1; monthStart <= 12; monthStart++) {
            const monthOption = document.createElement('option')
            monthOption.appendChild( document.createTextNode(monthNames[monthStart - 1]) );
            monthOption.value = monthStart;

            monthSelectElement.appendChild(monthOption)
        }
    }

    const yearPopulate = (yearSelectElement) => {
        for(let yearStart = defaultConfig.startYear; yearStart <= new Date().getFullYear(); yearStart++) {
            const yearOption = document.createElement('option')
            yearOption.appendChild( document.createTextNode(yearStart) );
            yearOption.value = yearStart;

            yearSelectElement.appendChild(yearOption)
        }
    }

    const pad2 = function(number) {
        return (number < 10 ? '0' : '') + number
    }

    const creatingResult = () => {
        let stringValue = moment(yearPicker.value + "-" + monthPicker.value + "-" + dayPicker.value, "YYYY-MM-DD").format(defaultConfig.format)

        element.value = stringValue

        element.setAttribute('value', stringValue)
    }

    const attributeJson = function(element) {
        jsonOutput = {}
        for(var i = attrs.length - 1; i >= 0; i--) {
            jsonOutput[attrs[i].name] = attrs[i].value;
        }

        return jsonOutput
    }
    
    const buildingUi = function(elementUi) {
        elementUi.style.display = 'none';        
        
        // create 4 warpperInputElement
        const wrapperInputYear = wrapperInputElementTemplate.cloneNode(true)
        const wrapperInputMonth = wrapperInputElementTemplate.cloneNode(true)
        const wrapperInputDay = wrapperInputElementTemplate.cloneNode(true)
        let wrapperButtonClear = null;

        if (defaultConfig.buttonClear) {
            wrapperButtonClear = wrapperInputElementTemplate.cloneNode(true)
        }

        wrapperInputYear.appendChild(yearPicker)
        wrapperInputMonth.appendChild(monthPicker)
        wrapperInputDay.appendChild(dayPicker)

        if (defaultConfig.buttonClear) {
            const buttonClear = document.createElement('div')
            buttonClear.className = 'btn btn-default'
            buttonClear.textContent = 'Clear'
            buttonClear.addEventListener('click', (ev) => {
                yearPicker.value = defaultConfig.startYear
                monthPicker.value = 1
                dayPicker.value = 1
            })

            wrapperButtonClear.appendChild(buttonClear)
        }

        yearPopulate(yearPicker)
        monthPopulate(monthPicker)
        dayPopulate(dayPicker)

        wrapperElement.appendChild(wrapperInputYear)
        wrapperElement.appendChild(wrapperInputMonth)
        wrapperElement.appendChild(wrapperInputDay)

        if (defaultConfig.buttonClear) {
            wrapperElement.appendChild(wrapperButtonClear)
        }
        
        elementUi.parentNode.insertBefore(wrapperElement,elementUi.nextSibling)
        elementUi.style.display = 'none';
    }

    if (element.length > 0) {
        element = element[0]        
    }

    // initialize event
    yearPicker.addEventListener('change', (ev) => {
        dayPopulate(dayPicker)

        creatingResult()
    })

    monthPicker.addEventListener('change', (ev) => {
        dayPopulate(dayPicker)

        creatingResult()
    })

    dayPicker.addEventListener('change', (ev) => {
        creatingResult()
    })

    let DateEle = new Date()
    if (element.value != null && element.value != "" ) {
        DateEle = moment(element.value,defaultConfig.formatDefault).toDate()
    }    

    buildingUi(element)

    yearPicker.value = DateEle.getFullYear()
    monthPicker.value = DateEle.getMonth() + 1
    dayPicker.value = DateEle.getDate()

    creatingResult()
}

function uuidv4() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
      var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
      return v.toString(16);
    });
}

function clone(obj) {
    if (null == obj || "object" != typeof obj) return obj;
    var copy = obj.constructor();
    for (var attr in obj) {
        if (obj.hasOwnProperty(attr)) copy[attr] = obj[attr];
    }
    return copy;
}

let quantumArray = function(defaultValue) {
    let valueLocal = []

    if (defaultValue != null) {
        valueLocal = defaultValue
    }

    this.changeListener = function(newValue) {        
    }

    const self = this

    return new Proxy(function(args) {
        if (args != null) {
            valueLocal = args
        }
        return valueLocal
    },{
        apply: function(target, thisArgs, argumentsList) {      

            if(argumentsList[0] != undefined && target() != argumentsList[0]) {
                target.apply(null, argumentsList)       
                self.changeListener(target())                          
            }                                  

            return target()
        },
        set: function(target, property, value) {                  
            if (property == 'subscriber' && typeof value == 'function') {
                self.changeListener = value
            }
        },
        construct: function(target, argArray) {

        }
    })
}

  
let FileGalleryGenerated = 0;
let FileGallery = function(element, config) {

    if (element == undefined || element.type != 'file') {
        console.error('only allowable for type file');
        return false;
    }

    if (element.length > 0) {
        element = element[0]        
    }  

    const tableId = `file-gallery-table-${FileGalleryGenerated}`
    const modalId = `modal-file-gallery-${FileGalleryGenerated}`
    const fileTempId = `file-gallery-temp-${FileGalleryGenerated}`
    const ketTempId = `file-gallery-keterangan-${FileGalleryGenerated}`
    const buttonSaveId = `file-gallery-button-${FileGalleryGenerated}`
    const checkBoxClass = `file-gallery-checkbox-${FileGalleryGenerated}`
    const checkBoxClassAll = `file-gallery-checkbox-${FileGalleryGenerated}-all`

    const refreshDataTable = (items) => {
        $(`#${tableId}`).DataTable().clear();
        $(`#${tableId}`).DataTable().rows.add(items);
        $(`#${tableId}`).DataTable().draw();        
    }   
    
    this.rawFiles = []     
    this.fileList = new quantumArray([])
    this.fileList.subscriber = function(newValue) {
        refreshDataTable(newValue)        
    }
    this.checkedRow = new quantumArray()
    this.isEdit = false
    const self = this

    const modalContent = `<div class="modal fade" id="${modalId}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <div class='form-group'>
                <label>
                    Dokumen
                </label>
                <input type='file' id="${fileTempId}"  class='form-control' />
            </div>
            <div class='form-group'>
                <label>
                    Keterangan
                </label>
                <textarea class='form-control' id='${ketTempId}' />
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="${buttonSaveId}">Simpan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>`

    $('body').append(modalContent)


    $(`#${fileTempId}`).change((e) => {       
        element.dispatchEvent(new Event("change"));
    })

    $(`#${buttonSaveId}`).click((e) => {
        temp = {}

        let file = $(`#${fileTempId}`)[0].files[0]

        if (file == undefined && !self.isEdit) {
            swal.fire({
                type: 'error',
                message: 'file tidak boleh kosong'
            })
        }

        if (!self.isEdit && $(`#${fileTempId}`)[0].files.length > 0) {            
            temp = {
                rawFile: file,
                lastModified: file.lastModified,
                lastModifiedDate: file.lastModifiedDate,
                name: file.name,
                size: file.size,
                type: file.type,
                keterangan:  $(`#${ketTempId}`).val(),
                uid: uuidv4()
            }

            self.fileList().push(temp)               
        } else {            
            let changeValue = {}
            const index = self.fileList().map((d) => {
                return d.uid
            }).indexOf(self.checkedRow()[0].uid)

            if (file != undefined) {
                changeValue = {
                    rawFile: file,
                    lastModified: file.lastModified,
                    lastModifiedDate: file.lastModifiedDate,
                    name: file.name,
                    size: file.size,
                    type: file.type,
                }
            }

            changeValue.keterangan = $(`#${ketTempId}`).val()

            self.fileList()[index] = {...self.fileList()[index], ...changeValue}
        }

        refreshDataTable(self.fileList())

        $(`#${fileTempId}`).val(null)

        $(`#${modalId}`).modal('hide')
    })

    defaultConfig = {
        title: ''
    }

    if (config != null) {
        defaultConfig = {...defaultConfig, ...config}
    }
  

    element.style.display = 'none';

    const tableEle = document.createElement('table')
    const tableHead = document.createElement('thead')
    const tableBody = document.createElement('tbody')


    const toolbars = document.createElement('div')
    toolbars.className = 'pull-right'

    const toolAdd = document.createElement('span')
    toolAdd.style.cursor = 'pointer'    
    const toolRemove = toolAdd.cloneNode(true)
    const toolEdit = toolAdd.cloneNode(true)
    
    toolAdd.addEventListener('click', () => {
        self.isEdit = false

        $(`#${modalId}`).modal('show')
    })

    toolEdit.addEventListener('click', () => {
        if (self.checkedRow().length != 1) {
            Swal.fire({
                type: 'info',
                text: 'Pilih 1 data',
            })
            return
        }

        self.isEdit = true

        $(`#${ketTempId}`).val(self.checkedRow()[0].keterangan)
        $(`#${modalId}`).modal('show')
        refreshDataTable(self.fileList())     
    })

    toolRemove.addEventListener('click', () => {

        cloneFileList = clone(self.fileList())
        
        for (let i = 0 ; i < self.checkedRow().length ; i ++) {
            let checked = self.checkedRow()[i]

            cloneFileList.splice(cloneFileList.map((d) => {
                return d.uid
            }).indexOf(checked.uid), 1)
        }

        self.fileList(cloneFileList)
        self.checkedRow([])
    })

    toolRemove.className = 'fa fa-trash mr-2'
    toolAdd.className = 'fa fa-plus mr-2'
    toolEdit.className = 'fa fa-edit mr-2'

    toolbars.appendChild(toolAdd)
    toolbars.appendChild(toolEdit)
    toolbars.appendChild(toolRemove)

    tableEle.id = tableId
    tableEle.className = 'table table-bordered table-striped'
    tableEle.style.width = '100%!important'

    tableEle.appendChild(tableHead)
    tableEle.appendChild(tableBody)

    const wrapperBox = document.createElement('div')
    wrapperBox.className = 'box box-primary'
    const wrapperBoxHeading = document.createElement('div')
    wrapperBoxHeading.className = 'box-header bg-blue'
    wrapperBoxHeading.textContent = defaultConfig.title
    const wrapperBoxBody = document.createElement('div')
    wrapperBoxBody.className = 'box box-body'

    wrapperBoxBody.appendChild(tableEle)
    wrapperBoxHeading.appendChild(toolbars)
    wrapperBox.appendChild(wrapperBoxHeading)
    wrapperBox.appendChild(wrapperBoxBody)

    element.parentNode.insertBefore(wrapperBox, element.nextSibling)

    $(`#${tableEle.id}`).DataTable({
        data: [],
        columns: [
            {data: 'name', title: 'Dokumen'},
            {data: 'keterangan', title: 'Keterangan'},
            {title: `<input type='checkbox' class='${checkBoxClassAll}' />`, "render": function ( data, type, full, meta ) {
                const typeInput = 'checkbox'
                const checked = self.checkedRow().find((d) => {
                    return d.uid == full.uid
                })
                return `<input type='${typeInput}' ${checked != undefined ? 'checked' : ''} value='1' data-uid='${full.uid}' class='${checkBoxClass}' />`;
            }}
        ],
        info:     false,
        bLengthChange: false,
        searching: false,
        ordering: false,
        drawCallback: () => {
            $(`.${checkBoxClass}`).change((ev) => {
                
                if (ev.currentTarget.checked) {
                    self.checkedRow().push(self.fileList().find((file) => {
                        return file.uid == ev.currentTarget.getAttribute('data-uid')
                    }))
                } else {
                    self.checkedRow().splice(self.checkedRow().map((d) => {
                        return d.uid
                    }).indexOf(ev.currentTarget.getAttribute('data-uid')), 1)            
                }        
            })
        }
    })

    

    $(`.${checkBoxClassAll}`).click((ev) => {
        $(`.${checkBoxClass}`).prop('checked', ev.currentTarget.checked)
    })

    FileGalleryGenerated++

}