
import DateRangePicker from 'flowbite-datepicker/DateRangePicker';

// import Alpine from 'alpinejs'
 
// window.Alpine = Alpine
 
// Alpine.start();

  
// if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
// 	localStorage.theme = 'dark';
// 	  document.documentElement.classList.add('dark')
// 	} else {
// 	  document.documentElement.classList.remove('dark')
// 	}

const options = {
	title: "Demo Title",
	autoHide: false,
	todayBtn: false,
	clearBtn: true,
	clearBtnText: "Clear",
	maxDate: new Date("2030-01-01"),
	minDate: new Date("1950-01-01"),
	theme: {
		background: "bg-gray-950 dark:bg-gray-800",
		todayBtn: "",
		clearBtn: "",
		icons: "",
		text: "",
		disabledText: "bg-red-500",
		input: "",
		inputIcon: "",
		selected: "",
	},
	icons: {
		// () => ReactElement | JSX.Element
		prev: () => "<span>p</span>",
		next: () => "<span>n</span>",
	},
	datepickerClassNames: "top-12",
	defaultDate: new Date("2022-01-01"),
	language: "en",
	disabledDates: [],
	weekDays: ["Mo", "Tu", "We", "Th", "Fr", "Sqqa", "Su"],
	inputNameProp: "date",
	inputIdProp: "date",
	inputPlaceholderProp: "Select Date",
	inputDateFormatProp: {
		day: "numeric",
		month: "long",
		year: "numeric"
	}
}

const dateRangePickerEl = document.getElementById('dateRangePickerId');
const dateRangePickerElBooking = document.getElementById('dateRangePickerIdBookign');
new DateRangePicker(dateRangePickerEl, {
    options
}); new DateRangePicker(dateRangePickerElBooking, {
    options
});