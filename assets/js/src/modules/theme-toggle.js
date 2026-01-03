// Dark Mode Toggle Button Logic
document.addEventListener('DOMContentLoaded', () => {
  const toggleButton = document.querySelector('.theme-toggle');
  
  // Get saved theme or default to dark (disable system auto-detection)
  const currentTheme = localStorage.getItem('theme') || 'dark';
  
  // Apply theme on load
  document.documentElement.setAttribute('data-theme', currentTheme);
  
  if (toggleButton) {
    // Ensure there is an element to contain the icon
    let iconEl = toggleButton.querySelector('.theme-toggle-icon');
    if ( !iconEl ) {
      iconEl = document.createElement('span');
      iconEl.className = 'theme-toggle-icon';
      toggleButton.appendChild(iconEl);
    }

    // Inline SVGs as reliable fallback (ensures icon even if Font Awesome isn't loaded)
    const svgSun = '<svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true" focusable="false"><path fill="currentColor" d="M6.995 12c0 2.761 2.246 5.005 5.005 5.005s5.005-2.244 5.005-5.005c0-2.76-2.246-5.005-5.005-5.005S6.995 9.24 6.995 12zM13 4h-2v2h2V4zm0 14h-2v2h2v-2zM4 13H2v-2h2v2zm18 0h-2v-2h2v2zM7.05 7.05L5.636 5.636 4.222 7.05 5.636 8.464 7.05 7.05zM18.364 18.364l1.414-1.414-1.414-1.414-1.414 1.414 1.414 1.414zM18.364 5.636l-1.414 1.414 1.414 1.414 1.414-1.414L18.364 5.636zM7.05 16.95L5.636 18.364 4.222 16.95 5.636 15.536 7.05 16.95z"/></svg>';
    const svgMoon = '<svg viewBox="0 0 24 24" width="20" height="20" aria-hidden="true" focusable="false"><path fill="currentColor" d="M21.64 13.01A9 9 0 0 1 10.99 2.36 7 7 0 1 0 21.64 13.01z"/></svg>';
    // Detect Font Awesome availability (window.FontAwesome or loaded FA stylesheet or .fa class)
    const faAvailable = !!window.FontAwesome || !!document.querySelector('link[href*="font-awesome"],link[href*="fontawesome"],link[href*="all.min.css"],.fa,.fa-solid');
    // If FA not available, add fallback marker class so CSS can show emoji fallback
    if (!faAvailable) {
      toggleButton.classList.add('fallback-emoji');
    } else {
      toggleButton.classList.remove('fallback-emoji');
    }

    function updateIconForTheme(current) {
      if (!iconEl) return;
      // Prefer Font Awesome if loaded: try to set classes; otherwise inject inline SVG
      const faAvailable = !!window.FontAwesome || !!document.querySelector('.fa');
      if (faAvailable) {
        // Use FA classes on the iconEl itself if it's an <i>, or a child <i>
        let faI = null;
        try {
          if (iconEl && iconEl.matches && iconEl.matches('i.fa, i.fas, i.far, i.fal, i.fab, i.fa-solid')) {
            faI = iconEl;
          } else {
            faI = iconEl.querySelector('i.fa, i.fas, i.far, i.fal, i.fab, i.fa-solid');
          }
        } catch (err) {
          faI = iconEl.querySelector('i.fa, i.fas, i.far, i.fal, i.fab, i.fa-solid');
        }

        if (!faI) {
          faI = document.createElement('i');
          faI.className = 'fa';
          iconEl.innerHTML = '';
          iconEl.appendChild(faI);
        }

        // Remove any previous icon/weight classes we might have set
        faI.classList.remove('fa-sun','fa-moon','fa-solid','fas','far','fa');
        // add solid style
        faI.classList.add('fa-solid');
        // NOTE: inverted behavior — dark theme shows SUN icon, light theme shows MOON icon
        if ( current === 'dark' ) {
          faI.classList.add('fa-sun');
          toggleButton.setAttribute('aria-pressed', 'true');
        } else {
          faI.classList.add('fa-moon');
          toggleButton.setAttribute('aria-pressed', 'false');
        }
      } else {
        // Inject inline SVG — inverted: dark => sun, light => moon
        iconEl.innerHTML = current === 'dark' ? svgSun : svgMoon;
        if ( current === 'dark' ) {
          toggleButton.setAttribute('aria-pressed', 'true');
        } else {
          toggleButton.setAttribute('aria-pressed', 'false');
        }
      }
    }

    // initialize icon state
    // Also set emoji fallback immediately as requested by user
    function setEmojiIcon(current) {
      if (!iconEl) return;
      // Clear any children/classes then set emoji
      iconEl.innerHTML = '';
      if ( current === 'dark' ) {
        // dark theme -> show sun emoji (user requested inverted behaviour)
        iconEl.textContent = '☀️';
      } else {
        // light theme -> show moon emoji
        iconEl.textContent = '🌙';
      }
    }

    // Prefer emoji fallback per user request to guarantee visibility
    setEmojiIcon(currentTheme);

    toggleButton.addEventListener('click', () => {
      let theme = document.documentElement.getAttribute('data-theme');
      let newTheme = theme === 'dark' ? 'light' : 'dark';
      
      document.documentElement.setAttribute('data-theme', newTheme);
      localStorage.setItem('theme', newTheme);
      // updateIconForTheme(newTheme); // keep if needed for FA support
      setEmojiIcon(newTheme);
    });
  }
});
