<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Weight</th>
                            <th scope="col">Sets</th>
                            <th scope="col">Reps</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(exercise, index) in session.exercises" v-bind:key="index">
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ exercise.name }}</td>
                            <td>{{ exercise.weight_number }} {{exercise.weight_type}}</td>
                            <td>{{ exercise.sets }}</td>
                            <td>{{ exercise.reps }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div class="mt-2">
                                Add Session
                            </div>
                            <div>
                                <button class="btn btn-secondary" @click="previousStep" v-show="step === totalSteps">Go Back</button>
                                <button class="btn btn-success" @click="nextStep" v-show="step !== totalSteps">Add Exercises</button>
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
                            </form>
                        </template>
                        <!--end add session name-->

                        <!--Add Exercises-->
                        <template v-if="step === totalSteps">
                            <form>
                                <!--exercise name-->
                                <div class="form-group">
                                    <label for="exercise-name">Exercise Name</label>
                                    <input type="text" v-model="exercise.name" class="form-control" id="exercise-name" aria-describedby="session-name-help"
                                    placeholder="E.g. Bench press">
                                </div>
                                <!--end exercise name-->

                                <div class="row">
                                    <div class="col">
                                        <!--exercise weight-->
                                        <div class="form-group">
                                            <label for="exercise-weight">Weight</label>
                                            <number-input v-model="exercise.weight_number" id="exercise-weight" :min="1" controls></number-input>
                                        </div>
                                        <!--end exercise weight-->
                                    </div>
                                    <div class="col">
                                        <!--exercise weight type-->
                                        <div class="form-group">
                                            <label for="exercise-type">Weight Type</label>
                                            <v-select v-model="exercise.weight_type" :options="weightOptions"></v-select>
                                        </div>
                                        <!--end exercise weight type-->
                                    </div>
                                </div>

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
                exercises: []
            },
            exercise: {
                name: '',
                weight_number: null,
                weight_type: 'kg',
                sets: null,
                reps: null
            }
        }
    },
    methods: {
        nextStep() {
            this.step++;
        },
        previousStep() {
            this.step--;
        },
        clearExerciseForm() {
            this.exercise.name = '';
            this.exercise.weight_number = null;
            this.exercise.weight_type = 'kg';
            this.exercise.sets = null;
            this.exercise.reps = null;
        },
        addExercise(e) {
            e.preventDefault();

            let exercise = {
                name: this.exercise.name,
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
