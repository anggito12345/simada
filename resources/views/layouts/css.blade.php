<style>

    .modal {
        overflow-y:auto;
    }

    
    .navbar {
        padding: 0px;
    }

    .pagination {
        margin: 10px !important;
    }

    .pagination>li>a {
        background: #35b4d4;
        padding: 10px;
        margin: 1px;
        color: white;
        cursor: pointer;
    }

    .dataTables_wrapper .row {
        width: 100% !important;
    }

    .pagination>li.disabled>a {
        cursor: not-allowed;
        color: rgba(255,255,255,.5);
    }

    .dataTables_filter {
        margin-left: 10px;
    }

    li.user-menu {
        margin-right: 1em;
    }

    .select2-selection__rendered {
        line-height: 2;
    }

    .select2-container--bootstrap {
        width: 100% !important;
    }
        
    .select2-container--bootstrap .select2-selection {
        border-radius: 0px;
    }

    .select2-selection__choice {
        color: black !important;
    }

    .container-view {
        margin-bottom: 20px;
    }        

    .container-view .row:nth-child(2n) {
        background:#F3F3F3;
    }

    .container-view .row .item-view {
        margin-bottom:0;
        padding:10px;   
    }

    .container-view .row .item-view:first-child {
        text-align: right;
        font-weight: bold;            
    }

    .image-preview {
        width: 220px;
    }

    .paginate_button.active a{
        color: rgba(255,255,255,.5);
    }

    @font-face {
        font-family: mainfont;
        src: url(<?= url('css/fonts/SourceSansPro-Regular.otf') ?>);
    }

    body {
        font-family: mainfont !important;
        /* font-size: 11px !important; */
    }
/* 
    .fa {
        font-size: 11px !important;
    }

    .treeview-menu>li>a {
        font-size: 11px !important;
    } */

    .collapse-toggle {
        width: 100%;
    }

    .box-header .collapse-toggle:after {
        /* symbol for "opening" panels */
        font-family: FontAwesome;  /* essential for enabling glyphicon */
        content: "\f062";    /* adjust as needed, taken from bootstrap.css */
        float: right;        /* adjust as needed */
        color: white;         /* adjust as needed */
    }

    .box-header .collapse-toggle.collapsed:after {
        /* symbol for "collapsed" panels */
        content: "\f063";    /* adjust as needed, taken from bootstrap.css */
    }

    .width-60 {
        width: 60% !important;
        float: left;
    }

    .width-80 {
        width: 80% !important;
        float: left;
    }

    .lookup-100 {
        width: 100%;
    }

    table.dataTable {
        width:100% !important;
    }

    .modal-lookup .dataTables_length {
    }

    .modal-lookup .row {
        width: 100%;
        margin: 0;
    }

    .fade-scale {
        transform: scale(0);
        opacity: 0;
        -webkit-transition: all 1s linear;
        -o-transition: all 1s linear;
        transition: all 1s linear;
    }

    .fade-scale.show {
        opacity: 1;
        transform: scale(1);
    }

    .dt-button-collection.dropdown-menu {
        padding: 10px;
    }

    .dt-buttons .btn-sm {
        padding: 10px !important;
    }

    .padding-notif {
        display: inline;
        padding: .2em .6em .3em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;
    }
</style>