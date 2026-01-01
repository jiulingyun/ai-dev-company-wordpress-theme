import PhotoSwipeLightbox from 'photoswipe/lightbox';
import PhotoSwipe from 'photoswipe';

/**
 * Initialize Lightbox for Project Images
 */
const initLightbox = () => {
    const contentAreas = document.querySelectorAll('.entry-content, .project-content-wrapper');
    
    if (contentAreas.length === 0) {
        return;
    }

    contentAreas.forEach((area, index) => {
        // Find all images that should be lightbox-able
        // We look for links to images OR images that stand alone
        const images = area.querySelectorAll('img');
        const galleryId = `gallery-${index}`;
        area.setAttribute('data-pswp-gallery-id', galleryId);

        images.forEach((img) => {
            // Skip if image is a badge, icon, or specifically excluded
            if (img.classList.contains('emoji') || img.classList.contains('avatar') || img.closest('.project-badges')) {
                return;
            }

            // Check if wrapped in a link
            let anchor = img.closest('a');
            const isImageLink = anchor && /\.(jpg|jpeg|png|gif|webp|svg)$/i.test(anchor.getAttribute('href'));

            if (!isImageLink) {
                // If not wrapped in an image link, we treat the image itself as the source
                // But PhotoSwipe works best with anchors. Let's wrap it or use a custom delegate.
                // Wrapping is safer for layout if done carefully, but might affect CSS.
                // Let's try to just use the image src as the full version if no link exists.
                
                // For simplicity and robustness, we will only enhance existing image links 
                // AND images that look like content images.
                
                // Let's wrap standalone images in a simple anchor for PhotoSwipe
                const wrapper = document.createElement('a');
                wrapper.href = img.getAttribute('src'); // Use current src as fallback full version
                wrapper.target = '_blank';
                wrapper.classList.add('lightbox-item');
                
                // Try to get high-res from srcset if possible (complex), 
                // for now just use src or if WP provided a full size link.
                
                // Insert wrapper
                img.parentNode.insertBefore(wrapper, img);
                wrapper.appendChild(img);
                anchor = wrapper;
            } else {
                anchor.classList.add('lightbox-item');
            }

            // Set dimensions for PhotoSwipe
            // WordPress usually outputs width/height attributes
            let width = img.getAttribute('width');
            let height = img.getAttribute('height');

            // If attributes missing, try natural dimensions (might need load event)
            if ((!width || !height) && img.naturalWidth) {
                width = img.naturalWidth;
                height = img.naturalHeight;
            }

            if (width && height) {
                anchor.setAttribute('data-pswp-width', width);
                anchor.setAttribute('data-pswp-height', height);
            } else {
                // Fallback: PhotoSwipe v5 can load image to determine size but it's slower.
                // We can just rely on the load event to update attributes
                img.onload = () => {
                    anchor.setAttribute('data-pswp-width', img.naturalWidth);
                    anchor.setAttribute('data-pswp-height', img.naturalHeight);
                };
            }
        });

        // Initialize Lightbox for this area
        const lightbox = new PhotoSwipeLightbox({
            gallery: area,
            children: 'a.lightbox-item',
            pswpModule: PhotoSwipe,
            
            // UI Options
            zoom: true,
            close: true,
            counter: true,
            bgOpacity: 0.9,
            
            // Animation
            showHideAnimationType: 'zoom',
        });

        lightbox.init();
    });
};

export default initLightbox;
