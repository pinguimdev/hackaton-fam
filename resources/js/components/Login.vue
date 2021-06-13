<template>
    <div class="login">
        <form >
            <h4>Faça login</h4>
            <input type="email" v-model="user.email" placeholder="email">
            <input type="password" v-model="user.password" placeholder="password">
            <div>
                <button @click.prevent="logar">Entrar</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "Login",
    data() {
        return {
            user: {}
        }
    },
    methods: {
        logar() {
            axios.post(`/api/auth/login`, this.user)
                .then(response => {
                    localStorage.setItem('user', JSON.stringify(response.data))
                    window.location.href = '/'
                })
                .catch(error => console.log(error.response))
        }

    }
}
</script>

<style scoped>
.login {
    height: 100vh;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(#0288d1, #005b9f);
}
form {
    width: 100%;
    max-width: 400px;
    padding: 15px;
    background-color: #005b9f;
    display: flex;
    flex-direction: column;
}
form h4 {
    padding: 10px 0;
    text-align: center;
    color: white;
}
form input {
    background-color: #fff;
    margin-top: 5px;
    margin-bottom: 5px;
    padding: 10px;
}
form input:focus {
    outline: none;
}

form button {
    margin-top: 5px;
    padding: 10px 20px;
    background-color: #003c8f;
    color: white;
    transition: all .2s;

}
form button:hover {
    opacity: .7;
}

</style>
