import "./bootstrap";
import 'laravel-datatables-vite';
import select2 from 'select2';

$(document).ready(function () {

    $(".select2").select2({
        tags: true,
        theme: 'bootstrap-5',
    });
   
});

select2();