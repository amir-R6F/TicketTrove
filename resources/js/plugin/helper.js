export default {
    getToken() {
        localStorage.getItem(process.env.MIX_PUSHER_APP_TOKEN);
    },
    setToken(token){
        localStorage.setItem(process.env.MIX_PUSHER_APP_TOKEN, token);
    }
}
