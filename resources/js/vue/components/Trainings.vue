<template>
    <div>
        <h1>Trainings</h1>
        <div class="row">
            <div class="col-12 ">
                <div class="card card-info card-outline ">
                    <div class="card-header">
                        <h3 class="card-title">Upcoming Trainings</h3>
                        <div class="card-tools">
                            <button class="btn btn-success bg-success" @click="showCreateTrainingsModal"> Add Training</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th>Team Name</th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>End time</th>
                                    <th>Training field</th>
                                    <th>Wardrobe</th>
                                    <th>Attendance</th>
                                    <th>Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="training in trainings" v-bind:key="training.id">
                                    <td>{{ training.team.name }}</td>
                                    <td>{{ training.date | regDate }}</td>
                                    <td>{{ training.start_time }}</td>
                                    <td>{{ training.end_time }}</td>
                                    <td>{{ training.field.title }}</td>
                                    <td>{{ training.wardrobe.title }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-success" @click="addAttendance(training.id)"><i class="fa fa-plus" ></i></button>
                                        </div>
                                        
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-info bg-info" @click="editTraining(training.id)"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-danger" @click="deleteTraining(training.id)"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                    
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- Modal  -->
        <div class="modal fade" id="addTraining" tabindex="-1" role="dialog" aria-labelledby="addTraining"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTraining">Add Training</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="createTraining">
                            <div class="modal-body">
                                <div class="form-group">
                                    <select v-model="training.team_id" type="type" name="type" id="type" class="form-control">
                                     <option disabled selected value="">Select Team</option>
                                    <option  v-for="team in teams" v-bind:key="team.id" v-bind:value="team.id">{{team.name}}</option>
                                </select>
                                </div>
                                <div class="form-group">
                                    <picker label="Date" only-date v-model="training.date" format="YYYY-MM-DD" formatted="DD/MM/YYYY"></picker>
                                </div>
                                <div class="form-group">
                                    <picker label="Start Time" only-time v-model="training.start_time" format="HH:MM:SS" formatted="HH:mm "></picker>
                                </div>
                                <div class="form-group">
                                    <picker label="End Time" only-time v-model="training.end_time" format="HH:MM:SS" formatted="HH:mm "></picker>
                                </div>
                                <div class="form-group">
                                <select v-model="training.field_id" type="type" name="type" id="type" class="form-control">
                                    <option disabled selected value="">Select Field</option>
                                    <option  v-for="field in fields" v-bind:key="field.id" v-bind:value="field.id">{{field.title}}</option>
                                </select>
                                </div>
                                <div class="form-group">
                                    <select v-model="training.wardrobe_id" type="type" name="type" id="type" class="form-control">
                                     <option disabled selected value="">Select Wardrobe</option>
                                    <option v-for="wardrobe in wardrobes" 
                                            v-bind:key="wardrobe.id" 
                                            v-bind:value="wardrobe.id">
                                        {{wardrobe.title}}</option>
                                </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Create</button>
                            </div>
                        </form>
                    
                </div>
            </div>
        </div>

        <!-- Attendance Modal  -->

        <div class="modal fade" id="addAttendance" tabindex="-1" role="dialog" aria-labelledby="addAttendance"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAttendance">Add Players to Training</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="createTrainingAttendance">
                            <div class="modal-body">
                                <div class="form-check">
                                    <div class="list-group" v-for="member in members" v-bind:key="member.id">
                                        <input class="form-check-input" type="checkbox" :value="member.id"
                                            v-model="attendance.members">
                                        <label class="form-check-label">{{member.membership.user.name}}</label>
                                    </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Create</button>
                            </div>
                        </form>
                    
                </div>
            </div>
        </div>

        <!-- Edit Training Modal  -->

        <div class="modal  fade" id="editTrainingModal" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header card-primary card-outline">
                        <h5 class="modal-title">Edit Training </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateTraining">
                             <div class="modal-body">
                                <div class="form-group">
                                    <select v-model="training.team_id" type="type" name="type" id="type" class="form-control">
                                     <option disabled selected value="">Select Team</option>
                                    <option  v-for="team in teams" v-bind:key="team.id" v-bind:value="team.id">{{team.name}}</option>
                                </select>
                                </div>
                                <div class="form-group">
                                    <picker label="Date" only-date v-model="training.date" format="YYYY-MM-DD" formatted="DD/MM/YYYY"></picker>
                                </div>
                                <div class="form-group">
                                    <picker label="Start Time" only-time v-model="training.start_time" format="HH:MM:SS" formatted="HH:mm "></picker>
                                </div>
                                <div class="form-group">
                                    <picker label="End Time" only-time v-model="training.end_time" format="HH:MM:SS" formatted="HH:mm "></picker>
                                </div>
                                <div class="form-group">
                                    <select v-model="training.field_id" type="type" name="type" id="type" class="form-control">
                                    <option disabled selected value="">Select Field</option>
                                    <option  v-for="field in fields" v-bind:key="field.id" v-bind:value="field.id">{{field.title}}</option>

                                </select>
                                </div>
                                <div class="form-group">
                                    <select v-model="training.wardrobe_id" type="type" name="type" id="type" class="form-control">
                                     <option disabled selected value="">Select Wardrobe</option>
                                    <option  v-for="wardrobe in wardrobes" v-bind:key="wardrobe.id" v-bind:value="wardrobe.id">{{wardrobe.title}}</option>
                                </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" >Close</button>
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
    import picker from 'vue-ctk-date-time-picker';
    import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';

    export default {

        components: {
            picker
        },

        data() {
            return {
                training: {
                    team_id: '',
                    date: '',
                    start_time: '',
                    end_time: '',
                    field_id: '',
                    wardrobe_id: '',
                },
                attendance: {
                    training_id: '',
                    members: []
                }
            }
        },

        computed: {
            teams() {
                return this.$store.state.teams
            },
            trainings() {
                return this.$store.state.trainings
            },
            members() {
                return this.$store.state.members
            },
            fields() {
                return this.$store.state.fields
            },
            wardrobes() {
                return this.$store.state.wardrobes
            }
        },

        methods: {
            showCreateTrainingsModal() {
                $('#addTraining').modal('show')
            },
            addAttendance(trainingId) {
                $('#addAttendance').modal('show')
                this.attendance.training_id = trainingId;
            },
            hideModal() {
                $('#addAttendance').modal('hide')
                $('#addTraining').modal('hide')
                $('#editTrainingModal').modal('hide');
                this.training = {};
            },
            editTraining(trainingId) {
                $('#editTrainingModal').modal('show');
                var training = this.trainings.find(training => {
                    return training.id == trainingId;
                });
                this.training = { ...training };
            },
            createTraining() {
                this.$store.dispatch('createTraining', this.training)
                            .then(res => this.hideModal());
            },
            deleteTraining(trainingId) {
                this.$store.dispatch('deleteTraining', trainingId)
                            .then(res => console.log('training deleted'));
            },
            updateTraining(){
                this.$store.dispatch('updateTraining', this.training)
                            .then(res => this.hideModal());
            },
            createTrainingAttendance() {
                this.$store.dispatch('createTrainingAttendance', this.attendance)
                            .then(res => this.hideModal());
            }
        },
        
        

    }

</script>
