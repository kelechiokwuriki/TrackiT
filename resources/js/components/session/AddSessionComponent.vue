<template>
    <div class="container">
        <div class="row">
            <div class="col">
                Exercises
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
                                    <input type="text" class="form-control" id="session-name" aria-describedby="session-name-help"
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
                                    <input type="text" class="form-control" id="exercise-name" aria-describedby="session-name-help"
                                    placeholder="E.g. Bench press">
                                </div>
                                <!--end exercise name-->

                                <div class="row">
                                    <div class="col">
                                        <!--exercise weight-->
                                        <div class="form-group">
                                            <label for="exercise-weight">Weight</label>
                                            <number-input id="exercise-weight" :min="1" controls></number-input>
                                        </div>
                                        <!--end exercise weight-->
                                    </div>
                                    <div class="col">
                                        <!--exercise weight type-->
                                        <div class="form-group">
                                            <label for="exercise-type">Weight Type</label>
                                            <v-select :options="weightOptions"></v-select>
                                        </div>
                                        <!--end exercise weight type-->
                                    </div>
                                </div>


                                <!--exercise set-->
                                <div class="form-group">
                                    <label for="exercise-set">How many sets?</label>
                                    <number-input id="exercise-set" :min="1" controls></number-input>
                                </div>
                                <!--end exercise set-->

                                <!--exercise reps-->
                                <div class="form-group">
                                    <label for="exercise-set">How many reps?</label>
                                    <number-input id="exercise-set" :min="1" controls></number-input>
                                </div>
                                <!--end exercise reps-->

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
            weightOptions: ['kg', 'lbs']
        }
    },
    methods: {
        nextStep() {
            this.step++;
        },
        previousStep() {
            this.step--;
        }
    }

}
</script>
