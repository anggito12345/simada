let MapInputIncrement = 1;
let MapInput = function(element, config) {
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
            latitude: -6.121435,
            longitude: 106.774124,
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
        

        if (element.tagName != "INPUT" ) {
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
                inputMaskingElement.style.display = 'block'
            }
            
        
            const inputGroupAppend = document.createElement('div')
            inputGroupAppend.className = 'input-group-append'
        
            const inputGroupText = document.createElement('div')
            inputGroupText.className = 'input-group-text'
            
            const inputGroupTextButton = document.createElement('i')
            inputGroupTextButton.className = 'fa fa-globe'

            let selectOption = document.createElement('select')    
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
        }        
        
        let raster =  new ol.layer.Tile({
            source: new ol.source.OSM()
        })
    
        let source = new ol.source.Vector({wrapX: false});
    
        let vector = new ol.layer.Vector({
            source: source
        });

        this.loadMap = () => {
            $(`#${mapId}`).html('')

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
    
            if (!self.defaultConfig.isNotInput) {                
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
            } else {
                initValue(self.defaultConfig.value)
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
                        zoom: 12
                    })
                );

                if (self.marker != null) {
                    source.removeFeature(self.marker)
                }
                createLayer(splittedValue)
            } else if (value != "" && value != null) {
                // if (self.marker != null) {
                //     source.removeFeature(self.marker)
                // }

                let values = JSON.parse(value);
                if (typeof values != 'object') 
                    values = JSON.parse(values)

                    
                let coordinatesDraws = []
                let currentCoord = values.features[0].geometry.coordinates
                for (let n = 0; n < currentCoord.length; n ++) {
                    coordinatesDraws.push(ol.proj.transform(currentCoord[n], 'EPSG:4326', 'EPSG:3857'))
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

let GoogleMap = (element, config) => {

}
