<template>

    <div class="card shadow mb-4">

            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Body Weight Chart</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <line-chart :data="chartData"></line-chart>
            </div>
        </div>

</template>

<script>
export default {
    data(){
        return {
            chartData: {}
        }
    },
    created() {
        this.transformDataForChart();
    },
    methods: {
        moment(date) {
            return moment(date);
        },
        transformDataForChart() {
            let sessions = this.dashboarddata.allSessions;

            for(let i = 0; i < sessions.length; i++) {
                let date = this.moment(sessions[i].created_at).format('YYYY-MM-DD');
                this.chartData[date] = sessions[i].body_weight;
            }
        }
    },
    props: {
        dashboarddata: {
            type: Object
        }
    }
}
</script>
