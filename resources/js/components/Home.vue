<template>
    <div class="fill-height ma-4">
        <h1 class="subheading grey--text">Dashboard</h1>
        <v-container>
            <v-row>
                <v-layout row wrap>

                    <v-flex sm6 xs12 md6 lg3>
                        <v-card class="ma-3">
                            <v-list-item>
                                <v-list-item-avatar tile width="80" height="80">
                                    <v-sheet color="green" width="80" height="80" elevation="10" rounded>
                                        <v-icon dark large>fas fa-users</v-icon>
                                    </v-sheet>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <div class="overline text-right">Total de alunos</div>
                                    <v-list-item-title class="headline mb-1 text-right">{{ totalStudents }}</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-card-actions>
                                <v-btn to="/participantes" tile color="green" dark>Ver todos</v-btn>
                                <div>
                                    <v-divider></v-divider>
                                </div>
                            </v-card-actions>
                        </v-card>
                    </v-flex>

                    <v-flex sm6 xs12 md6 lg3>
                        <v-card class="ma-3">
                            <v-list-item>
                                <v-list-item-avatar tile width="80" height="80">
                                    <v-sheet color="red" width="80" height="80" elevation="10" rounded>
                                        <v-icon dark large>fas fa-users</v-icon>
                                    </v-sheet>
                                </v-list-item-avatar>
                                <v-list-item-content>
                                    <div class="overline text-right">Eventos realizados</div>
                                    <v-list-item-title class="headline mb-1 text-right">{{ totalEvents }}</v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-card-actions>
                                <v-btn to="/eventos" tile color="red" dark>Ver eventos</v-btn>
                                <div>
                                    <v-divider></v-divider>
                                </div>
                            </v-card-actions>
                        </v-card>
                    </v-flex>

                </v-layout>
            </v-row>

            <v-row>
                <v-layout row wrap xl12 class="mt-10" align-center>
                    <v-flex md8 lg4 align-self-center>
                        <apexchart ref="line" type="line" :options="line.chartOptions" :series="line.series"></apexchart>
                    </v-flex>

                    <v-flex md8 lg4>
                        <h4>2019</h4>
                        <apexchart ref="oneTwo" type="pie" :options="oneTwo.chartOptions" :series="oneTwo.series"></apexchart>
                    </v-flex>

                    <v-flex md8 lg4>
                        <h4>2020</h4>
                        <apexchart ref="twoThree" type="pie" :options="twoThree.chartOptions" :series="twoThree.series"></apexchart>
                    </v-flex>
                </v-layout>
            </v-row>


        </v-container>
    </div>
</template>

<script>

import axios from 'axios'

export default {
    data: () => ({
        user: [],
        totalStudents: null,
        totalEvents: null,
        users: [],
        line: {
            series: [{
                name: "Participantes",
                data: []
            }],
            chartOptions: {
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                title: {
                    text: 'Eventos anteriores',
                    align: 'left'
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'],
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: ['2018','2019','2020'],
                }
            }
        },
        barChart: {
            options: {
                yaxis: {
                    categories: [2018, 2019, 2020]
                }
            },
            series: [
                {
                    name: '2018',
                    data: [80]
                },
                {
                    name: '2019',
                    data: [131]
                },
                {
                    name: '2020',
                    data: [120]
                }
            ]
        },
        oneTwo: {
            series: [44, 55],
            chartOptions: {
                chart: {
                    width: 380,
                    type: 'pie',
                },
                labels: ['Novos', 'Reincidentes'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            },
        },
        twoThree: {
            series: [44, 55],
            chartOptions: {
                chart: {
                    width: 380,
                    type: 'pie',
                },
                labels: ['Novos', 'Reincidentes'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            },
        }
    }),
    created() {
        this.getUser()
        this.getStudents()
        this.getEvents()
        this.getEventsInfo()
    },
    methods: {
        getStudents() {
            axios.get(`/api/participantes`, {
                headers: {
                    'Authorization': 'Bearer '+this.user.access_token
                }
            })
            .then(response => {
                this.totalStudents = response.data.length
            })
            .catch(error => console.log(error.response))
        },
        getEvents() {
            axios.get(`/api/eventos`, {
                headers: {
                    'Authorization': 'Bearer '+this.user.access_token
                }
            })
            .then(response => {
                this.totalEvents = response.data.length
            })
            .catch(error => console.log(error.response))
        },
        getEventsInfo() {
            axios.get(`/api/eventos/info`, {
                headers: {
                    'Authorization': 'Bearer '+this.user.access_token
                }
            })
            .then(response => {

                var data = []

                this.$refs.line.updateSeries([{
                    name: 'Alunos',
                    data: [response.data[2018].total, response.data[2019].total, response.data[2020].total]
                }])

                var novos2019 = (response.data[2019].total - response.data[2019].reincidentes)
                this.$refs.oneTwo.updateSeries([
                    novos2019, response.data[2019].reincidentes
                ])

                var novos2020 = (response.data[2020].total - response.data[2020].reincidentes)
                this.$refs.twoThree.updateSeries([
                    novos2020, response.data[2020].reincidentes
                ])

            })
            .catch(error => console.log(error.response))
        },
        getUser() {
            const user = localStorage.getItem('user')
            this.user = JSON.parse(user)
        }
    }
}

</script>

<style scoped>

</style>
