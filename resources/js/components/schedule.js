import { Calendar } from '@fullcalendar/core';
import timeGridPlugin from '@fullcalendar/timegrid';
import sqLocale from '@fullcalendar/core/locales/sq';
if(window.location.href.indexOf("schedule") > -1) {
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar-schedule');
    var id = document.getElementById('classroom-id').value;
    var calendar = new Calendar(calendarEl, {
        plugins: [ timeGridPlugin ],
        locale: sqLocale,
        timeZone: 'UTC',
        initialView: 'timeGridWeek',
        headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'timeGridWeek,timeGridDay'
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
        slotMinTime: '08:00:00',
        slotMaxTime:'14:00:00',
        weekends: false,
        firstDay:1,
        allDaySlot: false,
        eventTextColor: 'white',
        navLinks: true,
        events: '/admin/getSchedules?id='+id,
        eventClick: function(info) {
            window.location.replace(info.event.url);
        }
    });
    calendar.render();
  });
}
