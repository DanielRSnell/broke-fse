/**
 * Animation Utilities
 * Handles letter reveal and other animations
 */

export function initLetterReveal() {
  const elements = document.querySelectorAll('.letter-reveal');

  elements.forEach(element => {
    const text = element.textContent;
    element.innerHTML = '';

    // Split text into individual characters and wrap in spans
    text.split('').forEach((char, index) => {
      const span = document.createElement('span');
      span.textContent = char === ' ' ? '\u00A0' : char; // Use non-breaking space
      span.style.animationDelay = `${index * 0.05}s`;
      element.appendChild(span);
    });
  });
}

export function initScrollAnimations() {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('slide-up');
          observer.unobserve(entry.target);
        }
      });
    },
    {
      threshold: 0.1,
      rootMargin: '0px 0px -100px 0px'
    }
  );

  // Observe elements with data-animate attribute
  document.querySelectorAll('[data-animate="scroll"]').forEach(el => {
    observer.observe(el);
  });
}

export function initCardHoverEffects() {
  const cards = document.querySelectorAll('.card-hover');

  cards.forEach(card => {
    card.addEventListener('mouseenter', function() {
      this.style.transform = 'scale(1.02)';
    });

    card.addEventListener('mouseleave', function() {
      this.style.transform = 'scale(1)';
    });
  });
}
