var App = {
    Constant: {
        MimeOffice: "application/pdf|application/msword|application/msword|application/vnd.ms-excel"
    },
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

function uuidv4() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
      var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
      return v.toString(16);
    });
}

function IDGenerator() {
	 
    this.length = 50;
    this.timestamp = +new Date;
    
    var _getRandomInt = function( min, max ) {
       return Math.floor( Math.random() * ( max - min + 1 ) ) + min;
    }
    
    this.generate = function() {
        var ts = this.timestamp.toString();
        var parts = ts.split( "" ).reverse();
        var id = "";
        
        for( var i = 0; i < this.length; ++i ) {
           var index = _getRandomInt( 0, parts.length - 1 );
           id += parts[index];	 
        }
        
        return id;
    }

    
}

function readURL(file, containerToShow) {
    if (file) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        containerToShow.attr('src', e.target.result);
      }
      
      reader.readAsDataURL(file);
    }
}


function clone(obj) {
    if (null == obj || "object" != typeof obj) return obj;
    var copy = obj.constructor();
    for (var attr in obj) {
        if (obj.hasOwnProperty(attr)) copy[attr] = obj[attr];
    }
    return copy;
}

function isPromise(object){
    if(Promise && Promise.resolve){
      return Promise.resolve(object) == object;
    }else{
      throw "Promise not supported in your environment"
    }
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
    const iconFontAwesome = {
        "application/pdf": "fa fa-pdf",
        "application/msword": "fa fa-word",
        "image/.*": "fa fa-picture-o",
        ".*": "fa fa-file"
    }

    const classEnablePreview = "data-on-preview"

    const refreshDataTable = (items) => {
        $(`#${tableId}`).DataTable().clear();
        $(`#${tableId}`).DataTable().rows.add(items);
        $(`#${tableId}`).DataTable().draw();        
    }   

    const previewFile = (full) => {
        const fontKeys = Object.keys(iconFontAwesome)
        for (let i = 0; i < fontKeys.length ; i++) {
            if (full.type.match(new RegExp(fontKeys[i]))) {
                previewImage = ""
                if (fontKeys[i] == "image/.*") {
                    previewImage = classEnablePreview
                } 
                return `class="${iconFontAwesome[fontKeys[i]]}" ${previewImage} data-uid="${full.uid}"`
            }
        }
        
    }
    
    this.rawFiles = []     
    this.fileList = new quantumArray([])
    this.fileList.subscriber = function(newValue) {        
        refreshDataTable(newValue)        
    }
    this.checkedRow = new quantumArray()
    this.isEdit = false
    const self = this        

    let defaultConfig = {
        title: '',
        accept: "image/*|application/*",
        maxSize: 5000000
    }

    if (config != null) {
        defaultConfig = Object.assign(defaultConfig, config)
    }
    
    
    const modalContent = `<div class="modal fade" id="${modalId}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class='form-group'>
                    <label>
                        Dokumen
                    </label>
                    <input type='file' accept="${defaultConfig.accept}" id="${fileTempId}"  class='form-control' />
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

    const modalIdPreview = `modal-file-gallery-preview-${FileGalleryGenerated}`
    const containerPreviewImage = `file-gallery-preview-container${FileGalleryGenerated}`

    const modalPreview = `<div class="modal fade" id="${modalIdPreview}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src=""  id="${containerPreviewImage}"/>
            </div>
            <div class="modal-footer">            
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
        </div>
    </div>`

    $('body').append(modalContent)
    $('body').append(modalPreview)


    $(`#${fileTempId}`).change((e) => {       
        element.dispatchEvent(new Event("change"));
    })

    $(`#${buttonSaveId}`).click((e) => {
        temp = {}

        let file = $(`#${fileTempId}`)[0].files[0]

        if (!file.type.match(new RegExp(defaultConfig.accept))) {
            swal.fire({
                type: 'error',
                text: 'type file tidak diperbolehkan'
            })
            return
        }

        if (file.size > defaultConfig.maxSize) {
            swal.fire({
                type: 'error',
                text: `Ukuran file melebihi ukuran maksimal ${(defaultConfig.maxSize/1000000).toFixed(1)} MB`
            })
            return
        }

        if (file == undefined && !self.isEdit) {
            swal.fire({
                type: 'error',
                text: 'file tidak boleh kosong'
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
                keterangan:  $(`#${ketTempId}`).val() == null ? "" : $(`#${ketTempId}`).val(),
                uid: new IDGenerator().generate()
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

            self.checkedRow()[0] = self.fileList()[index]
        }

        refreshDataTable(self.fileList())

        $(`#${fileTempId}`).val(null)

        $(`#${modalId}`).modal('hide')
    })

    

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
        $(`#${ketTempId}`).val(null)
        $(`#${fileTempId}`).val(null)
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

        const deleteFunc = () => {
            cloneFileList = clone(self.fileList())
            for (let i = 0 ; i < self.checkedRow().length ; i ++) {
                let checked = self.checkedRow()[i]
    
                cloneFileList.splice(cloneFileList.map((d) => {
                    return d.uid
                }).indexOf(checked.uid), 1)
            }

            Swal.fire(
                'Terhapus!',
                'File telah berhasil dihapus!',
                'success'
            )
    
            self.fileList(cloneFileList)
            self.checkedRow([])
        }

        Swal.fire({
            title: 'Anda yakin?',
            text: "Anda tidak akan bisa mengembalikan file yang telah terhapus",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus!'
          }).then((result) => {
            if (result.value) {
                if (defaultConfig.onDelete != undefined) {
                    const returnOnDelete = defaultConfig.onDelete(self.checkedRow())
        
                    if (isPromise(returnOnDelete)) {
                        returnOnDelete.then((resp) => {
                            if (resp) // true then delete on grid
                                deleteFunc()
                        }) 
                    } else if (returnOnDelete) {
                        deleteFunc()
                    }
                } else {
                    deleteFunc()
                }              
            }
          })
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
            {title: `Preview`, "render": function ( data, type, full, meta ) {
                return `<i ${previewFile(full)}></i>`
            }},
            {title: `<input type='checkbox' class='${checkBoxClassAll}' />`, "render": function ( data, type, full, meta ) {
                const typeInput = 'checkbox'
                const checked = self.checkedRow().find((d) => {
                    return d.uid == full.uid
                })
                return `<input type='${typeInput}' ${checked != undefined ? 'checked' : ''} value='1' data-uid='${full.uid}' class='${checkBoxClass}' />`;
            }},
            
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

            $(`[${classEnablePreview}]`).click((ev) => {
                const uid = ev.target.getAttribute('data-uid')
                selectedFile = self.fileList().find((file) => {
                    return file.uid == uid
                })

                if (selectedFile.path != undefined) {
                    $(`#${containerPreviewImage}`)[0].src = $("[base-path]").val().replace("public", "storage/") + "app/" + selectedFile.path
                    $(`#${modalIdPreview}`).modal('show')
                } else {
                    readURL(selectedFile.rawFile, $(`#${containerPreviewImage}`))
                    $(`#${modalIdPreview}`).modal('show')
                }

            })
        }
    })

    $(`.${checkBoxClassAll}`).click((ev) => {
        $(`.${checkBoxClass}`).prop('checked', ev.currentTarget.checked)
        $(`.${checkBoxClass}`).trigger('change')
    })

    FileGalleryGenerated++

}

let GoogleMapInputIncrement = 1;
let GoogleMapInput = function(element, config) {
    const GoogleMapInputCurrentInc = GoogleMapInputIncrement
    const self = this

    GoogleMapInputIncrement++

    if (element == undefined) {
        console.error('Error when rendering GoogleMapInput');
        return false;
    }

    if (element.length > 0) {
        element = element[0]        
    }

    if (!navigator.geolocation) {
        console.error('Geolocation not supported on this browser!')
        return false
    }

    this.defaultConfig = {
        autoClose: true,
        draw: false,
        drawOptions: [
            'Polygon',
            'Line'
        ]
    }

    let position

    navigator.geolocation.getCurrentPosition((pos) => {
        position = pos

    })

    if  (config != null) {
        self.defaultConfig = Object.assign(self.defaultConfig, config)
    }

    

    new Promise((resolve, reject) => {
        let TIMEOUT = 10
        let intervalTicking = setInterval(function() {
            if (TIMEOUT < 0) {
                console.error('Oopss please include google map apis javascript')
                reject(false)
                clearInterval(intervalTicking)                
            }
            if (ol != undefined) {
                resolve(true)
                clearInterval(intervalTicking)
            }
            TIMEOUT--
        },1000)
        
    }).then(() => {
        element.style.display = "none"

        

        const containerInputGroup = document.createElement('div')
        containerInputGroup.className = 'input-group'
    
        let inputMaskingElement

        if (!self.defaultConfig.draw) {
            inputMaskingElement = element.cloneNode(true)
            inputMaskingElement.style.display = 'block'
        } else {
            inputMaskingElement = document.createElement('textarea')
            inputMaskingElement.style.display = 'block'
        }
        
    
        const inputGroupAppend = document.createElement('div')
        inputGroupAppend.className = 'input-group-append'
    
        const inputGroupText = document.createElement('div')
        inputGroupText.className = 'input-group-text'
        
        const inputGroupTextButton = document.createElement('i')
        inputGroupTextButton.className = 'fa fa-globe'

        let selectOption = document.createElement('select')        
        for (let i = 0 ; i < self.defaultConfig.drawOptions.length; i ++ ) {
            var drawOption = document.createElement('option')
            drawOption.appendChild(document.createTextNode(self.defaultConfig.drawOptions[i]))
            drawOption.value = self.defaultConfig.drawOptions[i]
            selectOption.appendChild(drawOption)
        }

        if (!self.defaultConfig.draw) {                        
            selectOption = null           
        }
    
        this.marker
        this.markerVectorLayer
        this.draw
        this.lastFeature

        inputMaskingElement.disabled = true
    
        containerInputGroup.appendChild(inputMaskingElement)
        inputGroupText.appendChild(inputGroupTextButton)
        inputGroupAppend.appendChild(inputGroupText)
        containerInputGroup.appendChild(inputGroupAppend)
        

        const addInteraction = function() {
            var value = selectOption.value;
            if (value !== 'None') {
              self.draw = new ol.interaction.Draw({
                source: source,
                type: value
              });

              self.draw.on('drawstart', function(ev) {

                if (self.lastFeature)
                     source.removeFeature(self.lastFeature);

              })

              self.draw.on('drawend', function(ev) {

                ev.feature.setId(new IDGenerator().generate());
                
                self.lastFeature = ev.feature

                let format = new ol.format['GeoJSON']()

                setTimeout(() => {
                    let data = format.writeFeatures(vector.getSource().getFeatures())

                    inputMaskingElement.value = JSON.stringify(data, null, 4)
                    inputMaskingElement.dispatchEvent(new Event('change'))
                },1000)
                

              })
              self.map.addInteraction(self.draw);
            }
        }

        const createLayer = (LonLat) => {
            self.marker = new ol.Feature({
                geometry: new ol.geom.Point(
                  ol.proj.fromLonLat([parseFloat(LonLat[0]),parseFloat(LonLat[1])])
                ),  // Cordinates of New York's Town Hall
            });


            source.addFeature(self.marker)
        }
    
        inputGroupText.addEventListener('click', (ev) => {            
            $(`#${modalIdGoogleMap}`).modal('show')
        })        

        inputMaskingElement.addEventListener('change', (ev) => {
            element.value = ev.target.value
            element.dispatchEvent(new Event('change'))
        })
    
        
        const mapId = `google-map-${GoogleMapInputCurrentInc}`
        const modalIdGoogleMap = `google-map-id-${GoogleMapInputCurrentInc}`
        
        const modalMapPicker = `<div class="modal fade" id="${modalIdGoogleMap}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">     
                    <div id='${mapId}' style='width:100%; height:300px'>
                    </div>           
                    ${selectOption != null ? selectOption.outerHTML : ''}
                </div>
                <div class="modal-footer">            
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
            </div>
        </div>`
        
        $('body').append(modalMapPicker)


        $(`#${modalIdGoogleMap}`).on('shown.bs.modal', function () {
            self.map.updateSize();

            if (element.value != "" && element.value != null && !self.defaultConfig.draw) {
                let splittedValue = element.value.split(",")
                if (splittedValue.length < 2) {
                    console.error("doesn't support fomat value!")
                    return;
                }
                
                self.map.setView(
                    new ol.View({
                        center: ol.proj.fromLonLat([parseFloat(splittedValue[0]), parseFloat(splittedValue[1])]),                         
                        zoom: 12
                    })
                );

                if (self.marker != null) {
                    source.removeFeature(self.marker)
                }
                createLayer(splittedValue)
            } else if (element.value != "" && element.value != null) {
                // if (self.marker != null) {
                //     source.removeFeature(self.marker)
                // }

                let values = JSON.parse(element.value);
                if (typeof values != 'object') 
                    values = JSON.parse(values)
                let coordinatesDraws = []
                let currentCoord = values.features[0].geometry.coordinates[0]
                for (let n = 0; n < currentCoord.length; n ++) {
                    coordinatesDraws.push(ol.proj.transform(currentCoord[n], 'EPSG:4326', 'EPSG:3857'))
                }
                let things = new ol.geom.Polygon(
                    [ values.features[0].geometry.coordinates[0].concat([values.features[0].geometry.coordinates[0][0]]) ]
                )
                self.lastFeature = new ol.Feature({
                    geometry: things
                })
                source.addFeature(self.lastFeature)
            }
        })

        let raster =  new ol.layer.Tile({
            source: new ol.source.OSM()
        })
    
        let source = new ol.source.Vector({wrapX: false});
    
        let vector = new ol.layer.Vector({
            source: source
        });

        this.loadMap = () => {
            $("#mapId").html('')

            let mapConfig = {
                target: mapId,
                layers: [
                  raster, vector
                ],
                view: new ol.View({
                  center: ol.proj.fromLonLat([position.coords.longitude, position.coords.latitude]),
                  zoom: 12
                })
            }
        
            self.map =  new ol.Map(mapConfig);
    
            if (!self.defaultConfig.draw) {
                self.map.on('click', (ev) => {
                    const coord = ol.proj.transform(ev.coordinate, 'EPSG:3857', 'EPSG:4326');
                    inputMaskingElement.value = `${coord[0]},${coord[1]}`
                    inputMaskingElement.dispatchEvent(new Event('change'))
        
                    if (self.defaultConfig.autoClose) {
                        $(`#${modalIdGoogleMap}`).modal('hide')
                    }
                })
            } else {
                addInteraction()
            }
        }

        self.loadMap();

        element.parentNode.insertBefore(containerInputGroup, element.nextSibling)
    })
}

const __ajax = (config) => {
   
    const promise = new Promise((resolve,reject) => {
        let anoErrorFunc = () => {}
        
        if (config.error != undefined) {
            anoErrorFunc = config.error            
        }

        config.error = (xmlHttpError, textStatus, errorThrown) => {
            anoErrorFunc(textStatus)  
            reject(textStatus)       
            
            swal.fire({
                type: 'error',
                title: textStatus,
                text: JSON.parse(xmlHttpError.responseText).message,
            })
        }

        $.ajax(config).then((d) => {
            resolve(d.data)
        })
    })

    return promise
}


