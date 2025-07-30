export default function cat_events(){
    function create_button(cat, name_btn, action, type, tgElement) {
                             const form = document.createElement('form');
                              const input_submit= document.createElement('button');
                              const hidden_id = document.createElement('input');
                              const cat_id = cat.id.replace(/^category-/, "");
                              const action_input = document.createElement('input');

                              const btn_classes = {
                                delete: 'delete-button button is-danger is-outlined',
                                edit: 'edit-button button is-info is-outlined'
                              }
                              
                              input_submit.type = 'submit';
                              input_submit.innerHTML = '<span>'+name_btn+'</span>';
                              input_submit.innerHTML += '<span class="icon is-small">';
                              input_submit.innerHTML += '<i class="fas fa-times"></i>';
                              input_submit.innerHTML += '</span>';
                              input_submit.className = btn_classes[type];

                              hidden_id.type = 'hidden';
                              hidden_id.value = cat_id;
                              hidden_id.name = 'category_id';

                              action_input.type='hidden';
                              action_input.value = action;
                              action_input.name = 'action';

                              form.appendChild(input_submit);
                              form.appendChild(hidden_id);
                              form.appendChild(action_input);

                              form.action = './php/category.php';
                              form.method = 'POST';
                              form.className = 'form-btn-dlt ajaxform';

                              form.style.position = 'absolute';
                              form.style.top = '-0.5em';
                              form.style.right = '-0.5em';

                            cat.appendChild(form);
                             tgElement.dataset.mode = 'deactive-dlt';
                             tgElement.textContent = 'Cancelar';
    }

return {
        transform_input_slug :  (input) => {
                const form = input.closest('#category_new');

            if(!form){
                return false;
            }
         
            const input_slug = form.querySelector('#slug');
            const preview = document.querySelector('.preview-slug');
            if(preview && input_slug){
     
             const slug = input.value.trim().toLowerCase().replace(/\s+/g, '-');
             preview.textContent = slug;
            input_slug.value = preview.textContent;
            }

          
            },
       card_down_toggle :  (target) => {
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
           
        },
    dissable_button : (type) => {
            const button = document.querySelector(`button[type="submit"][data-type="${type}"]`);
            if(button){
                button.disabled = true;
                button.classList.add('is-loading');
                setTimeout(() => {
                    button.classList.remove('is-loading');
                }, 2000); // Re-enable after 2 seconds
            }
    },

    return_button : () => {
            const cat_message = document.getElementById('cat_message');
            const type = cat_message.dataset.type || 'waiting';
            const static_msg = cat_message.dataset.stMessage || 'Esperando por una solicitud...';
            const cancel_btn = document.getElementById('cat_cancel');
            const type_btn = document.querySelector(`button[type="submit"][data-type="${type}"]`);
            if(type_btn && cancel_btn){
               
                type_btn.disabled = false;
                type_btn.classList.remove('is-loading');
                cat_message.innerHTML = static_msg;
            }
    },

    delete_categories : () => {
            document.addEventListener('click', function(e){
                let target = e.target;
                if(!target.matches('#delete-category')){
                    return;
                }
                e.preventDefault();
                let mode = target.dataset.mode;
                const categories_list = document.getElementById('categories-list');
                if(categories_list && categories_list.firstChild){
                    const col_cats = categories_list.querySelectorAll('.column');

                    if(col_cats){
                        col_cats.forEach(function(cat){
                            if( mode === 'active-dlt'){
                                create_button(cat, 'Delete', 'delete_category', 'delete', target);

                                }else if(mode === 'deactive-dlt'){
                                const dlt_btn = cat.querySelector('.form-btn-dlt');
                                if(dlt_btn){
                                      dlt_btn.remove();
                                        target.dataset.mode = 'active-dlt';
                                       target.textContent = 'Delete';
                                }
                            }
                          
                        })
                    }
                }
                  
            })
    },
    edit_categories :  () => {
                document.addEventListener('click', function(e){
                let target = e.target;
                if(!target.matches('#edit-category')){
                    return;
                }
                e.preventDefault();
                let mode = target.dataset.mode;
                const categories_list = document.getElementById('categories-list');
                if(categories_list && categories_list.firstChild){
                    const col_cats = categories_list.querySelectorAll('.column');

                    if(col_cats){
                        col_cats.forEach(function(cat){
                            if( mode === 'active-dlt'){
                                create_button(cat, 'Edit', 'edit_category', 'edit', target);

                                }else if(mode === 'deactive-dlt'){
                                const dlt_btn = cat.querySelector('.form-btn-dlt');
                                if(dlt_btn){
                                      dlt_btn.remove();
                                        target.dataset.mode = 'active-dlt';
                                       target.textContent = 'Edit';
                                }
                            }
                          
                        })
                    }
                }

                })
    }
        
}


}