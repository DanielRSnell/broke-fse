/**
 * Mobile Menu Toggle
 * Handles the mobile navigation menu open/close functionality
 */

export function initMobileMenu() {
  const menuToggle = document.querySelector('[data-menu-toggle]');
  const menuPanel = document.querySelector('[data-menu-panel]');

  if (!menuToggle || !menuPanel) return;

  menuToggle.addEventListener('click', () => {
    const isOpen = menuPanel.classList.contains('open');

    if (isOpen) {
      menuPanel.classList.remove('open');
      menuPanel.classList.add('hidden');
      menuToggle.setAttribute('aria-expanded', 'false');
    } else {
      menuPanel.classList.remove('hidden');
      // Force reflow before adding 'open' class for animation
      menuPanel.offsetHeight;
      menuPanel.classList.add('open');
      menuToggle.setAttribute('aria-expanded', 'true');
    }
  });

  // Close menu when clicking outside
  document.addEventListener('click', (e) => {
    if (!menuToggle.contains(e.target) && !menuPanel.contains(e.target)) {
      menuPanel.classList.remove('open');
      menuPanel.classList.add('hidden');
      menuToggle.setAttribute('aria-expanded', 'false');
    }
  });

  // Close menu on escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && menuPanel.classList.contains('open')) {
      menuPanel.classList.remove('open');
      menuPanel.classList.add('hidden');
      menuToggle.setAttribute('aria-expanded', 'false');
    }
  });
}
