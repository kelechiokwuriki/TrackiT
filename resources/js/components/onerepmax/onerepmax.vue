<template>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">One Rep Max Calculator</div>
                    <div class="card-body">
                        Calculate your one-rep max (1RM) for any lift.
                        Your one-rep max is the max weight you can lift for a single repetition for a given exercise.
                        <form class="mt-4">
                            <div class="form-group">
                                <label for="lift-type">Weight Lifted</label>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <input type="text" v-model="lift" class="form-control" id="lift-type">
                                    </div>
                                    <div class="col-sm-3">
                                        <v-select v-model="liftTypeSelected" :options="liftType"></v-select>
                                    </div>
                                </div>

                            </div>

                            <!-- <div class="form-group">
                                <label for="repititions">Repitions</label>
                                <number-input v-model="repititions" id="repititions" :min="1" controls></number-input>
                            </div> -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-success" @click="calculateOneRepMax" :disabled="lift === 0">Calculate</button>
                            </div>
                        </form>
                    </div>
                </div>

                <table class="table table-hover" v-show="clicked">
                    <thead>
                        <tr>
                            <th scope="col">Percentage of 1RM</th>
                            <th scope="col">Lift Weight	</th>
                            <th scope="col">Repetitions of 1RM</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(data, index) in percentageAndRepitions">
                            <th scope="row">{{ data.percentage }} %</th>
                            <td>{{ data.lift }} {{liftTypeSelected}}</td>
                            <td>{{ data.oneRepMax }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</template>

<script>
    export default{
        data() {
            return {
                liftType: [
                    'kg', 'lb'
                ],
                liftTypeSelected: '',
                lift: 0,
                clicked: false,
                percentageOfOneRepMax: 105,
                repititions: 0,
                percentages: ['100', '95', '90', '85', '80', '75', '70', '65', '60', '55', '50'],
                percentageAndRepitions: [
                    { percentage: 100, oneRepMax: 1 },
                    { percentage: 95, oneRepMax: 2},
                    { percentage: 90, oneRepMax: 4},
                    { percentage: 85, oneRepMax: 6},
                    { percentage: 80, oneRepMax: 8},
                    { percentage: 75, oneRepMax: 10},
                    { percentage: 70, oneRepMax: 12},
                    { percentage: 65, oneRepMax: 16},
                    { percentage: 60, oneRepMax: 20},
                    { percentage: 55, oneRepMax: 24},
                    { percentage: 50, oneRepMax: 30}
                ]
            }
        },
        methods: {
            calculateOneRepMax(e){
                e.preventDefault();
                this.clicked = true;

                let tempLift = parseInt(this.lift) + 10;

                this.percentageAndRepitions.forEach(element => {
                    element.lift = tempLift = tempLift - 10;
                });
            }
        },
        computed: {
            liftCalculated() {
                let result = [];


            }
        }
    }
</script>
