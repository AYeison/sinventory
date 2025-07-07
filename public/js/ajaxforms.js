document.addEventListener('DOMContentLoaded', function() {
   
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


    const forms = document.querySelectorAll('.ajaxform');

    forms.forEach(form => {
        form.addEventListener('input', function(event) {
          console.log(event.target.value);
        })

        form.addEventListener('submit', function(event) {
            event.preventDefault();
  console.log(event.target.value);
            const formData = new FormData(form);
            const formAction = form.getAttribute('action');
            const formMethod = form.getAttribute('method').toUpperCase();

            const header = new Headers
            console.log(formData)
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

                if(data.status === 'success') {
                    // Handle success, e.g., redirect or show a success message
                    window.location.href = 'success?message=' + data.message;
                    
                }else if(data.status === 'error') {
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
});