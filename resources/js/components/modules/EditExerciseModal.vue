<template>

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
                    <button type="button" class="btn btn-danger" @click="saveExercise" :disabled="allowSavingExercise">Save</button>
                </div>
                </div>
            </div>
        </div>
        <!--end edit confirmation modal-->

</template>

<script>
export default {
    data() {
        return {
            exercise: {}

        }
    },
    methods: {
        saveExercise() {
            this.$emit('edit-exercise', this.exercise);
        }
    },
    created() {
        this.exercise = this.exerciseData;
    },
    props: {
        exerciseData: {
            type: Object
        }
    },
    computed: {
        allowSavingExercise() {
            if(this.exercise.name === '' || this.exercise.type === '') {
                return true;
            }

            return false;
        }
    }

}
</script>
