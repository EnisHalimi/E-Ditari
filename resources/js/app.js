require('./components/jquery.min')
require('./bootstrap');
require('./components/jquery.easing.min')
require('./components/datatables.min')
require('./components/chart.bundle')
require('./components/sb-admin-2')
require('./components/login');
require('./components/calendar');
require('./components/schedule');
require('./components/data-tables');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


