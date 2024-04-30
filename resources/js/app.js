import './bootstrap';


  function switchTheme() {
  console.log('switchTheme');
  }// On page load or when changing themes, best to add inline in `head` to avoid FOUC
  
if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
  localStorage.theme = 'dark';
    document.documentElement.classList.add('dark')
  } else {
    document.documentElement.classList.remove('dark')
  }
  
  // Whenever the user explicitly chooses light mode
  //localStorage.removeItem('theme')
  // Whenever the user explicitly chooses dark mode
//   localStorage.theme = 'dark'
//   localStorage.theme = 'light'

  // Whenever the user explicitly chooses to respect the OS preference
