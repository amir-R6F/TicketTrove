<template>
    <div>
        <b-card class="container col-7">
            <b-card-title>Register</b-card-title>
            <b-form-input placeholder="name" class="my-2" v-model="form.name"></b-form-input>
            <b-form-input type="email" placeholder="email" class="my-2" v-model="form.email"></b-form-input>
            <b-form-input type="password" placeholder="password" class="my-2" v-model="form.password"></b-form-input>
            <b-form-input type="password" placeholder="password_confirmation" class="my-2"
                          v-model="form.c_password"></b-form-input>
            <b-btn @click="register" variant="success">Register</b-btn>
        </b-card>
    </div>
</template>

<script>
export default {
    name: "RegisterComponent",
    data() {
        return {
            url:process.env.MIX_PUSHER_APP_URL + '/api/register',
            form: {
                name: null,
                email: null,
                password: null,
                c_password: null
            }
        }
    },
    methods:{
        register(){
            axios.post(this.url, this.form).then(res => {
                if (res && res.data){
                    let token = this.$helper.setToken(res.data.token);
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
