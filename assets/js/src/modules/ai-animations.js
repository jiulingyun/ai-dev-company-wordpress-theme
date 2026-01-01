/**
 * AI Animations Module
 * Handles scroll animations and interactive effects.
 */
class AIAnimations {
  constructor() {
    this.initScrollObserver();
    this.initTypingEffect();
    this.initCounters();
  }

  /**
   * Initialize Number Counters
   */
  initCounters() {
    const counters = document.querySelectorAll('.counter');
    
    const observerOptions = {
      root: null,
      threshold: 0.5
    };

    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const counter = entry.target;
          const target = parseInt(counter.getAttribute('data-target'));
          
          if (!target) return;
          
          this.animateCounter(counter, target);
          observer.unobserve(counter);
        }
      });
    }, observerOptions);

    counters.forEach(counter => observer.observe(counter));
  }

  animateCounter(element, target) {
    let start = 0;
    const duration = 2000; // 2 seconds
    const startTime = performance.now();

    const update = (currentTime) => {
      const elapsed = currentTime - startTime;
      const progress = Math.min(elapsed / duration, 1);
      
      // Ease out quart
      const ease = 1 - Math.pow(1 - progress, 4);
      
      const current = Math.floor(start + (target - start) * ease);
      element.textContent = current;

      if (progress < 1) {
        requestAnimationFrame(update);
      } else {
        element.textContent = target;
      }
    };

    requestAnimationFrame(update);
  }

  /**
   * Initialize Intersection Observer for scroll animations
   */
  initScrollObserver() {
    const observerOptions = {
      root: null,
      rootMargin: '0px',
      threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          
          // Optional: Stop observing once animated
          if (entry.target.dataset.once !== 'false') {
            observer.unobserve(entry.target);
          }
        }
      });
    }, observerOptions);

    // Observe elements with animation classes
    const animatedElements = document.querySelectorAll('.fade-in-up, .scale-in, .slide-in-left, .slide-in-right');
    animatedElements.forEach(el => observer.observe(el));
  }

  /**
   * Initialize Typing Effect for elements with .typewriter class
   */
  initTypingEffect() {
    const typewriters = document.querySelectorAll('.typewriter');
    
    typewriters.forEach(el => {
      const text = el.dataset.text || el.textContent;
      const speed = parseInt(el.dataset.speed) || 50;
      const delay = parseInt(el.dataset.delay) || 0;
      
      // Clear content initially
      el.textContent = '';
      el.classList.add('typing-cursor');
      
      setTimeout(() => {
        this.typeText(el, text, speed);
      }, delay);
    });
  }

  typeText(element, text, speed) {
    let i = 0;
    
    const type = () => {
      if (i < text.length) {
        element.textContent += text.charAt(i);
        i++;
        setTimeout(type, speed);
      } else {
        // Animation complete
        // Optional: Remove cursor after typing finishes
        // element.classList.remove('typing-cursor');
      }
    };
    
    type();
  }
}

export default AIAnimations;
