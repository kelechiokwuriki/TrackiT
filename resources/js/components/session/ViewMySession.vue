<template>
    <div class="container">
        <div class="card shadow">

            <!-- Card Header -->
            <div class="card-header py-3">
                <div class="text-center">
                    <h4 class="m-0 font-weight-bold text-success">{{ session.name }}</h4>
                </div>

            </div>

            <!-- Card Body -->
            <div class="card-body">
                <!-- <div class="row"> -->
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
                    <!-- <div class="col-sm-9"> -->
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Sets</th>
                                <th scope="col">Reps</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(exercise, index) in session.exercises" v-bind:key="index">
                                    <td>{{index + 1}}</td>
                                    <td>{{exercise.name}}</td>
                                    <td>{{exercise.type}}</td>
                                    <td>{{exercise.sets}}</td>
                                    <td>{{exercise.reps}}</td>
                                </tr>
                            </tbody>
                        </table>
                    <!-- </div> -->
                <!-- </div> -->

            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        session: {
            type: Object
        }
    }
}
</script>
