/**
 * Lucide Icons Setup
 * Initializes Lucide icon library
 */

import { createIcons, icons } from 'lucide';

export function initLucideIcons() {
  createIcons({
    icons,
    attrs: {
      class: 'lucide-icon',
      'stroke-width': 2
    },
    nameAttr: 'data-lucide'
  });
}

// Re-initialize icons for dynamically added content
export function refreshIcons() {
  createIcons({
    icons,
    attrs: {
      class: 'lucide-icon',
      'stroke-width': 2
    },
    nameAttr: 'data-lucide'
  });
}
