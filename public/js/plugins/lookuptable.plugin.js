let lookupTableCounter = 0
let lookupTable = function(selector, config) {  
    
    this.defaultConfig = {
        id: 'datatable-lookup-' + lookupTableCounter,
        dataTableOption: {},
        dataFieldValue: 'text',
        dataFieldLabel: 'id',
        value: [],
        multiple: true,
        placeholder: 'Silahkan pilih'
    }

    let self = this

    this.selectedValues = []

    if (config != null) {
        this.defaultConfig = {...this.defaultConfig, ...config}
    }

    lookupTableCounter++

    let wrapperMask = document.createElement('div')
    wrapperMask.className = 'input-group'

    let addOns = document.createElement('div')
    addOns.className = 'input-group-append'

    let addOnsIcon = document.createElement('span')
    addOnsIcon.className = 'input-group-text fa fa-search'    

    let inputMask = selector.cloneNode(true)    

    this.dispayValuesWrapper = document.createElement('div')
    this.dispayValuesWrapper.className = 'lookup-values-wrapper'

    this.dispayValues = document.createElement('div')
    this.dispayValues.className = ''
    this.dispayValues.innerText = self.defaultConfig.placeholder
    selector.style.display = 'none'

    this.caretDown = document.createElement('i')
    this.caretDown.className = 'fa fa-caret-down pull-right'

    addOns.appendChild(addOnsIcon)

    this.dispayValuesWrapper.appendChild(this.dispayValues)
    this.dispayValuesWrapper.appendChild(this.caretDown)

    wrapperMask.appendChild(this.dispayValuesWrapper)
    // wrapperMask.appendChild(addOns)

    let table = document.createElement('table')
    table.className = 'table table-striped table-bordered'
    table.id = this.defaultConfig.id

    let tableTHEAD = document.createElement('thead')

    table.appendChild(tableTHEAD)

    // methods
    this.setToInput = (values) => {
        selector.value = values.join(',')
    }

    this.setToInputMask = (values) => {
        self.dispayValues.innerHTML = ''

        if (values.length <= 0) {
            self.dispayValues.innerHTML = self.defaultConfig.placeholder
        }
        for(let i = 0; i < values.length ; i ++) {
            let tag = document.createElement('div')
            tag.className = 'tag'
            tag.innerText = values[i][self.defaultConfig.dataFieldLabel]

            let iconTimes = document.createElement('i')
            iconTimes.className = 'fa fa-times ml-3'
            iconTimes.dataset.id = values[i][self.defaultConfig.dataFieldValue]

            tag.appendChild(iconTimes)

            iconTimes.addEventListener('click', (e) => {
                e.stopPropagation()

                self.selectedValues = self.selectedValues.filter((d) => {                    
                    return d[self.defaultConfig.dataFieldValue] != e.target.dataset.id
                })

                self.setToInput(self.selectedValues.map(d => d[self.defaultConfig.dataFieldValue]))
                self.setToInputMask(self.selectedValues)

            })

            self.dispayValues.appendChild(tag)
        }        
    }

    this.selectedManually = () => {
        self.tabelDt.rows( '.selected' )
        .nodes()
        .to$() 
        .removeClass( 'selected' );
        let allValues = self.tabelDt.rows().data().toArray()
        for(var i=0; i<allValues.length; ++i) {
            for(var j=0; j<self.selectedValues.length; ++j) {
                let valueCompare = self.selectedValues[j][self.defaultConfig.dataFieldValue]
                if (Number.isInteger(valueCompare)) {
                    valueCompare = valueCompare.toString()
                }   
                if(allValues[i][self.defaultConfig.dataFieldValue] == valueCompare) {                                        
                    self.tabelDt.row(`:eq(${i})`, { page: 'current' }).select();
                }                
            }            
        }
    }

    this.setDefault = (d) => {
        self.setValues(d, () => {
            self.setToInput(self.selectedValues.map(d => d[self.defaultConfig.dataFieldValue]))
            self.setToInputMask(self.selectedValues)
            self.selectedManually()
        })
    }


    this.setValues = (newValues, callback) => {
        

        if (!Array.isArray(newValues) && newValues != null) {
            newValues = [newValues]
        }

        if (newValues == null) {
            self.selectedValues = []
        } else if (self.defaultConfig.multiple) {
            self.selectedValues = self.selectedValues.concat(newValues)
        } else {
            if (self.selectedValues.length > 0) {
                if (newValues.length <= 0 && !self.tabelDt.rows().data().toArray().find((d) => {
                    d[self.defaultConfig.dataFieldValue] == self.selectedValues[0][self.defaultConfig.dataFieldValue]
                })) {
                    // do nothing
                    return
                } else {
                    self.selectedValues = newValues
                }
            } else {
                self.selectedValues = newValues
            }
            
        }
        
        for(var i=0; i<self.selectedValues.length; ++i) {
            for(var j=i+1; j<self.selectedValues.length; ++j) {
                let valueCompare = self.selectedValues[j][self.defaultConfig.dataFieldValue]
                if (Number.isInteger(valueCompare)) {
                    valueCompare = valueCompare.toString()
                }          
                if(self.selectedValues[i][self.defaultConfig.dataFieldValue] == valueCompare)
                    self.selectedValues.splice(j--, 1);
            }
        }

        if (callback != undefined && typeof callback == 'function') {
            callback()
        }
        
    }

    let modalId = `modal-${this.defaultConfig.id}`

    let modalHTML = `<div class="modal fade" id="${modalId}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                ${table.outerHTML}
            </div>
            <div class="modal-footer">            
                <button type="button" class="btn btn-secondary" data-save>Pilih</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
        </div>
    </div>`

    $('body').append(modalHTML)
    // init datatable
    this.tabelDt = $(`#${this.defaultConfig.id}`).DataTable(this.defaultConfig.dataTableOption)

    $(`table#${this.defaultConfig.id}`).on( 'page.dt', function () {
        self.setValues(self.tabelDt.rows('.selected').data().toArray())             
    } );

    $(`table#${this.defaultConfig.id}`).on( 'draw.dt', function () {
        self.selectedManually()   
    } );

    this.dispayValuesWrapper.addEventListener('click', (e) => {
        $(`#${modalId}`).modal('show')        
        self.selectedManually()   
    })    

    $(`#${modalId} [data-save]`).click(() => {
        self.setValues(self.tabelDt.rows('.selected').data().toArray(), () => {
            self.setToInput(self.selectedValues.map(d => d[self.defaultConfig.dataFieldValue]))
            self.setToInputMask(self.selectedValues)
        })
        $(`#${modalId}`).modal('hide')
    })
    

    selector.parentNode.insertBefore(wrapperMask, selector.nextSibling)
}       