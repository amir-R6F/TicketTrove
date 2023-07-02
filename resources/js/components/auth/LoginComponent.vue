<template>
    <div>
        <b-card class="container col-7">
            <b-card-title>Login</b-card-title>
            <b-form-input type="email" placeholder="email" class="my-2" v-model="form.email"></b-form-input>
            <b-form-input type="password" placeholder="password" class="my-2" v-model="form.password"></b-form-input>
            <b-btn @click="btnLogin" variant="success">Login</b-btn>
        </b-card>
    </div>
</template>

<script>
export default {
    name: "LoginComponent",
    data() {
        return {
            url:process.env.MIX_PUSHER_APP_URL + "/api/login",
            form: {
                email: null,
                password: null
            }
        }
    },
    methods: {
        btnLogin(){
            axios.post(this.url, this.form).then(res =>{
                if (res && res.data){
                    let token= this.$helper.setToken(res.data.token);
                    location.href = '/home'
                }
            }).catch(e => {

            })
        }
    }
}
</script>

<style scoped>

</style>
