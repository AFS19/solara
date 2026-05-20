import '../css/components/animations.css';

import Alpine from 'alpinejs';
import { ProductScene } from './three/ProductScene.js';
import ScrollAnimations from './scroll-animations.js';

// Start Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    // Initialize hero product scene
    const heroCanvas = document.getElementById('hero-product-canvas');
    if (heroCanvas) {
        const heroColor = heroCanvas.dataset.productColor || '#f59e0b';
        new ProductScene(heroCanvas, {
            color: heroColor,
            autoRotate: true,
            pixelRatio: window.matchMedia('(pointer: coarse)').matches ? 0.5 : 0.75
        });
    }
    
    // Initialize showcase product scene with product switching
    const showcaseCanvas = document.getElementById('showcase-canvas');
    if (showcaseCanvas) {
        let showcaseScene = new ProductScene(showcaseCanvas, {
            color: '#f59e0b',
            autoRotate: true,
            pixelRatio: window.matchMedia('(pointer: coarse)').matches ? 0.5 : 0.75
        });
        
        // Listen for product change events from Alpine
        showcaseCanvas.closest('section')?.addEventListener('product-change', (e) => {
            const product = e.detail;
            if (product) {
                // Change color
                if (product.color_hex) {
                    showcaseScene.changeColor(product.color_hex);
                }
                // Swap model if available
                if (product.model_file) {
                    showcaseScene.swapModel(product.model_file);
                }
            }
        });
    }
    
    // Initialize scroll animations
    new ScrollAnimations();
});

// Alpine.js is auto-initialized by Laravel/Breeze
// x-collapse directive works out of the box with Alpine v3+
