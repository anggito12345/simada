@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['id' => 'table-inventaris', 'width' => '100%', 'class' => 'table table-striped table-bordered']) !!}

@section('scripts')
    <script>    
        let colspan = {
            "Kode Barang": {
                value: 2, 
                title: "Nomor"
            },
        }

        let isReady = false
        
        function onLoadDataTable(e) {

            if (isReady) {
                return
            }

            let allHeader = $(e.nTHead).find("th")
            let createdMerge = document.createElement("tr")
            createdMerge.setAttribute("row-cloned" ,true)
            let headerByPass = 0
            
            for (let i = 0; i < allHeader.length ; i ++) {
                const col = allHeader[i]
                let th = document.createElement("th")
                let title = col.getAttribute('title')
                if (colspan[title] != undefined && headerByPass == 0) {
                    
                    th.setAttribute("colspan",2)
                    th.innerHTML = colspan[title].title
                    th.style.textAlign = "center"
                    
                    createdMerge.appendChild(th)
                    headerByPass = colspan[title].value                    
                }

                if (headerByPass > 0) {                    
                    headerByPass--
                } else {

                    th = col.cloneNode(true)

                    th.setAttribute("rowspan",2)

                    th.addEventListener("click", (ev) => {
                        col.click();     
                        let currentClassname = ev.target.className                   

                        $("[row-cloned] th[col-cloned]").attr("class", "sorting")

                        if ( currentClassname  == "sorting_asc") {
                            ev.target.className = "sorting_desc"
                        } else {
                            ev.target.className = "sorting_asc"
                        }
                        
                    })

                    th.setAttribute("col-cloned", true)

                    th.style.verticalAlign = "middle"
                    createdMerge.appendChild(th)

                    col.style.display = "none"

                }


            }

            isReady = true

            let element = $(e.nTHead).find("tr")[0]

            e.nTHead.prepend(createdMerge)
        }
        
    </script>
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}

    
@endsection