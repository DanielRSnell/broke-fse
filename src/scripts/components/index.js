/**
 * Component Initializer
 *
 * This file imports and initializes all JavaScript components.
 * Add your component imports and initialization calls here.
 *
 * Pattern:
 * 1. Import component initialization functions
 * 2. Call them in the initComponents() function
 * 3. Export initComponents to be called from main.js
 */

import { initFormHandler } from './form-handler';
import { initMobileMenu } from './mobile-menu';
import { initCharts } from './chart-setup';
import { initLucideIcons } from './lucide-icons';
import { initLetterReveal, initScrollAnimations, initCardHoverEffects } from './animations';

/**
 * Initialize all components
 * Called from main.js on DOMContentLoaded
 */
export function initComponents() {
  // Initialize form handler (example pattern)
  initFormHandler();

  // Initialize Umbral-specific components
  initMobileMenu();
  initCharts();
  initLucideIcons();
  initLetterReveal();
  initScrollAnimations();
  initCardHoverEffects();
}
