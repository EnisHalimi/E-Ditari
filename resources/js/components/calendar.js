import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import sqLocale from '@fullcalendar/core/locales/sq';
if(window.location.href.indexOf("calendar") > -1) {
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
        plugins: [ dayGridPlugin ],
        locale: sqLocale,
        header: {
            left: 'prev,next,today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,dayGridDay'
        },
        buttonText: {
            prev: "Mbrapa",
            next: "Përpara",
            today: "Sot",
            month: "Muaj",
            week: "Javë",
            day: "Ditë",
            list: "Listë"
        },
        weekends: false,
        eventTextColor: 'white',
        navLinks: true,
        events: '/getNotices'
    });
    calendar.render();
  });
}
