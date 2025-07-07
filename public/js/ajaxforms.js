document.addEventListener('DOMContentLoaded', function() {
       const forms = document.querySelectorAll('.ajaxform');

    // Define actions for different form submissions
    function new_category(data) {
        console.log('new category: ', data)
    }

    function save_category(data) {
        // Handle the save_category action
        console.log('Category saved:', data);
    }

    function register(data) {
        // Handle the register action
       window.location.href = 'success?message=' + data.message;
    }


    function login(data) {
            // Handle the login action
            window.location.href = 'home';
        }

        
    function logout(data) {
            // Handle the login action
             window.location.href = 'login?message=' + data.message;
        }
    // Handle unrecognized actions
    function none (data){
            throw new Error('Action not recognized: ' + data.action);
        }

    const actions = {new_category,save_category,register,login,logout,none}
// Attach event listeners to all forms with the class 'ajaxform'
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(form);
            const formAction = form.getAttribute('action');
            const formMethod = form.getAttribute('method').toUpperCase();

            const header = new Headers
       
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
                if(data.status === 'success') actions[data.action](data);
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
        });
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
});