<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-header"> <h3>Login Temperatures</h3></div>

                    <div class="card-body">

                        <div class="float-right mb-5">
                            <button class="btn btn-danger" @click="hottestFirst">Hottest First</button>
                            <button class="btn btn-dark" @click="resetOrder">Reset Order</button>
                        </div>

                            <table class="table">
                                <thead>
                                    <tr>
                                    <th><h3>Colombo</h3></th>
                                    <th><h3>Melbourne</h3></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="temperature in temperatures">
                                    <td>
                                        <label class="m-3">{{formatDate(temperature.logged_in_at)}}</label>
                                        <label class="m-3">{{Math.floor(temperature.city1_temperature)}}&#176;C</label>
                                        <label class="m-3">{{celsiusToFahrenheit(temperature.city1_temperature)}}&#176;F</label>
                                    </td>

                                    <td>
                                        <label class="m-3">{{formatDate(temperature.logged_in_at)}}</label>
                                        <label class="m-3">{{Math.floor(temperature.city2_temperature)}}&#176;C</label>
                                        <label class="m-3">{{celsiusToFahrenheit(temperature.city2_temperature)}}&#176;F</label>
                                    </td>
                                    </tr>
                                </tbody>
                            </table>                
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import moment from 'moment'
    export default {
        
        data(){
            return{
                temperatures: {}
            }
        },

        mounted() {
            axios.get('/user/temperatures')
            .then((response) => {
                this.temperatures = response.data
            })
            console.log('Component mounted.')
        },

        methods: {
            formatDate(date){
                return moment(String(date)).format('ddd, DD MMMM YYYY, hh:mm a')
            },

            celsiusToFahrenheit(value){
                return Math.floor((value * 9/5) + 32)
            },

            hottestFirst(){
                axios.get('/user/temperatures/'+'hottestfirst')
                .then((response) => {
                    this.temperatures = response.data
                })
            },

            resetOrder(){
                axios.get('/user/temperatures')
                .then((response) => {
                    this.temperatures = response.data
                })
            }
        }
    }
</script>
