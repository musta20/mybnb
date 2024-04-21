/* ES6 module in Node.js environment */
import Calendar from '@toast-ui/calendar';
import '@toast-ui/calendar/dist/toastui-calendar.min.css';

const calendar = new Calendar('#calendar', {
    usageStatistics: false
  });