<template>
    <div class="container">
        <div class="top-widgets">
            <div class="mb-4">
                <a href="/sessions/create" target="__blank" class="btn btn-success">Add Session</a>
            </div>
            <div class="row">
                <!-- Total essions -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                <div class="h6 font-weight-bold text-primary text-uppercase mb-1">Total Sessions</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800" v-if="dashboarddata.totalSessionCount > 0">{{ dashboarddata.totalSessionCount }}</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800" v-else><a href="/sessions/create">Add a session</a></div>

                                </div>
                                <div class="col-auto">
                                <i class="fas fa-book fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" v-if="dashboarddata.lastSession">
                            <a href="/mysessions" class="btn btn-success">View all sessions</a>
                        </div>
                    </div>
                </div>

                <!-- Last session -->
                <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div class="h6 font-weight-bold text-success text-uppercase mb-1">Last Session</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800" v-if="dashboarddata.lastSession">
                                    {{ dashboarddata.lastSession.name }}
                                </div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800" v-else><a href="/sessions/create">Add a session</a></div>
                            </div>
                            <div class="col-auto">
                            <i class="fas fa-dumbbell fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" v-if="dashboarddata.lastSession">
                        <a :href="'/sessions/' + dashboarddata.lastSession.slug" class="btn btn-success">View last session</a>
                    </div>
                </div>
                </div>

                <!-- Latest body weight -->
                <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div class="h6 font-weight-bold text-warning text-uppercase mb-1">Last Body Weight</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800" v-if="dashboarddata.lastSession">{{ dashboarddata.lastSession.body_weight }} kg</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800" v-else><a href="/sessions/create">Add a session</a></div>

                            </div>
                            <div class="col-auto">
                            <i class="fas fa-weight fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" v-if="dashboarddata.lastSession">
                        <a :href="'/sessions/' + dashboarddata.lastSession.slug" class="btn btn-success">View last session</a>
                    </div>
                </div>
                </div>


                <!-- Last session date -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h6 font-weight-bold text-info text-uppercase mb-1">Last Session Date</div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800" v-if="dashboarddata.lastSession">{{ moment(dashboarddata.lastSession.created_at).format("MMM Do YYYY hh:mm a") }}</div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800" v-else><a href="/sessions/create">Add a session</a></div>

                                </div>
                                <div class="col-auto">
                                <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" v-if="dashboarddata.lastSession">
                            <a :href="'/sessions/' + dashboarddata.lastSession.slug" class="btn btn-success">View last session</a>
                        </div>
                    </div>
                </div>

            </div>

          <!-- Content Row -->
        </div>

        <chart-component :dashboarddata="dashboarddata"></chart-component>

         <!-- Area Chart -->


    </div>
</template>

<script>
export default {
    data(){
        return {
            chartData: []
        }
    },
    methods: {
        moment(date) {
            return moment(date);
        },
        transformDataForChart() {
            let sessions = this.dashboarddata.allSessions;
            let data = {};

            // for(let i = 0; i < sessions.length; i++) {
            //     data[sessions[i].created_at] =
            // }
        }
    },
    props: {
        dashboarddata: {
            type: Object
        }
    }

}
</script>
