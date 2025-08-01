import cat_events from './categoria/events.js';

document.addEventListener('DOMContentLoaded', function() {

    const c_events = cat_events();
    function delete_category(data, params = null) {
        const {category_id} = data;
        const cat_element = document.querySelector('#category-' + category_id);
      console.log('Category deleted:', category_id);
        const cat_message = document.getElementById('cat_noty_message');
        cat_message.innerHTML = `
            <div class="notification is-info is-light fade-in" style="position:fixed;top:1rem;right:1rem;z-index:1000;transition:opacity 0.5s;">
            Category ${category_id} deleted successfully.
            <button class="delete"></button>
            </div>
        `;
        cat_message.dataset.type = 'delete_category';
        // Remove the category element after a delay
        if(cat_element) {
            // Fade out the category element before removing it
            cat_element.style.transition = 'opacity 0.3s';
            setTimeout(() => {
                cat_element.style.opacity = '0';
                setTimeout(() => {
                    cat_element.remove();
                }, 500); // Wait for fade-out transition
            }, 300); // Optional: small delay before starting fade
        }

        // Add fade-in effect
        const notification = cat_message.querySelector('.notification');
        if (notification) {
            notification.style.opacity = '0';
            setTimeout(() => {
            notification.style.opacity = '1';
            }, 10);

            // Remove after 3 seconds with fade-out
            setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => {
                cat_message.innerHTML = '';
            }, 500);
            }, 3000);
        }

        // Allow closing the notification manually
        const deleteBtn = cat_message.querySelector('.delete');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', () => {
            if (notification) {
                notification.style.opacity = '0';
                setTimeout(() => {
                cat_message.innerHTML = '';
                }, 500);
            } else {
                cat_message.innerHTML = '';
            }
            });
        }
    }
        
    // Define actions for different form submission
    function new_category(data, params= null) {
       
        const cat_message = document.getElementById('cat_message');
        const html = data.html;
       
        cat_message.innerHTML = html;
        cat_message.dataset.type =  data.action;

        c_events.dissable_button(data.action);
    }

    function save_category(data, params= null) {
            const {last_category} = data;
            const {form : form = null } = params;
            const cat_notice = document.getElementById('error-notification');
            const categories_list = document.getElementById('categories-list');
            const new_category = document.createElement('div');
            cat_notice.innerHTML = data.message;
            cat_notice.style.display = 'block';

            new_category.id = 'category-'+last_category.categoria_id;
            new_category.className = 'column is-one-quarter';
            new_category.style.position = 'relative';
            new_category.innerHTML = `
                <div class="card">
                    <div class="card-content">
                        <p class="title is-5">${last_category.categoria_name}</p>
                        <p class="subtitle is-6">${last_category.categoria_description}</p>
                    </div>
                </div>
            `;
            categories_list.appendChild(new_category);
            if(form){
                form.reset();
            }
      
    }

    function register(data, params= null) {
        // Handle the register action
       window.location.href = 'success?message=' + data.message;
    }


    function login(data, params= null) {
            // Handle the login action
            window.location.href = 'home';
        }


    function logout(data, params= null) {
            // Handle the login action
             window.location.href = 'login?message=' + data.message;
        }
    // Handle unrecognized actions
    function none (data, params){
            throw new Error('Action not recognized: ' + data.action);
        }

    const actions = {new_category,save_category,register,login,logout,none, delete_category};
    this.addEventListener('submit', function(e){
        if(e.target.matches('.ajaxform')) {
                e.preventDefault(); 
                const form = e.target;
                const formData = new FormData(form);
                const formAction = form.getAttribute('action');
                const formMethod = form.getAttribute('method').toUpperCase();
                
                const header = new Headers();
                const config = {
                    method: formMethod,
                    headers: header,
                    mode : 'cors',
                    cache: 'no-cache',
                    body: formData
                }
                fetch(formAction, config)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                  
                    return response.text();
                  
                })
                .then(text => {
                        try{
                    const data = JSON.parse(text);
                    console.log(data);
                    if(data.status === 'success') actions[data.action](data, {form});
                    else if(data.status === 'error') {
                        // Handle error, e.g., show an error message
                        const errorNotification = document.getElementById('error-notification');
                        const bodydata = data.hasOwnProperty('row') ? data.row : '';
                        errorNotification.innerHTML = data.message + '<br>'  + bodydata;
                        errorNotification.style.display = 'block';
                    }
                        }catch(e){
                            console.error('Error parsing response:', e);
                             throw new Error('Invalid JSON response: ' + text);
                        }
                })
                .catch(error => {
                 
                    console.error('Error:', error)
    
                });

                }
        });
 


 // Toggle password visibility
   const passwordInput = document.getElementById('password-input');
    const togglePassword = document.getElementById('toggle-password');
   

    if(togglePassword && passwordInput) {
         const icon = togglePassword.querySelector('i');
        togglePassword.addEventListener('click', function(e) {
               
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });

    }

   

     
        document.addEventListener('click', (e) =>  {
            if(e.target.matches('#cat_cancel')){
             c_events.return_button();
            }
        });
    
});