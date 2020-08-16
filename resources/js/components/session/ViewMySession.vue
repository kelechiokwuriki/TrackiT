<template>
    <div class="container">
        <div class="card shadow">

            <!-- Card Header -->
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="m-0 font-weight-bold text-success">{{ session.name }} Session</h4>
                    </div>
                    <div>
                        <button class="btn btn-warning">Edit session</button>
                        <button class="btn btn-danger" @click="deleteSession">Delete session</button>

                    </div>
                </div>

            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="row text-center mb-4">
                    <div class="col-sm-6">
                        <div class="card bg-success text-white shadow">
                            <div class="card-body">
                                <i class="fas fa-weight text-white"></i> Body Weight {{ session.body_weight }}
                            </div>
                        </div>
                        </div>

                    <div class="col-sm-6">
                        <div class="card bg-success text-white shadow">
                            <div class="card-body">
                                <i class="fas fa-dumbbell text-white"></i> Total Weight carried {{ session.total_weight_lifted_at_session }} kg
                            </div>
                        </div>
                    </div>

                </div>

                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Weight</th>
                        <th scope="col">Sets</th>
                        <th scope="col">Reps</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(exercise, index) in session.exercises" v-bind:key="index">
                            <td>{{index + 1}}</td>
                            <td>{{exercise.name}}</td>
                            <td>{{exercise.type}}</td>
                            <td>{{exercise.weight_number}} kg</td>
                            <td>{{exercise.sets}}</td>
                            <td>{{exercise.reps}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            // session: {}
        }
    },
    methods: {
        deleteSession() {
            axios.delete('/api/session/' + this.session.id).then(response => {
                console.log(response);
                if(response.data === 1) {
                    window.location = '/mysessions';
                }
            })
        }
    },
    mounted() {
        // this.getSession();
    },
    props: {
        session: {
            type: Object
        }
    }
}
</script>
