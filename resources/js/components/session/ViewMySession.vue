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
                        <a :href="'/file/' + session.slug" target="__blank" class="btn btn-info"><i class="mr-2 fas fa-file-pdf"></i>Generate PDF</a>
                        <a :href="'/sessions/' + session.slug + '/edit'" class="btn btn-secondary">Edit session</a>
                        <button class="btn btn-danger" @click="showDeleteConfirmation">Delete session</button>
                    </div>
                </div>

            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="row text-center mb-4">
                    <div class="col-sm-6">
                        <div class="card bg-success text-white shadow">
                            <div class="card-body">
                                <i class="fas fa-weight text-white"></i> Body Weight {{ session.body_weight }} kg
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

                <table class="table table-hover text-center mysessiontable">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col" class="d-none d-sm-none d-md-block d-sm-block">Type</th>
                        <th scope="col" class="d-none d-sm-none d-md-block d-sm-block">Weight</th>
                        <th scope="col">Sets</th>
                        <th scope="col">Reps</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(exercise, index) in session.exercises" v-bind:key="index">
                            <td>{{index + 1}}</td>
                            <td>{{exercise.name}}</td>
                            <td class="d-none d-sm-none d-md-block d-sm-block">{{exercise.type}}</td>
                            <td class="d-none d-sm-none d-md-block d-sm-block">{{exercise.weight_number}} kg</td>
                            <td>{{exercise.sets}}</td>
                            <td>{{exercise.reps}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!--delete confirmation modal-->
        <div class="modal fade" id="deleteSessionModal" tabindex="-1" aria-labelledby="deleteSessionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSessionModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Delete {{ session.name }} session?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" @click="deleteSession">Yes</button>
                </div>
                </div>
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
        showDeleteConfirmation() {
            $('#deleteSessionModal').modal('show');
        },
        deleteSession() {
            axios.delete('/api/sessions/' + this.session.id).then(response => {
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
