let inlineDatepicker = function(element, config) {

    const self = this

    this.isReady = false

    defaultConfig = {
        format: 'YYYY/MM/DD',
        minYear: 1970,
        maxYear: new Date().getFullYear(),
        formatDefault: 'DD/MM/YYYY',
        buttonClear: false,
        readonly: {

        }
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
        'November',
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

    if (config.readonly && config.readonly.hasOwnProperty('yearPicker')) {
        yearPicker.setAttribute('disabled', 'disabled')
    }

    if (config.readonly && config.readonly.hasOwnProperty('monthPicker')) {
        monthPicker.setAttribute('disabled', 'disabled')
    }

    if (config.readonly && config.readonly.hasOwnProperty('dayPicker')) {
        dayPicker.setAttribute('disabled', 'disabled')
    }

    this.config = defaultConfig;

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
        for(let yearStart = defaultConfig.minYear; yearStart <= defaultConfig.maxYear; yearStart++) {
            const yearOption = document.createElement('option')
            yearOption.appendChild( document.createTextNode(yearStart) );
            yearOption.value = yearStart;

            if (defaultConfig.maxYear == yearStart) {
                yearOption.setAttribute('selected', true)
            }

            yearSelectElement.appendChild(yearOption)
        }
    }

    const pad2 = function(number) {
        return (number < 10 ? '0' : '') + number
    }

    this.value = () => {
        return element.value
    }

    this.setValue = (value) => {
        const momentDate = moment(value, self.config.format);
        yearPicker.value = momentDate.year()
        monthPicker.value = parseInt(momentDate.month()+1)
        dayPicker.value = momentDate.date()
        self.creatingResult(true);
    }

    this.creatingResult = (poke) => {
        let stringValue = moment(yearPicker.value + "/" + monthPicker.value + "/" + dayPicker.value, "YYYY/MM/DD").format(defaultConfig.format)

        element.value = stringValue

        element.setAttribute('value', stringValue)

        if (poke != null) {
            return
        }


        element.dispatchEvent(new Event('change'))
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
                yearPicker.value = defaultConfig.minYear
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

        self.creatingResult()
    })

    monthPicker.addEventListener('change', (ev) => {
        dayPopulate(dayPicker)

        self.creatingResult()
    })

    dayPicker.addEventListener('change', (ev) => {
        self.creatingResult()
    })

    element.addEventListener('change', (ev) => {

        if(ev.target.value != "")
            showValue(ev.target.value)
    })

    buildingUi(element)

    const showValue = (defaultValue) => {
        let value = element.value

        let DateEle = new Date()

        if (defaultValue != null) {
            value = defaultValue
        }

        if (value != null && value != "" ) {
            DateEle = moment(value,defaultConfig.formatDefault).toDate()
        }

        yearPicker.value = self.isReady || value != "" ? DateEle.getFullYear() : defaultConfig.maxYear
        monthPicker.value = DateEle.getMonth() + 1
        dayPicker.value = DateEle.getDate()

        if (!self.isReady) {
            self.isReady = true
        }

    }

    showValue()

    self.creatingResult()

    console.log(self)
    return self;
}
