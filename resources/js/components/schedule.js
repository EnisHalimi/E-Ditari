import { Calendar } from '@fullcalendar/core';
import timeGridPlugin from '@fullcalendar/timegrid';
if(window.location.href.indexOf("schedule") > -1) {
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar-schedule');
    var id = document.getElementById('classroom-id').value;
    var calendar = new Calendar(calendarEl, {
        plugins: [ timeGridPlugin ],
        timeZone: 'UTC',
        initialView: 'timeGridWeek',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'timeGridWeek,timeGridDay'
        },
      buttonText: {
        today:    'Sot',
        month:    'Muaji',
        week:     'Java',
        day:      'Dita',
        list:     'Lista'
      },
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
