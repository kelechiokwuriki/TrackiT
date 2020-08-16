<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">Weight</th>
                            <th scope="col">Sets</th>
                            <th scope="col">Reps</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(exercise, index) in session.exercises" v-bind:key="index">
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ exercise.name }}</td>
                            <td>{{ exercise.type }}</td>
                            <td>{{ exercise.weight_number }} {{exercise.weight_type}}</td>
                            <td>{{ exercise.sets }}</td>
                            <td>{{ exercise.reps }}</td>
                            <td>
                                <button class="btn btn-sm btn-secondary" @click="showEditExerciseModal(exercise)">Edit exercise</button>
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center" v-if="session.exercises">
                    <button class="btn btn-success" v-show="session.exercises.length > 0" @click="updateSession">Update Session</button>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div class="mt-2">
                                <h4>Edit your Session</h4>
                            </div>
                            <!-- <div>
                                <button class="btn btn-secondary" @click="previousStep" v-show="step === totalSteps">Go Back</button>
                                <button class="btn btn-success" @click="nextStep" v-show="step !== totalSteps" :disabled="session.name === ''">Add Exercises</button>
                            </div> -->

                        </div>
                    </div>


                    <div class="card-body">
                        <!--Add session name-->
                            <form>
                                <div class="form-group">
                                    <label for="session-name">Session Name</label>
                                    <input type="text" v-model="session.name" class="form-control" id="session-name" aria-describedby="session-name-help"
                                    placeholder="E.g. Full Body Workout or Upper Body Workout">
                                </div>

                                <div class="form-group">
                                    <label for="session-body-weight">Body Weight in KG</label>
                                    <number-input v-model="session.body_weight" id="session-body-weight" :min="1" controls></number-input>
                                </div>
                            </form>
                        <!--end add session name-->

                        <!--Add Exercises-->

                        <!--end add exercises-->
                    </div>
                </div>
            </div>
        </div>

        <!--edit confirmation modal-->
        <div class="modal fade" id="editSessionModal" tabindex="-1" aria-labelledby="editSessionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSessionModalLabel">Editing {{exercise.name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <!--exercise name and type -->
                        <div class="row">
                            <div class="col">
                                <!--exercise name-->
                                <div class="form-group">
                                    <label for="exercise-name">Exercise Name</label>
                                    <input type="text" v-model="exercise.name" class="form-control" id="exercise-name" aria-describedby="session-name-help"
                                    placeholder="E.g. Bench press">
                                </div>
                                <!--end exercise name-->
                            </div>
                            <div class="col">
                                <!--exercise type-->
                                <div class="form-group">
                                    <label for="exercise-type">Exercise Type</label>
                                    <input type="text" v-model="exercise.type" class="form-control" id="exercise-type" aria-describedby="session-name-help"
                                    placeholder="E.g. Warm up">
                                </div>
                            </div>
                        </div>
                        <!--end exercise name and type -->


                        <!--exercise weight-->
                        <div class="form-group">
                            <label for="exercise-weight">Weight lifted in KG</label>
                            <number-input v-model="exercise.weight_number" id="exercise-weight" :min="0" controls></number-input>
                        </div>
                        <!--end exercise weight-->


                        <!--exercise set-->
                        <div class="form-group">
                            <label for="exercise-sets">How many sets?</label>
                            <number-input v-model="exercise.sets" id="exercise-sets" :min="1" controls></number-input>
                        </div>
                        <!--end exercise set-->

                        <!--exercise reps-->
                        <div class="form-group">
                            <label for="exercise-reps">How many reps?</label>
                            <number-input v-model="exercise.reps" id="exercise-reps" :min="1" controls></number-input>
                        </div>
                        <!--end exercise reps-->

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" @click="saveExercise">Save</button>
                </div>
                </div>
            </div>
        </div>
        <!--end edit confirmation modal-->

    </div>

</template>

<script>
export default {
    data() {
        return {
            session:{},
            exercise: {
                id: null,
                name: '',
                type: '',
                weight_number: null,
                weight_type: 'kg',
                sets: null,
                reps: null
            }
        }
    },
    mounted() {
        this.session = this.sessiontoedit;
    },
    props: {
        sessiontoedit: {
            type: Object
        }
    },
    methods: {
        getIndexFromExerciseArray() {
            return this.session.exercises.findIndex(exercise => exercise.id === this.exercise.id);
        },
        saveExercise() {
            let index = this.getIndexFromExerciseArray();

            this.session.exercises[index].name = this.exercise.name;
            this.session.exercises[index].type = this.exercise.type;
            this.session.exercises[index].weight_number = this.exercise.weight_number;
            this.session.exercises[index].weight_type = this.exercise.weight_type;
            this.session.exercises[index].sets = this.exercise.sets;
            this.session.exercises[index].reps = this.exercise.reps;

            $('#editSessionModal').modal('hide');


        },
        showEditExerciseModal(exerciseData) {
            this.exercise.id = exerciseData.id;
            this.exercise.name = exerciseData.name;
            this.exercise.type = exerciseData.type;
            this.exercise.weight_number = exerciseData.weight_number;
            this.exercise.weight_type = exerciseData.weight_type;
            this.exercise.sets = exerciseData.sets;
            this.exercise.reps = exerciseData.reps;

            $('#editSessionModal').modal('show');
        },
        updateSession() {
             axios.put('/api/sessions/' + this.session.id, this.session).then(response => {
                console.log(response);
            });

            // axios.put('/api/sessions/', this.session).then(response => {
            //     if(response.status === 200) {

            //         let statusMessage = {
            //             statusColor: 'alert-success',
            //             status: 'success',
            //             message: 'Session created successfully!'
            //         };

            //         window.eventBus.$emit('status', statusMessage);
            //     }
            // })

        },
        clearExerciseForm() {
            this.exercise.name = '';
            this.exercise.type = '';
            this.exercise.weight_number = null;
            this.exercise.weight_type = 'kg';
            this.exercise.sets = null;
            this.exercise.reps = null;
        },
        addExercise(e) {
            e.preventDefault();

            let exercise = {
                name: this.exercise.name,
                type: this.exercise.type,
                weight_number: this.exercise.weight_number,
                weight_type: this.exercise.weight_type,
                sets: this.exercise.sets,
                reps: this.exercise.reps
            }

            this.session.exercises.push(exercise);

            this.clearExerciseForm();
        }
    }

}
</script>
