let MapInputIncrement = 1;
let GoogleMapInput = function(element, config) {
    const MapInputCurrentInc = MapInputIncrement
    const self = this

    MapInputIncrement++

    // element could be map id or input element
    if (element == undefined) {
        console.error('Error when rendering MapInput');
        return false;
    }

    if (element.length > 0) {
        element = element[0]
    }

    let position = {
        coords: {
            latitude: -6.8638114,
            longitude: 106.4835186,
        }
    }

    if (!navigator.geolocation) {
        console.error('Geolocation not supported on this browser!')

    } else {
        navigator.geolocation.getCurrentPosition((pos) => {
            position = pos
        })
    }

    this.defaultConfig = {
        autoClose: true,
        draw: false,
        drawOptions: [
            'Polygon',
            'LineString'
        ],
        isNotInput: false,
        value: null,
        referFocus: null
    }

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


        this.marker
        this.markerVectorLayer
        this.draw
        this.lastFeature

        let addInteraction
        let inputMaskingElement

        let mapId = `ol-map-${MapInputCurrentInc}`
        const modalIdGoogleMap = `ol-map-id-${MapInputCurrentInc}`

        if (element.tagName != "INPUT" && !self.defaultConfig.isNotInput) {
            element.setAttribute('id', mapId)

            self.defaultConfig.isNotInput = true

            if (self.defaultConfig.value == null) {
                console.error("config value is required tag name of element doesn't input")
                return
            }
        }

        if (!self.defaultConfig.isNotInput) {

            element.style.display = "none"

            const containerInputGroup = document.createElement('div')
            containerInputGroup.className = 'input-group'



            if (!self.defaultConfig.draw) {
                inputMaskingElement = element.cloneNode(true)
                inputMaskingElement.style.display = 'block'
            } else {
                inputMaskingElement = document.createElement('textarea')
                inputMaskingElement.value = Object.keys(self.defaultConfig.value).length == 0 ? '' : self.defaultConfig.value;
                inputMaskingElement.style.display = 'block'
            }


            const inputGroupAppend = document.createElement('div')
            inputGroupAppend.className = 'input-group-append'

            const inputGroupText = document.createElement('div')
            inputGroupText.className = 'input-group-text'

            const inputGroupTextButton = document.createElement('i')
            inputGroupTextButton.className = 'fa fa-globe'

            let selectOption = document.createElement('select')

            let buttonSearchLatLon = document.createElement('div')

            buttonSearchLatLon.setAttribute('class', 'btn btn-success')
            buttonSearchLatLon.textContent = 'Search'



            let inputLatContainer = document.createElement('div')
            let labelInputLat = document.createElement('label')
            let inputLat = document.createElement('input')

            labelInputLat.textContent = 'Latitude'

            inputLatContainer.setAttribute('class', 'form-group')

            inputLat.setAttribute('id', `input-lat-${mapId}`)
            inputLat.setAttribute('class', `form-control`)

            inputLatContainer.appendChild(labelInputLat)
            inputLatContainer.appendChild(inputLat)


            let inputLonContainer = document.createElement('div')
            let labelInputLon = document.createElement('label')
            let inputLon = document.createElement('input')

            labelInputLon.textContent = 'Longitude'

            inputLonContainer.setAttribute('class', 'form-group')

            inputLon.setAttribute('id', `input-lon-${mapId}`)
            inputLon.setAttribute('class', `form-control`)

            inputLonContainer.appendChild(labelInputLon)
            inputLonContainer.appendChild(inputLon)

            selectOption.setAttribute('id', `select-${mapId}`)
            for (let i = 0 ; i < self.defaultConfig.drawOptions.length; i ++ ) {
                var drawOption = document.createElement('option')
                drawOption.appendChild(document.createTextNode(self.defaultConfig.drawOptions[i]))
                drawOption.value = self.defaultConfig.drawOptions[i]
                selectOption.appendChild(drawOption)
            }


            if (!self.defaultConfig.draw) {
                selectOption = null
            }

            inputMaskingElement.disabled = true

            containerInputGroup.appendChild(inputMaskingElement)
            inputGroupText.appendChild(inputGroupTextButton)
            inputGroupAppend.appendChild(inputGroupText)
            containerInputGroup.appendChild(inputGroupAppend)


            inputGroupText.addEventListener('click', (ev) => {
                $(`#${modalIdGoogleMap}`).modal('show')
            })

            inputMaskingElement.addEventListener('change', (ev) => {
                element.value = ev.target.value
                element.dispatchEvent(new Event('change'))
            })

            const modalMapPicker = `<div class="modal fade" id="${modalIdGoogleMap}" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">

                        ${inputLatContainer != null && !self.defaultConfig.draw ? inputLatContainer.outerHTML : ''}
                        ${inputLonContainer != null && !self.defaultConfig.draw  ? inputLonContainer.outerHTML : ''}
                        <div id='${mapId}' style='width:100%; height:300px'>
                        </div>
                        ${selectOption != null ? selectOption.outerHTML : ''}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Selesai</button>
                    </div>
                </div>
                </div>
            </div>`

            $('body').append(modalMapPicker)

            if (!self.defaultConfig.draw) {
                document.getElementById(`${mapId}`).parentNode.insertBefore(buttonSearchLatLon,document.getElementById(`${mapId}`))
            }


            buttonSearchLatLon.addEventListener('click', () => {
                console.log(self.map.getView())
                if ( !isNaN(parseFloat(document.getElementById(`input-lon-${mapId}`).value)) && !isNaN(parseFloat(document.getElementById(`input-lat-${mapId}`).value)) ) {
                    let coordinate = ol.proj.fromLonLat([parseFloat(document.getElementById(`input-lon-${mapId}`).value), parseFloat(document.getElementById(`input-lat-${mapId}`).value)])
                    self.map.getView().animate(
                        {
                            center: coordinate,
                            zoom: 8
                        }
                    );

                    self.setMarker(coordinate, true)
                    source.clear()
                    createLayer([parseFloat(document.getElementById(`input-lon-${mapId}`).value), parseFloat(document.getElementById(`input-lat-${mapId}`).value)])
                } else {
                    swal.fire({
                        type: 'error',
                        text: `Latitude dan Longitude salah!`
                    })
                }

            })

            $(`#${modalIdGoogleMap}`).on('shown.bs.modal', function () {
                if (self.map == null) {
                    self.loadMap();
                }

                self.map.updateSize();

                initValue(element.value)
            })

            $(`#${`select-${mapId}`}`).change(() => {
                self.map.removeInteraction(self.draw);
                addInteraction();
            })




            element.parentNode.insertBefore(containerInputGroup, element.nextSibling)


            addInteraction = function() {
                var value = $(`#${`select-${mapId}`}`).val();
                if (value !== 'None') {
                    self.draw = new ol.interaction.Draw({
                        source: source,
                        type: value
                    });

                    self.draw.on('drawstart', function(ev) {
                        if (self.lastFeature) {
                            source.clear();
                            // source.removeFeature(self.lastFeature);
                        }

                    })

                    self.draw.on('drawend', function(ev) {
                        ev.feature.setId(new IDGenerator().generate());

                        self.lastFeature = ev.feature

                        let format = new ol.format['GeoJSON']()

                        setTimeout(() => {
                            let data = format.writeFeatures(vector.getSource().getFeatures())

                            data = JSON.parse(data);
                            let coordsTemp = [];

                            for (let idx = 0; idx < data.features[0].geometry.coordinates[0].length; idx++) {
                                coordsTemp.push(ol.proj.transform(data.features[0].geometry.coordinates[0][idx], 'EPSG:3857', 'EPSG:4326'));
                            }

                            data.features[0].geometry.coordinates[0] = coordsTemp;
                            data = JSON.stringify(data);

                            inputMaskingElement.value = JSON.stringify(data, null, 4)
                            inputMaskingElement.dispatchEvent(new Event('change'))
                        },1000)
                    })

                    self.map.addInteraction(self.draw);
                }
            }
        } else {

            const parentElementHeight = $(element).height();
            const mapElement = `<div id="${mapId}" style="width:100%; height: ${parentElementHeight}px;"></div>`;
            $(element).html(mapElement);

            setTimeout(() => {
                if (self.map == null) {
                    this.loadMap();
                }

                self.map.updateSize();

                initValue(element.value)
            }, 1000);
        }

        let googleLayer = new olgm.layer.Google();

        let raster =  new ol.layer.Tile({
            source: new ol.source.OSM(),
            visible: false
        })

        let source = new ol.source.Vector();

        let vector = new ol.layer.Vector({
            source: source
        });

        this.loadMap = () => {
            $(`#${mapId}`).html('')

            let lon = position.coords.longitude
            let lat = position.coords.latitude
            let zoom = 8

            if (self.defaultConfig.referFocus != null) {
                let valLongLat = self.defaultConfig.referFocus.val().split(',')



                if (valLongLat.length == 2) {
                    lon = parseFloat(valLongLat[0])
                    lat = parseFloat(valLongLat[1])
                    zoom = 12
                }
            }

            let mapConfig = {
                interactions: olgm.interaction.defaults(),
                target: mapId,
                layers: [
                    googleLayer, raster, vector
                ],
                view: new ol.View({
                  center: ol.proj.fromLonLat([lon, lat]),
                  zoom: zoom
                })
            }

            self.map =  new ol.Map(mapConfig);

            if (!self.defaultConfig.isNotInput) {
                if (!self.defaultConfig.draw) {
                    self.map.on('click', (ev) => {
                        self.setMarker(ev.coordinate)
                    })
                } else {
                    addInteraction()
                }
            } else {
                initValue(self.defaultConfig.value)
            }

            var olGM = new olgm.OLGoogleMaps({map: self.map}); // map is the ol.Map instance
            olGM.activate();

        }


        this.setMarker = (coordinate, keepOpen) => {
            const coord = ol.proj.transform(coordinate, 'EPSG:3857', 'EPSG:4326');
            inputMaskingElement.value = `${coord[0]},${coord[1]}`
            inputMaskingElement.dispatchEvent(new Event('change'))

            if (self.defaultConfig.autoClose && !keepOpen) {
                $(`#${modalIdGoogleMap}`).modal('hide')
                self.map = null;
            }
        }



        const initValue = (value) => {
            if (value != "" && value != null && !self.defaultConfig.draw) {
                let splittedValue = value.split(",")
                if (splittedValue.length < 2) {
                    console.error("doesn't support fomat value!")
                    return;
                }

                self.map.setView(
                    new ol.View({
                        center: ol.proj.fromLonLat([parseFloat(splittedValue[0]), parseFloat(splittedValue[1])]),
                        zoom: 8
                    })
                );

                if (self.marker != null) {
                    source.clear();
                    // source.removeFeature(self.marker)
                }
                createLayer(splittedValue)
            } else if (value != "" && value != null) {
                // if (self.marker != null) {
                //     source.removeFeature(self.marker)
                // }

                // let values = JSON.stringify(value);
                let values = JSON.parse(value);
                if (typeof values != 'object')
                    values = JSON.parse(values)

                if (typeof values.features !== 'undefined') {
                    let coordsTemp = [];
                    let convertedCoord = [];
                    let validCoord = true;
                    for (let idx = 0; idx < values.features[0].geometry.coordinates[0].length; idx++) {
                        convertedCoord = ol.proj.transform(values.features[0].geometry.coordinates[0][idx], 'EPSG:4326', 'EPSG:3857');

                        if (convertedCoord.findIndex(el => isNaN(el)) != -1) {
                            validCoord = false;
                            break;
                        }

                        coordsTemp.push(convertedCoord);
                    }

                    if (validCoord) {
                        values.features[0].geometry.coordinates[0] = coordsTemp;
                    }

                    if (values.features[0].geometry.type == "Polygon") {
                        let things = new ol.geom[values.features[0].geometry.type](
                            [ values.features[0].geometry.coordinates[0].concat([values.features[0].geometry.coordinates[0][0]]) ]
                        )

                        self.lastFeature = new ol.Feature({
                            geometry: things
                        })
                    } else if (values.features[0].geometry.type == "LineString") {

                        let things = new ol.geom[values.features[0].geometry.type](values.features[0].geometry.coordinates)

                        self.lastFeature = new ol.Feature({
                            geometry: things
                        })
                    }


                    source.addFeature(self.lastFeature)

                    let ext    = self.lastFeature.getGeometry().getExtent();

                    self.map.getView().fit(ext, self.map.getSize());

                    $(`#${`select-${mapId}`}`).val(values.features[0].geometry.type)
                }

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




    })
}
