import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
if(window.location.href.indexOf("calendar") > -1) {
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
      plugins: [ dayGridPlugin ],
      buttonText: {
        today:    'Sot',
        month:    'Muaji',
        week:     'Java',
        day:      'Dita',
        list:     'Lista'
      },
      eventTextColor: 'white',
      navLinks: true,
      events: '/getNotices'

    });
    calendar.render();
  });
}
