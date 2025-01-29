<div id="errors"></div>
<form id="login-form" method="post" style="display: flex; align-items: center; justify-content: space-between; background-color: white; padding: 5px; border-radius: 5px;">
    <div style="margin-right: 5px;">
        <input type="text" class="form-control" id="username" name="username" placeholder="Identifiant" required style="padding: 5px;">
    </div>
    <div style="margin-right: 5px;">
        <input type="password" class="form-control" id="password" name="pass" placeholder="Mot de passe" required style="padding: 5px;">
    </div>
    <button type="button" id="valid-login-btn" class="btn btn-primary" name="login_button" style="padding: 5px 10px;">Valider</button>
</form>
<script src="./Assets/JS/services/login.js" type="module"></script>
<script type="module">
    import {login} from "./Assets/JS/services/login.js";

    document.addEventListener('DOMContentLoaded', () => {
        const validLoginBtn = document.querySelector('#valid-login-btn')
        const loginForm = document.querySelector('#login-form')
        const errorsElement = document.querySelector('#errors')
        validLoginBtn.addEventListener('click', async() => {
            if (!loginForm.checkValidity()) {
                loginForm.reportValidity()
                return false
            }

            const loginResult = await login(loginForm.elements['username'].value, loginForm.elements['pass'].value)
            if (loginResult.hasOwnProperty('authentication')){
                document.location.href = 'index.php'
            } else if (loginResult.hasOwnProperty('errors')){
                const errors = []
                for (let i = 0; i < loginResult.errors.length; i++){
                    errors.push(`<div class="alert alert-danger" role="alert">${loginResult.errors[i]}</div>`)
                }

                errorsElement.innerHTML = errors.join('')
            }
        })
    })
</script>

