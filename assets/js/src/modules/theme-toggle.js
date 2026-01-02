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
    const icon = toggleButton.querySelector('.theme-toggle-icon');

    function updateIconForTheme(current) {
      if (!icon) return;
      // Remove both classes then add the proper one
      icon.classList.remove('fa-sun', 'fa-moon');
      if ( current === 'dark' ) {
        icon.classList.add('fa-moon');
        toggleButton.setAttribute('aria-pressed', 'true');
      } else {
        icon.classList.add('fa-sun');
        toggleButton.setAttribute('aria-pressed', 'false');
      }
    }

    // initialize icon state
    updateIconForTheme(currentTheme);

    toggleButton.addEventListener('click', () => {
      let theme = document.documentElement.getAttribute('data-theme');
      let newTheme = theme === 'dark' ? 'light' : 'dark';
      
      document.documentElement.setAttribute('data-theme', newTheme);
      localStorage.setItem('theme', newTheme);
      updateIconForTheme(newTheme);
    });
  }
});
