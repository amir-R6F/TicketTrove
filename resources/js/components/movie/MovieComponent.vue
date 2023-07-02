<template>
    <div>
        <b-modal ref="report" hide-footer>
            <p v-for="(rep, index) in report" :key="index" v-text="rep"></p>
            <b-btn @click="hideReport"> close</b-btn>
        </b-modal>

        <b-btn @click="showReport" variant="danger" class="d-flex ml-auto">Report</b-btn>

        <b-alert
            dismissible
            :variant="mycolor()"
            :show="myalert.countdown"
            @dismissed="myalert.countdown = 0"
            @dismiss-count-down="counterDown"
            v-for="(alert, index) in myalert.message" :key="index"
        >
            {{ alert }}
        </b-alert>

        <div class="row" v-if="show">
            <b-card v-for="(movie, index) in all_movie" :key="index" class="col-5 my-3 mx-1">
                <b-card-header></b-card-header>
                <b-card-title v-text="movie.title"></b-card-title>
                <b-card-body>
                    <h4>Play Time: {{ movie.play_time }} </h4>
                    <h5>Release Date: {{ movie.release_year }}</h5>
                    <h6>Number Of Seats: {{movie.ticket.length}} Seats out of 10</h6>
                </b-card-body>
                <b-btn variant="primary" @click="showSeats(movie)">show</b-btn>
            </b-card>
        </div>

        <div class="seat" v-else>
            <b-btn variant="warning my-2" @click="showSeats">back</b-btn>

            <b-card>
                <b-card-title>

                </b-card-title>

                <b-card-body class="container">

                    <b-btn class="mx-3 my-3 w-25 h-25" v-for="(seat, index) in all_seat" :key="index"
                           @click="reservation(seat)"
                           :variant="checkColor(seat)"> {{ seat.number }}
                    </b-btn>

                </b-card-body>
            </b-card>
        </div>
    </div>
</template>

<script>
export default {
    props: ['all_movie', 'all_seat', 'auth_user'],
    name: "MovieComponent",
    data() {
        return {
            url: process.env.MIX_PUSHER_APP_URL,
            token: process.env.MIX_PUSHER_APP_TOKEN,
            route: {
                reserve: 'http://127.0.0.1:8000/reserve'
            },
            myalert: {
                secend: 5,
                countdown: 0,
                state: true,
                message: []
            },
            show: true,
            seat: this.all_seat,
            movie_id: null,
            reserved_seats: [],
            report: []
        }

    },
    methods: {
        showSeats(movie) {
            if (this.show) {
                this.show = false;
                this.movie_id = movie.id;
                if (movie.ticket.length > 0) {
                    this.reserved_seats = movie.ticket;
                }
            } else {
                this.show = true;
                this.movie_id = null;
                this.reserved_seats = []
            }

        },
        reservation(seat) {
            if (seat.ticket && seat.ticket.user_id !== this.auth_user && seat.ticket.movie_id === this.movie_id) {
                this.myalert.state = false;
                this.messageAlert('this ticket is reserved!!!!!!!!!!!!!!!!!!!!');
            } else if (seat.ticket && seat.ticket.user_id === this.auth_user && seat.ticket.movie_id === this.movie_id) {
                this.myalert.state = false;
                this.messageAlert('you did get this ticket ');
            } else if (!seat.ticket || (seat.ticket && seat.ticket.movie_id !== this.movie_id)) {
                axios.post('http://127.0.0.1:8000/api/reserve', {
                    movie_id: this.movie_id,
                    seat_id: seat.id,
                    user_id: this.auth_user,
                    date_bought: '2017-01-01 01:00:00'
                }).then(res => {
                    this.myalert.state = true;
                    this.reserved_seats.push(res.data);
                    this.checkColor(seat)
                    this.messageAlert('your successfully reserved');
                }).catch(e => {
                    this.myalert.state = false;
                    this.messageAlert(e.response.data.message);
                })
            }
            this.showAlert();

        },
        checkColor(seat) {
            if (this.reserved_seats.length > 0) {
                for (let i = 0; i < this.reserved_seats.length; i++) {

                    if (this.auth_user === this.reserved_seats[i].user_id) {
                        if (this.reserved_seats[i].seat_id === seat.id) {
                            return "success"
                        }
                    } else if (this.auth_user !== this.reserved_seats[i].user_id) {
                        if (this.reserved_seats[i].seat_id === seat.id) {
                            return "danger"
                        }
                    }


                }
            }
        },
        counterDown(counter) {
            this.myalert.countdown = counter;
        },
        showAlert() {
            this.myalert.countdown = this.myalert.secend;
        },
        messageAlert(message) {
            this.myalert.message = [];
            this.myalert.message.push(message)

        },
        mycolor() {
            if (this.myalert.state) {

                return 'success';
            } else {
                return 'danger';
            }
        },
        showReport() {
            let token = this.token;
            // let head = {header: {"authorazion": `barear${token}`}}
            axios.get('/api/report').then(res => {
                this.report.push(res.data)
            }).catch(e => {
                // if (e.response.status === 401) {
                    this.report.push("Forbbiden , you must authenticate!!")
                // }
            })
            this.$refs['report'].show();
        },
        hideReport() {
            this.$refs['report'].hide();
            this.report = []
        }
    },
    created() {
        console.log(this.all_movie)
    }
}
</script>

<style scoped>

</style>
