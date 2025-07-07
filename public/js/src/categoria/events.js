export default function cat_events(){

        function card_down_toggle(target){
            let card = target.closest('.card');
            if(card){
                let content = card.querySelector('.card-content');
                if(content){
                    // Add smooth transition for max-height
                    content.style.transition = 'max-height 0.3s ease';
                    content.style.overflow = 'hidden';

                    // Fade effect for the text inside card-content
                    let text = content.querySelector('.card-text');
                    if (text) {
                        text.style.transition = 'opacity 0.3s ease';
                    }

                    if (content.classList.contains('hidden')) {
                        content.classList.remove('hidden');
                        // Set maxHeight to 0 first to trigger transition
                        content.style.maxHeight = '0px';
                        // Force reflow to apply the initial state
                        void content.offsetWidth;
                        // Then set to scrollHeight to expand
                        content.style.maxHeight = content.scrollHeight + 'px';

                        // Fade in text
                        if (text) {
                            text.style.opacity = '0';
                            // Force reflow
                            void text.offsetWidth;
                            text.style.opacity = '1';
                        }

                        // Optionally, remove maxHeight after transition for flexibility
                        content.addEventListener('transitionend', function handler() {
                            content.style.maxHeight = '';
                            content.removeEventListener('transitionend', handler);
                        });
                    } else {
                        // Set maxHeight to current height before collapsing
                        content.style.maxHeight = content.scrollHeight + 'px';
                        // Force reflow
                        void content.offsetWidth;
                        // Collapse
                        content.style.maxHeight = '0px';

                        // Fade out text
                        if (text) {
                            text.style.opacity = '1';
                            // Force reflow
                            void text.offsetWidth;
                            text.style.opacity = '0';
                        }

                        content.addEventListener('transitionend', function handler() {
                            content.classList.add('hidden');
                            content.removeEventListener('transitionend', handler);
                        });
                    }
                    content.classList.toggle('active');
                }
                }
           
        }

    document.addEventListener('click', function(e){
        let target = e.target;
        if(target.matches('.card-down-toggle')){
            card_down_toggle(target);
        }
    });
}