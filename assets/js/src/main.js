import AIAnimations from './modules/ai-animations';
import AINavigation from './modules/ai-navigation';

document.addEventListener('DOMContentLoaded', () => {
  console.log('AI Dev Theme Initialized');
  
  // Initialize modules
  new AIAnimations();
  new AINavigation();
});
