<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <table class="table table-hover">
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
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ exercise.name }}</td>
                            <td>{{ exercise.type }}</td>
                            <td>{{ exercise.weight_number }} {{exercise.weight_type}}</td>
                            <td>{{ exercise.sets }}</td>
                            <td>{{ exercise.reps }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <button class="btn btn-success" v-show="session.exercises.length > 0" @click="submitSession">Submit Session</button>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div class="mt-2">
                                <h4>Add Session</h4>
                            </div>
                            <div>
                                <button class="btn btn-secondary" @click="previousStep" v-show="step === totalSteps">Go Back</button>
                                <button class="btn btn-success" @click="nextStep" v-show="step !== totalSteps" :disabled="session.name === ''">Add Exercises</button>
                            </div>

                        </div>
                    </div>


                    <div class="card-body">
                        <!--Add session name-->
                        <template v-if="step === 1">
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
                        </template>
                        <!--end add session name-->

                        <!--Add Exercises-->
                        <template v-if="step === totalSteps">
                            <form>
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

                                <div class="text-center">
                                    <button class="btn btn-success" @click="addExercise">Add Exercise</button>
                                </div>

                            </form>
                        </template>
                        <!--end add exercises-->
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
            step: 1,
            totalSteps: 2,
            weightOptions: ['kg', 'lbs'],
            session:{
                name: '',
                body_weight: '',
                exercises: []
            },
            exercise: {
                name: '',
                type: '',
                weight_number: null,
                weight_type: 'kg',
                sets: null,
                reps: null
            }
        }
    },
    methods: {
        submitSession() {
            axios.post('/api/sessions', this.session).then(response => {
                if(response.status === 200) {

                    let statusMessage = {
                        statusColor: 'alert-success',
                        status: 'success',
                        message: 'Session created successfully!'
                    };

                    window.eventBus.$emit('status', statusMessage);
                }
            })

        },
        nextStep() {
            this.step++;
        },
        previousStep() {
            this.step--;
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
