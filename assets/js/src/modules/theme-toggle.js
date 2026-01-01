// Dark Mode Toggle Button Logic
document.addEventListener('DOMContentLoaded', () => {
  const toggleButton = document.querySelector('.theme-toggle');
  const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
  
  // Get saved theme or system preference
  const currentTheme = localStorage.getItem('theme') || 
                       (prefersDarkScheme.matches ? 'dark' : 'light');
  
  // Apply theme on load
  document.documentElement.setAttribute('data-theme', currentTheme);
  
  if (toggleButton) {
    toggleButton.addEventListener('click', () => {
      let theme = document.documentElement.getAttribute('data-theme');
      let newTheme = theme === 'dark' ? 'light' : 'dark';
      
      document.documentElement.setAttribute('data-theme', newTheme);
      localStorage.setItem('theme', newTheme);
    });
  }
});
