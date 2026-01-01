import AIAnimations from './modules/ai-animations';
import AINavigation from './modules/ai-navigation';
import initLightbox from './modules/lightbox';
import './modules/theme-toggle';

document.addEventListener('DOMContentLoaded', () => {
  console.log('AI Dev Theme Initialized');
  
  // Initialize modules
  new AIAnimations();
  new AINavigation();
  initLightbox();
});
